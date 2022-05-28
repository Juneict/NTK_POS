<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        $customer = Customer::firstOrCreate(['customer_name' => 'Walk-In Customer']);
        $brand = Brand::firstOrCreate(['name' => 'Default Brand']);
        
        $order_count=DB::table('orders')->count();
        $payments = DB::table('payments')->get();
        $dailypayments = DB::table('payments')->whereDate('created_at', Carbon::today())->get();
        
        $customerCount =DB::table('customers')->count();
        $products = Product::where('stock','<','5')->get();
        
        return view('dashboard.index',compact('order_count','payments','dailypayments','customerCount','products'));
    }
}
