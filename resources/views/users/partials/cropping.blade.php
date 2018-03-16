<div class="modal fade" id="cropModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <input type="file" id="upload" value="Choose a file" accept="image/*" style="display: none;">
                
                <div class="form-group mb-0 is-empty" onclick="openFileInput('#upload')">
                    <input type="text" readonly="" class="form-control" placeholder="Choose a file" style="background-color: transparent;">
                    <span class="input-group-addon">
                        <i class="fa fa-paperclip" style="font-size: 18px;"></i>
                    </span>
                    <span class="material-input"></span>
                    <span class="material-input"></span>
                </div>

                <br />
                <div class="row">
                    <div class="col-md-4">
                        <button id="cropResult" class="btn btn-primary">Update</button>
                        <button id="cropCancel" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>