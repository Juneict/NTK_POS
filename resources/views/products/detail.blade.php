<div class="modal right fade" id="showproduct{{$product->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">Product Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              {{ $product->id}}
          </div>
          <div class="modal-body">
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
                  <b>Price</b>: {{ number_format($product->price,2) }} ks<br>
                  <b>Manag Stock?</b>Yes <br>
                  <b>Alert Quantity</b> 5 PCs <br>
                  <b>Product Type</b>: Single
              </div>
              <div class="col-md-4">
                <img src="/dist/img/product1.PNG"class="card-img-top" style="width:100px"alt="">
              </div>
          
          </div>
          </div>  
  
      </div>
  </div>
</div> 