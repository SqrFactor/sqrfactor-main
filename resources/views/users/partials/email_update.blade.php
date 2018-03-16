<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-toggle="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Enter Social Email As You Logged In  </h4>
               {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
--}}
            </div>
            <div class="modal-body">
                <form>




                         <div class="form-group label-floating">
                             <label class="control-label">Enter Social Email As You Logged In </label>
                             <input class="form-control" name="email" placeholder="" type="text">
                             <p class="errors_profile_update" style="color:red;display: none;"></p>
                         </div>




                </form>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                <button type="button" class="btn btn-primary profile_email_update"> Save</button>
            </div>
        </div>
    </div>
</div>