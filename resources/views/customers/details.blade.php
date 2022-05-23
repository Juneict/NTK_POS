<div class="modal right fade" id="showcustomer{{$customer->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">Customer Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              {{ $customer->id}}
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <h5><i class="fas fa-user"></i> {{$customer->customer_name}}</h5>
                <p><i class="fas fa-home mt-3"></i> {{$customer->address}}</p>
                <p><i class="fas fa-mobile"></i> {{$customer->phone}}</p>
              </div>            
            </div>
          </div>  
  
      </div>
  </div>
</div> 