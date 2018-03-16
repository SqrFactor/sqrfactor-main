@extends('layouts.app-news-feed')

@section('title'){{$post->title}} | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('og_title')
    {{$post->title}} | Sqrfactor
@endsection

@section('og_description')
    {{$post->short_description}}
@endsection

@section('og_image')
    {{asset($post->banner_image)}}
@endsection

@section('styles')
    @include('users.partials.medium-editor-css')
@endsection

@section('content')

    <div class="header-spacer"></div>
    <div class="design-detail font-color-gray">
        <div class="container">
            {{--users like model--}}
            @include('users.partials.users-like')

            @include('users.partials.required-filed')

            <div class="row  data_this this_{{ $post->shared_id }}" data-class="this_{{ $post->shared_id }}" data-is-shared="{{ $post->is_shared }}" data-users_post_id="{{ $post->user_post_id }}" data-id="{{ $post->shared_id }}"
                 data-type="users_post_share" data-post_slug="{{ $post->slug }}">

                <!-- main content 111 -->
                <div class="col-md-7 col-xl-7 mb-5">
                    <div class="design-detail-content text-article">
                        <!-- Start -->
                        <div class="post__author author vcard inline-items">
                            <img class="profile_change_append data-user_image"
                                 src="@if(!empty($post->user->profile)){{ asset($post->user->profile)}} @else {{ asset('assets/images/avatar.png') }} @endif"/>

                            <div class="author-date">
                                <a class="h6 post__author-name fn"
                                   href="{{ route('profile') }}"> {{ $post->user->fullName() }}   </a>
                                <div class="post__date">
                                    {{ $post->created_at->diffForHumans() }}
                                </div>
                            </div>

                            @if(Auth::check() && $post->user_id == Auth::id())
                                @include('users.partials.post-dropdown-options')
                            @endif
                        </div>
                        <!-- End --->


                        @if(!empty($post->title))
                            <h1 class="h5 post-title break-word-text">{!! $post->title !!}</h1>
                        @endif
                        @if(!empty($post->short_description))
                            <p class="break-word-text">{!! $post->short_description !!}</p>
                        @endif
                        <div class="post-meta mb-3">
                            <span class="post-date mr-2">{{ $post->created_at->format('j M Y , g:ia') }}</span>
                        </div>

                        @if($post->type == "status")
                            <img src="{{asset($post->image)}}">
                        @else
                            <div class="image_frame">
                                <img src="{{asset($post->banner_image)}}">
                            </div>
                        @endif

                        <br>
                      <div class="break-word-text">  {!! $post->description !!}</div>

                        @if($post->type == "design")
                            @include("users.partials.design-detail-table")
                        @endif
                    </div>
                </div>
                <!-- end main content -->
                <!-- Right side -->
                <div class="col-md-5 col-xl-4 offset-xl-1">

                    <div class="design-comments">
                        <div class="post-additional-info inline-items text-center"
                             style="border-bottom: 1px solid #e6ecf5; border-top: 1px solid #e6ecf5; padding-bottom:8px;">


                            @if(array_key_exists($post->shared_id,$user_like_posts_array))
                                <a href="javascript:void(0)" class="post-add-icon inline-items like_  hk_like_post like_color" >
                                    <i class="fa fa-caret-up"></i></a>
                                <span  class="like uses_like pointer    hk-margin hk_like_post like_color" >{{ $post->likes->count() }} Like</span>
                            @else
                                <a href="javascript:void(0)" class="post-add-icon inline-items like_ hk_like_post" >
                                    <i class="fa fa-caret-up "></i>
                                </a>
                                <span  class="like uses_like pointer hk-margin hk_like_post " >{{ $post->likes->count() }} Like</span>
                            @endif
                            <a href="javascript:void(0)" class="post-add-icon inline-items">
                                <i class="fa fa-circle"></i>
                                <span class="comment_count">{{ $post->commentsLimited->count() }} Comments</span>

                            </a>
                            <a href="javascript:void(0)"
                               class="post-add-icon inline-items user_post_share_">
                                <i class="fa fa-square"></i>
                                <span>Share</span>
                            </a>
                        </div>
                        <ul class="comments-list hello comment-li">

                            {{--comments--}}
                            @include('users.partials.comments-li-model')
                            {{-- end comments--}}


                        </ul>

                        <form class="comment-form media">
                            <img class="d-flex mr-3 post__author" src="{{ asset($post->user->profile) }}" alt="">
                            <div class="media-body">
                                <div class="alert alert-success comment_text_success" style="display: none;">
                                    <strong>Success!</strong> Commented Successfully.
                                </div>
                                <div class="form-group with-icon-right is-empty">
                                    <textarea class="form-control comment_text" placeholder=""
                                              name="comment_text"></textarea>
                                    <p class="errors" style="color: red;display: none;"></p>
                                    {{--<div class="add-options-message">
                                        <a href="#" class="options-message" data-toggle="modal"
                                           data-target="#update-header-photo">
                                            <svg class="olymp-camera-icon">
                                                <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-camera-icon') }}"></use>
                                            </svg>
                                        </a>
                                    </div>--}}
                                    <span class="material-input"></span>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm font-weight-bold comment_">Post
                                    Reply
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Right side -->
            </div>
        </div>
    </div>
@endsection