<div class="modal right fade" id="editcustomer{{$customer->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">edit customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              {{ $customer->id}}
          </div>
          <div class="modal-body">
                <form action="{{ route('customers.update', $customer) }}" method="POST">
                  @csrf
                  @method('PUT')
                
                    <div class="form-group">
                      <label for="name">Customer Name *</label>
                      <input type="text" name="customer_name" class="form-control" value="{{old('customer_name',$customer->customer_name)}}">
                    </div>
                    <div class="form-group">
                      <label for="name">Phone</label>
                      <input type="text" name="phone" class="form-control" value="{{old('phone',$customer->phone)}}">
                    </div>
                    <div class="form-group">
                      <label for="name">Address</label>
                      <input type="text" name="address" class="form-control" value="{{old('address',$customer->address)}}">
                    </div>
                                    
                  <button class="btn btn-warning" type="submit">Update</button>
              </form>
          </div>
  
      </div>
  </div>
</div> 