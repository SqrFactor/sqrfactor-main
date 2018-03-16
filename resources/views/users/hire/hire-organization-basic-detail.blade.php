@extends('layouts.app-users')

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
                    <h6 class="title">Firm Information</h6>
                </div>
                <div class="ui-block-content">
                    <!-- form -->
                    <form action="{{ route('hireOrganizationBasicDetail.save') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Name Of The Company*</label>
                                    <input class="form-control" placeholder="" value="{{ Auth::user()->fullName() }}" name="name_of_the_company" type="text">
                                    @if ($errors->has('name_of_the_company'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('name_of_the_company') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
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

                        </div>

                        <div class="row append_email_html">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Email *</label>
                                    <input class="form-control" placeholder="" value="@if(!empty(Auth::user()->email)){{ Auth::user()->email }} @endif" type="text" readonly style="background-color: white;">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="button" style="color: #fff;background-color: #007BFF;border-color: #007BFF;" class="add_more_email">Add More Email +</button>
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
                                    <label class="control-label"> Date Of Birth  </label>
                                    <input class="form-control" value="@if(!empty(Auth::user()->userDetail->date_of_birth)){{ Auth::user()->userDetail->date_of_birth }} @else {{ old('date_of_birth') }}   @endif" placeholder="" id="date_of_birth" name="date_of_birth" type="text">
                                    @if ($errors->has('date_of_birth'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('date_of_birth') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group label-floating">
                                    <label class="control-label">Pin Code</label>
                                    <input class="form-control" placeholder="" name="pin_code" value="@if(!empty(Auth::user()->userDetail->pin_code)){{ Auth::user()->userDetail->pin_code }} @else {{ old('pin_code') }}  @endif" type="text">
                                    @if ($errors->has('pin_code'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('pin_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Address</label>
                                    <input class="form-control" placeholder="" value="@if(!empty(Auth::user()->userDetail->address)){{ Auth::user()->userDetail->address }} @else {{ old('address') }} @endif" name="address" type="text" >
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if(Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null  )

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
                                    <textarea class="form-control counter_text" maxlength="150" name="short_bio">@if(!empty(Auth::user()->userDetail->short_bio)){{ Auth::user()->userDetail->short_bio }} @else {{ old('short_bio') }} @endif</textarea>
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
                                    <label class="control-label">Business Description</label>
                                    <textarea class="form-control counter_text" name="business_description" maxlength="500">@if(!empty(Auth::user()->userDetail->business_description)){{ Auth::user()->userDetail->business_description }} @else {{ old('business_description') }} @endif</textarea>
                                    <p class="errors" style="color: red;display: none;"></p>
                                    <p class="errors_counter" style="color: green;display: none;"></p>
                                    @if ($errors->has('business_description'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('business_description') }}</strong>
                                        </span>
                                        @endif
                                </div>
                            </div>

                            <div class="col-md-12 firm_or_company" >
                                <div class="form-group label-floating">
                                    <label class="control-label">Webside</label>
                                    <input class="form-control" placeholder="" value="@if(!empty(Auth::user()->userDetail->webside)){{ Auth::user()->userDetail->webside }} @else {{ old('webside') }} @endif" name="webside" type="text">
                                    @if ($errors->has('webside'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('webside') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>

                            @if ($errors->has('business_description'))
                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('business_description') }}</strong>
                                        </span>
                            @endif



                                <div class="col-md-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Select  Firm/Company</label>
                                        <select class="selectpicker form-control types_of_firm_company" name="types_of_firm_company">
                                            <option disabled selected> Select  Firm/Company</option>
                                            <option value="Private limited" @if(Auth::user()->userDetail->types_of_firm_company == 'Private limited') selected  @elseif('Private limited' == old('types_of_firm_company')) selected @endif >Private limited</option>
                                            <option value="Limited" @if(Auth::user()->userDetail->types_of_firm_company == 'Limited') selected @elseif('Limited' == old('types_of_firm_company')) selected @endif >Limited</option>
                                            <option value="LLP" @if(Auth::user()->userDetail->types_of_firm_company == 'LLP') selected  @elseif('LLP' == old('types_of_firm_company')) selected @endif>LLP</option>
                                        </select>
                                        @if ($errors->has('types_of_firm_company'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('types_of_firm_company') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                           {{-- <input type="hidden" value="" class="types_of_firm_company_value" name="types_of_firm_company_value">--}}



                            <div class="col-md-12 firm_or_company" >
                                <div class="form-group label-floating">
                                    <label class="control-label">Firm/Company Name</label>
                                    <input class="form-control" placeholder="" value="@if(!empty(Auth::user()->userDetail->firm_or_company_name)){{ Auth::user()->userDetail->firm_or_company_name }} @else {{ old('firm_or_company_name') }} @endif" name="firm_or_company_name" type="text">
                                    @if ($errors->has('firm_or_company_name'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('firm_or_company_name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                            </div>



                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Firm/Company Registration Number</label>
                                    <input class="form-control" placeholder="" value="@if(!empty(Auth::user()->userDetail->firm_or_company_registration_number)){{ Auth::user()->userDetail->firm_or_company_registration_number }} @else {{ old('firm_or_company_registration_number') }} @endif" name="firm_or_company_registration_number" type="text">
                                    @if ($errors->has('firm_or_company_registration_number'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('firm_or_company_registration_number') }}</strong>
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