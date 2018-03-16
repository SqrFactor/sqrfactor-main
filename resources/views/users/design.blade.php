@extends('layouts.app-news-feed')

@section('title')Post Design | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('styles')
    @include('users.partials.medium-editor-css')
@endsection
@section('content')
    <div id="scroll_refrence"></div>
    <div class="header-spacer"></div>
    <div class="container" id="page_scroll_up">
        <div class="design-post" id="design-post-1">
            <div class="pl-lg-5">
                @include('error-message')
            </div>

            <div class="d-flex align-items-center pl-lg-5 mb-3">

                <div class="author-thumb mr-3 mb-2">
                    <img alt="author" src="
@if(!empty(Auth::user()->profile)) {{ asset(Auth::user()->profile) }}@endif"
                         class="avatar align-center" style="width: 50px;height: 50px;">
                </div>
                <div class="h6">@if(Auth::user()->first_name !== null && Auth::user()->last_name !== null) {{ ucfirst(Auth::user()->first_name)." ". ucfirst(Auth::user()->last_name)}} @elseif(Auth::user()->name !== null) {{ Auth::user()->name }}@endif</div>
            </div>
            <div class="alert alert-success design-success" style="display: none;">
                <strong>Success!</strong> Post has been saved successfully.
            </div>

            <form method="POST" enctype="multipart/form-data" id="design_post_form">

                <input name="lat" type="hidden" value="">
                <input name="lng" type="hidden" value="">
                <input name="formatted_address" type="hidden" value="">
                {{ csrf_field() }}
                <div class="pl-lg-5">
                    <div class="form-group post_type" post-type="design">
                        <input type="text" placeholder="Title" id="design_title" name="design_title"
                               class="form-control">
                        <span class="help-block title">
                            <strong style="color: red;"> </strong>
                            </span>
                    </div>
                </div>

                <div class="pl-lg-5">
                    <div class="form-group ">
                        <input type="text" placeholder="Short description" id="description_short"
                               name="description_short" class="form-control counter_text" maxlength="140">
                        <p class="errors" style="display:none;color: red;display: none;"></p>
                        <p class="errors_counter" style="display:none;color: green;margin-left: 14px;"></p>
                        <span class="help-block description_short">
                         <strong style="color: red;"> </strong>
                        </span>
                    </div>
                </div>

                <div class="pl-lg-5">
                    <div class="form-group" style="margin-left: -13px;">
                        <div class="editable"></div>
                        <span class="help-block description" style="margin-left:    13px;">
                         <strong style="color: red;"> </strong>
                        </span>
                        <span class="placeholder">Type your text, add pictures and videos by clicking + (plus) icon on the left side.</span>
                    </div>
                </div>

                <div class="pl-lg-5">
                    <div class="form-group ">
                        <input id="geocomplete" class="form-control" type="text"
                               placeholder="Enter your location" size="90"/>
                        <p class="errors" style="display: none;color: red;font-weight: bolder;"></p>
                    </div>
                </div>


                <div style="height: 40px;"></div>
                <div class="pl-lg-5">
                    <button class="btn btn-primary btn-submit design_post helo" id="save_design">Next</button>
                </div>
            </form>
        </div>

        {{-- Design post 2--}}
        <div class="design-post" id="design-post-2" style="display: none;">
            <form id="designPostModalForm" method="post">

                <input name="oldLat" id="lat" type="hidden" value="">
                <input name="oldLng" id="lng" type="hidden" value="">
                <input name="oldFormatted_address" id="formatted_address" type="hidden" value="">

                {{--old form data--}}
                <input type="hidden" name="oldTitle" id="oldTitle" value="">
                <input type="hidden" name="oldDescription" id="oldDescription" value="">
                <input type="hidden" name="oldType" id="oldType" value="">
                <input type="hidden" id="oldDescription_short" name="oldDescription_short" value="">

                {{-- end old form data--}}

                <div class="row form-group">
                    <label class="col-lg-3 col-form-label h6">Status <span style="color: red;">*</span></label>
                    <div class="col-lg-4">
                        <div class="form-group is-select mb-0">
                            <select class="selectpicker form-control" name="status" id="status">
                                <option selected disabled>Select Status</option>
                                <option value="Idea">Idea</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Under Construction">Under Construction</option>
                                <option value="Completed">Completed</option>
                            </select>
                            <p class="status_errors_design errors" style="display: none;color: red;"></p>

                        </div>

                    </div>
                </div>


                <div class="row form-group">

                    <label class="col-lg-3 col-form-label h6">Type <span style="color: red;">*</span></label>

                    <div class="col-lg-4">
                        <div class="form-group is-select mb-0">
                            <select class="selectpicker form-control" name="select_design_type">
                                <option selected disabled> Select Design Type</option>
                                <option value="Architecture Design">Architecture Design</option>
                                <option value="Interior Design">Interior Design</option>
                                <option value="Landscape Design">Landscape Design</option>
                                <option value="Product Design">Product Design</option>
                                <option value="Art Installation">Art Installation</option>
                                <option value="Decoration">Decoration</option>
                                <option value="Other">Other</option>

                            </select>
                            <p class="select_design_type_errors_design errors"
                               style="display: none;color: red;"></p>
                        </div>
                    </div>
                </div>


                <!--  -->
                <div class="row form-group">
                    <label class="col-lg-3 col-form-label h6">Building Program</label>
                    <div class="col-lg-4">
                        <div class="form-group is-select mb-0">
                            <select class="selectpicker form-control" name="building_program">
                                <option value=""> Select Building Program</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Urbanism">Urbanism</option>
                                <option value="Public Space">Public Space</option>
                                <option value="Culture">Culture</option>
                                <option value="Body Culture">Body Culture</option>
                                <option value="Health">Health</option>
                                <option value="Education">Education</option>
                                <option value="Housing">Housing</option>
                                <option value="Hotel">Hotel</option>
                                <option value="Corporate">Corporate</option>
                                <option value="Office">Office</option>
                                <option value="Startup">Startup</option>
                                <option value="Residential">Residential</option>
                                <option value="Leisure - Pub, Cafes etc">Leisure - Pub, Cafe's etc.</option>
                                <option value="Media">Media</option>
                                <option value="Other">Other</option>
                            </select>
                            <p class="building_program_errors_design errors"
                               style="display: none;color: red;"></p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="row form-group">
                    <label class="col-lg-3 col-form-label h6">Years</label>
                    <div class="col-lg-4">
                        <div class="form-group is-select mb-lg-0">
                            <input type="text" id="start_year" placeholder="Start Year" class="form-control"
                                   name="start_year">
                            <p class="start_year_errors_design errors" style="display: none;color: red;"></p>
                        </div>
                    </div>
                    {{--{{ Form::selectYear('year', 2013, 2015) }}--}}
                    <div class="col-lg-4">
                        <div class="form-group is-select mb-0">

                            <input type="text" name="end_year" placeholder="End Year" id="end_year">
                            <p class="end_year_errors_design errors" style="display: none;color: red;"></p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="row form-group">
                    <label class="col-lg-3 col-form-label h6">Total Budget</label>
                    <div class="col-lg-4">
                        <div class="form-group mb-lg-0">
                            <input type="text" placeholder="Write budget..." name="total_budget"
                                   id="total_budget" class="form-control">
                            <p class="errors" style="display: none;color: red;"></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group is-select mb-0">
                            <select class="selectpicker form-control" name="inr" id="inr">
                                <option value="INR">INR</option>
                                <option value="USD">USD</option>
                            </select>
                            <p class="inr_errors_design" style="display: none;color: red;"></p>
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="row form-group">
                    <label class="col-lg-3 col-form-label h6 pt-lg-0">Is/was project part of competition</label>
                    <div class="col-lg-4">
                        <div class="form-group mb-lg-0">
                            <div class="radio d-inline-block mr-3">
                                <label>
                                    <input type="radio" name="project_part" class="project_part"
                                           id="project_part_yes" data-project_part="Yes" checked> Yes
                                </label>
                            </div>
                            <div class="radio d-inline-block">
                                <label>
                                    <input type="radio" name="project_part" class="project_part"
                                           id="project_part_no" data-project_part="No"> No
                                </label>
                            </div>
                            <p class="errors_project_parterrors" style="display: none;color: red;"></p>
                            <input type="hidden" name="project_part_val" id="project_part_val" value="Yes">
                        </div>
                        <div class="form-group mb-0" id="competition_link_container">
                            <input type="text" placeholder="Enter competition link" class="form-control"
                                   name="competition_link" id="competition_link">
                            <p class="errors" style="display: none;color: red;"></p>
                        </div>
                    </div>
                </div>

                {{--college part--}}


                <div class="row form-group">
                    <label class="col-lg-3 col-form-label h6 pt-lg-0">Is/was part of college project </label>
                    <div class="col-lg-4">
                        <div class="form-group mb-lg-0">
                            <div class="radio d-inline-block mr-3">
                                <label>
                                    <input type="radio" name="college_part" class="college_part"
                                           id="college_part_yes" data-college_part="Yes" checked> Yes
                                </label>
                            </div>
                            <div class="radio d-inline-block">
                                <label>
                                    <input type="radio" name="college_part" class="college_part"
                                           id="college_part_no" data-college_part="No"> No
                                </label>
                            </div>
                            <p class="errors_project_college" style="display: none;color: red;"></p>
                            <input type="hidden" name="college_part_val" id="college_part_val" value="Yes">
                        </div>
                        <div class="form-group mb-0" id="competition_link_container_college_part">
                            <input type="text" placeholder="Semester/Thesis" class="form-control"
                                   name="college_link" id="college_link">
                            <p class="errors" style="display: none;color: red;"></p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="row form-group">
                    <label class="col-lg-3 col-form-label h6">Tags</label>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            <input type="text" placeholder="Enter Tag keyword (Comma separated)"
                                   class="form-control" id="tags" name="tags">
                            <p class="errors" style="display: none;color: red;"></p>
                        </div>
                    </div>
                </div>


                <div class="row form-group">
                    <label class="col-lg-3 col-form-label h6">Banner Image</label>
                    <div class="col-lg-4">
                        <div class="form-group mb-0">
                            {{-- <input type="file" value="" name="banner_image" id="src_banner_image" placeholder="Enter Tag keyword" class="form-control image_icon_open">--}}
                            <div class="form-group mb-0 is-empty ">
                                <input type="text" readonly="" class="form-control cropping_banner_open "
                                       placeholder="Attachment" style="background-color: transparent;">
                                <span class="input-group-addon"><i class="fa fa-paperclip"
                                                                   style="font-size: 18px;"></i></span>
                                <span class="material-input"></span></div>
                            <input type="hidden" name="banner_image" id="image_val" value="">
                            <p class="src_banner_image" style="display: none;color: red;"></p>
                        </div>


                        <img src="{{ asset('img/remove-icon.png') }}" alt="" style="display: none;"
                             class="remove_image pull-right remove_icon" data-toggle="tooltip" data-placement="top"
                             title="Remove Image">


                        <img src="" id="target_image_cropper" class="target_image_cropper"/>


                    </div>
                </div>

                <div class="row pt-2">
                    <p class="errors" id="error_global" style="display: none;color: red;"></p>
                    <div class="col-lg-8 offset-lg-3">
                        <a href="javascript:void(0)" class="btn btn-primary btn-submit designPostModalSave">Publish
                            News</a>
                    </div>
                </div>
            </form>
        </div>
        {{-- /design post 2  --}}

        @include('users.partials.cropping-banner')
    </div>
@endsection

@section('scripts')
    @include('users.partials.medium-editor-js')
    <script>
        var editor = new MediumEditor('.editable');

        $(function () {
            $('.editable').mediumInsert({
                editor: editor
            });
        });

    </script>
@endsection
