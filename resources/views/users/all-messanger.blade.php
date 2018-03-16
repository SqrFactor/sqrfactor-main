@extends('layouts.app-news-feed')

@section('title'){{ Auth::user()->fullName() }} | SqrFactor @endsection
@section('content_description')
    @if(Auth::user()->userDetail->short_bio != null)
        {{ Auth::user()->userDetail->short_bio }}
    @else An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!
    @endif
@endsection

@section('content')

    <div class="header-spacer-fit hidden-sm-up"></div>
    <div class="container-fluid m-t-media-15" style="margin-top: 100px;">
        <div class="ui-block">
            <div class="ui-block-title">
                <h6 class="title">Chat / Messages</h6>
                <a class="backAllUsers more">Close</a>
            </div>
            <div class="row all_message_row">


                <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12 padding-r-0 all-message-user-list">
                    <!-- message list -->
                    <ul class="notification-list chat-message users-list">
                    </ul>
                    <form class="header-search-form">
                            <input type="text" class="header-search-form-input-msg"  placeholder="Search">
                             <button type="button" class="btn header-search-form-btn"><i class="fa fa-search"></i></button>
                             <ul class="header-search account-settings ajax_search-msg">
                             </ul>
                    </form>
                    <!-- end message list -->
                </div>


                <!-- right column -->
                <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-xs-12 padding-l-0 all-messages-list">
                    <!-- chat field -->
                    <div class="chat-field">
                        <div class="mCustomScrollbar helo ps ps--theme_default ps--active-y" data-mcs-theme="dark"
                             data-ps-id="55671391-f5ad-efa0-3b6d-fc4bbdc4d632">

                            <input type="hidden" id="from" value="{{Auth::user()->id}}"/>
                            <input type="hidden" id="from_name" value="{{Auth::user()->user_name}}"/>
                            <input type="hidden" id="all-msg-page" value="set"/>

                            <ul class="notification-list chat-message chat-message-field chat">
                            </ul>
                            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                <div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__scrollbar-y-rail" style="top: 0px; height: 520px; right: 0px;">
                                <div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 359px;"></div>
                            </div>
                        </div>
                        <form class="clearfix">
                            <div class="form-group label-floating mb-2 is-empty">
                                <label class="control-label">Write your reply here...</label>
                                <textarea class="form-control" placeholder="" id="message"></textarea>
                                <span class="material-input"></span></div>
                            <div class="add-options-message">
                                <button class="btn btn-primary btn-sm" id="send" type="submit">Post Reply</button>
                            </div>
                        </form>
                    </div>
                    <!-- end chat field -->
                </div>
                <!-- end right column -->
            </div>
        </div>
    </div>
    @include('users.partials.post-detail-view-model')

@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/js/jquery-2.1.3.min.js')}}"></script>
    
    <script src="{{asset('assets/js/chat-realtime-static-all.js')}}"></script>
@endsection
