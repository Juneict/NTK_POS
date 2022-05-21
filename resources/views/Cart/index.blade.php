@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
  <style>
    .cart-container{
      width: 100%;
      height: 350px;
    }
    .cart-total{
      width: 100%;
    }
  </style>
    <!-- Main content -->
    <form id="cart-form" action="{{ route('place-order') }}" method="POST">
    <div class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4">
                        <div class="card">

                            <div class="card-body">
                                
                                      <div class="row">
                                          {{-- barcode input --}}
                                          <div class="form-group col-md-4 barcode">
                                              <input type="text" class="form-control search-barcode" placeholder="Scan Barcodes">
                                          </div>
                                          {{-- barcode end --}}

                                          {{-- customer --}}
                                          <div class="input-group col-md-8">
                                            <select name="customer_id"  class="form-control customer-list">
                                              {{-- <option value="1" class="form-control">Walk-in Customer</option> --}}
                                                @foreach($customers as $customer)
                                                <option value="{{$customer->id}}" class="form-control">{{$customer->customer_name}}</option>
                                                @endforeach
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
                                              
                                              </tbody>
                                            </table>
                                          </div>
                                          {{-- cart end --}}

                                          <div class=" col-md-12">
                                                <table class="table" style="width: 100%">
                                                  <tr>
                                                    <th colspan="4">Total</th>
                                                    <td class="total-price">0</td>
                                                  </tr>
                                                </table>
                                          </div>
                                          <div class="row m-auto">
                                            <div class="col-md-6">
                                              <button class="btn btn-danger cancel-cart" type="submit">Clear</button>
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
                      
                          @csrf
                          <input type="text" name="payment_amount" class="form-control payment-input" value="0">

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
const proceedBtn = document.querySelector('.proceed-btn');
const paymentInput = document.querySelector('.payment-input');
const cancelCartBtn = document.querySelector('.cancel-cart')
const customerList = document.querySelector('.customer-list');
const sendBtn = document.querySelector('.btn-send');

const products = {!! json_encode($products, JSON_HEX_TAG) !!};

let customer_id, customer_name;

const enableButton = () => proceedBtn.style.removeProperty('pointer-events');
const disableButton = () => proceedBtn.style.cssText = 'pointer-events:none';

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

const saveCustomer = function(){
  localStorage.setItem('customer_id', customerList.value);
}

const getIds = function(){
  const inCartItemIds = new Array();
  Array.from(cart.children, tr => inCartItemIds.push(+tr.dataset.id));

  return inCartItemIds;
}

const inputCartItem = function(item){
  
  if(!item) return;

  if(item.stock === 0){
    alert('Item: Out of Stock!');
    return;
  }

  enableButton();

  if(getIds().includes(item.id)){

    updateCartItem(item.id);
    return;
  }

  const html = `
    <tr name="product_id[]" data-id=${item.id}>
      <input type="hidden" name="product_id[]" value="${item.id}">
      <td><input type="text" name="item_name[]" class="form-control item-name" value="${item.name}" readonly></td>
      <td><input type="number" min="1" max="${item.stock}" name="quantity[]" class="form-control item-count" value="1" onkeydown="return false" ></td>
      <td><input type="text" name="item_price[]" class="form-control item-price" value="${item.price}" readonly></td>
      <td><button class="btn btn-sm btn-danger delete-cart-item"><i class="fas fa-trash"></i></button></td>
    </td>
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
  rowElement = '';
}

const calculateTotalPrice = function(){

  const prices = new Array();

  const arr = document.getElementsByClassName('item-price');
  for(let i=0; i< arr.length; i++){
    prices.push(+arr[i].value);
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

    rowElement.querySelector('.item-price').value = count * item.price;
    return;
  }

  count = +e.target.value;
  const parent = e.target.parentElement.parentElement;
  item = products.find(cur => cur.id === +parent.dataset.id)
  
  parent.querySelector('.item-price').value = count * item.price;

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

  if(getIds().length === 0) disableButton();
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

const removeChildItems = function(){
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
      removeChildItems();

      products.forEach(item => getProductList(item));
      return;
    }

    removeChildItems();
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

const proceedCheckout = function(){

  const total_price = document.querySelector('.total-price').innerHTML;
  paymentInput.value = total_price;
}

const clearCheckout = function(e){
  e.preventDefault();

  // remove all child
  cart.innerHTML = '';
  document.querySelector('.total-price').innerHTML = 0;
  localStorage.clear();
  disableButton();

}

const setLocalStorage = function(){
  const cartItems = new Array();
  const total_price = document.querySelector('.total-price').innerHTML;

  Array.from(cart.children, tr => {
    const id = +tr.dataset.id;
    const name = tr.querySelector('.item-name').value;
    const count = +tr.querySelector('.item-count').value;
    const price = +tr.querySelector('.item-price').value;

    cartItems.push({id, name, count, price});
  });

  localStorage.setItem('cart_items', JSON.stringify(cartItems));
  localStorage.setItem('total_price', total_price);
}

const renderLocalStorage = function(){

    const customer_id = localStorage.customer_id;
    const cart_items = JSON.parse(localStorage.getItem("cart_items"));
    const total_price = localStorage.total_price;
  
    if(customer_id) customerList.value = customer_id;
    
    if(!cart_items) return;

    cart_items.forEach((item, i) => {

      const related_item = products.find(cur => cur.id === +cart_items[i].id);

      const html = `
        <tr name="product_id" data-id=${cart_items[i].id}>
          <input type="hidden" name="product_id[]" value="${cart_items[i].id}">
          <td><input type="text" name="item_name[]" class="form-control item-name" value="${cart_items[i].name}" readonly></td>
          <td><input type="number" min="1" max="${related_item.stock}" name="quantity[]" class="form-control item-count" value="${cart_items[i].count}" onkeydown="return false"></td>
          <td><input type="text" name="item_price[]" class="form-control item-price" value="${cart_items[i].price}" readonly></td>
          <td><button class="btn btn-sm btn-danger delete-cart-item"><i class="fas fa-trash"></i></button></td>
        </tr>
      `;

      cart.insertAdjacentHTML('beforeend', html);
    });

    document.querySelector('.total-price').innerHTML = total_price;

    enableButton();
}

barcodeInput.addEventListener('keydown', searchBarcode);
cartContainer.addEventListener('change', calculateCountPrice);
cartContainer.addEventListener('click', delete_cart_item);
searchProductInput.addEventListener('keydown', searchProduct);
productContainer.addEventListener('click', inputSearchItem);
proceedBtn.addEventListener('click', proceedCheckout);
cancelCartBtn.addEventListener('click', clearCheckout);
customerList.addEventListener('change', saveCustomer);
sendBtn.addEventListener('submit', clearCheckout);

renderLocalStorage();

};

</script>