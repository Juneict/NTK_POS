<div class="modal right fade" id="detailPurchase" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100" id="staticBackdropLabel">Total Purchase</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <b>Today </b> : {{$purchases->today_purchase}}  ks <br>
                        <b>This Month</b>: {{$purchases->this_month_purchase}} ks : <br>
                        <b>This Year</b> :  {{$purchases->this_year_purchase }} ks<br>
                    </div>            
                </div>
            </div>  
    
        </div>
    </div>
  </div> 