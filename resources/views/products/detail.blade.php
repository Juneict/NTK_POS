@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detail Products</h1>
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
                        <h3 class="card-title">{{$product->name}}</h3>
                        <a href="{{route('products.index')}}" class="btn btn-warning" style="float:right">Back</a>
                </div>
              <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <b>Barcode</b> : {{$product->barcode}} <br>
                            <b>Price</b> : {{$product->price}} <br>
                            <b>Size</b> :{{$product->size}} <br>
                            <b>Stock</b> :{{$product->stock}} <br>
                            <b>Color</b> :{{$product->color}}
                        </div>
                        <div class="col-md-4">
                            <b>Category</b> : Women Cloths<br>
                            <b>Sub Category</b> --<br>
                            <b>Manag Stock?</b>Yes <br>
                            <b>Alert Quantity</b> 5.0000 <br>
                            <b>Product Type</b>: Single
                        </div>
                        <div class="col-md-4">
                          <img src="/dist/img/product.png"class="card-img-top" style="width:300px"alt="">
                        </div>
                    
                    </div>
                    <div class="col-md-12 mt-3">
                        <table class="table table-striped ">
                            <thead style>
                                <tr>
                                    <th>Default Purchase Price(Exc.tax)</th>
                                    <th>Default Purchase Price(Inc.tax)</th>
                                    <th>x Margin(%)</th>
                                    <th>Default Selling Price(Exc.tax)</th>
                                    <th>Defailt Selling Price(Inc.tax)</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->price}}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
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
