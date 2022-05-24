<div class="modal right fade" id="showinvoice{{$order->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                {{ $order->id}}
            </div>
            <div class="modal-body">
                
              
                <div class="row">
                    <div class="col-md-4">
                        Invoice No:#00{{$order->id}} <br>
                        Payment Status : @if($order->amount == 0)
                        <span class="badge badge-danger">Not Paid</span>
                        @elseif($order->amount < $order->price)
                            <span class="badge badge-warning">Partial</span>
                        @elseif($order->amount == $order->price)
                            <span class="badge badge-success">Paid</span>
                        @elseif($order->amount > $order->price)
                            <span class="badge badge-info">Change</span>
                        @endif     
                    </div>
                    <div class="col-md-4">
                        <b>Customer Name</b>  : {{$order->customers->customer_name}} <br>
                       <b>Address</b>  : {{$order->customers->address}}    
                    </div>
                    <div class="col-md-4">
                       <b> Date </b>: {{date('d-m-Y')}}
                    </div>
                   
                </div>
                
            </div>  
    
        </div>
    </div>
  </div> 