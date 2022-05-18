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
                        <h3 class="card-title">Users</h3>
                        <a href="/users/create" class="btn btn-success" style="float:right">Create</a>
                </div>
              <div class="card-body">
                
                    <!-- datatable  -->
                    <table id="users" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>@if($user->is_admin == 1) Admin 
                                @else Cashier
                                @endif
                        </td>                   
                        <td>
                            <a href="/users/{{$user->id}}/edit" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <a href="" data-toggle="modal" data-target="#deleteUser{{$user->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @include('users.delete')
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
@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
     $(function () {
    $("#users").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#users').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  
</script>