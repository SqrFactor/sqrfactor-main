<div class="modal fade" id="myModalChangeProfile">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <img src="{{asset('assets/images/avatar.png')}}" alt=""
                 style="display:none;margin-bottom: 25px;" class="profile_image_append_on_model">

                <div style="display: none;" class="demo_change_profile"></div>

                <input type="file" id="upload_change_profile" value="Choose a file" accept="image/*" style="display: none;">

                <div class="form-group mb-0 is-empty" onclick="openFileInput('#upload_change_profile')">
                    <input type="text" readonly="" class="form-control" placeholder="Select Profile Picture" style="background-color: transparent;">
                    <span class="input-group-addon">
                        <i class="fa fa-paperclip" style="font-size: 18px;"></i>
                    </span>
                    <span class="material-input"></span>
                    </div>
                <br/>


                <div class="row">
                    <div class="col-md-4">
                        <button id="cropResult_change_profile" class="btn btn-primary">Update</button>
                        <button id="cropCancel_change_profile" class="btn btn-secondary">Cancel</button>
                    </div>

                    <div class="col-md-8">
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>