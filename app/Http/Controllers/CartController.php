<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $customers = Customer::all();
        $products = Product::all();
        $productlists = Product::latest()->paginate(20);
        return view('Cart.index',compact('products','customers','productlists'));
    }
}
