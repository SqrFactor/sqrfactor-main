@extends('layouts.app-news-feed')
@section('title')Post Article | SqrFactor @endsection
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
                        <input type="text"  placeholder="Title" id="design_title"  value="{{ $usersPost->title }}" name="design_title"
                               class="form-control">
                        <span class="help-block title">
                         <strong style="color: red;"></strong>
                         </span>
                    </div>
                </div>

                <div class="pl-lg-5">
                    <div class="form-group ">
                        <input type="text" placeholder="Short description" id="description_short" name="description_short" value="{{ $usersPost->short_description }}" class="form-control counter_text" maxlength="140">
                        <p class="errors" style="display:none;color: red;display: none;"></p>
                        <p class="errors_counter" style="display:none;color: green;margin-left: 14px;"></p>
                        <span class="help-block description_short">
                            <strong style="color: red;"> </strong>
                        </span>
                    </div>
                </div>
                <input type="hidden" id="post_article_slug" value="{{ $usersPost->slug }}">

                <div class="pl-lg-5">
                    <div class="form-group " style="margin-left: -13px;">
                        <div class="editable">{!! $usersPost->description !!}</div>
                        <span class="help-block description" style="margin-left:    13px;">
                         <strong style="color: red;"> </strong>
                        </span>
                    </div>
                </div>

                <div class="pl-lg-5">
                 @if(!empty($usersPost->banner_image))
                    <img src="{{ asset($usersPost->banner_image) }}" alt="" id="hide_image">
                    @endif

                    <img  id="image_target" >
                    <br>
                    <br>

                    <div class="form-group mb-0 is-empty">
                        <div class="form-group mb-0 is-empty " onclick="openFileInput('#article_image_picker')">
                            <input type=""  class="form-control cropping_banner_article_open" placeholder="Select Banner Image" >
                            <input type="hidden" id="image_val">
                    </div>

                        <input type="file" style="display: none;" id="article_image_picker" >



                    </div>
                </div>

                <div style="height: 40px;"></div>
                <div class="pl-lg-5">
                    <button class="btn btn-primary btn-submit article_post_helo_edit" id="">Save</button>
                </div>

            </form>


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
