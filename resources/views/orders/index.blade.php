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
                        <a href="{{route('cart')}}" class="btn btn-success" style="float:right">Open POS</a>
                </div>
              <div class="card-body">
                    <div class="col-md-5">
                        <form action="">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-outline-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- datatable  -->
                    <table id="orders" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Total</th>
                                    <th>Received Amount</th>
                                    <th>Status</th>
                                    <th>To Pay</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                                            
                            
                            </tbody>
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
    $("#orders").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#orders').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      
    });
  });
  $('div.alert').delay(3000).slideUp(300);
  
</script>