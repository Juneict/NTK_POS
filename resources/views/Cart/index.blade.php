@extends('layouts.admin')
@section('content')
<style>
  .cart-container{
    width: 100%;
  }
</style>
<div class="content-wrapper">
    <!-- Main content -->
    <form id="cart-form" action="{{ route('place-order') }}" method="POST">
    <div class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger alert-outofstock" role="alert" style="display:none;">
              #
            </div>
                  <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                          @if (session('success'))
                            <div class="alert alert-success success">
                                {{ session('success') }}
                            </div>
                          @endif
                          @if (session('error'))
                            <div class="alert alert-danger danger">
                                {{ session('error') }}
                            </div>
                          @endif
                            <div class="card-body">
                                
                                      <div class="row">
                                          {{-- barcode input --}}
                                          <div class="form-group col-md-4 barcode">
                                              <input type="text" class="form-control search-barcode" placeholder="Scan Barcodes">
                                          </div>
                                          {{-- barcode end --}}

                                          {{-- customer --}}
                                          <div class="input-group col-md-7">
                                            <select name="customer_id"  class="form-control customer-list">
                                              {{-- <option value="1" class="form-control">Walk-in Customer</option> --}}
                                                @foreach($customers as $customer)
                                                <option value="{{$customer->id}}" class="form-control">{{$customer->customer_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                          
                                          <div class="input-group col-md-1">
                                            <a href=""data-toggle="modal" data-target="#createCustomer" class="btn btn-success" style="float:right; height:35px">+</a>
                                          </div>
                                          {{-- customer end--}}

                                          {{-- cart --}}
                                          <div class="cart-container">
                                            <table class="table">
                                              <thead>
                                                  <tr>
                                                    <th>Products</th>
                                                    <th>Quantity</th>
                                                   
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody class="cart">
                                                  
                                              </tbody>
                                            </table>
                                          </div>
                                          {{-- cart end --}}

                                          <div class="col-md-12">
                                                <table class="table">
                                                  {{-- Card items here --}}
                                                  <tr>
                                                    <th colspan="4">Total</th>
                                                    <td class="total-price">0</td>
                                                  </tr>
                                                </table>
                                          </div>
                                          <div class="row m-auto">
                                            <div class="col-md-6">
                                              <button class="btn btn-danger clear-cart" type="submit">Clear</button>
                                            </div>
                                            <div class="col-md-6">
                                              <a href="" data-toggle="modal" data-target="#sendReceivedAmount" class="btn btn-primary proceed-btn" style="pointer-events:none;">Proceed</a>
                                            </div>
                                          </div>
                                      </div>
                                      
                                     
                                      {{-- row --}}                 
                                
                            </div>
                           {{-- card body --}}
                        </div>
                    </div>
                    <div class="col-md-7">
                      <div class="card">
                        <div class="card-body">
                              
                                  <input type="text" class="form-control search-product" placeholder="Search Products">
                                  <div class="row mt-3 product-container">
                                    @foreach($productlists as $product)
                                        
                                          <div class="col-md-2 col-lg-2 col-sm-6 justify-content-center search-item" data-id="{{ $product->id }}">
                                            {{-- <div class="product" style="height: 40px,width:150px">
                                                <img src="/dist/img/product1.png" alt="" width="60px">
                                                <p><small>{{$product->name}}({{$product->barcode}})</small> </p>
                                            </div> --}}
                                              <div class="card">
                                                  <div class="card-body" style="height: 150px">
                                                    <img src="/dist/img/product.png" class="card-img-top"  alt="">
                                                    <p style="text-align: center; margin-top:3px"><small> {{$product->name}}({{$product->barcode}}) </small> </p>                                               
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
                      
                          @csrf
                          <input type="number" name="payment_amount" class="form-control payment-input" value="0">

                          <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-send">Send</button>
                          </div>
                      
              </div>
      
          </div>
      </div>
    </div> 
    {{-- endmodal --}}
    </form>
</div>
@include('customers.create')
@endsection
<script src="/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">

  let products = '<?= $products ?>';
  let customers = '<?= $customers ?>';

</script>

<script type="text/javascript" src="{{ asset('js/cart.js') }}"></script>


