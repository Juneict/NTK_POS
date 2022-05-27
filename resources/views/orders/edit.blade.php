
<div class="modal right fade" id="editorder{{$order->order_id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Edit Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                 {{$order->order_id}}
            </div>
            <div class="modal-body">
              <form action="/orders/{{$order->order_id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="name">Total Price</label>
                        <input type="text"  class="form-control" value="{{old('received_amount',$order->total_amount)}}" disabled>
                      </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="name">Received Amount</label>
                        <input type="text" name="amount" class="form-control" value="{{old('received_amount',$order->received_amount)}}">
                      </div>
                </div>              
                <button class="btn btn-warning" type="submit">Update</button>
            </form>
            </div>
    
        </div>
    </div>
  </div> 