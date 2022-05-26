@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <style>
    
    </style>
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
                    Invoice No:#00{{$order->id}} <br>
                    Payment Status : @if($order->amount == 0)
                    <span class="badge badge-danger">Not Paid</span>
                    @elseif($order->amount < $order->price)
                        <span class="badge badge-warning">Partial</span>
                    @elseif($order->amount == $order->price)
                        <span class="badge badge-success">Paid</span>
                    @elseif($order->amount > $order->price)
                        <span class="badge badge-info">Change</span>
                    @endif     
                </div>
                <div class="col-md-4">
                    <b>Customer Name</b>  : {{$order->customers->customer_name}} <br>
                   <b>Address</b>  : {{$order->customers->address}}    
                </div>
                <div class="col-md-4">
                   <b> Date </b>: {{date('d-m-Y')}}
                </div>
            </div>     
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Items</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Tax</th>
                        <th>Price inc.tax</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                 
                </tbody>
            </table>    
          </div>
                    <!-- datatable  -->
                     
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mt-3">Payment info</h5>
                            <table class="table tabled-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Payment Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <th>18-5-2022</th>
                                        <th>ks 15,000.00</th>
                                        <th>Cash</th>
                                        <th>-</th>
                                    </tr>
                                </tbody>
                                
                            </table>
                        </div>
                        <div class="col-md-6 mt-3">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Total</th>
                                    <td>ks 15,000.00</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>0.00%</td>
                                </tr>
                                <tr>
                                    <th>Total Payable</th>
                                    <td>ks 15,000.00</td>
                                </tr>
                                <tr>
                                    <th>Total Paid</th>
                                    <td>ks 0.00</td>
                                </tr><tr>
                                    <th>Total Remaining</th>
                                    <td>ks 15,000.00</td>
                                </tr>
                            </table>
                        </div>
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
  </div>
@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
    

  
</script>