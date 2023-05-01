<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentHistory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
class OrderController extends Controller
{

    public function __construct()
    {
      $this->middleware(['auth','role:client'])->only(['saveOrder','handlePaymentGateway','orderHistory','orderCancel','orderItem']);
     }
    
    public function create(){
       $dogs=Dog::where('health_status','yes')->where('quantity','1')->latest()->get();
        return view('frontpage.store',compact('dogs'));
    }

    public function orderHistory(){
      $orders=Order::where('user_id',auth()->user()->id)->latest()->get();
       return view('backend.client.orders',compact('orders'));
   }

   public function orderItem($invoice_no){
    $orders=Order::where('invoice_no',$invoice_no)->first();
     return view('backend.client.order-details',compact('orders'));
 }

   public function orderCancel(Request $request){
    $validate=Validator::make($request->all(),[
      'id' => ['required'],
     ], 
);

if($validate->fails()){
  toast($validate->errors()->first(),'info');
return back()->withErrors($validate)->withInput();
}
    $orders=Order::findOrFail($request->id);
    $order_items=$orders->order_items;
    foreach($order_items as $item){
      Dog::where('id',$item->dog_id)->update([
        'quantity'=>1
      ]);
    }
    $orders->status="cancelled";
    $orders->save();
    toast('Order Cancelled','success');
    return redirect()->route('order.client.history');
 }

    public function buy($id){
        $id=substr($id,10);
        $dog=Dog::where('id',$id)->firstOrFail();
        return view('frontpage.buy',compact('dog'));
    }

  
      public function addCart(Request $request){
       $dog=Dog::findOrFail($request->dog_id);
      
          \Cart::add([
           'id'=>$dog->id,
           'name'=>ucwords($dog->name),
           'price'=>$dog->price,
           'quantity'=>1,
           'attributes' => array(
               'image' => $dog->image,
           )
          ]);
          toast('Item added cart','success');
          return redirect()->route('cart');
      }
   
   
      public function cartList(){
       $carts = \Cart::getContent();
       $total=\Cart::getTotal();
       return view('frontpage.cart',compact('carts','total'));
      }
   
      public function removeCart(Request $request)
      {
          \Cart::remove($request->id);
          toast('Item removed from cart','success');
          return redirect()->route('cart');
      }

      public function saveOrder(Request $request){
       
        $validate=Validator::make($request->all(),[
            'address' => ['required','string'],
           ], 
    );

    if($validate->fails()){
        toast($validate->errors()->first(),'info');
      return back()->withErrors($validate)->withInput();
    }
    $carts = \Cart::getContent();
    $previous_order=Order::orderBy('id','desc')->first();
    $invoice_start=1000;
    
    if(is_null($previous_order)){
      $invoice_no=$invoice_start;
    }
    else{
      $invoice_no=$previous_order->invoice_no + 1;
    }
  
    $total=\Cart::getTotal();
    
       $order=Order::create(
        [
            'invoice_no'=>$invoice_no,
            'user_id'=>auth()->user()->id,
            'total'=>$total,
            'payment_status'=>'not paid',
            'delivery_address'=>$request->address,
        ]
    );
    
    
    foreach($carts as $cart){
      $dog=Dog::find($cart->id);
        OrderItem::create(
            [
                'order_id'=>$order->id,
                'dog_id'=>$cart->id,
                'user_id'=>$dog->user_id,
                'quantity'=>$cart->quantity,
                'price'=>$cart->price
            ]
        );
        
        $dog->quantity=$dog->quantity - $cart->quantity;
        $dog->save();
    }
    
    \Cart::clear();
    toast('Order Saved','success');
    return redirect()->route('order.client.history');
     }

      public function handlePaymentGateway(Request $request){
        $validate=Validator::make($request->all(),[
          'invoice_no' => ['required'],
         ], 
    );
    
    if($validate->fails()){
      toast($validate->errors()->first(),'info');
    return back()->withErrors($validate)->withInput();
    }
      $order=Order::where('invoice_no',$request->invoice_no)->firstOrFail();
      $email=auth()->user()->email;
      $id=auth()->user()->id;
      $amount_with_fee=$order['delivery_fee'] + $order['total'];
      $amount=$amount_with_fee * 100;
      $reference=time().random_int(9,9999);
      $redirect=url('paystack-callback');
      
       $url = "https://api.paystack.co/transaction/initialize";
        $token=config('app.paystack');
      
    try{
        $response = Http::withToken($token)->withHeaders([
          'accept' => 'application/json'
      ])->post($url, 
      [
        'email' =>$email,
        'amount' =>$amount,
      'reference' =>$reference,
      'callback_url'=>$redirect,
      'channels'=>['card'],
      'metadata'=>json_encode([
        'invoice_no'=>$request->invoice_no,
        'user_id'=>$id
      ])
      ]);
    
      if($response->status()==200){
        return redirect($response['data']['authorization_url']);
      }
      toast('Payment fail try again later','info');
      return back();
     
    
    }
    catch(Exception $e){
        toast('Please connect to internet','info');
        return back();
       
    }
      }

      public function paystackCallback(Request $request){
        $validate=Validator::make($request->all(),[
            'reference'=>'required',
        ]
        );

        if($validate->fails()){
            toast($validate->errors()->first(),'info');
            return back();
          }

        $url = "https://api.paystack.co/transaction/verify/" . rawurlencode($request->reference);
        $token=config('app.paystack');
        
        try{
          $response = Http::withToken($token)->withHeaders([
          'accept' => 'application/json'
      ])->get($url);

      if($response->status()==200){
        if('success' == $response['data']['status']){
          $amount=$response['data']['amount'];
      $reference_id=$response['data']['reference'];
      $user_id=$response['data']['metadata']['user_id'];
    $invoice_no=$response['data']['metadata']['invoice_no'];
        }   
        
    $update_order=Order::where('invoice_no',$invoice_no)->update(['payment_status'=>'paid']);
   
    PaymentHistory::create(
      [
        'user_id'=>$user_id,
        'reference_no'=> $reference_id,
        'type'=>'order',
        'amount'=> $amount/100,
    ]
    );
    toast('Payment was successful','success');
  
    return back();  

    }
          }
          catch(Exception $e){
            toast('Payment verification fail','success');
           
            return back();  
        }
    }


}
