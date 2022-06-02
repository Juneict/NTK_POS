<div class="modal right fade" id="createuser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">Add User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form action="{{route('users.store')}}" method="POST">
              @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">User Name *</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                </div>
               
               
                <div class="form-group">
                  <label for="name">Password</label>
                  <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control"> 
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="is_admin" id="" class="form-control">
                        <option value="1">Admin</option>
                        <option value="0">Cashier</option>
                    </select>
                </div>                                     
              <button class="btn btn-success" type="submit">Create</button>
          </form>
          </div>
    
      </div>
  </div>
</div>