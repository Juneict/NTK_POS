<div class="modal right fade" id="createproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">Add product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form action="{{route('products.store')}}" method="POST">
              @csrf
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="name">Product Name *</label>
                  <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="">Size</label>
                  <select name="size" id="" class="form-control">
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="L">L</option>
                      <option value="XL">XL</option>
                      <option value="XXL">XXl</option>
                  </select>
                 </div> 
                 <div class="form-group col-md-4">  
                  <label for="">Color</label>
                  <select name="color" id="" class="form-control">
                      <option value="white">white</option>
                      <option value="black">black</option>
                      <option value="blue">blue</option>
                      <option value="red">yellow</option>
                      <option value="green">green</option>
                      <option value="yellow">yellow</option>
                      <option value="brown">brown</option>
                  </select>
                 </div>
                <div class="form-group col-md-4">
                  <label for="name">Barcode *</label>
                  <input type="text" name="barcode" class="form-control" value="{{old('barcode')}}" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Price *</label>
                  <input type="text" name="price" class="form-control" value="{{old('price')}}" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Stock</label>
                  <input type="text" name="stock" class="form-control" value="{{old('stock')}}" required>
                </div>
                <div class="form-group col-md-8">
                  <label for="name">Description</label>
                  <input type="text" name="description" class="form-control" value="{{old('description')}}">
                </div>                      
                
                <div class="form-group">
                              <label for="status">Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                            <option value="1" {{ old('status') === 1 ? 'selected' : ''}}>Active</option>
                            <option value="0" {{ old('status') === 0 ? 'selected' : ''}}>Inactive</option>
                        </select>
        
                </div>
              </div>                      
              <button class="btn btn-success" type="submit">Create</button>
          </form>
          </div>
    
      </div>
  </div>
</div>