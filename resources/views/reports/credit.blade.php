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
                        <h3 class="card-title">Credit List</h3>     
                </div>
                <div class="card-body">
                  
                      <!-- datatable  -->
                      <table id="creditlists" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                              <th>Customer Name</th>                            
                              <th>Total Amount</th>
                              <th>Received Amount</th>   
                              <th>To Pay</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                        <tbody>
                            @foreach($creditlists as $order)
                              <tr>
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
                                <td>
                                    @can('order_crud')
                                    <a href="" data-toggle="modal" data-target="#editorder{{$order->order_id}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    @endcan    
                                </td>  
                              </tr>
                            @include('reports.edit')
                            @endforeach  
                        </tbody>
                        <tfoot>
                          <tr>
                              <th colspan="1" style="text-align: center">Total</th>
                              <th>{{number_format($creditlists->sum('total_amount'))}} ks</th>
                              <th>{{number_format($creditlists->sum('received_amount'))}} ks</th>
                              <th>{{number_format(abs($creditlists->sum('received_amount')-$creditlists->sum('total_amount')))}} ks</th>
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
    
    $('#creditlists').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('div.alert').delay(1000).slideUp(300);
  });

  
</script>