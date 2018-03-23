@extends('layouts.app-users')

@section('title') Basic Details | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('styles')

    <style>
        .add_more_email, .remove_email{
            width:35%; 
            height: 70%; 
            background-color: white; 
            border:2px solid #515365; 
            color:#515365
        }
        .add_more_mail, .remove_more_mail:hover
        {
            background-color: #515365 !important;
            color: white !important;
            border:2px solid #515365 !important;
        }
        .add_email{
            width:100%; 
            height: 70%; 
            background-color: white; 
            border:2px solid #515365; 
            color:#515365
        }
        .add_email:hover
        {
            background-color: #515365 !important;
            color: white !important;
            border:2px solid #515365 !important; 
        }

    </style>

@endsection

@section('content')
    <div class="container">
        <div class="row">
        @if(!isset($_REQUEST['simple']))

            <!-- Left Sidebar -->
            @include('users.partials.left-sidebar')
            <!-- End Left Sidebar -->
        @endif

        <!-- Main Content -->
            <div class="col-xl-9">
                <div class="ui-block">
                    @include('sqrfactor.partials.message')
                    <div class="ui-block-title">
                        <h6 class="title">Basic Detail</h6>
                    </div>
                    <div class="ui-block-content">
                        <!-- form -->

                        <form method="POST" id="work_individual_basic_form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">First Name*</label>
                                        <input class="form-control" placeholder=""
                                               @if(!empty(Auth::user()->first_name))value="{{ Auth::user()->first_name }}"
                                               @endif name="first_name" type="text">
                                        <p class="errors" style="color: red;display: none;"></p>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Last Name*</label>
                                        <input class="form-control" placeholder=""
                                               @if(!empty(Auth::user()->last_name)) value="{{ Auth::user()->last_name }}"
                                               @endif name="last_name" type="text">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>

                            </div>

                            <div class="row append_email_html">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email *</label>
                                        <input class="form-control" placeholder=""
                                               value="@if(!empty(Auth::user()->email)){{ Auth::user()->email }} @endif"
                                               type="text" readonly style="background-color: white;">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="add_more_email btn btn-primary font-weight-bold add_email">
                                        Add Email
                                    </button>
                                </div>

                            </div>
                            @if($emails->count())

                                @foreach($emails as $email)
                                    <div class="row  remove_email_html{{$email->id }}" id="getClass"
                                         data-class="remove_email_html{{$email->id }} ">
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Email *</label>
                                                <input class="form-control" placeholder="" value="{{ $email->email }} "
                                                       name="email[]" type="text" readonly
                                                       style="background-color: white;">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" data-id="{{ $email->id }}"
                                                    class="remove_email btn  font-weight-bold">
                                                Remove
                                            </button>

                                        </div>

                                        </div>
                                        
                                @endforeach
                            @endif


                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group label-floating">
                                        @if(Auth::user()->mobile_verify == 'n' && Auth::user()->mobile_number != null)
                                            <a href="javascript:void(0)" class="mobile_verify_model" style="">Click For
                                                Verify </a>
                                        @elseif(Auth::user()->mobile_number == null)
                                            <a href="javascript:void(0)" class="mobile_verify_model"
                                               style="display: none">Click For Verify </a>
                                        @endif

                                        <label class="control-label">Mobile
                                            Number*@if(Auth::user()->mobile_number !== null && Auth::user()->mobile_verify == 'y')
                                                (<span style="color: green;">Verified</span>
                                                ) @elseif(Auth::user()->mobile_number !== null && Auth::user()->mobile_verify == 'n')
                                                (<span style="color: red;" class="not_verified"> Unverified OTP</span>
                                                ) @elseif(Auth::user()->mobile_number == null) <span
                                                        style="color: red;display: none;" class="not_verified">( Unverified OTP )</span>
                                            @endif   </label>

                                        <input readonly class="form-control appendMobileNumber" placeholder=""
                                               @if(!empty(Auth::user()->mobile_number)) value="{{ Auth::user()->mobile_number }}"
                                               @else value="{{ old('mobile_number') }}"
                                               @endif  style="    background-color: #FFFFFF;" name="mobile_number"
                                               type="text">
                                        <p class="errors" style="color: red;display: none;"></p>

                                    </div>
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"> Date Of Birth </label>
                                        <input class="form-control"
                                               @if(!empty(Auth::user()->userDetail->date_of_birth)) value="{{ Auth::user()->userDetail->date_of_birth }}"
                                               @else value="{{ old('date_of_birth') }}" @endif placeholder=""
                                               id="date_of_birth" name="date_of_birth" type="text">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>

                                    {{-- <div class="form-group label-floating">
                                         <label class="control-label">Address </label>
                                         <input class="form-control" placeholder="" name="address" @if(!empty(Auth::user()->userDetail->address))  value="{{ Auth::user()->userDetail->address }}" @else value="{{ old('address') }}"  @endif type="text">
                                         <p class="errors" style="color: red;display: none;"></p>
                                     </div>--}}


                                </div>
                                <div class="col-md-6">

                                    <div class="form-group label-floating is-select">
                                        {{--  <label class="control-label">Gender</label>--}}
                                        <select class="selectpicker form-control" name="gender">
                                            <option disabled selected> Select Gender*</option>
                                            <option value="male"
                                                    @if(Auth::user()->userDetail->gender == 'male') selected
                                                    @elseif(old('gender') == 'male')  selected @endif>Male
                                            </option>
                                            <option value="female"
                                                    @if(Auth::user()->userDetail->gender == 'female') selected
                                                    @elseif(old('gender') == 'female')  selected @endif>Female
                                            </option>
                                        </select>
                                        <p class="gender_errors" style="color: red;display: none;"></p>
                                    </div>

                                    <div class="form-group label-floating">
                                        <label class="control-label">UID (Aadhar Id) </label>
                                        <input class="form-control" placeholder=""
                                               @if(!empty(Auth::user()->userDetail->aadhar_id)) value="{{ Auth::user()->userDetail->aadhar_id }}"
                                               @else value="{{ old('aadhar_id')}}" @endif name="aadhar_id" type="text">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>

                                    {{-- <div class="form-group label-floating">
                                         <label class="control-label"> Pin Code </label>
                                         <input class="form-control" @if(!empty(Auth::user()->userDetail->pin_code)) value="{{ Auth::user()->userDetail->pin_code }}" @else value="{{ old('pin_code') }}" @endif placeholder="" name="pin_code" type="text">
                                         <p class="errors" style="color: red;display: none;"></p>
                                     </div>--}}


                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <label class="control-label">Select Occupation*</label>
                                                <div class="remember">
                                                    <div class="checkbox clicked">
                                                        <label>
                                                            <input name="occupation[]" type="checkbox"
                                                                   @if(!empty(Auth::user()->userDetail->occupation)) @if(in_array('Architect',explode(',',Auth::user()->userDetail->occupation))) checked
                                                                   @endif  @endif value="Architect"> Architect
                                                        </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label>
                                                            <input name="occupation[]" type="checkbox"
                                                                   value="Interior Designer"
                                                                   @if(!empty(Auth::user()->userDetail->occupation)) @if(in_array('Interior Designer',explode(',',Auth::user()->userDetail->occupation))) checked @endif @endif>
                                                            Interior Designer
                                                        </label>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label>
                                                            <input name="occupation[]" type="checkbox"
                                                                   value="Design Student"
                                                                   @if(!empty(Auth::user()->userDetail->occupation)) @if(in_array('Design Student',explode(',',Auth::user()->userDetail->occupation))) checked @endif @endif>
                                                            Design Student
                                                        </label>

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label>
                                                            <input name="occupation[]" type="checkbox"
                                                                   value="Landscape Architect"
                                                                   @if(!empty(Auth::user()->userDetail->occupation)) @if(in_array('Landscape Architect',explode(',',Auth::user()->userDetail->occupation))) checked @endif @endif>Landscape
                                                            Architect
                                                        </label>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label>
                                                            <input name="occupation[]" type="checkbox" value="Academician"
                                                                   @if(!empty(Auth::user()->userDetail->occupation)) @if(in_array('Academician ',explode(',',Auth::user()->userDetail->occupation))) checked @endif @endif>Academician
                                                        </label>
                                                        @if(!empty(Auth::user()->userDetail->occupation))

                                                            @foreach(explode(',',Auth::user()->userDetail->occupation) as $item)
                                                                @if('Architect' == $item || 'Interior Designer' == $item || 'Design Student' == $item || 'Landscape Architect' == $item || 'Academician' == $item)
                                                                @else
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label>
                                                                        <input name="occupation[]" type="checkbox"
                                                                               @if(!empty(Auth::user()->userDetail->occupation)) @if(in_array($item,explode(',',Auth::user()->userDetail->occupation))) checked
                                                                               @endif @endif value="{{ $item }}">{{ $item }}
                                                                    </label>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label id="checkbox_append">
                                                            <input id="occupation_other" name="occupation"
                                                                   type="checkbox"> Other
                                                        </label>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                    <div class="row" style="display: none;" id="append_occupation_other_div">
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Other Name*</label>
                                                <input class="form-control" placeholder="" value="" id="other_name"
                                                       name="other_name" type="text">
                                                <p class="error_other" style="color: red;"></p>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">

                                                <a href="javascript:void(0)" class="btn btn-primary "
                                                   id="other_name_add">Add +</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @if(Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null  )

                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your Country*</label>
                                            <select class="selectpicker form-control" name="country"
                                                    data-live-search="true">
                                                <option selected disabled>Select Country</option>
                                                @if($countries->count())
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                                @if(Auth::user()->userDetail->country_id == $country->id) selected @endif>{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p class="errors_country" style="color: red;display: none;"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your State / Province*</label>
                                            <select class="selectpicker form-control state" name="state"
                                                    data-live-search="true">
                                                <option selected disabled>Select State</option>
                                                @if($states->count())
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}"
                                                                @if(Auth::user()->userDetail->state_id == $state->id) selected @endif >{{ $state->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p class="errors_state" style="color: red;display: none;"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your City*</label>
                                            <select class="selectpicker form-control city" name="city"
                                                    data-live-search="true">
                                                <option selected disabled>Select City</option>
                                                @if($cities->count())
                                                    @foreach($cities as $city)

                                                        <option value="{{ $city->id }}"
                                                                @if(Auth::user()->userDetail->city_id == $city->id) selected @endif >{{ $city->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p class="errors_city" style="color: red;display: none;"></p>
                                        </div>
                                    </div>



                                @else
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your Country*</label>
                                            <select class="selectpicker form-control" name="country"
                                                    data-live-search="true">
                                                <option selected disabled>Select Country</option>
                                                @if($countries->count())
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p class="errors_country" style="color: red;display: none;"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your State / Province*</label>
                                            <select class="selectpicker form-control state" data-live-search="true"
                                                    name="state">
                                            </select>
                                            <p class="errors_state" style="color: red;display: none;"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your City*</label>
                                            <select class="selectpicker form-control city  fghfghfghf" name="city"
                                                    data-live-search="true">
                                            </select>
                                            <p class="errors_city" style="color: red;display: none;"></p>
                                        </div>
                                    </div>



                                @endif


                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Short Bio (150 Words)</label>
                                        <textarea class="form-control short_bio_content counter_text" placeholder=""
                                                  maxlength="150"
                                                  name="short_bio">@if(!empty(Auth::user()->userDetail->short_bio)){{ Auth::user()->userDetail->short_bio }} @else {{ old('short_bio')}} @endif</textarea>
                                        <p class="errors" style="color: red;display: none;"></p>
                                        <p class="errors_counter" style="color: green;display: none;"></p>
                                    </div>
                                </div>

                              {{--  <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Describe yourself(400-500 Words)</label>
                                        <textarea class="form-control counter_text" maxlength="500"
                                                  name="describe_yourself"
                                                  placeholder="">@if(!empty(Auth::user()->userDetail->describe_yourself)){{ Auth::user()->userDetail->describe_yourself }}@else{{ old('describe_yourself') }}@endif</textarea>
                                        <p class="errors" style="color: red;display: none;"></p>
                                        <p class="errors_counter" style="color: green;display: none;"></p>
                                    </div>
                                </div>--}}

                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Facebook Link</label>
                                        <input class="form-control" name="facebook_link" placeholder=""
                                               @if(!empty(Auth::user()->userDetail->facebook_link)) value="{{ Auth::user()->userDetail->facebook_link }}"
                                               @else value="{{ old('facebook_link') }}" @endif type="text">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Twitter Link</label>
                                        <input class="form-control" name="twitter_link" placeholder=""
                                               @if(!empty(Auth::user()->userDetail->twitter_link)) value="{{ Auth::user()->userDetail->twitter_link }}"
                                               @else value="{{ old('twitter_link') }}" @endif type="text">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Linkedin Link</label>
                                        <input class="form-control" name="linkedin_link"
                                               @if(!empty(Auth::user()->userDetail->linkedin_link)) value="{{ Auth::user()->userDetail->linkedin_link }}"
                                               @else value="{{ old('linkedin_link') }}" @endif placeholder=""
                                               type="text">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Instagram Link</label>
                                        <input class="form-control" placeholder=""
                                               @if(!empty(Auth::user()->userDetail->instagram_link)) value="{{ Auth::user()->userDetail->instagram_link }}"
                                               @else value="{{ old('instagram_link') }}" @endif name="instagram_link"
                                               type="text">
                                        <p class="errors" style="color: red;display: none;"></p>


                                    </div>
                                </div>

                                <button type="button"
                                        class="btn btn-primary btn-block font-weight-bold save_work_individual">Save &
                                    Next
                                </button>

                            </div>
                        </form>
                        <!-- end form -->
                    </div>


                </div>


            </div>
            <!-- End Main Content -->
        </div>
    </div>

@endsection

