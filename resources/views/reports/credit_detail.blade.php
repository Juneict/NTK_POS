@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
        <!-- Main content -->
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                                <h3 class="card-title">Credit Details</h3>
                                <a href="{{route('credits.index')}}" class="btn btn-success" style="float:right">Back</a>
                        </div>
                        <div class="card-body">     
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mt-3">Payment info</h5>
                                    <table class="table tabled-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Payment Method</th>
                                                <th>Payment Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                @foreach($detail_list as $transaction)
                                                    <tr>
                                                        <td>{{$transaction->updated_at}}</td>
                                                        <td>{{$transaction->amount}}</td>
                                                        <td>Cash</td>
                                                        <td>-</td>
                                                    </tr>
                                                @endforeach
                                            
                                        </tbody>
                                        
                                    </table>
                                </div>
                        
                            </div>
                               
                        </div>        
                    </div>
                </div>
            </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
    <!-- /.content -->

@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
    

  
</script>