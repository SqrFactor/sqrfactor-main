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
    <div class="messages-container">
    <div class="ui-block mb-0">
        <div class="ui-block-title">
            <h6 class="title">Chat / Messages</h6>
            <a href="#" class="more">
                <svg class="olymp-three-dots-icon">
                    <use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use>
                </svg>
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
                        <li>
                            <div class="author-thumb">
                                <img src="{{asset('assets/images/avatar-1.jpg')}}" alt="author">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend mb-1">Nitik Ratnakar</a>
                                <span class="chat-message-item">Hi James! It’s Diana, I just wanted to let you know that we have to </span>
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
                            </div>
                            <span class="notification-icon">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use></svg>
                            </span>

                            <div class="more">
                                <svg class="olymp-three-dots-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use></svg>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{asset('assets/images/avatar-2.jpg')}}" alt="author">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend mb-1">Angad Gill</a>
                                <span class="chat-message-item">Great, I’ll see you tomorrow!</span>
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">7 hours ago</time></span>
                            </div>
                            <span class="notification-icon">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use></svg>
                            </span>

                            <div class="more">
                                <svg class="olymp-three-dots-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use></svg>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{asset('assets/images/avatar-3.jpg')}}" alt="author">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend mb-1">Chetan Chouhan</a>
                                <span class="chat-message-item">Pick up my call</span>
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">7 hours ago</time></span>
                            </div>
                            <span class="notification-icon">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use></svg>
                            </span>

                            <div class="more">
                                <svg class="olymp-three-dots-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use></svg>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{asset('assets/images/avatar-4.jpg')}}" alt="author">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend mb-1">Rakesh Bisht</a>
                                <span class="chat-message-item">Great, I’ll see you tomorrow!</span>
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">7 hours ago</time></span>
                            </div>
                            <span class="notification-icon">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use></svg>
                            </span>

                            <div class="more">
                                <svg class="olymp-three-dots-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use></svg>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{asset('assets/images/avatar-1.jpg')}}" alt="author">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend mb-1">Nitik Ratnakar</a>
                                <span class="chat-message-item">Hi James! It’s Diana, I just wanted to let you know that we have to </span>
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
                            </div>
                            <span class="notification-icon">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use></svg>
                            </span>

                            <div class="more">
                                <svg class="olymp-three-dots-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use></svg>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{asset('assets/images/avatar-2.jpg')}}" alt="author">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend mb-1">Angad Gill</a>
                                <span class="chat-message-item">Great, I’ll see you tomorrow!</span>
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">7 hours ago</time></span>
                            </div>
                            <span class="notification-icon">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use></svg>
                            </span>

                            <div class="more">
                                <svg class="olymp-three-dots-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use></svg>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{asset('assets/images/avatar-4.jpg')}}" alt="author">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend mb-1">Rakesh Bisht</a>
                                <span class="chat-message-item">Great, I’ll see you tomorrow!</span>
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">7 hours ago</time></span>
                            </div>
                            <span class="notification-icon">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use></svg>
                            </span>

                            <div class="more">
                                <svg class="olymp-three-dots-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use></svg>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{asset('assets/images/avatar-1.jpg')}}" alt="author">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend mb-1">Nitik Ratnakar</a>
                                <span class="chat-message-item">Hi James! It’s Diana, I just wanted to let you know that we have to </span>
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
                            </div>
                            <span class="notification-icon">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use></svg>
                            </span>

                            <div class="more">
                                <svg class="olymp-three-dots-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use></svg>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{asset('assets/images/avatar-2.jpg')}}" alt="author">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend mb-1">Angad Gill</a>
                                <span class="chat-message-item">Great, I’ll see you tomorrow!</span>
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">7 hours ago</time></span>
                            </div>
                            <span class="notification-icon">
                                <svg class="olymp-chat---messages-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use></svg>
                            </span>

                            <div class="more">
                                <svg class="olymp-three-dots-icon"><use xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use></svg>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- end message list -->
            </div>

            <!-- right column -->
            <div class="messages-col messages-col-right">
                <!-- chat field -->
                <div class="chat-field">
                    <div class="ui-block-title">
                        <h6 class="title">Elaine Dreyfuss</h6>
                        <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
                    </div>
                    <div class="chat-field-content mCustomScrollbar" data-mcs-theme="dark">
                        <ul class="notification-list chat-message chat-message-field">
                            <li>
                                <div class="media">
                                    <img class="d-flex author-thumb" src="{{asset('assets/images/avatar-1.jpg')}}" alt="author">
                                    <div class="media-body">
                                        <div class="notification-event">
                                            <div class="clearfix">
                                                <a href="#" class="h6 notification-friend">Elaine Dreyfuss</a>
                                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
                                            </div>
                                            <span class="chat-message-item">
                                                Hello Bhai! How’re you? :D <br>
                                                Let’s meet up next weekend?
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="d-flex author-thumb" src="{{asset('assets/images/avatar-2.jpg')}}" alt="author">
                                    <div class="media-body">
                                        <div class="notification-event">
                                            <div class="clearfix">
                                                <a href="#" class="h6 notification-friend">Nitik Ratnakar</a>
                                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:30pm</time></span>
                                            </div>
                                            <span class="chat-message-item">
                                                I’m good Bhai, You say? <br>
                                                Haan let’s meet. <br>
                                                Check out my new work 

                                                <div class="added-photos">
                                                    <img src="{{asset('assets/images/news.jpg')}}" alt="photo">
                                                    <img src="{{asset('assets/images/post-image-1.jpg')}}" alt="photo">
                                                    <span class="photos-name">photo-1.jpg; photo-2.jpg</span>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="media">
                                    <img class="d-flex author-thumb" src="{{asset('assets/images/avatar-3.jpg')}}" alt="author">
                                    <div class="media-body">
                                        <div class="notification-event">
                                            <div class="clearfix">
                                                <a href="#" class="h6 notification-friend">Suvrat Jhavar</a>
                                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 9:56pm</time></span>
                                            </div>
                                            <span class="chat-message-item">
                                                Nice design, architecture of building looks awesome. <br>
                                                Are we meeting on weekend ?
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!--  -->

                            <li>
                                <div class="media">
                                    <img class="d-flex author-thumb" src="{{asset('assets/images/avatar-4.jpg')}}" alt="author">
                                    <div class="media-body">
                                        <div class="notification-event">
                                            <div class="clearfix">
                                                <a href="#" class="h6 notification-friend">Nitik Ratnakar</a>
                                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 10:30pm</time></span>
                                            </div>
                                            <span class="chat-message-item">
                                                Yes we are meeting. <br>
                                                Do you have some plan for weekend ?
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!--  -->

                            <li>
                                <div class="media">
                                    <img class="d-flex author-thumb" src="{{asset('assets/images/avatar-3.jpg')}}" alt="author">
                                    <div class="media-body">
                                        <div class="notification-event">
                                            <div class="clearfix">
                                                <a href="#" class="h6 notification-friend">Suvrat Jhavar</a>
                                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 10:56pm</time></span>
                                            </div>
                                            <span class="chat-message-item">
                                                Yea, Need to discus a new project with you. <br>
                                                After that will have dinner together. 
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!--  -->

                            <li>
                                <div class="media">
                                    <img class="d-flex author-thumb" src="../assets/images/avatar-4.jpg" alt="author">
                                    <div class="media-body">
                                        <div class="notification-event">
                                            <div class="clearfix">
                                                <a href="#" class="h6 notification-friend">Nitik Ratnakar</a>
                                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 10:59pm</time></span>
                                            </div>
                                            <span class="chat-message-item">
                                                cool !
                                                I will leave after 7 PM
                                                and meet you at city center at Tinku’s shop :)
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!--  -->

                            <li>
                                <div class="media">
                                    <img class="d-flex author-thumb" src="../assets/images/avatar-3.jpg" alt="author">
                                    <div class="media-body">
                                        <div class="notification-event">
                                            <div class="clearfix">
                                                <a href="#" class="h6 notification-friend">Suvrat Jhavar</a>
                                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 11:05pm</time></span>
                                            </div>
                                            <span class="chat-message-item">
                                                I will be there. <br>
                                                have a good night :)
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <form class="messages-form clearfix">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Write your reply here...">
                        </div>
                        <i class="fa fa-send"></i>
                    </form>
                </div>
                <!-- end chat field -->
            </div>
            <!-- end right column -->

        </div>
    </div>
</div>

   <!--  @include('users.partials.post-detail-view-model') -->
@endsection
 
@section('scripts')
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
