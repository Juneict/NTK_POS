@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Orders</a></li>
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
                        <h3 class="card-title">Orders</h3>
                        <a href="" class="btn btn-success" style="float:right">Open POS</a>
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
                    <table id="products" class="table table-striped table-bordered">
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
                                    <tr>
                                        <td>1</td>
                                        <td>Walk-in Customer</td>
                                        <td>ks 59,000.00</td>
                                        <td>ks 59,000.00</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                        <td>ks 0.00</td>
                                        <td>17-05-2022</td>
                                        <td>
                                          <a href="" class="btn btn-success"><i
                                                  class="fas fa-eye"></i></a>
                                          <a href="" class="btn btn-primary"><i
                                                  class="fas fa-edit"></i></a>
                                          <a href="" data-toggle="modal" data-target="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Ko Ko</td>
                                        <td>ks 10,000.00</td>
                                        <td>ks 5,000.00</td>
                                        <td><span class="badge badge-warning">Partial</span></td>
                                        <td>ks 5,000.00</td>
                                        <td>17-05-2022</td>
                                        <td>
                                          <a href="" class="btn btn-success"><i
                                                  class="fas fa-eye"></i></a>
                                          <a href="" class="btn btn-primary"><i
                                                  class="fas fa-edit"></i></a>
                                          <a href="" data-toggle="modal" data-target="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Myat Ko</td>
                                        <td>ks 10,000.00</td>
                                        <td>ks 0.00</td>
                                        <td><span class="badge badge-danger"></span></td>
                                        <td>ks 10,000.00</td>
                                        <td>17-05-2022</td>
                                        <td>
                                          <a href="" class="btn btn-success"><i
                                                  class="fas fa-eye"></i></a>
                                          <a href="" class="btn btn-primary"><i
                                                  class="fas fa-edit"></i></a>
                                          <a href="" data-toggle="modal" data-target="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    
                            
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
    $("#products").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  
</script>