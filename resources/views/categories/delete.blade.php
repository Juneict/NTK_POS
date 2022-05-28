<div class="modal right fade" id="deletecategory{{$category->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Delete Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body">
                    <form action="/categories/{{$category->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <p> {{ $category->name}} ကို ဖျက်ရန်သေချာပါသလား ?</p>
                    
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
            </div>
    
        </div>
    </div>
</div> 