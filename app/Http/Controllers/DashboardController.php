<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        $customer = Customer::firstOrCreate(['customer_name' => 'Walk-In Customer']);

        $order_count=DB::table('orders')->count();
        $payments = DB::table('payments')->get();
        $dailypayments = DB::table('payments')->whereDate('created_at', Carbon::today())->get();
        
        $customerCount =DB::table('customers')->count();
        $products = Product::where('stock','<','5')->get();
        
        return view('dashboard.index',compact('order_count','payments','dailypayments','customerCount','products'));
    }
}
