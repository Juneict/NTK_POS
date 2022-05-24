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

        $orders =Order::join('payments', 'orders.id','=','payments.order_id')
                ->join('order_items','orders.id','=','order_items.order_id')
                ->select('orders.*','payments.*','order_items.*')
                ->get();
    
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
            $user_id = auth()->user()->id;
        
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
    
            $payment = Payment::insert([
                'amount' => $req->payment_amount,
                'order_id' => $order->id,
                'customer_id' => $req->customer_id 
            ]);
           
            return redirect()->back()->with('success', 'Payment success.');

          } catch (\Exception $e) {
            $e->getMessage();
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        
        return view('orders.detail',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $this->authorize('order_crud');
        //
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
