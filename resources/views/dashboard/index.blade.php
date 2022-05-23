@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color: #7A8DA1">Welcome POS Admin,</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box ">
                <div class="inner">
                  <h3>{{$order_count}}</h3>
  
                  <p>Order Count</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="/orders" class="small-box-footer bg-info">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box">
                <div class="inner">
                  <h3>{{ number_format($payments->sum('amount'),2)}} ks</h3>
  
                  <p>Income</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/orders" class="small-box-footer bg-success">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box ">
                <div class="inner">
                  <h3>{{ number_format($dailypayments->sum('amount'),2)}} ks</h3>
  
                  <p>Income Today</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="/orders" class="small-box-footer bg-warning">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box">
                <div class="inner">
                  <h3>{{$customerCount}}</h3>
  
                  <p>Customer Counts</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/customers" class="small-box-footer bg-danger">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Low Stock Report</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
              <table id="customers" class="table">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Product</th>
                      <th>Stock</th>
                      <th>Price</th>
                                           
                    </tr>
                </thead>
                <tbody>
                  @foreach($products as $index=>$product)
                    <tr>
                      <td>{{$index+1}}</td>
                      <td>{{$product->name}}</td>
                      <td>{{$product->stock}}</td>
                      <td>{{$product->price}}</td>
                    </tr>
                  @endforeach
                </tbody>
                
              </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <a href="/products" class="btn btn-sm btn-info float-left">Products</a>
            
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
          
          <!-- /.card -->
          
        </div><!-- /.container-fluid -->    
    </section>
    <!-- /.content -->
  </div>
@endsection