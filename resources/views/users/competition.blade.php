@extends('layouts.app-news-feed')

@section('title') Launch competition | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

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
                    <form id="competition-form" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div id="form-1">
                            {{-- Cover Image --}}
                            <div class="row form-group">
                                <label class="col-lg-3 col-form-label h6">Cover Image</label>
                                <div class="col-lg-7">
                                    <div class="form-group mb-0 is-empty" onclick="openFileInput('#cover_image')">
                                        <input type="text" readonly="" class="form-control" placeholder="Attachment"
                                               style="background-color: transparent;">
                                        <span class="input-group-addon">
                                        <i class="fa fa-paperclip" style="font-size: 18px;"></i></span>
                                        <span class="material-input"></span>
                                          <p style="color: red">Imgae size should be 502 X 292 px</p>
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
                                        <div class="editable medium-editor-insert-plugin" id="competition_brief">

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
                                               type="text">
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
                                                   style="display: inline;width: auto;"> No Jury
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="jury_type" value="will_update_later"
                                                   style="display: inline;width: auto;"> Will Update Later
                                        </label>
                                    </div>

                                    <div class="jury-div form-group jury-div-1">
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

                                </div>

                            </div>
                            {{-- / Jury --}}

                            {{-- Awards --}}
                            <div class="row awards-div">
                                <label class="col-lg-3 col-form-label h6">Awards</label>
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

                            </div>
                            {{-- /Awards --}}

                            {{-- Honourable Mentions --}}
                            <div class="row form-group">
                                <label class="col-lg-3 col-form-label h6">Awards other details</label>
                                <div class="col-lg-7">
                                    <div class="form-group" style="margin-left: -13px;">
                                        <div class="editable medium-editor-insert-plugin honourable-mentions"></div>
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
                                                       name="schedule_start_date_of_registration">
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
                                                       name="schedule_close_date_of_registration">
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
                                                       name="schedule_closing_date_of_project_submission">
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
                                                       name="schedule_announcement_of_the_winner">
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

                            {{-- Partner --}}
                            <div class="row form-group">
                                <label class="col-lg-3 col-form-label h6">Partners</label>
                                <div class="col-lg-7">
                                    <div class="partners-div-container form-group">
                                        <div class="form-group">
                                            <label class="radio-inline" style="margin-right: 15px;">
                                                <input type="radio" name="partner_type" value="no_partners"
                                                       style="display: inline;width: auto;"> No
                                                Partners</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="partner_type"
                                                       value="will_update_later"
                                                       style="display: inline;width: auto;"> Will Update
                                                Later</label>
                                        </div>

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
                                </div>

                            </div>
                            {{-- / Partner --}}

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