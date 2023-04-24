<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
      /**
     * The class instance
     */
    public function __construct()
    {
       $this->middleware(['auth','role:admin'])->except(['register','store']);
     }

      /**
     * showing users
     */
    public function create(){

        $users=User::latest()->get();
        $roles=Role::all();
        return view('backend.admin.users',compact('users','roles'));
    }

    public function register(){
      return view('register');
  }

  /**
     * showing edit user
     */
   public function show($id){
      $user_id=substr($id,10);
      $user=User::with('roles')->where('id',$user_id)->firstOrFail();
      $roles=Role::all();
       return view('backend.admin.edit-user',compact('user','roles'));
   }


//     /**
//      * showing profile
//      */
//     public function profile(){
      
//     return view('pages.profile');

//      }

    /**
     * register 
     */
    public function store(Request $request){
      $validate=Validator::make($request->all(),[
        'name' => ['required','string','max:200'],
        'phone'=>['required','string','max:20'],
        'user_type'=>['required'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
       'password' => ['required', 'confirmed', Rules\Password::min(8)],
       ], 
);

if($validate->fails()){
  toast($validate->errors()->first(),'info');
  return back()->withErrors($validate)->withInput();
}

$password=Hash::make($request->password);


   $user=User::create([
    'name'=>$request->name,
    'phone'=>$request->phone,
    'email'=>$request->email,
    'password'=>$password
   ]);


   if($user){
  //assign role to user
  $user->assignRole($request->user_type);
  toast('User Registered Successfully','info');
  return back();
    }
    toast('Fail to register user','info');
    return back();
}

/**
     * add user
     */
    public function add(Request $request){
      $validate=Validator::make($request->all(),[
        'name' => ['required','string','max:200'],
        'phone'=>['required','string','max:20'],
        'user_type'=>['required'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
       'password' => ['required', 'confirmed', Rules\Password::min(8)],
       ], 
);

if($validate->fails()){
  toast($validate->errors()->first(),'info');
  return back()->withErrors($validate)->withInput();
}

$password=Hash::make($request->password);


   $user=User::create([
    'name'=>$request->name,
    'phone'=>$request->phone,
    'email'=>$request->email,
    'password'=>$password
   ]);


   if($user){
  //assign role to user
  $user->assignRole($request->user_type);
  toast('User Added Successfully','info');
  return back();
    }
    toast('Fail to add user','info');
    return back();
}

//     public function changePassword(Request $request){

//       $validate=Validator::make($request->all(),[
//         'password' => ['required', 'confirmed', Rules\Password::min(8)],
//            ]
// );

// if($validate->fails()){
//   Alert::info('', $validate->errors()->first());
//   return back()->withErrors($validate)->withInput();
// }


// $user_id=auth()->user()->id;

// $user=User::find($user_id);
// if(is_null($user)){
//    Alert::info('','User not found');
//    return back(); 
// }
// $password=Hash::make($request->password);
// $user->password=$password;
// $user->save();
// if($user){
//    Alert::success('','Password Changed');
//    return back(); 

// }
// Alert::info('','Fail to change password');
// return back();

//      }


     /**
     * edit user
     */
    public function edit(Request $request){
      $validate=Validator::make($request->all(),[
        'id'=>['required'],
        'name' => ['required','string','max:200'],
        'phone'=>['required','string','max:20'],
        'user_type'=>['required','string'],
       'email' => ['required', 'string', 'email', 'max:255'],
         ], 
         [
          'id.required'=>'Wrong User'
         ]
);

if($validate->fails()){
  toast($validate->errors()->first(),'info');
  return back()->withErrors($validate)->withInput();
}


$user_id=$request->id;

$user=User::findOrFail($user_id);

   $update_user=User::where('id',$user_id)->update([
    'name'=>$request->name,
    'phone'=>$request->phone,
    'email'=>$request->email,
   ]);


   if($update_user){
  //sync role to user
  $user->syncRoles([$request->user_type]);
  toast('User record updated','success');
  return redirect()->route('users');
    }
    toast('Fail to update user','info');
    return redirect()->route('users');
}

     


 /**
     * delete user
     */

     public function destroy(Request $request){

      $validate=Validator::make($request->all(),[
        'id' => ['required'],
           ], 
           [
            'id.required'=>'Wrong User'
           ]
);

if($validate->fails()){
  toast($validate->errors()->first(),'info');
  return back()->withErrors($validate)->withInput();
}



$user=User::findOrFail($request->id);

//delete user
$role= $user->getRoleNames()[0];
  $user->removeRole($role);
$delete_user=$user->delete();

if($delete_user){
  toast('User Deleted','success');
   return back(); 

}
toast('Fail to delete','info');
return back();

     }



}
