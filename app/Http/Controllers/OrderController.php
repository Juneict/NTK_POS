<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CartController;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {  
        $orders =Order::select('customer_name','orders.id as order_id','orders.created_at',DB::raw("group_concat(order_items.name) as items"),DB::raw('sum(order_items.price) as total_amount'),'payments.amount as received_amount')
        ->leftjoin('order_items','orders.id','=','order_items.order_id')
        ->leftjoin('customers','orders.customer_id', '=', 'customers.id')
        ->leftjoin('payments', 'orders.id', '=', 'payments.order_id')
        ->groupBy('orders.id', 'customers.customer_name', 'payments.amount','created_at')->get();  
         
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->authorize('order_crud');

        // some changes
        try {    

            $user_id = $req->user()->id;
        
            $order = Order::create([
                'customer_id' => $req->customer_id,
                'user_id' => $user_id
            ]);

    
            $items = array();
            for($i = 0; $i < count($req->product_id); $i++)
            {
                $tmp = [
                    'name' => $req->item_name[$i],
                    'price' => $req->item_price[$i],
                    'quantity' => $req->quantity[$i],
                    'order_id' => $order->id,
                    'product_id' => $req->product_id[$i]
                ];
                array_push($items, $tmp);
            }
    
            $result = OrderItem::insert($items);

            
    
            for($i = 0; $i < count($req->product_id); $i++)
            {
                $product = Product::find($req->product_id[$i]);
                $currentStock = $product->stock;
                $updatedStock = $currentStock - $req->quantity[$i];
                $product->stock = $updatedStock;
                $product->save();
            }

            $total_price = (int)$order->total();
            $payment_status = $this->calcStatus($total_price, (int)$req->payment_amount);

            $payment = Payment::insert([
                'amount' => $req->payment_amount,
                'order_id' => $order->id,
                'customer_id' => $req->customer_id,
                'status' => $payment_status
            ]);
            
            return redirect()->back()->with('success', 'Payment success.');

          } catch (\Exception $e) {
            $e->getMessage();
          }
    }

    public function calcStatus($price, $amount)
    {
        if($amount == 0) return('no paid');
        if($amount == $price) return('paid');
        if($amount < $price) return('partial');
        if($amount > $price) return('change');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $order;
        return view('orders.detail',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
    
        $this->authorize('order_crud');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $this->authorize('order_crud');
        
        $total_price = Order::where('id', $order->id)->first()->total();
        $payment = Payment::where('order_id', $order->id)->first();
        $payment->amount += (int)$request->amount;

        $payment_status = $this->calcStatus($total_price, $payment->amount);
        $payment->status = $payment_status;
        $payment->save();

        return redirect()->back()->with('success', 'Payment updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('order_crud');
        //
    }
}
