<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminOrderController extends Controller
{
    
    public function __construct()
    {
      $this->middleware(['auth','role:admin'])->only(['orderHistory','orderItem','orderCancel','setFee','orderStatus']);
      $this->middleware(['auth','role:breeder'])->only(['breederOrder']);
     }


     public function paymentHistory(){
        $histories=PaymentHistory::latest()->get();
         return view('backend.admin.payment-history',compact('histories'));
     }

     public function orderHistory(){
        $orders=Order::latest()->get();
         return view('backend.admin.orders',compact('orders'));
     }
  
     public function orderItem($invoice_no){
      $orders=Order::where('invoice_no',$invoice_no)->first();
       return view('backend.admin.order-details',compact('orders'));
   }

   public function orderCancel(Request $request){
    $validate=Validator::make($request->all(),[
      'id' => ['required'],
      [
        'id.required'=>'Order required'
       ]
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
    return redirect()->route('admin.order');
 }

 public function orderStatus(Request $request){
    $validate=Validator::make($request->all(),[
      'id' => ['required'],
      'status' => ['required'],
     ], 
);

if($validate->fails()){
  toast($validate->errors()->first(),'info');
return back()->withErrors($validate)->withInput();
}
    $orders=Order::findOrFail($request->id);
    $orders->status=$request->status;
    $orders->save();
    toast('Order Status Changed','success');
    return redirect()->route('admin.order');
 }

 public function setFee(Request $request){
    $validate=Validator::make($request->all(),[
      'id' => ['required'],
      'fee' => ['required'],
     ], 
     [
      'id.required'=>'Order required'
     ]
);

if($validate->fails()){
  toast($validate->errors()->first(),'info');
return back()->withErrors($validate)->withInput();
}
    $orders=Order::findOrFail($request->id);
    $orders->delivery_fee=$request->fee;
    $orders->save();
    toast('Order Fee Set','success');
    return redirect()->route('admin.order');
 }
   public function breederOrder(){
    $orders=OrderItem::where('user_id',auth()->user()->id)->latest()->get();
    return view('backend.breeder.orders',compact('orders'));
   }
     
}
