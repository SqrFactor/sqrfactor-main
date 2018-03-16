@extends('layouts.app-users')
@section('title') Basic Details | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')

    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
         @include('users.partials.left-sidebar')
            <!-- End Left Sidebar -->
            <!-- Main Content -->
            <div class="col-xl-9">
                <div class="ui-block">
                    @include('sqrfactor.partials.message')
                    <div class="ui-block-title">
                        <h6 class="title">Basic Detail</h6>
                    </div>
                    <div class="ui-block-content">
                        <!-- form -->
                        <form action="{{ route('hireIndividualBasicDetail.save') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Firm Name*</label>
                                        {{--{{ dd(Auth::user()->userDetail) }}--}}
                                        <input class="form-control" name="first_name" value="@if(!empty(Auth::user()->first_name)){{ Auth::user()->first_name }} @endif"  placeholder="" type="text">
                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('first_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Last Name*</label>
                                        <input class="form-control" placeholder="" value="@if(!empty(Auth::user()->last_name)){{ Auth::user()->last_name }} @endif"  name="last_name" type="text">
                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <div class="row append_email_html">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email *</label>
                                        <input class="form-control" placeholder="" value="@if(!empty(Auth::user()->email)){{ Auth::user()->email }} @endif" type="text" readonly style="background-color: white;">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="add_more_email">Add More Email +</button>
                                </div>

                            </div>

                            @if($emails->count())

                                @foreach($emails as $email)

                                    <div class="row  remove_email_html{{$email->id }}" id="getClass" data-class="remove_email_html{{$email->id }}">
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Email *</label>
                                                <input class="form-control" placeholder="" value="{{ $email->email }} " name="email[]" type="text" readonly style="background-color: white;">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" data-id="{{ $email->id }}" style="color: #fff;background-color: #f84343;border-color: #f84343;" class="remove_email">Remove -</button>
                                        </div>

                                    </div>
                                @endforeach
                            @endif

                            <div class="row">
                                <div class="col-md-6">




                                    <div class="form-group label-floating">
                                        @if(Auth::user()->mobile_verify == 'n' && Auth::user()->mobile_number != null)
                                            <a href="javascript:void(0)" class="mobile_verify_model" style="" >Click For Verify </a>
                                        @elseif(Auth::user()->mobile_number == null)
                                            <a href="javascript:void(0)" class="mobile_verify_model" style="display: none" >Click For Verify </a>
                                        @endif

                                        <label class="control-label">Mobile Number*@if(Auth::user()->mobile_number !== null && Auth::user()->mobile_verify == 'y')(<span style="color: green;">Verified</span>) @elseif(Auth::user()->mobile_number !== null && Auth::user()->mobile_verify == 'n') (<span style="color: red;" class="not_verified"> Unverified OTP</span>) @elseif(Auth::user()->mobile_number == null) <span style="color: red;display: none;" class="not_verified"  >( Unverified OTP )</span>
                                            @endif   </label>

                                        <input readonly class="form-control appendMobileNumber" placeholder="" value=" @if(!empty(Auth::user()->mobile_number)){{ Auth::user()->mobile_number }} @else {{ old('mobile_number') }} @endif " style="    background-color: #FFFFFF;" name="mobile_number"  type="text" >
                                        @if ($errors->has('mobile_number'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('mobile_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">



                                    <div class="form-group label-floating">
                                        <label class="control-label">Occupation  </label>
                                        <input class="form-control" placeholder="" value="@if(!empty(Auth::user()->userDetail->occupation)){{ Auth::user()->userDetail->occupation }} @else {{ old('occupation') }} @endif" type="text" name="occupation">
                                        @if ($errors->has('occupation'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('occupation') }}</strong>
                                        </span>
                                        @endif
                                    </div>


                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Gender*</label>
                                        <select class="selectpicker form-control" name="gender">
                                            <option disabled selected> Gender*</option>
                                            <option value="male"@if(!empty(Auth::user()->userDetail->gender)) @if(Auth::user()->userDetail->gender == 'male') selected @endif @endif>Male</option>
                                            <option value="female" @if(!empty(Auth::user()->userDetail->gender)) @if(Auth::user()->userDetail->gender == 'female') selected @endif @endif>Female</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('gender') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label"> Date Of Birth  </label>
                                        <input class="form-control" value="@if(!empty(Auth::user()->userDetail->date_of_birth)){{ Auth::user()->userDetail->date_of_birth }} @else {{ old('date_of_birth') }} @endif" placeholder="" id="date_of_birth" name="date_of_birth" type="text">
                                        @if ($errors->has('date_of_birth'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('date_of_birth') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-group label-floating">
                                        <label class="control-label"> Pin Code </label>
                                        <input class="form-control"  name="pin_code" placeholder="" value="@if(!empty(Auth::user()->userDetail->pin_code)){{ Auth::user()->userDetail->pin_code }} @else {{ old('pin_code') }} @endif" type="text">
                                        @if ($errors->has('pin_code'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('pin_code') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">UID (Aadhar Id)  </label>
                                        <input class="form-control" name="aadhar_id" value="@if(!empty(Auth::user()->userDetail->aadhar_id)){{ Auth::user()->userDetail->aadhar_id }} @endif" placeholder="" type="text">
                                        @if ($errors->has('aadhar_id'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('aadhar_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Address </label>
                                        <input class="form-control" placeholder="" name="address" value="@if(!empty(Auth::user()->userDetail->address)){{ Auth::user()->userDetail->address }} @else {{ old('address') }} @endif" type="text">
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                @if(Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null )

                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your Country*</label>
                                            <select class="selectpicker form-control"  name="country" data-live-search="true">
                                                <option selected disabled>Select Country</option>
                                                @if($countries->count())
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}"  @if(Auth::user()->userDetail->country_id == $country->id) selected @endif>{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('country'))
                                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('country') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your State / Province*</label>
                                            <select class="selectpicker form-control state" name="state" data-live-search="true">
                                                <option selected disabled>Select State</option>
                                                @if($states->count())
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}" @if(Auth::user()->userDetail->state_id == $state->id) selected @endif >{{ $state->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('state'))
                                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('state') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your City*</label>
                                            <select class="selectpicker form-control city" name="city" data-live-search="true">
                                                <option selected disabled>Select City</option>
                                                @if($cities->count())
                                                    @foreach($cities as $city)

                                                        <option value="{{ $city->id }}" @if(Auth::user()->userDetail->city_id == $city->id) selected @endif >{{ $city->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('city'))
                                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('city') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>



                                @else
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your Country*</label>
                                            <select class="selectpicker form-control" name="country"  data-live-search="true">
                                                <option selected disabled>Select Country</option>
                                                @if($countries->count())
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" >{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('country'))
                                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('country') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your State / Province*</label>
                                            <select class="selectpicker form-control state" data-live-search="true" name="state">
                                            </select>
                                            @if ($errors->has('state'))
                                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('state') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your City*</label>
                                            <select class="selectpicker form-control city  fghfghfghf" name="city" data-live-search="true">
                                            </select>
                                            @if ($errors->has('city'))
                                                <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('city') }}</strong>
                                        </span>
                                            @endif

                                        </div>

                                    </div>



                                @endif



                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Short Bio (150 Words)</label>
                                        <textarea class="form-control counter_text" name="short_bio" maxlength="150">@if(!empty(Auth::user()->userDetail->short_bio)){{ Auth::user()->userDetail->short_bio }} @else {{ old('short_bio') }} @endif</textarea>
                                        <p class="errors" style="color: red;display: none;"></p>
                                        <p class="errors_counter" style="color: green;display: none;"></p>
                                        @if ($errors->has('short_bio'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('short_bio') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Looking for an Architect, Interior Designer or just design ideas? Let us know your preferences. (400-500 words)</label>
                                        <textarea class="form-control counter_text" name="looking_for_an_architect" placeholder="" maxlength="500">@if(!empty(Auth::user()->userDetail->looking_for_an_architect)){{ Auth::user()->userDetail->looking_for_an_architect }} @else {{ old('looking_for_an_architect') }} @endif</textarea>
                                        <p class="errors" style="color: red;display: none;"></p>
                                        <p class="errors_counter" style="color: green;display: none;"></p>
                                        @if ($errors->has('looking_for_an_architect'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('looking_for_an_architect') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Facebook Link</label>
                                        <input class="form-control" name="facebook_link" placeholder="" value="@if(!empty(Auth::user()->userDetail->facebook_link)){{ Auth::user()->userDetail->facebook_link }} @else {{ old('facebook_link') }} @endif" type="text">
                                        @if ($errors->has('facebook_link'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('facebook_link') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Twitter Link</label>
                                        <input class="form-control" name="twitter_link" placeholder="" value="@if(!empty(Auth::user()->userDetail->twitter_link)){{ Auth::user()->userDetail->twitter_link }} @else {{ old('twitter_link') }} @endif" type="text">
                                        @if ($errors->has('twitter_link'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('twitter_link') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Linkedin Link</label>
                                        <input class="form-control" name="linkedin_link" value="@if(!empty(Auth::user()->userDetail->linkedin_link)){{ Auth::user()->userDetail->linkedin_link }} @else {{ old('linkedin_link') }} @endif" placeholder="" type="text">
                                        @if ($errors->has('linkedin_link'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('linkedin_link') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Instagram Link</label>
                                        <input class="form-control" placeholder="" value="@if(!empty(Auth::user()->userDetail->instagram_link)){{ Auth::user()->userDetail->instagram_link }} @else {{ old('instagram_link') }} @endif" name="instagram_link" type="text">
                                        @if ($errors->has('instagram_link'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('instagram_link') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>



                            </div>
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold">Save all Changes</button>
                        </form>
                        <!-- end form -->
                    </div>
                </div>
            </div>
            <!-- End Main Content -->
        </div>
    </div>

    @endsection