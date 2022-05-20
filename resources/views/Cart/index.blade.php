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
                                          <div class="input-group col-md-8">
                                            <select name="customer_id"  class="form-control">
                                              <option value="1" class="form-control">Walk-in Customer</option>
                                              @foreach($customers as $customer)
                                              <option value="{{$customer->customer_name}}" class="form-control">{{$customer->customer_name}}</option>
                                              @endforeach
                                            </select>
                                            <div class="input-group-append">
                                              <a href="{{route('customers.create')}}" class="btn btn-default btn-sm"><i class="fas fa-plus"></i></a>
                                            </div>
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
                                                    <td><input type="number" name="quantity" class="form-control item-count" value="1"></td>
                                                   
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
                                    @foreach($productlists as $product)
                                        
                                          <div class="col-md-2 col-lg-2 col-sm-6 justify-content-center search-item" data-id="{{ $product->id }}">
                                              <div class="card">
                                                  <div class="card-body">
                                                    <img src="/dist/img/product.png" class="card-img-top"  alt="">
                                                    <p style="text-align: center; margin-top:3px"><small> {{$product->name}} </small> </p>                                                
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
window.onload = () => {

const barcodeInput = document.querySelector('.search-barcode');
const cartContainer = document.querySelector('.cart-container');
const cart = document.querySelector('.cart');
const counter = document.getElementById('counter'); 
const productContainer = document.querySelector('.product-container');
const searchProductInput = document.querySelector('.search-product');

const products = {!! json_encode($products, JSON_HEX_TAG) !!};

const searchBarcode = function(e){
  if(e.key === 'Enter'){
    e.preventDefault();

    const item = products.find(cur => +cur.barcode === +barcodeInput.value);
    inputCartItem(item);

    calculateTotalPrice();

    setLocalStorage();

    barcodeInput.value = '';
  }
};

const getIds = function(){
  const inCartItemIds = new Array();
  Array.from(cart.children, tr => inCartItemIds.push(+tr.dataset.id));

  return inCartItemIds;
}

const inputCartItem = function(item){
  
  if(!item) return;

  if(getIds().includes(item.id)){

    updateCartItem(item.id);
    return;
  }

  const html = `
  <tr data-id=${item.id}>
    <td class="item-name">${item.name}</td>
    <td><input type="number" min="1" max="${item.stock}" name="quantity" class="form-control item-count" value="1"></td>
    <td class="item-price">${item.price}</td>
    <td> <button class="btn btn-sm btn-danger delete-cart-item"><i class="fas fa-trash"></i></button></td>
  </tr>
  `;

  cart.insertAdjacentHTML('beforeend', html);
}

const inputSearchItem = function(e){
  e.preventDefault();
  
  const element = e.target.closest('.search-item');
  const item = products.find(item => item.id === +element.dataset.id);

  inputCartItem(item);

  calculateTotalPrice();

  setLocalStorage();
}

 

let rowElement;
const updateCartItem = function(id){

  Array.from(cart.children, tr => {

    if(+tr.dataset.id === id){
      rowElement = tr;
      const element = tr.querySelector('.item-count');

      const currentCount = +element.value;
      element.value = currentCount + 1;
    }
  });

  calculateCountPrice(rowElement);
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
  let count, item;

  if(rowElement){
    count = rowElement.querySelector('.item-count').value;
    const id = +rowElement.dataset.id;
    item = products.find(item => item.id === id);

    rowElement.querySelector('.item-price').innerHTML = count * item.price;
    return;
  }

  count = +e.target.value;
  const parent = e.target.parentElement.parentElement;
  item = products.find(cur => cur.id === +parent.dataset.id)
  
  parent.querySelector('.item-price').innerHTML = count * item.price;

  calculateTotalPrice();
  setLocalStorage();
}

const delete_cart_item = function(e){
  e.preventDefault();

  if(!e.target.closest('button')) return;

  const parentTr = e.target.closest('button').parentNode?.parentNode;
  parentTr.parentElement?.removeChild(parentTr);

  calculateTotalPrice();
  
  setLocalStorage();
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
    <div class="col-md-2 col-lg-2 col-sm-6 justify-content-center search-item" data-id="${item.id}">
      <div class="card">
          <div class="card-body">
              <img src="/dist/img/product.png" class="card-img-top"  alt="">
              <p style="text-align: center; margin-top:3px"><small> ${item.name} </small></p>                                                
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

const setLocalStorage = function(){
  const cartItems = new Array();
  const total_price = document.querySelector('.total-price').innerHTML;

  Array.from(cart.children, tr => {
    const id = +tr.dataset.id;
    const name = tr.querySelector('.item-name').innerHTML;
    const count = +tr.querySelector('.item-count').value;
    const price = +tr.querySelector('.item-price').innerHTML;

    cartItems.push({id, name, count, price});
  });

  localStorage.setItem('cart_items', JSON.stringify(cartItems));
  localStorage.setItem('total_price', total_price);
}

const renderLocalStorage = function(){
    
    const cart_items = JSON.parse(localStorage.getItem("cart_items"));
    const total_price = localStorage.total_price;
  
    if(!cart_items) return;

    cart_items.forEach((item, i) => {

      const related_item = products.find(cur => cur.id === +cart_items[i].id);

      const html = `
        <tr data-id=${cart_items[i].id}>
          <td class="item-name">${cart_items[i].name}</td>
          <td><input type="number" min="1" max="${related_item.stock}" name="quantity" class="form-control item-count" value="${cart_items[i].count}"></td>
          <td class="item-price">${cart_items[i].price}</td>
          <td> <button class="btn btn-sm btn-danger delete-cart-item"><i class="fas fa-trash"></i></button></td>
        </tr>
      `;

      cart.insertAdjacentHTML('beforeend', html);
    });

    document.querySelector('.total-price').innerHTML = total_price;
}

barcodeInput.addEventListener('keydown', searchBarcode);
cartContainer.addEventListener('change', calculateCountPrice);
cartContainer.addEventListener('click', delete_cart_item);
searchProductInput.addEventListener('keydown', searchProduct);
productContainer.addEventListener('click', inputSearchItem);

renderLocalStorage();
};

</script>