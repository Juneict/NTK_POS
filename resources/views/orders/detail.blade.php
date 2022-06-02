@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
        <!-- Main content -->
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                                <h3 class="card-title">Orders Details</h3>
                                <a href="{{route('orders.index')}}" class="btn btn-success" style="float:right">Back</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                <b> Invoice No:</b> #00{{$order->id}} <br>
                                <b> Payment Status :</b> {{$order->payments->status}}    
                                </div>
                                <div class="col-md-4">
                                    <b>Customer Name</b>  : {{$order->customers->customer_name}} <br>
                                <b>Address</b>  : {{$order->customers->address}}    
                                </div>
                                <div class="col-md-4">
                                <b> Date </b>: {{$order->created_at->format('d-m-Y')}}
                                </div>
                            </div>     
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                    
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderdetail as $items)  
                                        <tr>
                                            <td>{{$items->name}}</td>
                                            <td>{{$items->quantity}}</td>
                                            <td>{{$items->price}}</td>
                                            <td>{{$items->price*$items->quantity}}</td>
                                        </tr>
                                    @endforeach              
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Total</th>
                                        <th>{{$totalamount}}</th>
                                    </tr>
                                </tfoot>
                                
                            </table> 
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mt-3">Payment info</h5>
                                    <table class="table tabled-bordered table-striped">
                                        <thead>
                                            <tr>
                                             
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Payment Method</th>
                                                <th>Payment Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                                @foreach($detail_list as $transaction)
                                                    <tr>
                                                        <td>{{$transaction->updated_at}}</td>
                                                        <td>{{$transaction->amount}}</td>
                                                        <td>Cash</td>
                                                        <td>-</td>
                                                    </tr>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                        
                                    </table>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>Total</th>
                                            <td>{{$totalamount}}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Paid</th>
                                            <td>{{$order->payments->amount}}</td>
                                        </tr><tr>
                                            <th>Total Remaining</th>
                                            <td>{{$totalamount-$order->payments->amount}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                               
                        </div>        
                    </div>
                </div>
            </div>
          <!-- /.col-md-6 -->
            <div class="row no-print pl-3">
                <div class="col-md-12">
                    <a href="/orders/invoice/{{$order->id}}" class="btn btn-success mr-3"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
        
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
    <!-- /.content -->

@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
    

  
</script>