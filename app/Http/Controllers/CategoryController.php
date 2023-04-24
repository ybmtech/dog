<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
      /**
     * The class instance
     */
    public function __construct()
    {
       $this->middleware(['auth','role:admin']);
     }

     public function create(){

        $categories=Category::latest()->get();
        return view('backend.admin.category',compact('categories'));
    }

    public function show($id){
        $id=substr($id,10);
        $category=Category::where('id',$id)->firstOrFail();
         return view('backend.admin.edit-category',compact('category'));
     }

     public function store(Request $request){
        $validate=Validator::make($request->all(),[
          'name' => ['required','string','max:200']
         ], 
  );
  
  if($validate->fails()){
    toast($validate->errors()->first(),'info');
    return back()->withErrors($validate)->withInput();
  }
    
     $category=Category::create([
      'name'=>$request->name
     ]);
  
  
     if($category){
     toast('Category Added Successfully','info');
    return back();
      }
      toast('Fail to add category','info');
      return back();
  }

  public function edit(Request $request){
    $validate=Validator::make($request->all(),[
      'id'=>['required'],
      'name' => ['required','string','max:200']
       ], 
       [
        'id.required'=>'Wrong Category'
       ]
);

if($validate->fails()){
toast($validate->errors()->first(),'info');
return back()->withErrors($validate)->withInput();
}


$id=$request->id;

$category=Category::findOrFail($id);

 $update_category=Category::where('id',$id)->update([
  'name'=>$request->name
 ]);


 if($update_category){
toast('Category updated','success');
return redirect()->route('categories');
  }
  toast('Fail to update category','info');
  return redirect()->route('categories');
}

   


/**
   * delete category
   */

   public function destroy(Request $request){

    $validate=Validator::make($request->all(),[
      'id' => ['required'],
         ], 
         [
          'id.required'=>'Wrong category'
         ]
);

if($validate->fails()){
toast($validate->errors()->first(),'info');
return back()->withErrors($validate)->withInput();
}



$category=Category::findOrFail($request->id);

$delete_category=$category->delete();

if($delete_category){
toast('Category Deleted','success');
 return back(); 

}
toast('Fail to delete','info');
return back();

   }


}
