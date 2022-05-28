<div class="modal right fade" id="createCustomer" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">Add Customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{route('customers.store')}}" method="POST">
                @csrf
                
                  <div class="form-group">
                    <label for="name">Customer Name *</label>
                    <input type="text" name="customer_name" class="form-control" value="{{old('customer_name')}}">
                  </div>
                  <div class="form-group">
                    <label for="name">Phone</label>
                    <input type="number" name="phone" class="form-control" value="{{old('phone')}}">
                  </div>
                  <div class="form-group">
                    <label for="name">Address</label>
                    <input type="text" name="address" class="form-control" value="{{old('color')}}">
                  </div>
                                
                <button class="btn btn-success" type="submit">Create</button>
            </form>
          </div>
    
      </div>
  </div>
</div>