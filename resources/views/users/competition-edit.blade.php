@extends('layouts.app-news-feed')

@section('og_title')
    {{$competition->competition_title}} | Sqrfactor Competition
@endsection

@section('og_description')
    {{$competition->competition_title}} competition Sqrfactor
@endsection

@section('og_image')
    {{asset($competition->cover_image)}}
@endsection

@section('styles')
    @include('users.partials.medium-editor-css')
    <style>
        #form-2 {
            display: none;
        }

        .hidden-file {
            display: none;
        }

        .btn-100-width {
            min-width: 100% !important;
        }

        .cursor {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="header-spacer"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-10">
                @include('error-message')

                <div class="competition-launch">
                    <h3 class="h3 mb-5">Launch a competition</h3>
                    <form id="competition-form-edit" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="users_competition_slug" value="{{ $userCompetition->slug }}">

                        <div id="form-1">
                            {{-- Cover Image --}}
                            <div class="row form-group">


                                <label class="col-lg-3 col-form-label h6">Cover Image</label>

                                <div class="col-lg-7">
                                    @if(!empty($userCompetition->cover_image))
                                        <img src="{{ asset($userCompetition->cover_image) }}" alt=""
                                             style="height: 150px;">
                                    @endif
                                    <br/>
                                    <br/>
                                    <div class="form-group mb-0 is-empty" onclick="openFileInput('#cover_image')">
                                        <input type="text" readonly="" class="form-control" placeholder="Attachment"
                                               style="background-color: transparent;">
                                        <span class="input-group-addon">
                                        <i class="fa fa-paperclip" style="font-size: 18px;"></i></span>
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>

                            <input type="file" class="hidden-file" name="cover_image" id="cover_image">
                            {{-- / Cover Image --}}

                            {{-- Competition Title --}}
                            <div class="row">
                                <label class="col-lg-3 col-form-label h6">Competition Title</label>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Competition Title"
                                               @if(!empty($userCompetition->competition_title)) value="{{ $userCompetition->competition_title }}"
                                               @else value="{{ old('competition_title') }}" @endif
                                               name="competition_title"
                                               id="competition_title" type="text">
                                    </div>
                                </div>
                            </div>
                            {{-- / Competition Title --}}

                            {{-- Brief --}}
                            <div class="row form-group">
                                <label class="col-lg-3 col-form-label h6">Brief</label>
                                <div class="col-lg-7">
                                    <div class="form-group" style="margin-left: -13px;">
                                        <div class="editable medium-editor-insert-plugin"
                                             id="competition_brief"> @if(!empty($userCompetition->brief)){!! $userCompetition->brief !!}@endif

                                        </div>
                                        <span class="placeholder" style="margin-left: 13px;">
                                        Write a description of competition you want to
                                        launch</span>
                                    </div>
                                </div>
                            </div>
                            {{-- /Brief --}}

                            {{-- Eligibility Criteria --}}
                            <div class="row">
                                <label class="col-lg-3 col-form-label h6">Eligibility Criteria</label>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Eligibility Criteria"
                                               id="eligibility_criteria"
                                               name="eligibility_criteria"
                                               type="text"
                                               @if(!empty($userCompetition->eligibility_criteria)) value="{{ $userCompetition->eligibility_criteria }}"
                                               @else value="{{ old('eligibility_criteria') }}" @endif>
                                    </div>
                                </div>
                            </div>
                            {{-- /Eligibility Criteria --}}

                            {{-- Jury --}}
                            <div class="row form-group">
                                <label class="col-lg-3 col-form-label h6">Jury</label>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label class="radio-inline" style="margin-right: 15px;">
                                            <input type="radio" name="jury_type" value="no_jury"
                                                   @if(!empty($userCompetition->jury_type) == 'no_jury') checked @endif
                                                   style="display: inline;width: auto;"> No Jury
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="jury_type" value="will_update_later"
                                                   @if(!empty($userCompetition->jury_type) == 'will_update_later') checked
                                                   @endif
                                                   style="display: inline;width: auto;"> Will Update Later
                                        </label>
                                    </div>
                                    @if(count($userCompetition->userCompetitionJury) > 0)
                                        @foreach($userCompetition->userCompetitionJury as $value)
                                            <div class="jury-div form-group jury-div-{{$loop->index + 1}}">
                                                <input type="hidden" name="user_competition_jury_id[]"
                                                       value="{{ $value->id }}">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-group" placeholder="Full Name"
                                                               @if(!empty($value->jury_fullname)) value="{{ $value->jury_fullname }}"
                                                               @endif
                                                               name="jury_fullname[]">
                                                        <ul class="account-settings ajax_search competitions-jury"></ul>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-group"
                                                               placeholder="Firm/Company/College name"
                                                               @if(!empty($value->jury_firm_company)) value="{{ $value->jury_firm_company }}"
                                                               @endif
                                                               name="jury_firm_company[]">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-group"
                                                               @if(!empty($value->jury_email)) value="{{ $value->jury_email }}"
                                                               @endif placeholder="Email address"
                                                               name="jury_email[]">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-group"
                                                               placeholder="Contact number"
                                                               @if(!empty($value->jury_contact)) value="{{ $value->jury_contact }}"
                                                               @endif
                                                               name="jury_contact[]">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="file" name="jury_logo[]">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        @if($loop->first)
                                                            <a href="javascript:void(0)"
                                                               class="link-inverse form-text mt-3"
                                                               id="jury-add-more"><u>Add more +</u></a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                               class="link-inverse form-text mt-3 remove-jury-div"
                                                               data-jury-index="{{$loop->index + 1}}"><u>Remove
                                                                    -</u></a>
                                                        @endif
                                                    </div>
                                                </div>

                                                <input type="hidden" value="{{ $value->jury_id }}" name="jury_id[]"/>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="jury-div form-group jury-div-1">
                                            <input type="hidden" name="user_competition_jury_id[]"
                                                   value="{{ $value->id }}">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group" placeholder="Full Name"
                                                           name="jury_fullname[]">
                                                    <ul class="account-settings ajax_search competitions-jury"></ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group"
                                                           placeholder="Firm/Company/College name"
                                                           name="jury_firm_company[]">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group" placeholder="Email address"
                                                           name="jury_email[]">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group" placeholder="Contact number"
                                                           name="jury_contact[]">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="file" name="jury_logo[]">
                                                </div>

                                                <div class="col-sm-6">
                                                    <a href="javascript:void(0)" class="link-inverse form-text mt-3"
                                                       id="jury-add-more"><u>Add more +</u></a>
                                                </div>
                                            </div>

                                            <input type="hidden" name="jury_id[]"/>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            {{-- / Jury --}}


                            {{-- Awards --}}
                            <div class="row awards-div">
                                <label class="col-lg-3 col-form-label h6">Awards</label>
                                @if(count($userCompetition->usersCompetitionsAward) > 0)
                                    @foreach($userCompetition->usersCompetitionsAward as $value)
                                        <input type="hidden" name="users_competitions_award_id[]"
                                               value="{{ $value->id }}">

                                        <div class="@if($loop->first) col-lg-7  @else  col-lg-7 offset-lg-3 append-div-award @endif ">
                                            <div class="row compeition-append">
                                                <div class="col-sm-4">
                                                    <select class="form-control selectpicker"
                                                            data-placeholder="Award type"
                                                            name="award_type[]">
                                                        <option value="1_prize"
                                                                @if($value->award_type == '1_prize') selected @endif>1st
                                                            prize
                                                        </option>
                                                        <option value="2_prize"
                                                                @if($value->award_type == '2_prize') selected @endif>2nd
                                                            prize
                                                        </option>
                                                        <option value="3_prize"
                                                                @if($value->award_type == '3_prize') selected @endif>3rd
                                                            prize
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="Award Amount"
                                                               @if(!empty($value->award_amount))value="{{ $value->award_amount }}"
                                                               @endif type="text"
                                                               name="award_amount[]">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker"
                                                                data-placeholder="Award Currency"
                                                                name="award_currency[]">
                                                            <option value="USD"
                                                                    @if($value->award_currency == 'USD') selected @endif>
                                                                USD
                                                            </option>
                                                            <option value="INR"
                                                                    @if($value->award_currency == 'INR') selected @endif>
                                                                INR
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <input class="form-control"
                                                               placeholder="Add more details of the award/prize for the competition"
                                                               type="text" name="award_extra[]"
                                                               @if(!empty($value->award_extra))value="{{ $value->award_extra }}" @endif >
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            @if($loop->first)
                                                <a href="javascript:void(0)" class="link-inverse form-text mt-3"
                                                   id="add-more-awards"><u>Add more +</u></a>
                                            @endif
                                        </div>
                                    @endforeach

                                @else
                                    <div class="col-lg-7">
                                        <div class="row compeition-append">
                                            <div class="col-sm-4">
                                                <select class="form-control selectpicker" data-placeholder="Award type"
                                                        name="award_type[]">
                                                    <option value="1_prize">1st prize</option>
                                                    <option value="2_prize">2nd prize</option>
                                                    <option value="3_prize">3rd prize</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Award Amount" type="text"
                                                           name="award_amount[]">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker"
                                                            data-placeholder="Award Currency" name="award_currency[]">
                                                        <option value="USD">USD</option>
                                                        <option value="INR">INR</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input class="form-control"
                                                           placeholder="Add more details of the award/prize for the competition"
                                                           type="text" name="award_extra[]">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <a href="javascript:void(0)" class="link-inverse form-text mt-3"
                                           id="add-more-awards"><u>Add more +</u></a>
                                    </div>

                                @endif


                            </div>
                            {{-- /Awards --}}

                            {{-- {{ dump($userCompetition) }}--}}

                            {{-- Honourable Mentions --}}
                            <div class="row form-group">
                                <label class="col-lg-3 col-form-label h6">Awards other details</label>
                                <div class="col-lg-7">
                                    <div class="form-group" style="margin-left: -13px;">
                                        <div class="editable medium-editor-insert-plugin honourable-mentions">{!! $userCompetition->honourable_mentions !!}</div>
                                    </div>
                                </div>
                            </div>
                            {{-- /Honourable Mentions  --}}

                            {{-- Schedule --}}
                            <div class="row form-group">
                                <label class="col-lg-3 col-form-label h6">Schedule</label>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="col-form-label">
                                                    <b>Start date of registration</b>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control datepicker"
                                                       placeholder="Enter Date"
                                                       name="schedule_start_date_of_registration"
                                                       @if(!empty($userCompetition->schedule_start_date_of_registration)) value="{{ $userCompetition->schedule_start_date_of_registration }}" @endif >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="col-form-label">
                                                    <b>Close date of registration</b>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control datepicker"
                                                       placeholder="Enter Date"
                                                       name="schedule_close_date_of_registration"
                                                       @if(!empty($userCompetition->schedule_close_date_of_registration)) value="{{ $userCompetition->schedule_close_date_of_registration }}" @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="col-form-label">
                                                    <b>Closing date of project submission</b>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control datepicker"
                                                       placeholder="Enter Date"
                                                       name="schedule_closing_date_of_project_submission"
                                                       @if(!empty($userCompetition->schedule_closing_date_of_project_submission)) value="{{ $userCompetition->schedule_closing_date_of_project_submission }}" @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="col-form-label">
                                                    <b>Announcement of the winners</b>
                                                </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control datepicker"
                                                       placeholder="Enter Date"
                                                       name="schedule_announcement_of_the_winner"
                                                       @if(!empty($userCompetition->schedule_announcement_of_the_winner)) value="{{ $userCompetition->schedule_announcement_of_the_winner }}" @endif>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- / Schedule --}}

                            <div class="row pt-2">
                                <div class="col-lg-12 offset-lg-3">
                                    <button type="button" class="btn btn-primary btn-submit" id="form-1-submit">Next
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div id="form-2">
                            {{-- Competition Type --}}
                            <div class="row form-group">
                                <label class="col-lg-3 col-form-label h6">Competition Type</label>
                                <div class="col-lg-7">
                                    <select class="form-control selectpicker" id="competition_type"
                                            name="competition_type">
                                        <option value="">Select Competition Type</option>
                                        <option value="free"
                                                @if($userCompetition->competition_type == "free") selected @endif> Free
                                            Competition
                                        </option>
                                        <option value="paid"
                                                @if($userCompetition->competition_type == "paid") selected @endif> Paid
                                            Competition
                                        </option>
                                    </select>
                                </div>
                            </div>
                            {{-- /Competition Type --}}
                            {{-- url radio --}}

                            <div class="row form-group payement-div"
                                 @if($userCompetition->competition_type == "free") style="display: none;" @endif>
                                <label class="col-lg-3 col-form-label h6"> Registration submission</label>
                                <div class="col-lg-7">
                                    <label class="radio-inline" style="margin-right: 15px;">
                                        <input type="radio" class="reg_form" name="reg_form" value="sqr"
                                               @if($userCompetition->reg_from == 'sqr')  checked @endif
                                               style="display: inline;width: auto;"> Registration from Sqrfactor</label>
                                    <label class="radio-inline">
                                        <input type="radio" class="reg_form" name="reg_form" value="oth"
                                               @if($userCompetition->reg_from == 'oth')  checked @endif
                                               style="display: inline;width: auto;"> Registration from your own site
                                    </label>
                                    <label id="label-warn" style="color: red; display: none;">Sqrfactor charge 5% on
                                        every transaction</label>
                                </div>
                            </div>

                            <div class="row url"
                                 @if($userCompetition->reg_from == "sqr" || $userCompetition->competition_type == "free") style="display: none;" @endif>
                                <label class="col-lg-3 col-form-label h6">Enter url</label>
                                <div class="col-lg-7">
                                    <input class="form-control" id="url" placeholder="Enter the url" type="text"
                                           @if(!empty($userCompetition->reg_url)) value="{{ $userCompetition->reg_url }}"
                                           @endif
                                           name="url">
                                </div>
                            </div>

                            {{-- url radio --}}

                            <input type="hidden" class="is_paid"
                                   @if($userCompetition->competition_type == "paid") value="paid" @endif>
                            {{-- Early Bird Registration --}}
                            <div class="row form-group ">
                                <label class="col-lg-3 col-form-label h6 paid-registration ">Early Bird
                                    Registration</label>
                                <div class="col-lg-7 paid-registration">
                                    <div class="registration-container">
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="Start date"
                                                       @if(!empty($userCompetition->early_bird_registration_start_date)) value="{{ $userCompetition->early_bird_registration_start_date }}"
                                                       @endif
                                                       class="datepicker form-control"
                                                       name="early_bird_registration_start_date">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="End date"
                                                       class="datepicker form-control"
                                                       name="early_bird_registration_end_date"
                                                       @if(!empty($userCompetition->early_bird_registration_end_date)) value="{{ $userCompetition->early_bird_registration_end_date }}" @endif>
                                            </div>
                                        </div>
                                        <div class="registration-type-container">
                                            @if(count($userCompetition->userCompetitionRegistrationType) > 0)
                                                @foreach($userCompetition->userCompetitionRegistrationType as $value)
                                                    <input type="hidden" name="user_competition_registration_type_id[]"
                                                           value="{{ $value->id }}">
                                                    <div class="registration-type-child row form-group">
                                                        <div class="col-sm-6">
                                                            <input type="text" placeholder="Registration Type"
                                                                   name="early_bird_registration_type[]"
                                                                   @if(!empty($value->registration_type))
                                                                   value="{{ $value->registration_type }}" @endif>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select class="form-control selectpicker"
                                                                    name="early_bird_registration_currency[]">
                                                                <option value="USD"
                                                                        @if($value->currency == 'USD') selected @endif >
                                                                    USD
                                                                </option>
                                                                <option value="INR"
                                                                        @if($value->currency == 'INR')selected @endif >
                                                                    INR
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" placeholder="Amount"
                                                                   name="early_bird_registration_amount[]"
                                                                   @if(!empty($value->amount)) value="{{ $value->amount }} " @endif>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else

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

                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-2 paid-registration">
                                    <a href="javascript:void(0)" class="link-inverse form-text mt-3"
                                       id="add-more-registration-early-bird"><u>Add more +</u></a>
                                </div>
                            </div>
                            {{-- / Early Bird Registration --}}

                            {{-- {{ dd($userCompetition) }}--}}

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
                                                       name="advance_registration_start_date"
                                                       @if(!empty($userCompetition->advance_registration_start_date)) value="{{ $userCompetition->advance_registration_start_date }}" @endif>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="End date"
                                                       class="datepicker form-control"
                                                       name="advance_registration_end_date"
                                                       @if(!empty($userCompetition->advance_registration_end_date)) value="{{ $userCompetition->advance_registration_end_date }}" @endif >
                                            </div>
                                        </div>
                                        <div class="registration-type-container">
                                            @if(count($userCompetition->userCompetitionRegistrationType)>0)
                                                @foreach($userCompetition->userCompetitionRegistrationType as $value)
                                                    <input type="hidden" name="user_competition_registration_type_id[]"
                                                           value="{{ $value->id }}">

                                                    <div class="registration-type-child row form-group">
                                                        <div class="col-sm-6">
                                                            <input type="text" placeholder="Registration Type"
                                                                   name="advance_registration_type[]"
                                                                   @if(!empty($value->registration_type)) value="{{ $value->registration_type }}" @endif >
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select class="form-control selectpicker"
                                                                    name="advance_registration_currency[]">
                                                                <option value="USD"
                                                                        @if($value->currency == 'USD') selected @endif >
                                                                    USD
                                                                </option>
                                                                <option value="INR"
                                                                        @if($value->currency == 'INR') selected @endif >
                                                                    INR
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" placeholder="Amount"
                                                                   name="advance_registration_amount[]"
                                                                   @if(!empty($value->amount)) value="{{ $value->amount }}" @endif>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
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
                                            @endif

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
                                                       name="last_minute_registration_start_date"
                                                       @if(!empty($userCompetition->last_minute_registration_start_date)) value="{{  $userCompetition->last_minute_registration_start_date}}" @endif >
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="End date"
                                                       class="datepicker form-control"
                                                       name="last_minute_registration_end_date"
                                                       @if(!empty($userCompetition->last_minute_registration_end_date)) value="{{  $userCompetition->last_minute_registration_end_date}}" @endif>
                                            </div>
                                        </div>
                                        <div class="registration-type-container">
                                            @if(count($userCompetition->userCompetitionRegistrationType)>0)
                                                @foreach($userCompetition->userCompetitionRegistrationType as $value)
                                                    <input type="hidden" name="user_competition_registration_type_id[]"
                                                           value="{{ $value->id }}">
                                                    <div class="registration-type-child row form-group">
                                                        <div class="col-sm-6">
                                                            <input type="text" placeholder="Registration Type"
                                                                   name="last_minute_registration_type[]"
                                                                   @if(!empty($value->registration_type)) value="{{ $value->registration_type }}" @endif >
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select class="form-control selectpicker"
                                                                    name="last_minute_registration_currency[]">
                                                                <option value="USD"
                                                                        @if($value->currency == 'USD') selected @endif >
                                                                    USD
                                                                </option>
                                                                <option value="INR"
                                                                        @if($value->currency == 'INR') selected @endif >
                                                                    INR
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" placeholder="Amount"
                                                                   name="last_minute_registration_amount[]"
                                                                   @if(!empty($value->amount)) value="{{ $value->amount }}" @endif>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            @else
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
                                            @endif


                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-2 paid-registration">
                                    <a href="javascript:void(0)" class="link-inverse form-text mt-3"
                                       id="add-more-registration-last-minute"><u>Add more +</u></a>
                                </div>
                            </div>
                            {{-- / Last Minute Registration --}}

                            {{-- Partner --}}
                            <div class="row form-group">
                                <label class="col-lg-3 col-form-label h6">Partners</label>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label class="radio-inline" style="margin-right: 15px;">
                                            <input type="radio" name="partner_type" value="no_partners"
                                                   @if($userCompetition->partner_type == 'no_partners')checked
                                                   @endif
                                                   style="display: inline;width: auto;"> No
                                            Partners</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="partner_type"
                                                   @if($userCompetition->partner_type == 'will_update_later')checked
                                                   @endif
                                                   value="will_update_later"
                                                   style="display: inline;width: auto;"> Will Update
                                            Later</label>
                                    </div>

                                    @if(count($userCompetition->userCompetitionPartner)  > 0)
                                        @foreach($userCompetition->userCompetitionPartner as $value)
                                            <div class="partners-div-container form-group">
                                                <input type="hidden" name="user_competition_partner_id[]"
                                                       value="{{ $value->id }}">


                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-group" placeholder="Name"
                                                               @if(!empty($value->partner_name))  value="{{ $value->partner_name}}"
                                                               @endif
                                                               name="partner_name[]">
                                                        <ul class="account-settings ajax_search competitions-jury competitions-partner"></ul>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-group" placeholder="Website"
                                                               @if(!empty($value->partner_website)) value="{{ $value->partner_website}}"
                                                               @endif
                                                               name="partner_website[]">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-group"
                                                               placeholder="Email address"
                                                               name="partner_email[]"
                                                               @if(!empty($value->partner_email)) value="{{ $value->partner_email}}" @endif>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-group"
                                                               placeholder="Contact number"
                                                               name="partner_contact[]"
                                                               @if(!empty($value->partner_contact)) value="{{ $value->partner_contact}}" @endif>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group mb-0 is-empty">
                                                            <input type="file" name="partner_logo[]">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        @if($loop->first)
                                                            <a href="javascript:void(0)"
                                                               class="link-inverse form-text mt-3"
                                                               id="add-more-partner"><u>Add more +</u></a>
                                                        @else
                                                            <a href="javascript:void(0)"
                                                               class="link-inverse form-text mt-3 "><u>Remove -</u></a>
                                                        @endif
                                                    </div>
                                                </div>

                                                <input type="hidden" name="partner_id[]"
                                                       @if(!empty($value->partner_id))  value="{{ $value->partner_id}}" @endif >
                                                <br/>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="partners-div-container form-group">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group" placeholder="Name"
                                                           name="partner_name[]">
                                                    <ul class="account-settings ajax_search competitions-jury competitions-partner"></ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group" placeholder="Website"
                                                           name="partner_website[]">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group"
                                                           placeholder="Email address"
                                                           name="partner_email[]">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-group"
                                                           placeholder="Contact number"
                                                           name="partner_contact[]">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-0 is-empty">
                                                        <input type="file" name="partner_logo[]">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="javascript:void(0)"
                                                       class="link-inverse form-text mt-3"
                                                       id="add-more-partner"><u>Add more +</u></a>
                                                </div>
                                            </div>

                                            <input type="hidden" name="partner_id[]">
                                        </div>
                                    @endif
                                </div>

                            </div>
                            {{-- / Partner --}}
                            @foreach($userCompetition->userCompetitionAttachment as $value)
                                {{dump($value)}}
                            @endforeach

                            <div class="row form-group">
                                <label class="col-lg-3 col-form-label h6">Attach documents</label>

                                <div class="col-lg-7 attach-documents_append">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-0 is-empty">
                                                <input type="file" name="attach_documents[]">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="javascript:void(0)"
                                               class="link-inverse form-text mt-3 attach-more-documents"><u>Attach
                                                    more documents +</u></a>
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class="row pt-2">
                                <div class="col-lg-3 offset-lg-3 form-group">
                                    <button type="button" class="btn btn-primary btn-submit btn-100-width"
                                            id="form-back">Back
                                    </button>
                                </div>
                                <div class="col-lg-3 form-group">
                                    <button type="submit" class="btn btn-primary btn-submit btn-100-width"
                                            id="form-2-submit">Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('users.partials.medium-editor-js')
    <script>
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () {
            null
        };

        var editor = new MediumEditor('.editable');

        $('.editable').mediumInsert({
            editor: editor
        });
    </script>
@endsection