@if(Auth::user()->type == null OR Auth::user()->user_type == null OR Auth::user()->email == null OR Auth::user()->mobile_number == null  )

    <input type="hidden" class="open_model" value="false">
    @include('users.partials.profile-update')

@endif


<input type="hidden" id="mobileVerification_model" @if(Auth::user()->mobile_number != null && Auth::user()->mobile_verify == "n") value="true" @endif>


<!-- Modal -->
<div class="modal fade" id="myModalkkk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     {{--aria-hidden="true" data-backdrop="static"--}} data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verify Your Mobile Number </h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group label-floating">
                            <label class="control-label">Enter OTP </label>
                            <input type="text" name="otp" class="form-control">
                            <p class="errors_otp  " style="color: red;"></p>


                            <p class=" pull-right">OTP <a href="javascript:void(0)" class=" resent_otp resend_color">Resend</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary verify_otp " disabled="disabled">Verify</button>
            </div>
        </div>
    </div>
</div>
{{--end model--}}


{{--short bio --}}
<div class="modal fade" id="mobileShortBio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     data-toggle="modal"
     data-short-bio="@if(Auth::user()->userDetail != null && Auth::user()->userDetail->short_bio != null){{ Auth::user()->userDetail->short_bio }} @endif"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Short Bio</h4>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group label-floating">
                        <label class="control-label">Short Bio </label>
                        <textarea class="form-control short_bio_textarea counter_text" maxlength="150"></textarea>
                        <p class="errors" style="color:red;display: none;"></p>
                        <p class="errors_counter" style="color: green;display: none;"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                <button type="button" class="btn btn-primary disabled_short_bio"> Update</button>
            </div>
        </div>
    </div>
</div>
{{--end short bio--}}


{{--view profile pic --}}


<div class="modal fade" id="modelViewProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     data-toggle="modal" @if(isset($user))data-profile="{{ $user->profile }}" @endif data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Profile </h4>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <img class="view_profile_pic_append" src="" alt="">
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
{{--end view profile pic--}}


{{--add more email--}}

<div class="modal fade" id="addMoreEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add More Email</h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form id="add_more_email_form" method="POST">


                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Enter Email</p>
                        </div>
                    </div>
                    <div class="row add_email_model_div">
                        <div class="col-md-9">
                            <div class="form-group label-floating">
                                <label class="control-label">Enter Email </label>
                                <input type="text" readonly class="form-control"
                                       @if(Auth::user()->email != null)value="{{ Auth::user()->email }}"
                                       @endif style="background-color: white;">
                                <p class="errors_email" style="color: red;display: none;"></p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button type="button" class="add_email_model btn btn-primary btn-sm font-weight-bold">Add</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary email_save hello" id="dftgertwewer">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>




