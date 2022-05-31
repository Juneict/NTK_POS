<div class="modal right fade" id="detailProfit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100" id="staticBackdropLabel">Total Profit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <b>Today</b> : {{ number_format($stats->today_profit)}} ks <br>
                        <b>This Month</b> : {{ number_format($stats->this_month_profit)}} ks<br>
                        <b>This Year</b> : {{ number_format($stats->this_year_profit)}} ks<br>
                    </div>            
                </div>
            </div>  
    
        </div>
    </div>
  </div> 