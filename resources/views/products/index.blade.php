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
                        <h3 class="card-title">Products</h3>

                        @can('product_crud')  
                        <a href="" data-toggle="modal" data-target="#createproduct" class="btn btn-success" style="float:right">Create</a>
                        @endcan
                </div>
                

              <div class="card-body">
                
                    <!-- datatable  -->
                    <table id="products" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Barcode</th>
                    <th>Stock</th>
                    @can('product_crud')
                    <th>Purchase Price</th>
                    @endcan
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->barcode}}</td>
                        <td>{{$product->stock}}</td>
                        @can('product_crud')
                        <td>{{number_format($product->purchase_price)}} ks</td>
                        @endcan
                        <td>{{number_format($product->price)}} ks</td>
                        <td><span
                            class="right badge badge-{{ $product->status ? 'success' : 'danger' }}">{{$product->status ? 'Active' : 'Inactive'}}</span></td>
                            
                        
                        <td>
                            <a href=""data-toggle="modal" data-target="#showproduct{{$product->id}}" class="btn btn-success"><i class="fas fa-eye"></i></a>

                            @can('product_crud')
                            <a href="" data-toggle="modal" data-target="#editproduct{{$product->id}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            @endcan

                            @can('product_crud')
                            <a href="" data-toggle="modal" data-target="#deleteproduct{{$product->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            @endcan
                        </td>

                    </tr>
                    @include('products.detail')
                    @include('products.delete')
                    @include('products.edit')
                    @endforeach
                    
               
            </tbody>
            <tfoot>
                <tr>
                  <th colspan="5" class="text-center">Total Stock Price</th>
                  <th> ks</th>
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


  @include('products.create')

@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
     $(function () {
    $("#products").DataTable({
      
      "buttons": ["copy", "csv", "excel", "pdf", "print","colvis"],
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      
      "autoWidth": false,
      "responsive": true,
    }).buttons().container().appendTo('#products_wrapper .col-md-6:eq(0)');
   
    $('div.alert').delay(3000).slideUp(300);
  });
  
</script>