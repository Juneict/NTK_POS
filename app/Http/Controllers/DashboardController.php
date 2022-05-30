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

        $purchases = (object)[];
        $purchases->total_purchase = $this->calculate_purchase();
        $purchases->today_purchase = $this->calculate_purchase(true, '', '');
        $purchases->this_month_purchase = $this->calculate_purchase('', true, '');
        $purchases->this_year_purchase = $this->calculate_purchase('', '', true);
        

        $products = Product::where('stock','<','5')->get();

        return view('dashboard.index',compact('products', 'purchases'));
    }



    public function calculate_purchase($today = '', $month = '', $year = '')
    {
        
        $purchase = Product::select(DB::raw('sum(purchase_price * stock) as price'))
                            ->where('deleted', 0);

        if($today)
        {
            $purchase->whereDate('updated_at', Carbon::today());
        }

        if($month)
        {
            $purchase->whereMonth('updated_at', date('m'))
                    ->whereYear('updated_at', date('Y'));
        }

        if($year)
        {
            $purchase->whereBetween('updated_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ]);
            
        }

        return $purchase->first()->price;
    }


    public function sale()
    {

    }

}
