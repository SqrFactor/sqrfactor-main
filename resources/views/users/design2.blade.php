@extends('layouts.app-news-feed')
@section('content')



    <div class="header-spacer"></div>
    <div class="container">


        <div class="design-post">
            <div class="pl-lg-5">
                @include('error-message')
            </div>

                <div class="container p-4 p-lg-5">
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
                            <label class="col-lg-3 col-form-label h6">Status</label>
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
                        <!--  -->
                        <div class="row form-group">
                            <label class="col-lg-3 col-form-label h6">Building Program</label>
                            <div class="col-lg-4">
                                <div class="form-group is-select mb-0">
                                    <select class="selectpicker form-control" name="building_program">
                                        <option selected disabled> Select Building Program</option>
                                        <option value="Commercial">Commercial</option>
                                        <option value="Urbanism">Urbanism</option>
                                        <option value="Public Space">Public Space</option>
                                        <option value="Culture">Culture</option>
                                        <option value="Body Culture">Body Culture</option>
                                        <option value="Health">Health</option>
                                        <option value="Health">Residential</option>
                                        <option value="Health">Office</option>
                                        <option value="Education">Education</option>
                                        <option value="Housing">Housing</option>
                                        <option value="Hotel">Hotel</option>
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
                                    <input type="text" placeholder="Enter college project  link" class="form-control"
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
                                    <input type="text" placeholder="Enter Tag keyword (Comma sepreated)"
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
                                <br>

                                <img src="" id="target_image_cropper" class="target_image_cropper"/>

                            </div>
                        </div>

                        <div class="row pt-2">
                            <p class="errors" id="error_global" style="display: none;color: red;"></p>
                            <div class="col-lg-12 offset-lg-3">
                                <a href="javascript:void(0)" class="btn btn-primary btn-submit designPostModalSave">Publish
                                    News</a>
                            </div>
                        </div>
                    </form>
                </div>
        

        @include('users.partials.cropping-banner')
    </div>
@endsection

@section('scripts')
    <script>
        var editor = new MediumEditor('.editable'
        );

        $(function () {
            $('.editable').mediumInsert({
                editor: editor
            });
        });

    </script>
@endsection
