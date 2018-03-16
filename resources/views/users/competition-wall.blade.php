@extends('layouts.app-news-feed')
@section('title') {{$competition->competition_title}} | wall | competition | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

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
    <style type="text/css">
        .people-search {
            left: 0px !important;
            width: 100% !important;
            top: 55px !important;
        }
    </style>
@endsection

@section('content')
@include('users.partials.medium-editor-css')

    @include('users.partials.competitions-header')

    <div class="competition-wall">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="ui-block competition-discussion-form mb-5">
                        @if(Auth::id() == $competition->user_id)
                            <div class="news-feed-form">
                                <!-- Tab panes -->
                                <form id="user_competition_ann_form">
                                    <div class="author-thumb">
                                        <img src="{{asset(Auth::user()->profile)}}" alt="author">
                                    </div>
                                    <div class="form-group with-icon label-floating">
                                        <label class="control-label">Enter title</label>
                                        <input type="text" class="form-control" name="announcement_title"
                                               style="border: 0px;padding-left:80px;"/>
                                    </div>
                                   

                                    <div class="row form-group">
                                        <label class="col-lg-1 col-form-label h6"></label>
                                        <div class="col-lg-10"><br>
                                            <div class="form-group" style="margin-left: -13px;">
                                                <textarea class="editable medium-editor-insert-plugin" name="announcement"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="users_competition_id" value="{{$competition->id}}">

                                    <div class="add-options-message">
                                        <button type="submit" class="btn btn-primary btn-sm font-weight-bold">Post
                                            Announcement
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="news-feed-form">
                                <!-- Tab panes -->
                                <form id="user_competition_wall_form">
                                    <div class="author-thumb">
                                        <img src="{{asset(Auth::user()->profile)}}" alt="author">
                                    </div>
                                    <div class="form-group with-icon label-floating">
                                        <label class="control-label">Enter title...</label>
                                        <input type="text" class="form-control" name="subject"
                                               style="border: 0px;padding-left:80px;"/>
                                    </div>
                                    <div class="form-group with-icon label-floating">
                                        <label class="control-label">Share what you are thinking here...</label>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                    <input type="hidden" name="users_competition_id" value="{{$competition->id}}">

                                    <div class="add-options-message">
                                        <button type="submit" class="btn btn-primary btn-sm font-weight-bold">Post
                                            Question
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>


                    <!-- question list -->
                    <div class="competition-discussion-list">
                        @foreach($competition->userCompetitionWallQuestion as $item)
                      
                            <div class="ui-block competition-discussion-item">
                                <div class="competition-discussion-header">
                                    <a href="#discussion-{{$item->id}}" class="collapsed title"
                                       data-toggle="collapse">{{$item->subject}}</a>

                                       @if($item->is_announcement == "y")
                                        announced by
                                       @else
                                        asked by
                                       @endif
                                    
                                       <a href="{{route("profileView",$item->user->user_name)}}"
                                            class="author link-inverse">{{$item->user->fullName()}}</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2017-03-24T18:18">
                                            @if($item->created_at != null)
                                                {{$item->created_at->diffForHumans()}}
                                            @endif
                                        </time>
                                    </div>

                                    <button type="button" class="btn collapsed" data-toggle="collapse"
                                            data-target="#discussion-{{$item->id}}"><i class="fa fa-chevron-down"></i>
                                    </button>

                                </div>
                                <div class="collapse" id="discussion-{{$item->id}}">
                                    <div class="competition-discussion-content">
                                        @if(Auth::id() == $item->user_id )
                                            <div class="more">
                                                <svg class="olymp-three-dots-icon">
                                                    <use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use>
                                                </svg>
                                                <ul class="more-dropdown">
                                                    <li>
                                                        <a class="edit-question" data-id-qus="{{$item->id}}"
                                                           data-question="{{$item->description}}"
                                                           data-subject-qus="{{$item->subject}}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="delete-question"
                                                           data-delete-id="{{$item->id}}">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif


                                        <p class="qus-text">{!!$item->description!!}</p>
                                    </div>

                                    <div class="competition-discussion-footer">
                                        <div class="post-additional-info inline-items">
                                            <a href="#" class="post-add-icon inline-items">
                                                <i class="fa fa-circle"></i>
                                                <span>{{$item->comments->count()}} Comments</span>
                                            </a>
                                        </div>
                                    </div>
                                    <ul class="comments-list" style="max-height: 270px;overflow-y: hidden;">
                                        @foreach($item->comments as $comment)

                                            <li>
                                                <div class="post__author author vcard inline-items">
                                                    <img src="{{asset($comment->user->profile)}}" alt="">

                                                    <div class="author-date">
                                                        <a class="h6 post__author-name fn"
                                                           href="{{route("profileView",$comment->user->user_name)}}">{{$comment->user->fullName()}}</a>
                                                        <div class="post__date">
                                                            <time class="published" datetime="2017-03-24T18:18">
                                                                @if($comment->created_at != null)
                                                                    {{$comment->created_at->diffForHumans()}}
                                                                @endif
                                                            </time>
                                                        </div>
                                                    </div>
                                                    @if(Auth::id() == $comment->user_id )
                                                        <div class="more">
                                                            <svg class="olymp-three-dots-icon">
                                                                <use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use>
                                                            </svg>
                                                            <ul class="more-dropdown">
                                                                <li>
                                                                    <a class="edit-comment"
                                                                       data-id-comment="{{$comment->id}}"
                                                                       data-comment="{{$comment->comment}}">Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a class="delete-comment"
                                                                       data-delete-comment-id="{{$comment->id}}">Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif

                                                </div>

                                                <p>{{$comment->comment}}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if($item->comments->count() > 2)
                                        <a class="more-comments" style="cursor: pointer;">View more comments
                                            <span>+</span></a>
                                    @endif

                                    <form class="comment-form media">
                                        <img class="d-flex mr-3 post__author" src="{{asset(Auth::user()->profile)}}"
                                             alt="">
                                        <div class="media-body">
                                            <div class="form-group with-icon-right is-empty">
                                                <textarea class="form-control" name="comment"></textarea>
                                                <span class="material-input"></span>
                                            </div>
                                            <input type="hidden" name="users_competition_wall_question_id"
                                                   value="{{$item->id}}">
                                            <button type="submit" class="btn btn-primary btn-sm font-weight-bold">Post
                                                Reply
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- end question list -->

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
