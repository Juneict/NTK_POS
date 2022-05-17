@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add new Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Customers</a></li>
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
                        <h3 class="card-title">New Customers</h3>
                        <a href="{{route('customers.index')}}" class="btn btn-warning" style="float:right">Back</a>
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
                    <form action="{{route('customers.store')}}" method="POST">
                      @csrf
                      
                        <div class="form-group">
                          <label for="name">Customer Name *</label>
                          <input type="text" name="customer_name" class="form-control" value="{{old('customer_name')}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Phone</label>
                          <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Address</label>
                          <input type="text" name="address" class="form-control" value="{{old('color')}}">
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
