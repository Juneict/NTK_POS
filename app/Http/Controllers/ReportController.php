<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(){

        // $creditlists = Order::


        $creditlists =Order::select('customer_name','status as order_status','orders.created_at',DB::raw("group_concat(order_items.name) as items"),DB::raw('sum(order_items.price) as total_amount'),'payments.amount as received_amount')
        ->leftjoin('order_items','orders.id','=','order_items.order_id')
        ->leftjoin('customers','orders.customer_id', '=', 'customers.id')
        ->leftjoin('payments', 'orders.id', '=', 'payments.order_id')
        ->groupBy('status', 'customers.customer_name', 'payments.amount','created_at')
        ->where('status','=','partial')
        ->orwhere('status','=','no paid')
        ->get();
       
        return view('reports.credit',compact('creditlists'));
    }
}
