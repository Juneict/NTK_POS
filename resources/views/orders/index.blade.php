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
                    <table id="products" class="table table-striped table-bordered">
            <thead>
                  <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Received Amount</th>   
                    <th>To Pay</th>
                    <th>Status</th>
                    <th>DATE</th>
                    <th>Action</th>
                  </tr>
            </thead>
            <tbody>
                
                    @foreach($orders as $index=>$order)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$order->customers->customer_name}}</td>
                        <td>{{ number_format($order->price,2)}} ks</td>
                        <td>{{ number_format($order->amount,2)}} ks</td>
                        <td>{{ number_format(($order->price-$order->amount),2)}} ks</td>
                        <td>
                          @if($order->amount == 0)
                          <span class="badge badge-danger">Not Paid</span>
                          @elseif($order->amount < $order->price)
                              <span class="badge badge-warning">Partial</span>
                          @elseif($order->amount == $order->price)
                              <span class="badge badge-success">Paid</span>
                          @elseif($order->amount > $order->price)
                              <span class="badge badge-info">Change</span>
                          @endif
                        </td>
                        <td>{{$order->created_at}}</td>

                          
                        <td>
                          <a href=""data-toggle="modal" data-target="" class="btn btn-success"><i class="fas fa-eye"></i></a>

                          @can('order_crud')
                          <a href="" data-toggle="modal" data-target="" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                          @endcan

                          @can('order_crud')
                          <a href="" data-toggle="modal" data-target="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                          @endcan
                          
                        </td>
                        
                      </tr>
                
                    @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <th colspan="2" style="text-align: center">Total</th>
                 
                  <th>{{number_format($orders->sum('price'))}}</th>
                  <th>{{number_format($orders->sum('amount'))}}</th>
                  <th>{{number_format($orders->sum('price')-$orders->sum('amount'))}}</th>
                  <th></th>
                  <th></th>
                  <th></th>
                 
              </tr>
          </tfoot>
        </table>  
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
     $(function () {
    $("#products").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $('div.alert').delay(3000).slideUp(300);
</script>