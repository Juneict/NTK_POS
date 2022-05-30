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
        $products = Product::where('status', 1)->where('deleted',0)->get();
        $productlists = Product::where('status', 1)->where('deleted','0')->latest()->paginate(20);
        return view('Cart.index',compact('products','customers','productlists'));
    }
}
