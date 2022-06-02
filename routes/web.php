<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
	if(!Auth::user()){
		return view('auth.login');
	}else{
		return redirect()->route('dashboard');
	}	
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login/owner', [LoginController::class, 'index'])->name('user.login');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders/invoice/{order}',[OrderController::class,'invoice'])->name('invoice');
    Route::resource('/orders', OrderController::class);
    Route::resource('/customers', CustomerController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/brands', BrandController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/users',UserController::class);
    Route::resource('/credits', ReportController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
   
    // Route::get('/credit',[ReportController::class,'index'])->name('credit');

    Route::get('/logout', [LogoutController::class,'perform'])->name('user.logout');
    Route::post('/place-order', [OrderController::class, 'store'])->name('place-order');
});
