@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add new product</h1>
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
                        <h3 class="card-title">New Products</h3>
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
                    <form action="{{route('products.store')}}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="name">Product Name *</label>
                          <input type="text" name="name" class="form-control" value="{{old('name')}}">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="">Size</label>
                          <select name="size" id="" class="form-control">
                              <option value="S">S</option>
                              <option value="M">M</option>
                              <option value="L">L</option>
                              <option value="XL">XL</option>
                              <option value="XXL">XXl</option>
                          </select>
                         </div> 
                         <div class="form-group col-md-2">
                          <label for="">Color</label>
                          <select name="color" id="" class="form-control">
                              <option value="white">white</option>
                              <option value="black">black</option>
                              <option value="blue">blue</option>
                              <option value="red">yellow</option>
                              <option value="green">green</option>
                              <option value="yellow">yellow</option>
                              <option value="brown">brown</option>
                          </select>
                         </div>
                        <div class="form-group col-md-2">
                          <label for="name">Barcode *</label>
                          <input type="text" name="barcode" class="form-control" value="{{old('barcode')}}">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="name">Price *</label>
                          <input type="text" name="price" class="form-control" value="{{old('price')}}">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="name">Description</label>
                          <input type="text" name="description" class="form-control" value="{{old('description')}}">
                        </div>                      
                        <div class="form-group col-md-2">
                          <label for="name">Stock</label>
                          <input type="text" name="stock" class="form-control" value="{{old('stock')}}">
                        </div>
                        <div class="form-group">
                                      <label for="status">Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                    <option value="1" {{ old('status') === 1 ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{ old('status') === 0 ? 'selected' : ''}}>Inactive</option>
                                </select>
                
                        </div>
                      </div>                      
                      <button class="btn btn-success" type="submit">Create</button>
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
