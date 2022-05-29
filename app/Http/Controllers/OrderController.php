<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CartController;
use App\Models\Customer;
use App\Models\Debt;

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
        $orders =Order::select('customer_name','orders.id as order_id','status as order_status','orders.created_at',DB::raw("group_concat(order_items.name) as items"),DB::raw('sum(order_items.price) as total_amount'),'payments.amount as received_amount')
        ->leftjoin('order_items','orders.id','=','order_items.order_id')
        ->leftjoin('customers','orders.customer_id', '=', 'customers.id')
        ->leftjoin('payments', 'orders.id', '=', 'payments.order_id')
        ->groupBy('orders.id','status', 'customers.customer_name', 'payments.amount','created_at')
        ->orderBy('orders.id', 'DESC')->get();
        
      
        
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

        // some changes
        try {    

            
            $req->validate([
                'customer_id' => 'required',
                'product_id' => 'required|array',
                'item_name' => 'required|array',
                'quantity' => 'required|array',
                'item_price' => 'required|array',
                'payment_amount' => 'required',
            ]);
            
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

            if($payment_status != 'paid'){
                
                $this->calculateDebt($req, $order->id);
            }

            
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
    }

    public function calculateDebt($request, $order_id)
    {
        $amount = Payment::where('order_id', $order_id)->first()->amount;
        $price = OrderItem::where('order_id', $order_id)->groupBy('order_id')->sum('price');
        $debt_status = $this->calcStatus($price, $amount);

        $debt = Debt::where('customer_id', $request->customer_id)->where('debt_status', '!=', 'paid')->first();

        if(!$debt)
        {
            Debt::insert([
                'customer_id' => $request->customer_id,
                'total_amount' => $price,
                'total_received' => $amount,
                'debt_status' => $debt_status
            ]);
            
        }
        

        if($debt)
        {
            $updated_price = $debt->total_amount + $price;
            $updated_received = $debt->total_received + $amount;

            $debt->update([
                'total_amount' => $updated_price,
                'total_received' => $updated_received,
                'debt_status' => $debt_status
            ]);
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
       
        $orderdetail = Order::select('order_items.name','order_items.price','order_items.quantity','payments.amount')
                        ->leftjoin('order_items', 'orders.id', '=', 'order_items.order_id')
                        ->leftjoin('products', 'order_items.product_id', '=', 'products.id')
                        ->leftjoin('payments', 'orders.id', '=', 'payments.order_id')
                        ->where('orders.id', $order->id)
                        ->get();
        $total =Order::select(DB::raw('sum(order_items.price) as total_amount'))
                ->leftjoin('order_items','orders.id','=','order_items.order_id')
                ->groupBy('order_items.order_id','order_items.price')
                ->where('orders.id',$order->id)->get();
        $totalamount =$total->sum('total_amount');
       
       
        return view('orders.detail',compact('order','orderdetail','totalamount'));
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
        
        try{

            $request->validate([
                'amount' => 'required'
            ]);

            $total_price = Order::where('id', $order->id)->first()->total();
            $payment = Payment::where('order_id', $order->id)->first();
            $payment->amount += (int)$request->amount;
    
            $payment_status = $this->calcStatus($total_price, $payment->amount);
            $payment->status = $payment_status;
            $payment->save();
    
            return redirect()->back()->with('success', 'Payment updated.');
            
        }catch (\Exception $e) {
            $e->getMessage();
          }
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

        try{

            $pricesToSubstract = OrderItem::select(DB::raw('sum(price) as total_price'))
                    ->where('order_id', $id)->groupBy('order_id')->first()->total_price;

            // return $pricesToSubstract;

            $details = Order::with('order_items', 'payments')->where('id', $id)->get();
            $items = $details[0]->order_items;
            $payments = $details[0]->payments;
            // return $payments;
            
            foreach($items as $item)
            {
                $product = Product::where('id', $item->product_id)->first();
                $product->stock += $item->quantity;
                $product->save();

                $item->delete();
            }

            
            if( $payments ) {
                
                $debt = Debt::where('customer_id', $payments->customer_id)->where('debt_status', '!=', 'paid')->first();
                $new_total_price = $debt->total_amount - $pricesToSubstract;
                $new_received = $debt->total_received - $payments->amount;
                // return $new_received;
                if($new_received == 0)
                {
                    $debt->debt_status = 'paid';
                }

                $debt->total_amount = $new_total_price;
                $debt->total_received = $new_received;
                $debt->save();
                // return 'hi';

                $payments->delete();
            }
                

            Order::where('id', $id)->delete();
            
            return redirect()->back()->with('success', 'order deleted successfully.');

        }catch (\Exception $e) {
            $e->getMessage();
        }
    }

}
