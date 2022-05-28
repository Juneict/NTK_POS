<div class="modal right fade" id="showinvoice{{$order->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                {{ $order->order_id}}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        Invoice No:#00{{$order->order_id}} <br>
                        Payment Status : @if($order->received_amount == 0)
                        <span class="badge badge-danger">Not Paid</span>
                        @elseif($order->received_amount < $order->total_amount)
                            <span class="badge badge-warning">Partial</span>
                        @elseif($order->received_amount == $order->total_amount)
                            <span class="badge badge-success">Paid</span>
                        @elseif($order->received_amount > $order->total_amount)
                            <span class="badge badge-info">Change</span>
                        @endif     
                    </div>
                    <div class="col-md-4">
                        <b>Customer Name</b>  : {{$order->customer_name}} <br>
                       <b>Address</b>  : {{$order->address}}    
                    </div>
                    <div class="col-md-4">
                       <b> Date </b>: {{date('d-m-Y')}}
                    </div>
                    <div class="col-md-12">
                        <h3>Products</h3>
                    </div>
                    
                    <div class="col-md-2">
                        <b>Product Name</b> <br>
                            {{$order->items}}
                    </div>
                    <div class="col-md-2">
                        <b>Quantity</b> <br>
                            {{$order->total_amount}}
                    </div>
                    <div class="col-md-2">
                        <b>Price</b> <br>
                            {{$order->received_amount}}
                    </div>
                    <div class="col-md-2">
                        <b>Subtotal</b> <br>
                       {{ $order->total_amount-$order->received_amount}}
                    </div>
                </div>
            </div>  
    
        </div>
    </div>
  </div> 