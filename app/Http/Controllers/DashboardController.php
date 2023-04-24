<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function __construct()
    {
       $this->middleware(['auth']);
        $this->middleware(['role:admin'])->only(['adminDashboard']);
        $this->middleware(['role:breeder'])->only(['breederDashboard']);
        $this->middleware(['role:client'])->only(['clientDashboard']);
    }

    public function adminDashboard(){
        $users=User::count();
        $dogs=Dog::count();
        $orders=Order::count();
        $paid_orders=Order::where('payment_status','paid')->count();
   return view('backend.admin.index',compact('users','dogs','orders','paid_orders'));

    }

    public function breederDashboard(){
        $dogs=Dog::where('id',auth()->user()->id)->count();
        $orders=Order::where('id',auth()->user()->id)->count();
        $paid_orders=Order::where('id',auth()->user()->id)->where('payment_status','paid')->count();
   return view('backend.breeder.index',compact('dogs','orders','paid_orders'));

         }

         public function clientDashboard(){
            
            return view('backend.client.index');

             }

}
