<div class="modal right fade" id="editbrand{{$brand->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Edit Brand</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('brands.update',$brand)}}" method="POST">
                  @csrf
                  @method('PUT')
                    <div class="form-group">
                      <label for="name">Brand Name</label>
                      <input type="text" name="name" class="form-control" value="{{old('name',$brand->name)}}">
                    </div>
                    <div class="form-group">
                      <label for="name">Description</label>
                      <input type="text" name="description" class="form-control" value="{{old('description',$brand->description)}}">
                    </div>
                                  
                  <button class="btn btn-warning" type="submit">Update</button>
              </form>
            </div>
      
        </div>
    </div>
  </div>