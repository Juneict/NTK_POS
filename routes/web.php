<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
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

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::resource('/products', ProductController::class);
    Route::resource('/customers', CustomerController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/users',UserController::class);

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::get('/orders/details', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.details');
    Route::get('/logout', [App\Http\Controllers\LogoutController::class,'perform'])->name('logout.perform');

    Route::post('/place-order', [OrderConroller::class, 'store']);
    Route::post('/place-order', [App\Http\Controllers\OrderController::class, 'store'])->name('place-order');
});