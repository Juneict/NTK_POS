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
                                <b> Date </b>: {{$order->created_at}}
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
                                            <td>{{$items->quantity*$items->price}}</td>
                                        </tr>
                                    @endforeach                  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Total</th>
                                        <th>{{$order->payments->amount}}</th>
                                    </tr>
                                </tfoot>
                            </table>    
                        </div>        
                    </div>
                </div>
            </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
    <!-- /.content -->

@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
    

  
</script>