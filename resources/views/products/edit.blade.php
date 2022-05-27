<div class="modal right fade" id="editproduct{{$product->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">Edit product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              {{ $product->id}}
          </div>
          <div class="modal-body">
            <form action="{{ route('products.update', $product) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="name">Product Name *</label>
                  <input type="text" name="name" class="form-control" value="{{old('name',$product->name)}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Size</label>
                  <input type="text" name="size" class="form-control" value="{{old('size',$product->size)}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Color</label>
                  <input type="text" name="color" class="form-control" value="{{old('color',$product->color)}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Barcode *</label>
                  <input type="text" name="barcode" class="form-control" value="{{old('barcode',$product->barcode)}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Price *</label>
                  <input type="text" name="price" class="form-control" value="{{old('price',$product->price)}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Stock</label>
                  <input type="text" name="stock" class="form-control" value="{{old('stock',$product->stock)}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Description</label>
                  <input type="text" name="description" class="form-control" value="{{old('description',$product->description)}}">
                </div>                      
               
                <div class="form-group">
                              <label for="status">Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                            <option value="1" {{ $product->status == 1 ? 'selected' : ''}}>Active</option>
                            <option value="0" {{ $product->status == 0 ? 'selected' : ''}}>Inactive</option>
                        </select>
        
                </div>
              </div>                      
              <button class="btn btn-warning" type="submit">Update</button>
          </form>
          </div>
  
      </div>
  </div>
</div> 