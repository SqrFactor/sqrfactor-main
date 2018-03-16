<div class="modal fade" id="cropBanner_article">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                
                <div class="demo_cropping_banner_article article_banner_image"></div>

                <input type="file" id="upload_cropping_banner_article" value="Choose a file" accept="image/*" style="display: none;">

                <div class="form-group mb-0 is-empty" onclick="openFileInput('#upload_cropping_banner_article')">
                    <input type="text" readonly="" class="form-control" placeholder="Choose a file" style="background-color: transparent;">
                    <span class="input-group-addon">
                        <i class="fa fa-paperclip" style="font-size: 18px;"></i>
                    </span>
                    <span class="material-input"></span>
                </div>

                <br />


                <div class="row">
                    <div class="col-md-4">
                        <button id="cropResult_cropping_banner_article" class="btn btn-primary">Crop</button>
                        <button id="cropCancel_cropping_banner_article" class="btn btn-secondary">Cancel</button>
                    </div>

                    <div class="col-md-8">
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>