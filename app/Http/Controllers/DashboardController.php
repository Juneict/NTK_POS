<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Debt;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;


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

        // Purchases
        $stats->total_purchase = $this->calculate_purchase();
        $stats->today_purchase = $this->calculate_purchase(true, '', '');
        $stats->this_month_purchase = $this->calculate_purchase('', true, '');
        $stats->this_year_purchase = $this->calculate_purchase('', '', true);

        // Sales
        $stats->total_sale = $this->calculate_sale();
        $stats->today_sale = $this->calculate_sale(true, '', '');
        $stats->this_month_sale = $this->calculate_sale('', true, '');
        $stats->this_year_sale = $this->calculate_sale('', '', true);

        // Dues
        $stats->total_due = $this->calculate_total_due();

        $res = $this->calculate_due(true, '', '');
        $stats->today_due = $res[0];
        $stats->today_due_received = $res[1];

        $res = $this->calculate_due('', true, '');
        $stats->this_month_due = $res[0];
        $stats->this_month_due_received = $res[1];

        $res = $this->calculate_due('', '', true);
        $stats->this_year_due = $res[0];
        $stats->this_year_due_received = $res[1];

        // Profits
        $stats->total_profit = $this->calculate_profit();
        $stats->today_profit = $this->calculate_profit(true, '', '');
        $stats->this_month_profit = $this->calculate_profit('', true, '');
        $stats->this_year_profit = $this->calculate_profit('', '', true);
        
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

        $d = Debt::select(DB::raw('sum(amount) as due_received'))
                    ->leftjoin('transactions', 'debts.id', '=', 'transactions.debt_id')
                    ->where('debt_status', '!=', 'paid')
                    ->where('transactions.deleted', 0);

        if($today)
        {
            $sales->whereDate('created_at', Carbon::today());
            $d->whereDate('transactions.created_at', Carbon::today());
        }

        if($month)
        {
            $sales->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'));

            $d->whereMonth('transactions.created_at', date('m'))
                    ->whereYear('transactions.created_at', date('Y'));
        }

        if($year)
        {
            $sales->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ]);

            $d->whereBetween('transactions.created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ]);
            
        }

        $sales = $sales->first()->sales;
        $debt_received = $d->first()->due_received;
        return $sales + $debt_received;
    }

    
    public function calculate_total_due()
    {
        return Debt::select(DB::raw('sum(total_amount - total_received) as total_due'))->first()->total_due;
    } 


    public function calculate_due($today = '', $month = '', $year = '')
    {
        $due = Order::select(DB::raw('sum(order_price) - sum(amount) as dues'))
                    ->leftjoin('payments', 'orders.id', 'payments.order_id')
                    ->where('orders.deleted', 0)
                    ->where('status', '!=', 'paid');

        // $dr = Transaction::select(DB::raw('sum(amount) as due_received'))
        //                 ->where('deleted', 0);

        $dr = Debt::select(DB::raw('sum(amount) as due_received'))
                ->leftjoin('transactions', 'debts.id', '=', 'transactions.debt_id')
                ->where('debt_status', '!=', 'paid')
                ->where('transactions.deleted', 0);

        if($today)
        {
            $due->whereDate('orders.created_at', Carbon::today());
            $dr->whereDate('transactions.created_at', Carbon::today());
        }

        if($month)
        {
            $due->whereMonth('orders.created_at', date('m'))
                    ->whereYear('orders.created_at', date('Y'));

            $dr->whereMonth('transactions.created_at', date('m'))
                    ->whereYear('transactions.created_at', date('Y'));
        }

        if($year)
        {
            $due->whereBetween('orders.created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ]);

            $dr->whereBetween('transactions.created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ]);
            
        }

        $dues = $due->first()->dues;
        $due_received = $dr->first()->due_received;
        $dues_remain = $dues - $due_received;
        
        return array($dues_remain, $due_received);
    }

    
    public function calculate_profit($today = '', $month = '', $year = '')
    {
        $p = OrderItem::select(DB::raw('sum((products.price - purchase_price) * quantity) as profit'))
                        ->leftjoin('products', 'products.id', '=', 'order_items.product_id')
                        ->where('order_items.deleted', 0)
                        ->where('products.deleted', 0);
        
        if($today)
        {
            $p->whereDate('order_items.created_at', Carbon::today());
        }

        if($month)
        {
            $p->whereMonth('order_items.created_at', date('m'))
                    ->whereYear('order_items.created_at', date('Y'));

        }

        if($year)
        {
            $p->whereBetween('order_items.created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ]);
        }

        return $p->first()->profit;
    }
   
}