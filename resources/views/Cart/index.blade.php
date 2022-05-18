@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <form action="">
                                      <div class="row">
                                          {{-- barcode input --}}
                                          <div class="form-group col-md-4">
                                              <input type="text" class="form-control" placeholder="Scan Barcode">
                                          </div>
                                          {{-- barcode end --}}

                                          {{-- customer --}}
                                          <div class="form-group col-md-8">
                                            <select name="period"  class="form-control">
                                              <option value="" class="form-control">Walk-in Customer</option>
                                              
                                              <option value="morning" class="form-control">Myat Ko</option>
                                              <option value="evening" class="form-control">Ko Nyi</option>
                                            </select>
                                          </div>
                                          {{-- customer end--}}

                                          {{-- cart --}}
                                          <div class="col-lg-3 col-md-4">
                                            <table class="table  table-striped">
                                              <thead>
                                                  <tr>
                                                    <th>Products</th>
                                                    <th>Quantity</th>
                                                    <th>Discount</th>
                                                    <th>Price</th>
                                                    <th>action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                    
                                                    <td>T-shirt</td>
                                                    <td width="15%">
                                                      <div class="row">
                                                          <div class="">
                                                              <button class="btn btn-sm btn-success">+ </button>
                                                          </div> 
                                                          <div class="">
                                                              1
                                                          </div>
                                                          <div class="">
                                                              <button class="btn btn-sm btn-danger">-</button>
                                                          </div> 
                                                      </div>
                                                      
                                                    </td>
                                                    <td>0.00</td>
                                                    <td>7,000.00</td>
                                                    <td> <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    
                                                    <td>Skirt</td>
                                                    <td width="15%">
                                                      <div class="row">
                                                          <div class="">
                                                              <button class="btn btn-sm btn-success">+ </button>
                                                          </div> 
                                                          <div class="">
                                                              1
                                                          </div>
                                                          <div class="">
                                                              <button class="btn btn-sm btn-danger">-</button>
                                                          </div> 
                                                      </div>
                                                      
                                                    </td>
                                                    <td>0.00</td>
                                                    <td>9,000.00</td>
                                                    <td> <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                  </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          {{-- cart end --}}

                                          <div class="col-md-12">
                                                <table class="table">
                                                  <tr>
                                                    <th colspan="4">Total</th>
                                                    <td>16,000.00</td>
                                                  </tr>
                                                </table>
                                          </div>
                                          <div class="row m-auto">
                                            <div class="col-md-6">
                                              <button class="btn btn-danger" type="submit">Cancle</button>
                                            </div>
                                            <div class="col-md-6">
                                              <button class="btn btn-success" type="submit">Submit</button>
                                            </div>
                                          </div>
                                      </div>
                                      {{-- row --}}                 
                                </form>
                            </div>
                           {{-- card body --}}
                        </div>
                    </div>
                    <div class="col-md-8">
                      <div class="card">
                        <div class="card-body">
                              
                                  <input type="text" class="form-control" placeholder="Search Product">
                            
                              
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- row --}}
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
    

  
</script>