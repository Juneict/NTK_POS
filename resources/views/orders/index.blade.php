@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
   <!-- Main content -->
    <div class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                @endif
                @if (session('delete'))
                  <div class="alert alert-danger">
                      {{ session('delete') }}
                  </div>
                @endif
                <div class="card-header">
                        <h3 class="card-title">Orders</h3>     
                </div>
                <div class="card-body">
                  
                      <!-- datatable  -->
                      <table id="orders" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                              <th>No.</th>
                             
                              <th>Customer Name</th>
                              
                              
                              <th>Total Amount</th>
                              <th>Received Amount</th>   
                              <th>To Pay</th>
                              <th>Status</th>
                              <th>ID</th>
                              <th>DATE</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                        <tbody>
                            @foreach($orders as $index=>$order)
                              <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$order->customer_name}}</td>
                               
                                
                                <td>{{ number_format($order->total_amount)}} ks</td>
                                <td>{{ number_format($order->received_amount)}} ks</td>
                                <td>{{ number_format(abs($order->total_amount-$order->received_amount))}} ks</td>
                               
                                <td>

                                  @if($order->received_amount == 0)
                                  <span class="badge badge-danger">Not Paid</span>
                                  @elseif($order->received_amount < $order->total_amount)
                                  <span class="badge badge-warning">Partial</span>
                                  @elseif($order->received_amount == $order->total_amount)
                                      <span class="badge badge-success">Paid</span>
                                  @elseif($order->received_amount > $order->total_amount)
                                      <span class="badge badge-info">Change</span>
                                  @endif
                                </td>
                                <td>{{$order->order_id}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                   
                                    <a href="/orders/{{$order->order_id}}"  class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                    
                                    @can('order_crud')
                                    <a href="" data-toggle="modal" data-target="#editorder{{$order->order_id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    @endcan

                                    @can('order_crud')
                                    <a href="" data-toggle="modal" data-target="#deleteorder{{$order->order_id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    @endcan        
                                </td>  
                              </tr>
                              @include('orders.invoice')
                              @include('orders.delete')
                              @include('orders.edit')
                            @endforeach  
                        </tbody>
                        <tfoot>
                          <tr>
                              <th colspan="2" style="text-align: center">Total</th>
                            
                              <th>{{number_format($orders->sum('total_amount'))}} ks</th>
                              <th>{{number_format($orders->sum('received_amount'))}} ks</th>
                              <th>{{number_format(abs($orders->sum('received_amount')-$orders->sum('total_amount')))}} ks</th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                          </tr>
                        </tfoot>
                      </table>  
                </div>
            </div>  
          </div>  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
    <!-- /.content -->
</div>
@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
     $(function () {
    
    $('#orders').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "pageLength":10,
      "autoWidth": false,
      "responsive": true,
    });
    $('div.alert').delay(1000).slideUp(300);
  });

  
</script>