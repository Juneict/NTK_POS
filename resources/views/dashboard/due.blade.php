<div class="modal right fade" id="detailDue" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100" id="staticBackdropLabel">Total Due</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <div class="col-md-6">
                        <h4>Due</h4>
                        <b>Today</b> : {{ $stats->today_due ? number_format($stats->today_due) : 0}} ks <br>
                        <b>This Month</b> : {{ $stats->this_month_due ? number_format($stats->this_month_due) : 0}} ks<br>
                        <b>This Year</b> : {{ $stats->this_year_due ? number_format($stats->this_year_due) : 0}} ks<br>
                    </div>    
                    <div class="col-md-6">
                        <h4>Due Received</h4>
                        <b>Today</b> : {{ $stats->today_due_received ? number_format($stats->today_due_received) : 0}} ks <br>
                        <b>This Month</b> : {{ $stats->this_month_due_received ? number_format($stats->this_month_due_received) : 0}} ks<br>
                        <b>This Year</b> : {{ $stats->this_year_due_received ? number_format($stats->this_year_due_received) : 0}} ks<br>
                    </div>         
                </div>
            </div>  
    
        </div>
    </div>
  </div> 