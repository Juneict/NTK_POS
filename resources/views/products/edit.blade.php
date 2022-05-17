@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Products</a></li>
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
                        <h3 class="card-title">Edit Products</h3>
                        <a href="{{route('products.index')}}" class="btn btn-warning" style="float:right">Back</a>
                </div>
              <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('products.update', $product) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="name">Product Name *</label>
                          <input type="text" name="name" class="form-control" value="{{old('name',$product->name)}}">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="name">Size</label>
                          <input type="text" name="size" class="form-control" value="{{old('size',$product->size)}}">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="name">Color</label>
                          <input type="text" name="color" class="form-control" value="{{old('color',$product->color)}}">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="name">Barcode *</label>
                          <input type="text" name="barcode" class="form-control" value="{{old('barcode',$product->barcode)}}">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="name">Price *</label>
                          <input type="text" name="price" class="form-control" value="{{old('price',$product->price)}}">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="name">Description</label>
                          <input type="text" name="description" class="form-control" value="{{old('description',$product->description)}}">
                        </div>                      
                        <div class="form-group col-md-2">
                          <label for="name">Stock</label>
                          <input type="text" name="stock" class="form-control" value="{{old('stock',$product->stock)}}">
                        </div>
                        <div class="form-group">
                                      <label for="status">Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                    <option value="1" {{ old('status') === 1 ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{ old('status') === 0 ? 'selected' : ''}}>Inactive</option>
                                </select>
                
                        </div>
                      </div>                      
                      <button class="btn btn-warning" type="submit">Update</button>
                  </form>
              </div>
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
