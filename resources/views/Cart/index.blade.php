@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <form action="">
                                      <div class="row">
                                          {{-- barcode input --}}
                                          <div class="form-group col-md-4">
                                              <input type="text" class="form-control" placeholder="Scan Barcodes">
                                          </div>
                                          {{-- barcode end --}}

                                          {{-- customer --}}
                                          <div class="form-group col-md-8">
                                            <select name="customer_id"  class="form-control">
                                              <option value="1" class="form-control">Walk-in Customer</option>
                                              @foreach($customers as $customer)
                                              <option value="{{$customer->customer_name}}" class="form-control">{{$customer->customer_name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                          {{-- customer end--}}

                                          {{-- cart --}}
                                          <div class="">
                                            <table class="table">
                                              <thead>
                                                  <tr>
                                                    <th>Products</th>
                                                    <th>Quantity</th>
                                                   
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($products as $product)
                                                  <tr>
                                                      
                                                    <td>{{$product->name}}</td>
                                                    {{-- <td width="15%">
                                                      <div class="row">
                                                          <div class="">
                                                              <button class="btn btn-sm btn-success">+ </button>
                                                          </div> 
                                                          <div class="">
                                                              1
                                                          </div>
                                                          <div class="">
                                                              <button class="btn btn-sm btn-danger">-</button>
                                                          </div> 
                                                      </div>
                                                      
                                                    </td> --}}
                                                    <td><input type="number" name="quantity" class="form-control" value="1"></td>
                                                   
                                                    <td>{{$product->price}}</td>
                                                    <td> <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                  </tr>
                                                @endforeach

                                                 
                                                  {{-- <tr>
                                                    
                                                    <td>Skirt</td>
                                                    <td width="15%">
                                                      <div class="row">
                                                          <div class="">
                                                              <button class="btn btn-sm btn-success">+ </button>
                                                          </div> 
                                                          <div class="">
                                                              1
                                                          </div>
                                                          <div class="">
                                                              <button class="btn btn-sm btn-danger">-</button>
                                                          </div> 
                                                      </div>
                                                      
                                                    </td>
                                                    <td>0.00</td>
                                                    <td>9,000.00</td>
                                                    <td> <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                  </tr> --}}
                                              </tbody>
                                            </table>
                                          </div>
                                          {{-- cart end --}}

                                          <div class="col-md-12">
                                                <table class="table">
                                                  <tr>
                                                    <th colspan="4">Total</th>
                                                    <td>{{$product->sum('price')}}</td>
                                                  </tr>
                                                </table>
                                          </div>
                                          <div class="row m-auto">
                                            <div class="col-md-6">
                                              <button class="btn btn-danger" type="submit">Cancle</button>
                                            </div>
                                            <div class="col-md-6">
                                              <a href="" data-toggle="modal" data-target="#sendReceivedAmount" class="btn btn-primary">Send</a>
                                            </div>
                                          </div>
                                      </div>
                                      
                                     
                                      {{-- row --}}                 
                                </form>
                            </div>
                           {{-- card body --}}
                        </div>
                    </div>
                    <div class="col-md-8">
                      <div class="card">
                        <div class="card-body">
                              
                                  <input type="text" class="form-control" placeholder="Search Products">
                                  <div class="row mt-3 ">
                                    @foreach($products as $product)
                                        
                                          <div class="col-md-2 col-lg-2 col-sm-6 justify-content-center">
                                              <div class="card">
                                                  <div class="card-body">
                                                    <img src="/dist/img/product.png"class="card-img-top" alt="">
                                                    <p class="card-text">  {{$product->name}}  </p>                                                
                                                  </div>
                                              </div>
                                          </div>
                                        
                                  @endforeach
                                </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- row --}}
          </div>
          
         
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

     {{-- modal --}}
     <div class="modal right fade" id="sendReceivedAmount" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="staticBackdropLabel">Received Amount</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  
              </div>
              <div class="modal-body">
                      <form action="" method="POST">
                          @csrf
                          <input type="text" class="form-control" value="66000">

                          <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Send</button>
                              <button class="btn btn-default" data-dismiss="modal">Cancle</button>
                              
                          </div>
                      </form>
              </div>
      
          </div>
      </div>
</div> 
    {{-- endmodal --}}
</div>
@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
    

  
</script>