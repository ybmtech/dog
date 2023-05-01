<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\AwaitingBreedController;
use App\Http\Controllers\BreedingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Models\Dog;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $dogs=Dog::where('health_status','yes')->latest()->get();
    return view('frontpage.index',compact('dogs'));
})->name('index');

Route::get('/about', function () {
    return view('frontpage.about');
})->name('about');

Route::get('/buy/{id}',[OrderController::class,'buy'])->name('buy');

Route::post('/add-cart',[OrderController::class,'addCart'])->name('add.cart');

Route::get('/carts',[OrderController::class,'cartList'])->name('cart');

Route::delete('/remove-cart',[OrderController::class,'removeCart'])->name('cart.remove');

Route::get('/contact', function () {
    return view('frontpage.contact');
})->name('contact');

Route::get('/store',[OrderController::class,'create'])->name('store');


 //paytack callback
 Route::get('/paystack-callback',[OrderController::class,'paystackCallback'])->name('paystack.callback');
 Route::get('/breeding-payment-verify',[BreedingController::class,'paystackCallback'])->name('reward.fee.payment.verify');

Route::group(['prefix'=>'auth'],function(){

    Route::get('/login',[AuthenticatedSessionController::class,'create'])->name('login');
    Route::post('/login',[AuthenticatedSessionController::class,'store'])->name('login.store');

    Route::get('/register',[UserController::class,'register'])->name('register');

    Route::post('/register',[UserController::class,'store'])->name('user.register');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');
});

Route::middleware('auth')->group(function () {
    //logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::group(['prefix'=>'admin','middleware'=>['role:admin']],function(){

    Route::get('/dashboard',[DashboardController::class,'adminDashboard'])->name('admin.dashboard');
    
    //user
    Route::get('/user',[UserController::class,'create'])->name('users');

    Route::post('/user',[UserController::class,'add'])->name('user.store');

    Route::get('/edit-user/{id}',[UserController::class,'show'])->name('user.show');

    Route::put('/update-user',[UserController::class,'edit'])->name('user.edit');

    Route::delete('/delete-user',[UserController::class,'destroy'])->name('user.delete');

    //category
    Route::get('/categories',[CategoryController::class,'create'])->name('categories');

    Route::post('/categories',[CategoryController::class,'store'])->name('category.store');

    Route::get('/edit-category/{id}',[CategoryController::class,'show'])->name('category.show');

    Route::put('/update-category',[CategoryController::class,'edit'])->name('category.edit');

    Route::delete('/delete-category',[CategoryController::class,'destroy'])->name('category.delete');

    Route::get('/order-history',[AdminOrderController::class,'orderHistory'])->name('admin.order');
    Route::get('/order-detail/{invoice_no}',[AdminOrderController::class,'orderItem'])->name('admin.order.item');
    Route::delete('/cancel-order',[AdminOrderController::class,'orderCancel'])->name('admin.order.cancel');
    Route::put('/order-fee',[AdminOrderController::class,'setFee'])->name('admin.order.fee');
    Route::put('/order-status',[AdminOrderController::class,'orderStatus'])->name('admin.order.status');
    Route::get('/payment-history',[AdminOrderController::class,'paymentHistory'])->name('admin.payment.history');
  
});

Route::group(['prefix'=>'breeder','middleware'=>['role:breeder']],function(){
    Route::get('/dashboard',[DashboardController::class,'breederDashboard'])->name('breeder.dashboard');
       Route::view('/guide','backend.breeder.guide')->name('guide'); 
    Route::get('/orders',[AdminOrderController::class,'breederOrder'])->name('breeder.order');
  
});

Route::group(['prefix'=>'client'],function(){
    Route::get('/dashboard',[DashboardController::class,'clientDashboard'])->name('client.dashboard');
    Route::post('/save-order',[OrderController::class,'saveOrder'])->name('order.save');
    Route::get('/order-items/{invoice_no}',[OrderController::class,'orderItem'])->name('order.items');
    Route::delete('/cancel-order',[OrderController::class,'orderCancel'])->name('order.cancel');
    Route::post('/order-payment',[OrderController::class,'handlePaymentGateway'])->name('order.payment');
    Route::get('/order-history',[OrderController::class,'orderHistory'])->name('order.client.history');

});

Route::group(['prefix'=>'','middleware'=>['role:admin|breeder']],function(){

    Route::get('/dogs',[DogController::class,'create'])->name('dogs');

    Route::post('/dogs',[DogController::class,'store'])->name('dog.store');

    Route::get('/edit-dog/{id}',[DogController::class,'show'])->name('dog.show');

    Route::put('/update-dog',[DogController::class,'edit'])->name('dog.edit');

    Route::delete('/delete-dog',[DogController::class,'destroy'])->name('dog.delete');

    Route::put('/dog-visited',[DashboardController::class,'visitDoctor'])->name('dog.visited');
    Route::put('/dog-breed-process',[AwaitingBreedController::class,'process'])->name('dog.breed.process');
    Route::get('/breeding',[AwaitingBreedController::class,'create'])->name('breeding');
    Route::post('/breeding',[BreedingController::class,'breed'])->name('breed');
    Route::get('/breed-history',[BreedingController::class,'breedHistory'])->name('breed.history');
    Route::put('/breed-action',[BreedingController::class,'breedAction'])->name('breed.action');
    Route::put('/breed-reward-fulfil',[BreedingController::class,'rewardFulfil'])->name('reward.fulfil');
    Route::put('/breed-reward-fee',[BreedingController::class,'setFee'])->name('reward.fee');
    Route::get('/breeding-payment/{id}',[BreedingController::class,'handlePaymentGateway'])->name('reward.fee.payment');
   

});

});