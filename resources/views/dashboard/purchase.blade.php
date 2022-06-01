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
                    <div class="col-md-12">
                        </i> <b>Today </b> : {{$stats->today_purchase ? number_format($stats->today_purchase) : 0}}  ks <br>
                        <b>This Month</b>: {{$stats->this_month_purchase ? number_format($stats->this_month_purchase) : 0}} ks  <br>
                        <b>This Year</b> :  {{$stats->this_year_purchase ? number_format($stats->this_year_purchase) : 0 }} ks<br>
                    </div>            
                </div>
            </div>  
    
        </div>
    </div>
  </div> 