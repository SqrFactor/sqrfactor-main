@extends('layouts.app-news-feed')
@section('content')
    <div class="header-spacer"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-10">
                {{--error message--}}
                @include('error-message')
                {{--end error message--}}
                <div class="competition-launch">
                    <h3 class="h3 mb-5">Post event</h3>
                    <form action="{{ route('event2Add',$usersEvent) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div id="form-2">
                            {{-- Competition Type --}}
                            <div class="row form-group">
                                <input type="hidden" name="event_id" value="{{$usersEvent->id}}">
                                <label class="col-lg-3 col-form-label h6">Competition Type</label>
                                <div class="col-lg-7">
                                    <select class="form-control selectpicker" id="competition_type"
                                            name="event_type_name">
                                        <option value="">Select Competition Type</option>
                                        <option value="free">Free Competition</option>
                                        <option value="paid">Paid Competition</option>
                                    </select>
                                </div>
                            </div>
                            {{-- /Competition Type --}}
                            {{-- url radio --}}
                            <div class="row payement-div" style="display: none;margin-bottom: 20px;margin-top: 20px">
                                <label class="col-lg-3 col-form-label h6"> Registration submission</label>
                                <div class="col-lg-7">
                                    <label class="radio-inline" style="margin-right: 15px;">
                                        <input type="radio" class="reg_form" name="reg_form" value="sqr"
                                               style="display: inline;width: auto;"> Registration from Sqrfactor</label>
                                    <label class="radio-inline">
                                        <input type="radio" class="reg_form" name="reg_form" value="oth"
                                               style="display: inline;width: auto;"> Registration from your own site
                                    </label>
                                    <label id="label-warn" style="color: red; display: none;">Sqrfactor charge 5% on
                                        every transaction</label>
                                </div>
                            </div>
                            <div class="row url" style="display: none;">
                                <label class="col-lg-3 col-form-label h6">Enter url</label>
                                <div class="col-lg-7">
                                    <input class="form-control" id="url" placeholder="Enter the url" type="text"
                                           name="url">
                                </div>

                            </div>
                            {{-- url radio --}}
                            {{-- Early Bird Registration --}}
                            <div class="row form-group ">
                                <label class="col-lg-3 col-form-label h6 paid-registration">Early Bird
                                    Registration</label>
                                <div class="col-lg-7 paid-registration">
                                    <div class="registration-container">
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="Start date"
                                                       class="datepicker form-control"
                                                       name="early_bird_registration_start_date">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="End date"
                                                       class="datepicker form-control"
                                                       name="early_bird_registration_end_date">
                                            </div>
                                        </div>
                                        <div class="registration-type-container">
                                            <div class="registration-type-child row form-group">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Registration Type"
                                                           name="early_bird_registration_type[]">
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control selectpicker"
                                                            name="early_bird_registration_currency[]">
                                                        <option value="USD">USD</option>
                                                        <option value="INR">INR</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" placeholder="Amount"
                                                           name="early_bird_registration_amount[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-2 paid-registration">
                                    <a href="javascript:void(0)" class="link-inverse form-text mt-3"
                                       id="add-more-registration-early-bird"><u>Add more +</u></a>
                                </div>
                            </div>
                            {{-- / Early Bird Registration --}}

                            {{-- Advance Registration --}}
                            <div class="row form-group ">
                                <label class="col-lg-3 col-form-label h6 paid-registration">Advance
                                    Registration</label>
                                <div class="col-lg-7 paid-registration">
                                    <div class="registration-container">
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="Start date"
                                                       class="datepicker form-control"
                                                       name="advance_registration_start_date">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="End date"
                                                       class="datepicker form-control"
                                                       name="advance_registration_end_date">
                                            </div>
                                        </div>
                                        <div class="registration-type-container">
                                            <div class="registration-type-child row form-group">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Registration Type"
                                                           name="advance_registration_type[]">
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control selectpicker"
                                                            name="advance_registration_currency[]">
                                                        <option value="USD">USD</option>
                                                        <option value="INR">INR</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" placeholder="Amount"
                                                           name="advance_registration_amount[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-2 paid-registration">
                                    <a href="javascript:void(0)" class="link-inverse form-text mt-3"
                                       id="add-more-registration-advance"><u>Add more +</u></a>
                                </div>
                            </div>
                            {{-- / Advance Registration --}}

                            {{-- Last Minute Registration --}}
                            <div class="row form-group ">
                                <label class="col-lg-3 col-form-label h6 paid-registration">Last Minute
                                    Registration</label>
                                <div class="col-lg-7 paid-registration">
                                    <div class="registration-container">
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="Start date"
                                                       class="datepicker form-control"
                                                       name="last_minute_registration_start_date">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="End date"
                                                       class="datepicker form-control"
                                                       name="last_minute_registration_end_date">
                                            </div>
                                        </div>
                                        <div class="registration-type-container">
                                            <div class="registration-type-child row form-group">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Registration Type"
                                                           name="last_minute_registration_type[]">
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control selectpicker"
                                                            name="last_minute_registration_currency[]">
                                                        <option value="USD">USD</option>
                                                        <option value="INR">INR</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" placeholder="Amount"
                                                           name="last_minute_registration_amount[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-2 paid-registration">
                                    <a href="javascript:void(0)" class="link-inverse form-text mt-3"
                                       id="add-more-registration-last-minute"><u>Add more +</u></a>
                                </div>
                            </div>
                            {{-- / Last Minute Registration --}}
                            
                        </div>
                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Date & Time <span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <div class="form-group date-time-picker">
                                    <input value="{{ old('datetimepicker') }}" type="text" class="form-control" name="datetimepicker" placeholder="Date">
                                    @if ($errors->has('datetimepicker'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('datetimepicker') }}</strong>
                                        </span>
                                    @endif
                                    <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                </div>
                                <div class="row time-picker-group">
                                    <div class="col-md-6">
                                        <div class="form-group mb-md-0 with-icon-right">
                                            <input type="text" class="form-control time-picker-start" name="start_time" value="{{ old('start_time') }}" placeholder="Start">
                                            @if ($errors->has('start_time'))
                                                <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('start_time') }}</strong>
                                        </span>
                                            @endif
                                            <span class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control time-picker-end" placeholder="End" name="end_time" value="{{ old('end_time') }}">
                                            @if ($errors->has('end_time'))
                                                <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('end_time') }}</strong>
                                        </span>
                                            @endif
                                            <span class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="row">
                            <label class="col-lg-3 col-form-label h6">Event Organizer</label>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <input type="text" name="event_organizer" class="form-control" placeholder="Who’s organising this event" value="{{ old('event_organizer') }}">
                                    @if ($errors->has('event_organizer'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('event_organizer') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="row">
                            <label class="col-lg-3 col-form-label h6">Event Type</label>
                            <div class="col-lg-7">
                                <div class="form-group is-select">
                                    <select class="selectpicker form-control" name="event_type">
                                        <option value="">Select the type of event</option>
                                        <option value="option1" @if(old('event_type') == 'option1') selected @endif >Option 1</option>
                                        <option value="option2" @if(old('event_type') == 'option2') selected @endif>Option 2</option>
                                    </select>
                                    @if ($errors->has('event_type'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('event_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="row">
                            <label class="col-lg-3 col-form-label h6">Admission <span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <div class="form-group is-select">
                                    <select class="selectpicker form-control" name="admission">
                                        <option value="">Select admission type</option>
                                        <option value="option1" @if(old('admission') == 'option1') selected @endif>Option 1</option>
                                        <option value="option2" @if(old('admission') == 'option2') selected @endif>Option 2</option>
                                    </select>
                                    @if ($errors->has('admission'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('admission') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="row">
                            <label class="col-lg-3 col-form-label h6">Price <span class="text-danger">*</span></label>
                            <div class="col-lg-7">
                                <div class="form-group with-icon">
                                    <i class="fa fa-rupee" style="border-right: none;"></i>
                                    <input type="text" class="form-control" placeholder="0" style="padding-left: 50px;" value="{{ old('price') }}" name="price">
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-lg-12 offset-lg-3">
                                <button type="submit" class="btn btn-primary btn-submit">Post Event</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    </script>

@endsection
