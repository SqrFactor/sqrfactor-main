
<!DOCTYPE html>
<html>
<head>
    <title>Biggest Social network for the Architecture Community! | SqrFactor</title>
    <meta name="description" content="An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!">
    <meta name="keywords" content="sqrfactor,Social network,architects,interior designers">



    @include('sqrfactor.partials.head')
</head>
<body class="login-page" data-base="{{URL::to("/")}}">
<!-- header -->
 @include('sqrfactor.partials.banner-sqr')
<div class="container">
    <div class="clearfix">
        <div class="header-landing header-login">
            <a href="{{ route('login') }}" class="logo">
                <img src="{{ asset('assets/images/logo.jpg') }}" alt=""/>
            </a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row display-flex">
        <div class="col-lg-6">
            <div class="landing-content login-content">
                <h1 class="text-primary">Dear Architecture Community,</h1>
                    <p style="font-size: 20px;">This space has been created for you to learn and explore. A platform designed thoughtfully for architects by a team of architects and developers. </p>
                 <p style="font-size: 20px;">With Love, <br>
                     Team SqrFactor</p>
             
            </div>
        </div>
        <div class="col-lg-6">
            <div class="registration-login-form">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    {{-- Check & tabs with query string or page login route --}}
                    @if(isset($_REQUEST["active"]) && isset($_REQUEST['active']) == "login" || isset($_REQUEST['active']) == "signup")
                        {{-- If query string is present & its valid --}}
                        <li class="nav-item">
                            <a class="nav-link @if(isset($_REQUEST['active']) && $_REQUEST['active'] == 'signup') active @endif or_hide_button"
                               data-toggle="tab" href="#nav-signup" role="tab">
                                <svg class="olymp-register-icon">
                                    <use xlink:href="{{ asset('assets/icons/sqr-icons.svg#sqricon-register') }}"></use>
                                </svg>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if(isset($_REQUEST['active']) && $_REQUEST['active'] == 'login') active  @endif nav_login"
                               data-toggle="tab" href="#nav-login" role="tab">
                                <svg class="olymp-login-icon">
                                    <use xlink:href="{{ asset('assets/icons/sqr-icons.svg#sqricon-login') }}"></use>
                                </svg>
                            </a>
                        </li>
                    @else
                        {{-- If query string is not present & login or singup is direct open --}}
                        <li class="nav-item">
                            <a class="nav-link @if($type == "signup") active @endif or_hide_button"
                               data-toggle="tab" href="#nav-signup" role="tab">
                                <svg class="olymp-register-icon">
                                    <use xlink:href="{{ asset('assets/icons/sqr-icons.svg#sqricon-register') }}"></use>
                                </svg>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if($type == 'login') active  @endif nav_login"
                               data-toggle="tab" href="#nav-login" role="tab">
                                <svg class="olymp-login-icon">
                                    <use xlink:href="{{ asset('assets/icons/sqr-icons.svg#sqricon-login') }}"></use>
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    {{-- Check & tabs with query string or page login route --}}
                    @if(isset($_REQUEST["active"]) && isset($_REQUEST['active']) == "login" || isset($_REQUEST['active']) == "signup")
                        <div class="tab-pane @if(isset($_REQUEST['active']) && $_REQUEST['active'] == 'signup') active @endif"
                             id="nav-signup" role="tabpanel" data-mh="log-tab">
                            <div class="content">
                                <div class="h6" style="margin-bottom: 1.5rem;">Register to Square Factor</div>

                                {{--message statet--}}
                                <div class="register_message" style="display: none;">

                                </div>
                                {{--message end--}}


                                {{--<div class="form-group">--}}
                                    {{--<div class="register-option">--}}
                                        {{--<div class="register-option-item">--}}
                                            {{--<div class="radio">--}}
                                                {{--<label>--}}
                                                    {{--<input type="radio" name="registerOption" value="hire"--}}
                                                           {{--class="hire_select_checked" checked><span--}}
                                                            {{--class="circle "></span><span--}}
                                                            {{--class="check"></span> Hire--}}
                                                {{--</label>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="register-option-item">--}}
                                            {{--<div class="radio">--}}
                                                {{--<label>--}}
                                                    {{--<input type="radio" name="registerOption" value="work"><span--}}
                                                            {{--class="circle"></span><span class="check"></span> Work--}}
                                                {{--</label>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--value--}}
                                <input type="hidden" value="" class="user_type_value">
                                <input type="hidden" value="hire" class="registerOption_value">
                                {{-- end value--}}

                                {{--hire_select--}}
                                {{--<div class="form-group label-floating is-select hire_select" style="display: none;">--}}
                                    {{--<label class="control-label">User type</label>--}}
                                    {{--<select class="selectpicker form-control user_type" name="user_type">--}}
                                        {{--<option selected disabled>User type</option>--}}
                                        {{--<option value="hire_individual" data-name="Individual Consumers">Individual--}}
                                            {{--Consumers--}}
                                        {{--</option>--}}
                                        {{--<option value="real_estate_firm_companies"--}}
                                                {{--data-name=" Real Estate Firm/Companies">--}}
                                            {{--Real Estate Firm/Companies--}}
                                        {{--</option>--}}
                                        {{--<option value="hire_organization" data-name="Government Organizations">--}}
                                            {{--Government--}}
                                            {{--Organizations--}}
                                        {{--</option>--}}

                                    {{--</select>--}}
                                    {{--<p class="registerOption_value_bag" style="color:red;display: none;"></p>--}}
                                {{--</div>--}}

                                {{--work_select--}}
                                <div class="form-group label-floating is-select work_select" style="display: none;">
                                    <label class="control-label">User type</label>
                                    <select class="selectpicker form-control user_type" name="user_type">


                                        <option value="work_individual" data-name="Individuals">Individual</option>
                                        <option value="work_architecture_firm_companies"
                                                data-name="Architecture Firm/Companies">Firm/Companies (Design Service providers)
                                        </option>
                                        <option value="work_architecture_organizations"
                                                data-name="Architecture Organizations">Organizations, Companies, NGO's, Media 
                                        </option>
                                        <option value="work_architecture_college" data-name="Architecture College">
                                            College/University
                                        </option>
                                    </select>
                                    <p class="registerOption_value_bag" style="color:red;display: none;"></p>
                                </div>


                                <div class="row firstName_lastName" style="display: none;">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">First Name</label>
                                            <input class="form-control" name="first_name" value="" placeholder=""
                                                   type="text">
                                            <p class="error_bag" style="color:red;display: none;"></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Last Name</label>
                                            <input class="form-control" name="last_name" value="" placeholder=""
                                                   type="text">
                                            <p class="error_bag" style="color:red;display: none;"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group label-floating one_input" style="display: none;">
                                    <label class="control-label ddddd">gfdgdfgd </label>
                                    <input class="form-control dfgdfgfdgdfg" placeholder="" name="company_name" value=""
                                           type="text">

                                    <p class="error_bag" style="color:red;display: none;"></p>
                                </div>

                                <div class="row ">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Username</label>
                                            <input class="form-control" name="user_name" value="" placeholder=""
                                                   type="text">
                                            <p class="error_bag" style="color:red;display: none;"></p>
                                            <p class="suggestion" style="color:red;display: none;"></p>
                                            <input type="hidden">

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group label-floating">
                                    <label class="control-label">Your Email</label>
                                    <input class="form-control" placeholder="" name="email" value="" type="email">
                                    <p class="error_bag" style="color:red;display: none;"></p>
                                </div>

                                <div class="form-group label-floating">
                                    <label class="control-label">Mobile No.</label>
                                    <input class="form-control" placeholder="" name="mobile_number" value=""
                                           type="text">
                                    <p class="error_bag" style="color:red;display: none;"></p>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">Your Password</label>
                                    <input class="form-control" placeholder="" name="password" value="" type="password">
                                    <p class="error_bag" style="color:red;display: none;"></p>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">Confirm Password </label>
                                    <input class="form-control" placeholder="" id="password_confirmation"
                                           name="password_confirmation" value="" type="password">
                                    <p class="error_bag" style="color:red;display: none;"></p>
                                </div>
                                <div class="remember">
                                    <div class="checkbox">
                                        <label>
                                            <input name="terms_and_conditions" id="terms_and_conditions"
                                                   class="terms_and_conditions" type="checkbox" value="yes"> I accept
                                            the <a href="{{route('tc')}}" target="_blank" class="d-inline-block">Terms and Conditions</a> of the
                                            website
                                            <input type="hidden" class="terms_and_conditions_value"
                                                   name="terms_and_conditions_value" value="">
                                            <p class="terms_and_conditions11" style="color:red;display: none;"></p>
                                        </label>
                                    </div>
                                </div>


                                <a href="javascript:void(0)"
                                   class="btn btn-lg btn-secondary full-width  complete_registration"
                                   style="display: none;">Complete Registration!
                                    <div class="ripple-container"></div>
                                </a>
                                <a href="javascript:void(0)"
                                   class="btn btn-lg btn-secondary full-width  complete_registration_only_register"
                                   style="display: none;">Complete Registration!
                                    <div class="ripple-container"></div>
                                </a>

                                <div class="or or_hide" style="display: none;"></div>
                                <div class="social_button">
                                    <a href="javascript:void(0)" id="facebook_login_werning_signup"
                                       class="btn btn-lg bg-facebook full-width btn-icon-left facebook_login "><i
                                                class="fa fa-facebook" aria-hidden="true"></i>Login with Facebook</a>
                                    <a href="javascript:void(0)" id="google_werning_signup"
                                       class="btn btn-lg bg-googleplus full-width btn-icon-left google_login "><i
                                                class="fa fa-google-plus" aria-hidden="true"></i>Login with Google Plus</a>

                                </div>


                            </div>
                        </div>

                        <div class="tab-pane @if(isset($_REQUEST['active']) && $_REQUEST['active'] == 'login') active @endif nav_login"
                             id="nav-login" role="tabpanel" data-mh="log-tab">
                            <div class="content">
                                <div class="h6" style="margin-bottom: 1.5rem;">Login to your Account</div>

                                {{--message statet--}}
                                <div class="resentEmail"></div>
                                @include('sqrfactor.partials.message')
                                {{--message end--}}
                                <form>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Your Email</label>
                                        <input class="form-control email_login" placeholder="" name="email"
                                               type="email">
                                        <p class="login_errors" style="color: red;display: none;"></p>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Your Password</label>
                                        <input class="form-control password_login" placeholder="" type="password"
                                               name="password">
                                        <p class="login_errors" style="color: red;display: none;"></p>
                                    </div>
                                    <div class="remember">
                                        <div class="checkbox mr-3">
                                            <label>
                                                <input name="optionsCheckboxes" id="optionsCheckboxes"
                                                       class="remember_login" name="remember" type="checkbox"> Remember
                                                Me
                                                <input type="hidden" class="remember_login_value"
                                                       name="remember_login_value">
                                            </label>
                                        </div>
                                        <a href="{{ route('password.request') }}" class="forgot ">Forgot my Password</a>
                                    </div>

                                    <a href="javascript:void(0)"
                                       class="btn btn-lg btn-secondary full-width  login_user">Login</a>
                                    <div class="or"></div>
                                    <a href="javascript:void(0)" id="facebook_login_werning_login"
                                       class="btn btn-lg bg-facebook full-width btn-icon-left facebook_login "><i
                                                class="fa fa-facebook" aria-hidden="true"></i>Login with Facebook</a>

                                    <a href="javascript:void(0)" id="google_werning_login"
                                       class="btn btn-lg bg-googleplus full-width btn-icon-left google_login "><i
                                                class="fa fa-google-plus" aria-hidden="true"></i>Login with Google Plus</a>


                                </form>
                            </div>
                        </div>
                    @else
                        {{-- If query string is not present & login or singup is direct open --}}

                        <div class="tab-pane @if($type == 'signup') active @endif"
                             id="nav-signup" role="tabpanel" data-mh="log-tab">
                            <div class="content">
                                <div class="h6" style="margin-bottom: 1.5rem;">Register to Square Factor</div>

                                {{--message statet--}}
                                <div class="register_message" style="display: none;">

                                </div>
                                {{--message end--}}


                                {{--  <div class="form-group">
                                      <div class="register-option">
                                          --}}{{--<div class="register-option-item">
                                              <div class="radio">
                                                  <label>
                                                      <input type="radio" name="registerOption" value="hire"
                                                             class="hire_select_checked" checked><span class="circle "></span><span
                                                              class="check"></span> Hire
                                                  </label>
                                              </div>
                                          </div>--}}{{--

                                          <div class="register-option-item">
                                              <div class="radio">
                                                  <label>
                                                      <input type="radio" name="registerOption" value="work" ><span
                                                              class="circle"></span><span class="check"></span> Work
                                                  </label>
                                              </div>
                                          </div>
                                      </div>
                                  </div>--}}

                                {{--value--}}
                                <input type="hidden" value="" class="user_type_value">
                                <input type="hidden" value="hire" class="registerOption_value">
                                {{-- end value--}}

                                {{--hire_select--}}
                                {{--<div class="form-group label-floating is-select hire_select" style="display: none;">
                                    <label class="control-label">User type</label>
                                    <select class="selectpicker form-control user_type" name="user_type">
                                        <option selected disabled>User type</option>
                                        <option value="hire_individual" data-name="Individual Consumers">Individual
                                            Consumers
                                        </option>
                                        <option value="real_estate_firm_companies" data-name=" Real Estate Firm/Companies">
                                            Real Estate Firm/Companies
                                        </option>
                                        <option value="hire_organization" data-name="Government Organizations">Government
                                            Organizations
                                        </option>

                                    </select>
                                    <p class="registerOption_value_bag" style="color:red;display: none;"></p>
                                </div>--}}

                                {{--work_select--}}

                                <div class="form-group label-floating is-select work_select" style="display: none;">
                                    <label class="control-label">User type</label>
                                    <select class="selectpicker form-control user_type" name="user_type">


                                        <option value="work_individual" data-name="Individuals">Individual</option>
                                        <option value="work_architecture_firm_companies"
                                                data-name="Architecture Firm/Companies">Firm/Companies (Design Service providers)
                                        </option>
                                        <option value="work_architecture_organizations"
                                                data-name="Architecture Organizations">Organizations, Companies, NGO's, Media 
                                        </option>
                                        <option value="work_architecture_college" data-name="Architecture College">
                                            College/University
                                        </option>
                                    </select>
                                    <p class="registerOption_value_bag" style="color:red;display: none;"></p>
                                </div>
                                <div class="row firstName_lastName" style="display: none;">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">First Name</label>
                                            <input class="form-control" name="first_name" value="" placeholder=""
                                                   type="text">
                                            <p class="error_bag" style="color:red;display: none;"></p>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Last Name</label>
                                            <input class="form-control" name="last_name" value="" placeholder=""
                                                   type="text">
                                            <p class="error_bag" style="color:red;display: none;"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group label-floating one_input" style="display: none;">
                                    <label class="control-label ddddd">gfdgdfgd </label>
                                    <input class="form-control dfgdfgfdgdfg" placeholder="" name="company_name" value=""
                                           type="text">

                                    <p class="error_bag" style="color:red;display: none;"></p>
                                </div>

                                <div class="row ">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group label-floating ">
                                            <label class="control-label">Username</label>
                                            <input class="form-control" name="user_name" value="" placeholder=""
                                                   type="text">
                                            <p class="error_bag" style="color:red;display: none;"></p>
                                            <p class="suggestion" style="color:red;display: none;"></p>
                                            <input type="hidden">

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group label-floating">
                                    <label class="control-label">Your Email</label>
                                    <input class="form-control" placeholder="" name="email" value="" type="email">
                                    <p class="error_bag" style="color:red;display: none;"></p>
                                </div>
                                 <div class="form-group label-floating is-select work_select" style="display: none;">
                                    <label class="control-label">Choose country</label>
                                    <!-- <select class="selectpicker form-control user_type"  id="country-name">

                                        @foreach($countries as $country)
                                        <option value="{{$country->phonecode}}" >{{$country->name}}</option>
                                        @endforeach
                                    </select> -->
                                    <select class="selectpicker form-control user_type" id="country-name"
                                            data-live-search="true">
                                        <option selected disabled>Select Country</option>
                                        @if($countries->count())
                                            @foreach($countries as $country)
                                                <option 
                                                value="{{$country->phonecode}}"
                                                @if($country->phonecode == "91")
                                                    selected
                                                @endif>
                                                {{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="registerOption_value_bag" style="color:red;display: none;"></p>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">Mobile No.</label>
                                    <input class="form-control" placeholder="" name="mobile_number" value=""
                                           type="text">
                                    <p class="error_bag" style="color:red;display: none;"></p>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">Your Password</label>
                                    <input class="form-control" placeholder="" name="password" value="" type="password">
                                    <p class="error_bag" style="color:red;display: none;"></p>
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">Confirm Password </label>
                                    <input class="form-control" placeholder="" id="password_confirmation"
                                           name="password_confirmation" value="" type="password">
                                    <p class="error_bag" style="color:red;display: none;"></p>
                                </div>
                                <div class="remember">
                                    <div class="checkbox">
                                        <label>
                                            <input name="terms_and_conditions" id="terms_and_conditions"
                                                   class="terms_and_conditions" type="checkbox" value="yes"> I accept
                                            the <a
                                                    href="{{route('tc')}}" target="_blank" class="d-inline-block">Terms and Conditions</a> of the
                                            website
                                            <input type="hidden" class="terms_and_conditions_value"
                                                   name="terms_and_conditions_value" value="">
                                            <p class="terms_and_conditions11" style="color:red;display: none;"></p>
                                        </label>
                                    </div>
                                </div>


                                <a href="javascript:void(0)"
                                   class="btn btn-lg btn-secondary full-width  complete_registration"
                                   style="display: none;">Complete Registration!
                                    <div class="ripple-container"></div>
                                </a>
                                <a href="javascript:void(0)"
                                   class="btn btn-lg btn-secondary full-width  complete_registration_only_register"
                                   style="display: none;">Complete Registration!
                                    <div class="ripple-container"></div>
                                </a>

                                <div class="or or_hide" style="display: none;"></div>
                                <div class="social_button">
                                    <a href="javascript:void(0)"
                                       class="btn btn-lg bg-facebook full-width btn-icon-left facebook_login " id="facebook_login_werning_signup"><i
                                                class="fa fa-facebook" aria-hidden="true"></i>Login with Facebook</a>
                                    <a href="javascript:void(0)" id="google_werning_signup"
                                       class="btn btn-lg bg-googleplus full-width btn-icon-left google_login "><i
                                                class="fa fa-google-plus" aria-hidden="true"></i>Login with Google Plus</a>

                                </div>


                            </div>
                        </div>

                        <div class="tab-pane @if($type == 'login') active @endif nav_login"
                             id="nav-login" role="tabpanel" data-mh="log-tab">
                            <div class="content">
                                <div class="h6" style="margin-bottom: 1.5rem;">Login to your Account</div>

                                {{--message statet--}}
                                <div class="resentEmail"></div>
                                @include('sqrfactor.partials.message')
                                {{--message end--}}
                                <form>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Your Email</label>
                                        <input class="form-control email_login" placeholder="" name="email"
                                               type="email">
                                        <p class="login_errors" style="color: red;display: none;"></p>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Your Password</label>
                                        <input class="form-control password_login" placeholder="" type="password"
                                               name="password">
                                        <p class="login_errors" style="color: red;display: none;"></p>
                                    </div>
                                    <div class="remember">
                                        <div class="checkbox mr-3">
                                            <label>
                                                <input name="optionsCheckboxes" id="optionsCheckboxes"
                                                       class="remember_login" name="remember" type="checkbox"> Remember
                                                Me
                                                <input type="hidden" class="remember_login_value"
                                                       name="remember_login_value">
                                            </label>
                                        </div>
                                        <a href="{{ route('password.request') }}" class="forgot ">Forgot my Password</a>
                                    </div>

                                    <a href="javascript:void(0)"
                                       class="btn btn-lg btn-secondary full-width  login_user">Login</a>
                                    <div class="or"></div>
                                    <a href="javascript:void(0)" id="facebook_login_werning_login"
                                       class="btn btn-lg bg-facebook full-width btn-icon-left facebook_login "><i
                                                class="fa fa-facebook" aria-hidden="true"></i>Login with Facebook</a>

                                    <a href="javascript:void(0)" id="google_werning_login"
                                       class="btn btn-lg bg-googleplus full-width btn-icon-left google_login "><i
                                                class="fa fa-google-plus" aria-hidden="true"></i>Login with Google Plus</a>


                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('sqrfactor.partials.footer-script')

<script>
    $(".or_hide").show();
    $(".launching_soon").click(function(){
        swal("Success","Feature Launching soon","success");
    });
</script>
</body>
</html>
