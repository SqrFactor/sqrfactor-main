@extends('layouts.app-news-feed')

@section('title')Post Article  | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('styles')
    @include('users.partials.medium-editor-css')
@endsection

@section('content')
    <div class="header-spacer"></div>
    <div class="container">
        <div class="design-post">
            <div class="pl-lg-5">
                @include('error-message')
            </div>

            <div class="d-flex align-items-center pl-lg-5 mb-3">

                <div class="author-thumb mr-3 mb-2">
                    <img alt="author" src="@if(!empty(Auth::user()->profile)) {{ asset(Auth::user()->profile) }}@endif"
                         class="avatar align-center" style="width: 50px;height: 50px;">
                </div>
                <div class="h6">@if(Auth::user()->first_name !== null && Auth::user()->last_name !== null) {{ ucfirst(Auth::user()->first_name)." ". ucfirst(Auth::user()->last_name)}} @elseif(Auth::user()->name !== null) {{ Auth::user()->name }}@endif</div>
            </div>
            <form method="POST" enctype="multipart/form-data" id="design_post_form">
                {{ csrf_field() }}
                <div class="pl-lg-5">
                    <div class="form-group post_type" post-type="article">
                        <input type="text"  placeholder="Title" id="design_title" name="design_title"
                               class="form-control">
                        <span class="help-block title">
                         <strong style="color: red;"></strong>
                         </span>
                    </div>
                </div>

                <div class="pl-lg-5">
                    <div class="form-group ">
                        <input type="text" placeholder="Short description" id="description_short" name="description_short" class="form-control counter_text" maxlength="140">
                        <p class="errors" style="display:none;color: red;display: none;"></p>
                        <p class="errors_counter" style="display:none;color: green;margin-left: 14px;"></p>
                        <span class="help-block description_short">
                            <strong style="color: red;"> </strong>
                        </span>
                    </div>
                </div>

                <div class="pl-lg-5">
                    <div class="form-group " style="margin-left: -13px;">
                        <div class="editable"></div>
                        <span class="help-block description" style="margin-left:    13px;">
                         <strong style="color: red;"> </strong>
                        </span>
                        <span class="placeholder">Type your text, add pictures and videos by clicking + (plus) icon on the left side.</span>
                    </div>
                </div>

                <div class="pl-lg-5">


                    <img src="" id="target_image_cropper" style="display:none;margin-bottom: 20px;" class="target_image_cropper" />

                    <div class="form-group mb-0 is-empty">
                        <div class="form-group mb-0 is-empty ">
                            <input type="text" readonly="" class="form-control cropping_banner_article_open" placeholder="Select Banner Image" style="background-color: transparent;">
                            <span class="input-group-addon"><i class="fa fa-paperclip" style="font-size: 18px;"></i></span>
                            <span class="material-input"></span>
                        </div>
                            <input type="hidden" name="banner_image" id="image_val" value="" >
                            <span class="help-block banner_image" style="margin-left:    13px;">
                                <strong style="color: red;"> </strong>
                            </span>
                    </div>
                </div>

                <div style="height: 40px;"></div>
                <div class="pl-lg-5">
                    <button class="btn btn-primary btn-submit article_post helo" id="">Save</button>
                </div>

            </form>

            @include('users.partials.cropping-banner-article')
        </div>
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
