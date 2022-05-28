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
                        <h3 class="card-title">Customers</h3>
                        <a href=""data-toggle="modal" data-target="#createCustomer" class="btn btn-success" style="float:right">Create</a>
                </div>
              <div class="card-body">
                
                    <!-- datatable  -->
                    <table id="customers" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{$customer->id}}</td>
                        <td>{{$customer->customer_name}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->address}}</td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#showcustomer{{$customer->id}}" class="btn btn-success"><i
                                    class="fas fa-eye"></i></a>
                            <a href="" data-toggle="modal" data-target="#editcustomer{{$customer->id}}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            @can('order_crud')
                            <a href="" data-toggle="modal" data-target="#deletecustomer{{$customer->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            @endcan
                        </td>
                    </tr>
                    @include('customers.details')
                    @include('customers.edit')
                    @include('customers.delete')
                    @endforeach
                    
               
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
  @include('customers.create')
@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
    $(function () {
   
    $('#customers').DataTable({
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