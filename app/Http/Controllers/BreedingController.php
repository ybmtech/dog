<?php

namespace App\Http\Controllers;

use App\Models\AwaitingBreed;
use App\Models\Breeding;
use App\Models\Dog;
use App\Models\PaymentHistory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class BreedingController extends Controller
{
    public function __construct()
    {
    $this->middleware(['auth','role:admin|breeder'])->except('paystackCallback');
    }

    public function breed(Request $request){
        $validate=Validator::make($request->all(),[
            'mine' => ['required'],
            'other' => ['required'],
            'reward'=>['required']
           ], 
         
      );
      
      if($validate->fails()){
        toast($validate->errors()->first(),'info');
      return back()->withErrors($validate)->withInput();
      }

$awaiting_male=AwaitingBreed::find($request->mine);
$awaiting_male->breed="yes";
$awaiting_male->save();
$awaiting_female=AwaitingBreed::find($request->other);
$awaiting_female->breed="yes";
$awaiting_female->save();
      Breeding::create([
        'first_dog_id'=>$awaiting_male->dog_id,
        'second_dog_id'=>$awaiting_female->dog_id,
        'fdog_user_id'=>$awaiting_male->user_id,
        'sdog_user_id'=>$awaiting_female->user_id,
        'reward'=>$request->reward,
    ]);
    
    toast('Done','success');
    return back();
    }

    public function breedHistory(){
        $histories=Breeding::where('fdog_user_id',auth()->user()->id)->orWhere('sdog_user_id',auth()->user()->id)->latest()->get();
         return view('backend.breeder.breed-history',compact('histories'));
      }

      public function breedAction(Request $request){
        $validate=Validator::make($request->all(),[
          'id' => ['required'],
          'status' => ['required'],
         ], 
    );
    
    if($validate->fails()){
      toast($validate->errors()->first(),'info');
    return back()->withErrors($validate)->withInput();
    }
        $breed=Breeding::findOrFail($request->id);
        $breed->status=$request->status;
        $breed->save();

        if($request->status=="accept"){
Dog::where('id',$breed->first_dog_id)->update([
      'last_breeding_date'=>now()
    ]);
    Dog::where('id',$breed->second_dog_id)->update([
        'last_breeding_date'=>now()
      ]);
        }
        toast('Done','success');
        return back();
     }

     public function rewardFulfil(Request $request){
      $validate=Validator::make($request->all(),[
        'id' => ['required'],
       ], 
  );
  
  if($validate->fails()){
    toast($validate->errors()->first(),'info');
  return back()->withErrors($validate)->withInput();
  }
      $breed=Breeding::findOrFail($request->id);
      $breed->reward_status="fulfilled";
      $breed->save();

      toast('Done','success');
      return back();
   }

   public function setFee(Request $request){
    $validate=Validator::make($request->all(),[
      'id' => ['required'],
      'fee' => ['required'],
     ], 
);

if($validate->fails()){
  toast($validate->errors()->first(),'info');
return back()->withErrors($validate)->withInput();
}
    $breed=Breeding::findOrFail($request->id);
    $breed->amount=$request->fee;
    $breed->save();

    toast('Done','success');
    return back();
 }

 public function handlePaymentGateway($id){
  $id=substr($id,10);

$breed=Breeding::findOrFail($id);
$email=auth()->user()->email;
$user_id=auth()->user()->id;
$amount_with_fee=$breed['amount'];
$amount=$amount_with_fee * 100;
$reference=time().random_int(9,9999);
$redirect=url('breeding-payment-verify');

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
  'breed_id'=>$id,
  'user_id'=>$user_id
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
    $amount=$response['data']['amount'] / 100;
$reference_id=$response['data']['reference'];
$user_id=$response['data']['metadata']['user_id'];
$breed_id=$response['data']['metadata']['breed_id'];
  }   
  
$update_breed=Breeding::where('id',$breed_id)->update(['amount_paid'=>$amount]);

PaymentHistory::create(
[
  'user_id'=>$user_id,
  'reference_no'=> $reference_id,
  'type'=>'breed reward',
  'amount'=> $amount,
]
);
toast('Payment was successful','success');

return redirect()->route('breed.history');  

}
    }
    catch(Exception $e){
      toast('Payment verification fail','success');
     
      return back();  
  }
}


}
