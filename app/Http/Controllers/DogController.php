<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DogController extends Controller
{
    

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['role:admin|breeder'])->only(['create','store','destroy']);
    }


    public function create(){
        if(auth()->user()->roles->pluck('name')[0]=="admin"){
           $dogs=Dog::latest()->get(); 
        }
        else{
            $dogs=Dog::where('user_id',auth()->user()->id)->latest()->get();
        }
        $categories=Category::all();
        return view('backend.breeder.add-dog',compact('dogs','categories'));
    }


 public function store(Request $request){
    $validate=Validator::make($request->all(),[
        'name' => ['required','string'],
        'price'=>['required','string'],
        'petid'=>['required','string'],
        'category_id'=>['required','string'],
        'gender'=>['required','string'],
        'dob'=>['required','string'],
        'age'=>['required','string'],
        'health_status'=>['required'],
        'healthy'=>['required'],
        'medication'=>['required'],
        'image'=>'required|image|mimes:jpg,jpeg,png|max:2048',
       ], 
);

if($validate->fails()){
  toast($validate->errors()->first(),'info');
  return back()->withErrors($validate)->withInput();
}

$image=$request->file('image');
$image_name=$image->getClientOriginalName();
$destinationPath=public_path('/dog_images');
$image->move($destinationPath,$image_name);

  $user_id=auth()->user()->id;
  $validated = $validate->validated();
  $validated['user_id']=$user_id;
  $validated['image']=$image_name;
  $validated['last_breeding_date']=$request->dob;
  $validated['last_visit_date']=$request->dob;

  $dog=Dog::create($validated);

  if($dog){
    toast('Dog Added Successfully','success');
    return back();
  }
toast('Fail to add dog','info');
return back();
 }

 public function show($id){
    $id=substr($id,10);
   $dog=Dog::where('id',$id)->first();
    $categories=Category::all();
    return view('backend.breeder.edit-dog',compact('dog','categories'));
}

public function edit(Request $request){
    $validate=Validator::make($request->all(),[
        'name' => ['required','string'],
        'price'=>['required','string'],
        'petid'=>['required','string'],
        'category_id'=>['required','string'],
        'gender'=>['required','string'],
        'dob'=>['required','string'],
        'age'=>['required','string'],
        'health_status'=>['required'],
        'healthy'=>['required'],
        'medication'=>['required'],
        'id'=>['required'],
       ], 
);

if($validate->fails()){
  toast($validate->errors()->first(),'info');
  return back()->withErrors($validate)->withInput();
}

$user_id=auth()->user()->id;
  $validated = $validate->validated();

if($request->hasFile('image')){
$image=$request->file('image');
$image_name=$image->getClientOriginalName();
$destinationPath=public_path('/dog_images');
$image->move($destinationPath,$image_name);
$validated['image']=$image_name;
}

  
 unset($validated['user_id']) ;
 unset($validated['id']) ;
 $validated['last_breeding_date']=$request->dob;
 $validated['last_visit_date']=$request->dob;

  $dog=Dog::where('id',$request->id)->update($validated);

  if($dog){
    toast('Dog Updated Successfully','success');
    return redirect()->route('dogs');
  }
toast('Fail to update dog','info');
return redirect()->route('dogs');
 }


 public function destroy(Request $request){
    $dog=Dog::findorFail($request->id);
    $dog->delete();
    toast('Dog Record Deleted','success');
    return back();
 }

}
