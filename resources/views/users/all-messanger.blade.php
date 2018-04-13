@extends('layouts.app-news-feed')

@section('title')
    {{ Auth::user()->fullName() }} | SqrFactor
@endsection
@section('content_description')
    @if(Auth::user()->userDetail->short_bio != null)
        {{ Auth::user()->userDetail->short_bio }}
    @else 
        An online platform for architects, interior designers, teachers and students to showcase their skills, 
        apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!
    @endif
@endsection
@section('styles')
<!-- fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="{{ asset('css/messages/app-bootstrap.css') }}" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Vendor CSS -->
<!-- CSS -->
<!-- Main css -->
<link href="{{ asset('css/messages/app1.css') }}" rel="stylesheet">
<link href="{{ asset('css/messages/messages.css') }}" rel="stylesheet">
<!-- custom scroll -->
<link href="{{ asset('css/messages/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
@endsection

@section('content')  
    <div class="messages-container" id="chatApp">
    <div class="ui-block mb-0">
        <div class="ui-block-title">
            <h6 class="title">Chat / Messages</h6>
            <a href="#" class="more">
                <!-- <svg class="olymp-three-dots-icon">
                    <use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use>
                </svg> -->
            </a>
        </div>

        <!--<div class="messages-row mCustomScrollbar" data-mcs-theme="dark">-->
        <div class="messages-row">
            <div class="messages-overlay messages-list-toggle"></div>
            <div class="messages-col messages-col-left">
                <div class="form-group mb-0 search-messages-group">
                    <a href="#" class="messages-list-toggle messages-list-toggle-open"><i class="fa fa-bars"></i></a>
                    <div class="search-messages">
                        <input type="text" class="form-control" placeholder="Search Message">
                        <i class="fa fa-search"></i>
                    </div>
                    <a href="#" class="messages-list-toggle"><i class="fa fa-close"></i></a>
                </div>
                <div class="messages-list mCustomScrollbar" data-mcs-theme="dark">
                    <!-- message list -->
                    <ul class="notification-list chat-message chat-message-list">
                        @foreach($friends as $friend)
                                <li>
                                    <a href="{{url('/myallMSG/'.$friend->id)}}" style="justify-content: space-between;">
                                        <div class="author-thumb">
                                            <img src="{{URL::asset($friend->profile)}}" alt="author">
                                        </div>
                                    </a>
                                    <div class="notification-event">
                                        <a href="{{url('/myallMSG/'.$friend->id)}}" class="h6 notification-friend mb-1">
                                            {{$friend->first_name}}&nbsp;{{$friend->last_name}}
                                        </a>
                                    </div>
                                    <onlineuser v-bind:friend ="{{$friend}}" v-bind:onlineusers="onlineUsers"></onlineuser>
                                </li>
                        @endforeach
                    </ul>
                </div>
                <!-- end message list -->
            </div>

            <!-- right column -->
            <div class="messages-col messages-col-right">
                <meta name="friendId" content="{{$chat_friend->id}}">
                <!-- chat field -->
                <div class="chat-field">
                    <div class="ui-block-title">

                        <h6 class="title">{{$chat_friend->first_name}}&nbsp{{$chat_friend->last_name}}</h6>
                        <!-- {{$chat_friend}}
                        <br>
                        {{Auth::user()->first_name}} -->
                        <div class="more">
                            <svg class="olymp-three-dots-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use></svg>
                        </div>
                    </div>
                    <div class="chat-field-content" id="showAllMsg">
                        <chat v-bind:chats="chats" v-bind:userid="{{Auth::user()->id}}" v-bind:friendid="{{$chat_friend->id}}"
                            v-bind:user="{{Auth::user()}}"  v-bind:friend="{{$chat_friend}}"></chat>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery-2.1.3.min.js')}}"></script>    
    <script src="{{asset('assets/js/chat-realtime-static-all.js')}}"></script>
    <!-- Bootstrap script -->
    <script src="{{asset('vendor/tether/dist/js/tether.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Js effects for material design. + Tooltips -->
    <script src="{{asset('assets/js/material.min.js')}}"></script>
    <!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
    <script src="{{asset('assets/js/theme-plugins.js')}}"></script>
    <!-- Init functions -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <!-- vendor script -->
    <script src="{{asset('assets/js/messages.js')}}"></script>
    <!-- script -->
    <!-- app script -->
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
@endsection
