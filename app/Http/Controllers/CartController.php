<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $customers = Customer::all();
        $products = Product::all();
        return view('Cart.index',compact('products','customers'));
    }
}
