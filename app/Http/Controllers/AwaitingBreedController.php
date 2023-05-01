<?php

namespace App\Http\Controllers;

use App\Models\AwaitingBreed;
use App\Models\Breeding;
use App\Models\Dog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AwaitingBreedController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth']);
    $this->middleware(['role:admin|breeder']);
    }


    public function create(){
        $awaitings=AwaitingBreed::where('user_id','!=',auth()->user()->id)->where('breed','no')->get();
        $my_awaitings=AwaitingBreed::where('user_id',auth()->user()->id)->where('breed','no')->get();
        $collect_wait=collect($awaitings);
        $collect_my_wait=collect($my_awaitings);
        $males=$collect_my_wait->filter(function($value){
          return $value->gender=="male";
        });
        $females=$collect_my_wait->filter(function($value){
            return $value->gender=="female";
          });

          $other_males=$collect_wait->filter(function($value){
            return $value->gender=="male";
          });
          $other_females=$collect_wait->filter(function($value){
              return $value->gender=="female";
            });
       
           
        return view('backend.breeder.breeding',compact('males','other_females','other_males','females'));
    }

    
    public function process(Request $request){
        $validate=Validator::make($request->all(),[
            'id' => ['required'],
           ], 
           [
            'id.required'=>'Dog required'
           ]
      );
      
      if($validate->fails()){
        toast($validate->errors()->first(),'info');
      return back()->withErrors($validate)->withInput();
      }

      $dog=Dog::findOrFail($request->id);
      $dog->last_breeding_date=now();
      $dog->save();
      AwaitingBreed::create([
        'user_id'=>auth()->user()->id,
        'dog_id'=>$dog->id,
        'name'=>$dog->name,
        'image'=>$dog->image,
        'gender'=>$dog->gender
      ]);
      toast('Processed','success');
       return back();
       
     }

    

}
