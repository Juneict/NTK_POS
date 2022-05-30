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

        Customer::firstOrCreate(
            ['customer_name' => 'Walk-In Customer'],
            ['is_customer' => 0]
        );

        Brand::firstOrCreate(
            ['name' => 'default'],
            ['description' => 'Default brand to use for no brand items.']
        );


        $order_count=DB::table('orders')->count();
        $payments = DB::table('payments')->get();
        $dailypayments = DB::table('payments')->whereDate('created_at', Carbon::today())->get();
        
        $customerCount =DB::table('customers')->count();


        $products = Product::where('stock','<','5')->get();

        return view('dashboard.index',compact('order_count','payments','dailypayments','customerCount','products'));
    }

    public function calculate_purchase()
    {
        
    }
}
