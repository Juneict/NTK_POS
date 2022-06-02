<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CartController;
use Dotenv\Exception\ValidationException;

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
        ->where('orders.deleted', '=', 0)
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
            
            if(is_null($req->payment_amount))
            {
                return redirect()->back()->with('error', 'Fill some payment amount.');
            }
            
            $user_id = $req->user()->id;

            $order = new Order;
            $order->customer_id = $req->customer_id;
            $order->user_id = $user_id;
            $order->save();
            
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

            OrderItem::insert($items);
           
            for($i = 0; $i < count($req->product_id); $i++)
            {
                $product = Product::find($req->product_id[$i]);
                $currentStock = $product->stock;
                $updatedStock = $currentStock - $req->quantity[$i];
                $product->stock = $updatedStock;
                $product->save();
            }
            
            $total_price = (int)$order->total();

            Order::where('id', $order->id)->update(['order_price' => $total_price]);
            
            $payment_status = $this->calcStatus($total_price, (int)$req->payment_amount);
           
            Payment::insert([
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
       
        $orderdetail = Order::select('order_items.name','order_items.price','products.price','order_items.quantity','payments.amount')
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
       
        $detail_list = Transaction::select('amount','created_at','updated_at')->where('debt_id',$order->id)->get();
       
        return view('orders.detail',compact('order','orderdetail','totalamount','detail_list'));
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
        
        $request->validate([
            'amount' => 'required | integer'
        ]);

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
        
        try{    

            $paying = Order::select('paying')->where('id', $id)->first()->paying;
            if($paying == 1)
            {
                return redirect()->back()->with('error', 'Paying in progress, cannot return!');
            }
            
           
            $pricesToSubstract = OrderItem::select(DB::raw('sum(price) as total_price'))
                    ->where('order_id', $id)->groupBy('order_id')->first()->total_price;
            
            
            $details = Order::with('order_items', 'payments')->where('id', $id)->get();

            $items = $details[0]->order_items;
            if(!$items) return redirect()->back()->with('error', 'Order items not found!');

            $payments = $details[0]->payments;
            if(!$payments) return redirect()->back()->with('error', 'Payments not found!');
            
            // product stock recovered & order items delete
            foreach($items as $item)
            {
                $product = Product::where('id', $item->product_id)->first();
                $product->stock += $item->quantity;
                $product->save();

                OrderItem::where('id', $item->id)->update(['deleted' => 1]);
            }

            
            // remove order payment from debt
            $debt = Debt::where('customer_id', $payments->customer_id)->where('debt_status', '!=', 'paid')->first();
            if($debt)
            {
                $new_total_price = $debt->total_amount - $pricesToSubstract;
                $new_received = $debt->total_received - $payments->amount;
                if($new_received == 0)
                {
                    $debt->debt_status = 'paid';
                }
    
                $debt->total_amount = $new_total_price;
                $debt->total_received = $new_received;
                $debt->save();
            }

            Payment::where('id', $payments->id)->update(['deleted' => 1]);
            Order::where('id', $id)->update(['deleted' => 1]);
            
            return redirect()->back()->with('success', 'order deleted successfully.');

        }catch (\Exception $e) {
            $e->getMessage();
        }
    }
    public function invoice(Order $order){
        return $order;
        return view('orders.invoice',compact('order'));
    }

}
