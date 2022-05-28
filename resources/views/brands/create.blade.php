<div class="modal right fade" id="createbrand" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add Brand</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('brands.store')}}" method="POST">
                  @csrf
                  
                    <div class="form-group">
                      <label for="name">Brand Name</label>
                      <input type="text" name="name" class="form-control" value="">
                    </div>
                    <div class="form-group">
                      <label for="name">Description</label>
                      <input type="text" name="description" class="form-control" value="">
                    </div>
                                  
                  <button class="btn btn-success" type="submit">Create</button>
              </form>
            </div>
      
        </div>
    </div>
  </div>