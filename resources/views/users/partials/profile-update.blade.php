<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-toggle="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Fill Detail</h4>
               {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}

            </div>
            <div class="modal-body">
                <form>
                    {{--<div class="form-group">
                        <div class="register-option">
                            <div class="register-option-item">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="registerOption"   value="hire" class="hire_select_checked" checked ><span class="circle "></span><span class="check"></span> Hire
                                    </label>
                                </div>
                            </div>
                            <div class="register-option-item">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="registerOption" value="work"><span class="circle"></span><span class="check"></span> Work
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    --}}{{--value--}}{{--

                    <input type="hidden" value="hire" class="registerOption_value">
                    <input type="hidden" value="hire_individual" class="user_type_value" >
                    --}}{{-- end value--}}{{--

                    --}}{{--hire_select--}}{{--

                    <div class="form-group label-floating is-select  hire_select" style="display: none;" >
                        <label class="control-label">User Type</label>


                            <select class="selectpicker form-control" name="user_type">
                               --}}{{-- <option selected disabled>User type</option>--}}{{--
                                <option value="hire_individual">Individual Consumers</option>
                               --}}{{-- <option value="real_estate_firm_companies">Real Estate Firm/Companies.</option>
                                <option value="hire_organization">Government Organizations.</option>--}}{{--

                            </select>


                        <p class="errors_profile_update" style="color:red;display: none;"></p>
                    </div>



                    <div class="form-group label-floating is-select work_select" style="display: none;">
                        <label class="control-label">User type</label>
                        <select class="selectpicker form-control" name="user_type">
                          --}}{{--  <option value="0" selected disabled>User type</option>--}}{{--
                            <option value="work_individual">Individuals</option>
                            --}}{{--<option value="work_architecture_firm_companies">Architecture Firm/Companies</option>
                            <option value="work_architecture_organizations">Architecture Organizations.</option>
                            <option value="work_architecture_college">Architecture College.</option>--}}{{--
                        </select>
                        <p class="errors_profile_update" style="color:red;display: none;"></p>
                    </div>--}}

                    <div class="form-group label-floating" @if(Auth::user()->user_name != null) style="display: none;"  @endif >
                        <label class="control-label">User Name</label>
                        <input class="form-control email_login" placeholder="" name="user_name"  @if(Auth::user()->user_name != null) readonly style="background-color: white;" value="{{ Auth::user()->user_name }}" @endif type="text" id="user_name_social">
                        <p class="error_bag" style="color:red;display: none;"></p>
                        <p class="suggestion" style="color:red;display: none;"></p>
                    </div>

                    <input type="hidden" value="work" class="registerOption_value" id="registerOption_value">
                    <input type="hidden" value="work_individual" class="user_type_value" id="user_type_value" >


                    <div class="form-group label-floating"  @if(Auth::user()->email != null) style="display: none;"  @endif>
                        <label class="control-label">Your Email</label>
                        <input class="form-control email_login" placeholder="" @if(Auth::user()->email != null ) readonly style="background-color: white;" value="{{ Auth::user()->email }}" @endif name="email" type="email" id="email_social">
                        <p class="error_bag" style="color: red;display: none;"></p>
                    </div>



                    <div class="form-group label-floating"   @if(Auth::user()->mobile_number != null)  style="display: none;" @endif>
                        <label class="control-label">Mobile Number </label>
                        <input class="form-control email_login" placeholder="" name="mobile_number" @if(Auth::user()->mobile_number != null ) readonly style="background-color: white;" value="{{ Auth::user()->mobile_number }}" @endif type="text" id="mobile_number_social">
                        <p class="error_bag" style="color: red;display: none;"></p>
                    </div>



                </form>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                <button type="button" class="btn btn-primary profile_update"> Save</button>
            </div>
        </div>
    </div>
</div>