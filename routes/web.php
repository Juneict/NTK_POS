<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login/owner', [LoginController::class, 'index'])->name('user.login');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/orders', OrderController::class);
    Route::resource('/customers', CustomerController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/users',UserController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/orders/details', [OrderController::class, 'show'])->name('orders.details');
    Route::get('/logout', [LogoutController::class,'perform'])->name('user.logout');
    Route::post('/place-order', [OrderController::class, 'store'])->name('place-order');
});
