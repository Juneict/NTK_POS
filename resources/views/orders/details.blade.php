@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Orders Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Orders Details</a></li>
              <li class="breadcrumb-item active">POS</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                        <h3 class="card-title">Orders Details</h3>
                        <a href="{{route('orders.index')}}" class="btn btn-success" style="float:right">Back</a>
                </div>
              <div class="card-body">
                    <div class="col-md-5">
                       <h5><b>Customer Name</b>  : Myat Ko</h5> <br>   
                       <b> Order ID</b> : 0003 <br>
                       <b> Payment Status</b> : no paid <br>
                    </div>
                    <!-- datatable  -->
                    <table id="products" class="table table-striped table-bordered">
                            <thead>
                                <h5 class="mt-2"> Products </h5>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Tax</th>
                                    <th>Price inc.tax</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>T-Shirt</td>
                                        <td>2</td>
                                        <td>ks 9,000.00</td>
                                        <td>0,00</td>
                                        <td>ks 9,000.00</td>
                                        <td>ks 9,000.00</td>
                                    </tr>                                   
                                    <tr>
                                        <td>2</td>
                                        <td>Skirt</td>
                                        <td>1</td>
                                        <td>ks 6,000.00</td>
                                        <td>0,00</td>
                                        <td>ks 6,000.00</td>
                                        <td>ks 6,000.00</td>
                                    </tr>
                            </tbody>
                    </table>  
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