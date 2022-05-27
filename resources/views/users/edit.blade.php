<div class="modal right fade" id="editUser{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">edit product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="name">User Name *</label>
                              <input type="text" name="name" class="form-control" value="{{old('name',$user->name)}}">
                            </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="name">Email</label>
                              <input type="email" name="email" class="form-control" value="{{old('email',$user->email)}}">
                          </div>
                      </div>
                  </div>                      
                  <div class="form-group">
                    <label for="name">Change Password</label>
                    <input type="password" name="password" class="form-control" value="">
                  </div>
                  <div class="form-group">
                      <label for="">Role</label>
                      <select name="is_admin" id="" class="form-control">
                        <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>Cashier</option>
                      </select>
                  </div>         
                                  
                <button class="btn btn-warning" type="submit">Update</button>
            </form>
          </div>
    
      </div>
  </div>
</div>