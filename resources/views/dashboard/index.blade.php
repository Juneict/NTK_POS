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
                  <h3>{{ $stats->total_purchase ? number_format($stats->total_purchase) : 0}} ks</h3>
  
                  <p>Total Purchase </p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="" data-toggle="modal" data-target="#detailPurchase" class="small-box-footer bg-info">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box">
                <div class="inner">
                  <h3>{{ $stats->total_sale ? number_format($stats->total_sale) : 0}}ks</h3>
  
                  <p>Total Sales</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="" data-toggle="modal" data-target="#detailIncome" class="small-box-footer bg-success">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box ">
                <div class="inner">
                  <h3> {{ $stats->total_due ? number_format($stats->total_due) : 0}} ks</h3>
  
                  <p>Total Due</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="" data-toggle="modal" data-target="#detailDue" class="small-box-footer bg-warning">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box">
                <div class="inner">
                  <h3>  {{ $stats->total_profit ? number_format($stats->total_profit) : 0}} ks</h3>
  
                  <p>Total Profit</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="" data-toggle="modal" data-target="#detailProfit" class="small-box-footer bg-danger">More info <i class="fas fa-arrow-circle-right"></i></a>
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
              <div class="table-responsive"  style="height: 200px;">
              <table id="customers" class="table table-head-fixed text-nowrap">
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
@include('dashboard.purchase');
@include('dashboard.income');
@include('dashboard.due');
@include('dashboard.profit');
@endsection