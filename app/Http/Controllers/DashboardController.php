<?php

namespace App\Http\Controllers;

use App\Models\Breeding;
use App\Models\Dog;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    
    public function __construct()
    {
       $this->middleware(['auth']);
        $this->middleware(['role:admin'])->only(['adminDashboard']);
        $this->middleware(['role:admin|breeder'])->only(['breederDashboard','visitDoctor']);
        $this->middleware(['role:client'])->only(['clientDashboard']);
    }

    public function adminDashboard(){
        $users=User::count();
        $dogs=Dog::count();
        $orders=Order::count();
        $paid_orders=Order::where('payment_status','paid')->count();
        $order_history=Order::latest()->limit(5)->get();
        $breed_count=Breeding::where('fdog_user_id',auth()->user()->id)->count();
        $admin_breed_count=Breeding::count();
        $vet_dogs=Dog::where('user_id',auth()->user()->id)->whereDate('last_visit_date', '<=', now()->subDays(60)->setTime(0, 0, 0)->toDateTimeString())->latest()->get();
        $breed_dogs=Dog::where('user_id',auth()->user()->id)->whereDate('last_breeding_date', '<=', now()->subYears(1)->setTime(0, 0, 0)->toDateTimeString())->latest()->get();

   return view('backend.admin.index',compact('breed_count','admin_breed_count','vet_dogs','breed_dogs','users','dogs','orders','paid_orders','order_history'));

    }

    public function breederDashboard(){
        $dogs=Dog::where('id',auth()->user()->id)->count();
        $orders=OrderItem::where('user_id',auth()->user()->id)->count();
        $order_history=OrderItem::where('user_id',auth()->user()->id)->latest()->limit(5)->get();
        $vet_dogs=Dog::where('user_id',auth()->user()->id)->whereDate('last_visit_date', '<=', now()->subDays(60)->setTime(0, 0, 0)->toDateTimeString())->latest()->get();
        $breed_dogs=Dog::where('user_id',auth()->user()->id)->whereDate('last_breeding_date', '<=', now()->subYears(1)->setTime(0, 0, 0)->toDateTimeString())->latest()->get();
        $breed_count=Breeding::where('fdog_user_id',auth()->user()->id)->count();
    
        return view('backend.breeder.index',compact('dogs','orders','order_history','vet_dogs','breed_dogs','breed_count'));

         }

         public function clientDashboard(){
            $orders=Order::where('user_id',auth()->user()->id)->latest()->limit(5)->get(); 
            $order=Order::where('user_id',auth()->user()->id)->count(); 
            $paid_order=Order::where('user_id',auth()->user()->id)->where('payment_status','paid')->count(); 
            return view('backend.client.index',compact('orders','order','paid_order'));

             }


             public function visitDoctor(Request $request){
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
              $dog->last_visit_date=now();
              $dog->save();
              toast('Saved','success');
               return back();

             }

             
}
