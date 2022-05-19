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
                                          <div class="form-group col-md-4 barcode">
                                              <input type="text" class="form-control search-barcode" placeholder="Scan Barcodes">
                                          </div>
                                          {{-- barcode end --}}

                                          {{-- customer --}}
                                          <div class="form-group col-md-8">
                                            <select name="period"  class="form-control">
                                              <option value="" class="form-control">Walk-in Customer</option>
                                              
                                              <option value="morning" class="form-control">Myat Ko</option>
                                              <option value="evening" class="form-control">Ko Nyi</option>
                                            </select>
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
                                                {{-- @foreach($products as $product)
                                                  <tr>
                                                      
                                                    <td>{{$product->name}}</td>
                                                    <td><input type="number" name="quantity" class="form-control" value="1"></td>
                                                   
                                                    <td>{{$product->price}}</td>
                                                    <td> <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                  </tr>
                                                @endforeach --}}

                                                 
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
                                                    <td class="total-price">0</td>
                                                  </tr>
                                                </table>
                                          </div>
                                          <div class="row m-auto">
                                            <div class="col-md-6">
                                              <button class="btn btn-danger" type="submit">Cancel</button>
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
                              
                                  <input type="text" class="form-control search-product" placeholder="Search Products">
                                  <div class="row mt-3 product-container">
                                  {{-- @foreach($products as $product)
                                      
                                        <div class="col-md-2 col-lg-2 justify-content-center">
                                            <div class="card">
                                                <div class="card-body">
                                                  <img src="/dist/img/product.png"class="card-img-top" alt="">
                                                  {{$product->name}}                                                 
                                                </div>
                                            </div>
                                        </div>
                                      
                                  @endforeach --}}
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
window.onload = () => {

  const barcodeInput = document.querySelector('.search-barcode');
  const cartContainer = document.querySelector('.cart-container');
  const cart = document.querySelector('.cart');
  const counter = document.getElementById('counter'); 
  const productContainer = document.querySelector('.product-container');
  const searchProductInput = document.querySelector('.search-product');

  const products = {!! json_encode($products, JSON_HEX_TAG) !!};
  console.log(products);

  const searchBarcode = function(e){
    if(e.key === 'Enter'){
      e.preventDefault();

      inputBarcodeItem();

      calculateTotalPrice();

      barcodeInput.value = '';

    }
  };

  const inputBarcodeItem = function(){
    const item = products.find(cur => +cur.barcode === +barcodeInput.value);

    if(!item) return;

    const html = `
    <tr data-id=${item.id}>
      <td>${item.name}</td>
      <td><input type="number" min="1" max="${item.stock}" name="quantity" class="form-control" value="1"></td>
      <td class="item-price">${item.price}</td>
      <td> <button class="btn btn-sm btn-danger delete-cart-item"><i class="fas fa-trash"></i></button></td>
    </tr>
    `;

    cart.insertAdjacentHTML('beforeend', html);
  }

  const calculateTotalPrice = function(){

    const prices = new Array();

    const arr = document.getElementsByClassName('item-price');
    for(let i=0; i< arr.length; i++){
      prices.push(+arr[i].innerHTML);
    }

    const total_price = prices.reduce((acc, cur) => acc + cur, 0);
    document.querySelector('.total-price').innerHTML = total_price;
  }

  const calculateCountPrice = function(e){
    const count = +e.target.value;
    const parent = e.target.parentElement.parentElement;
    const item = products.find(cur => cur.id === +parent.dataset.id)

    parent.querySelector('.item-price').innerHTML = count * item.price;

    calculateTotalPrice();
  }

  const delete_cart_item = function(e){
    e.preventDefault();

    if(!e.target.closest('button')) return;

    const parentTr = e.target.closest('button').parentNode?.parentNode;
    parentTr.parentElement?.removeChild(parentTr);

    calculateTotalPrice();
  }

  function similarItems(a,b) {
    let equivalency = 0;
    const minLength = (a.length > b.length) ? b.length : a.length;    
    const maxLength = (a.length < b.length) ? b.length : a.length;    
    for(let i = 0; i < minLength; i++) {
        if(a[i] == b[i]) {
            equivalency++;
        }
    }

    const weight = equivalency / maxLength;
    return (weight * 100);
  }

  const getProductList = function(item){

    const html = `
      <div class="col-md-2 col-lg-2 justify-content-center">
        <div class="card">
          <div class="card-body">
            <img src="/dist/img/product.png" class="card-img-top" alt="">
            ${item.name}                                                 
          </div>
        </div>
      </div>
      `;

      productContainer.insertAdjacentHTML('beforeend', html);
  }

  const removeRecentItems = function(){
    let lastChild = productContainer.lastElementChild;

    while(lastChild){

      productContainer.removeChild(lastChild);
      lastChild = productContainer.lastElementChild;
    }
  }

  const searchProduct = function(e){
    if(e.key === 'Enter'){
      e.preventDefault();
      
      if(searchProductInput.value === '') {
        removeRecentItems();

        products.forEach(item => getProductList(item));
        return;
      }

      removeRecentItems();
      const keyword = searchProductInput.value.toLowerCase();
      const item = products.find(item => item.name.toLowerCase() === keyword);

      if(!item) {
        products.forEach(item => {
          const similarValue = similarItems(item.name.toLowerCase(), keyword);

          if(!similarValue) return;

          getProductList(item);
        });
        return;
      };
      getProductList(item);
    }
  }

  barcodeInput.addEventListener('keydown', searchBarcode);
  cartContainer.addEventListener('change', calculateCountPrice);
  cartContainer.addEventListener('click', delete_cart_item);
  searchProductInput.addEventListener('keydown', searchProduct);
};

</script>