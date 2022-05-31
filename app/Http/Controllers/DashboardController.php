<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Debt;
use App\Models\Payment;
use App\Models\Transaction;
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

        $stats = (object)[];

        $stats->total_purchase = $this->calculate_purchase();
        $stats->today_purchase = $this->calculate_purchase(true, '', '');
        $stats->this_month_purchase = $this->calculate_purchase('', true, '');
        $stats->this_year_purchase = $this->calculate_purchase('', '', true);

        $stats->total_sale = $this->calculate_sale();
        $stats->today_sale = $this->calculate_sale(true, '', '');
        $stats->this_month_sale = $this->calculate_sale('', true, '');
        $stats->this_year_sale = $this->calculate_sale('', '', true);

        $stats->total_due = $this->calculate_total_due();

        // return $this->calculate_due(true, '', '');

        $products = Product::where('stock','<','5')->get();

        return view('dashboard.index',compact('products', 'stats'));
    }


    public function calculate_purchase($today = '', $month = '', $year = '')
    {
        
        $purchase = Product::select(DB::raw('sum(purchase_price * stock) as price'))
                            ->where('deleted', 0);

        if($today)
        {
            $purchase->whereDate('created_at', Carbon::today());
        }

        if($month)
        {
            $purchase->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'));
        }

        if($year)
        {
            $purchase->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ]);
            
        }

        return $purchase->first()->price;
    }


    public function calculate_sale($today = '', $month = '', $year = '')
    {
        $sales = Payment::select(DB::raw('sum(amount) as sales'))
                        ->where('deleted', 0);

        if($today)
        {
            $sales->whereDate('created_at', Carbon::today());
        }

        if($month)
        {
            $sales->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'));
        }

        if($year)
        {
            $sales->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ]);
            
        }

        return $sales->first()->sales;
    }

    
    public function calculate_total_due()
    {
        return Debt::select(DB::raw('sum(total_amount - total_received) as total_due'))->first()->total_due;
    } 



    public function calculate_due($today = '', $month = '', $year = '')
    {

        $res = Payment::leftjoin('order_items', 'order_items.order_id', 'payments.order_id')
                        ->where('payments.deleted', 0)
                        ->where('status', '!=', 'paid');
                        // ->whereDate('payments.updated_at', Carbon::today())->get();


        if($today)
        {
            $res->whereDate('payments.updated_at', Carbon::today());
        }
        
        $res->get();
        return $res;
        
    }

}
