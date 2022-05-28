@extends('layouts.admin')
@section('content')
<div class="content-wrapper">

  <!-- Main content -->
  <div class="content">
      <div class="container-fluid mt-3">
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
                        <h3 class="card-title">Users</h3>
                        <a href=""  data-toggle="modal" data-target="#createuser" class="btn btn-success" style="float:right">Create</a>
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
                                        <a href="" data-toggle="modal" data-target="#editUser{{$user->id}}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="" data-toggle="modal" data-target="#deleteUser{{$user->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                              {{-- modal --}}
                                @include('users.edit')
                                @include('users.delete')
                              {{-- end modal --}}
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

 @include('users.create')

@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
     $(function () {
    
    $('#users').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('div.alert').delay(3000).slideUp(300);
  });


</script>