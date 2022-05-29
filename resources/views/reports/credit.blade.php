@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
   <!-- Main content -->
    <div class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                @endif
                @if (session('error'))
                  <div class="alert alert-danger">
                      {{ session('error') }}
                  </div>
                @endif
                <div class="card-header">
                        <h3 class="card-title">debt List</h3>     
                </div>
                <div class="card-body">
                  
                      <!-- datatable  -->
                      <table id="debtlists" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                              <th>Customer Name</th>                            
                              <th>Phone</th>                            
                              <th>Address</th>                            
                              <th>Total Amount</th>
                              <th>Received Amount</th>   
                              <th>To Pay</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                        <tbody>
                            @foreach($debtlists as $debt)
                              <tr>
                                <td>{{$debt->customer_name}}</td>
                                <td>{{$debt->phone}}</td>
                                <td>{{$debt->address}}</td>
                                <td>{{ number_format($debt->total_amount)}} ks</td>
                                <td>{{ number_format($debt->total_received)}} ks</td>
                                <td>{{ number_format(abs($debt->total_amount-$debt->total_received))}} ks</td>
                                <td>
                                  @if($debt->debt_status == 'no paid')
                                  <span class="badge badge-danger">Not Paid</span>
                                  @elseif($debt->debt_status == 'partial')
                                  <span class="badge badge-warning">Partial</span>
                                  @endif
                                </td>                             
                                <td>
                                    <a href="/credits/{{$debt->debt_id}}"  class="btn btn-success"><i class="fas fa-eye"></i></a>
                                    <a href="" data-toggle="modal" data-target="#editorder{{$debt->debt_id}}" class="btn btn-primary"><i class="fas fa-edit"></i></a> 
                                </td>  
                              </tr>
                            @include('reports.edit')
                            @endforeach  
                        </tbody>
                        <tfoot>
                          <tr>
                              <th colspan="1" style="text-align: center">Total</th>
                              <th></th>
                              <th></th>
                              <th>{{number_format($debtlists->sum('total_amount'))}} ks</th>
                              <th>{{number_format($debtlists->sum('total_received'))}} ks</th>
                              <th>{{number_format(abs($debtlists->sum('total_received')-$debtlists->sum('total_amount')))}} ks</th>
                              <th></th> 
                              <th></th>
                          </tr>
                        </tfoot>
                      </table>  
                </div>
            </div>  
          </div>  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
    <!-- /.content -->
</div>
@endsection
<script src="/plugins/jquery/jquery.min.js"></script>
<script>
     $(function () {
    
    $('#debtlists').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('div.alert').delay(1000).slideUp(300);
  });

  
</script>