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
                @if (session('error'))
                  <div class="alert alert-danger">
                      {{ session('error') }}
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
                               
                                <td>

                                  @if($order->order_status == 'no paid')
                                  <span class="badge badge-danger">Not Paid</span>
                                  @elseif($order->order_status == 'partial')
                                  <span class="badge badge-warning">Partial</span>
                                  @elseif($order->order_status == 'paid')
                                  <span class="badge badge-success">Paid</span>
                                  @endif
                                </td>
                                <td>{{$order->order_id}}</td>
                                <td>{{$order->created_at->format('d-m-Y')}}</td>
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
    $("#orders").DataTable({ 
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "pageLength":10,
      "autoWidth": false,
      "responsive": true,
    }).buttons().container().appendTo('#orders_wrapper .col-md-6:eq(0)');
  
    $('div.alert').delay(1000).slideUp(300);
  });

  
</script>