<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debtlists = Debt::select('customers.id as customer_id', 'customer_name', 'phone', 'address', 'debts.id as debt_id', 'total_amount', 'total_received', 'debt_status')
        ->leftjoin('customers', 'customers.id', 'debts.customer_id')->where('debt_status', '!=', 'paid')->get();
   
        return view('reports.credit',compact('debtlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
       $detail_list = Transaction::select('amount','created_at','updated_at')->where('debt_id',$id)->get();
        return view('reports.credit_detail',compact('detail_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update_payment_amounts($customer_id)
    {
        $res = Payment::select(DB::raw('group_concat(order_id) as order_ids'))
                            ->where('customer_id', $customer_id)
                            ->where('status', '!=', 'paid')
                            ->groupBy('customer_id')
                            ->get();

        $order_ids = array_map('intval', explode(',', $res[0]->order_ids));
        
        foreach($order_ids as $id)
        {
            $order_price = OrderItem::select(DB::raw('sum(price) as price'))->where('order_id', $id)->groupBy('order_id')->first()->price;
            
            Payment::where('order_id', $id)->update(['amount' => $order_price]);
            
        }
        
    }

    public function update(Request $request, $id)
    {
        if((int)$request->amount <= 0){
            return redirect()->back()->with('error', 'Invalid Amount.');
        }
       
        $debt = Debt::where('id', $id)->first();
        $updated_amount = $debt->total_received + (int)$request->amount;
        
        if($updated_amount >= $debt->total_amount)
        {
            
            $customer_id = $debt->customer_id;

            $this->update_payment_amounts($customer_id);

            Payment::where('status', '!=', 'paid')->where('customer_id', $customer_id)
                    ->update(['status' => 'paid']);
            

            $debt->debt_status = 'paid';
            
        }


        $debt->total_received = $updated_amount;
        $debt->save();

        Payment::leftjoin('orders', 'orders.id', 'payments.order_id')
                ->where('status', '!=', 'paid')
                ->where('orders.deleted', 0)
                ->update(['paying' => 1]);

        Transaction::insert([
            'debt_id' => $id,
            'customer_id' => $debt->customer_id,
            'amount' => $request->amount,
        ]);

        return redirect()->back()->with('success', 'Payment Received.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
