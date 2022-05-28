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
                        <h3 class="card-title">Brands</h3>

                        <a href="" data-toggle="modal" data-target="#createbrand" class="btn btn-success" style="float:right">Create</a>
                </div>
                

              <div class="card-body">
                
                    <!-- datatable  -->
                    <table id="brands" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                    @foreach($brands as $brand)
                    <tr>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->description}}</td>   
                        
                        <td>
                            <a href="" data-toggle="modal" data-target="#editbrand{{$brand->id}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>

                            <a href="" data-toggle="modal" data-target="#deletebrand{{$brand->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>

                    </tr>
                    @include('brands.delete')
                    @include('brands.edit')
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


  @include('brands.create')

@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
     $(function () {
   
    $('#brands').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('div.alert').delay(1000).slideUp(300);
  });

 
</script>