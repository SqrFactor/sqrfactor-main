<header class="header" id="site-header">
    <div class="header-content-wrapper container">
        <!-- logo -->
        <a href="{{route('home')}}" class="header-brand">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt=""/>
        </a>

        <!-- nav -->
        @if(Auth::check())
        
            <ul class="header-nav">
                <!--<li class="active">-->
                <li><a href="{{ route('competition.find')}}" class="">Find Competition</a></li>
                <li class="has-submenu">
                    <a href="#">Announcement</a>
                    <ul class="submenu">

                      
                         <li><a href="{{route('jobList')}}">Job/Internship</a></li>
                      
                        <li><a href="{{route('eventList')}}">Event</a></li>
                       <!--  @if(Auth::user()->user_type != "work_individual")
                            <li><a href="{{route('competitionAdd')}}">Competition</a></li>
                        @endif -->
                    </ul>
                </li>
            </ul>

            <!-- search form -->
            <form class="header-search-form">
                <input type="text" class="header-search-form-input" placeholder="Search">
                <button type="button" class="btn header-search-form-btn"><i class="fa fa-search"></i></button>
                <ul class="header-search account-settings ajax_search">
                </ul>
            </form>

    @endif
    <!-- Notifications -->
        <div class="control-block">
            @if(Auth::check())
            <!-- more has-items  -->
                <div class="control-icon launching_soon">
                    <i class="fa fa-envelope-o"></i>
                    <div class="label-avatar bg-primary" id="chat-alert" style="display: none;">0</div>
                    <div class="more-dropdown more-with-triangle header-notification-dropdown">
                        <div class=" ui-block-title ui-block-title-small">
                            <h6 class="title">New Messages</h6>
                        </div>
                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            <!-- notification-list-only-header -->
                            <ul class="notification-list launching_soon">

                            </ul>
                        </div>
                        <a href="/myallMSG" class="view-all bg-primary">View All Messages</a>
                    </div>
                </div>
                <div class="control-icon more has-items" id="web_notification_triger">
                    <i class="fa fa-bell-o"></i>
                    <div class="label-avatar bg-primary notification-badge" style="display: none;">0</div>
                    <div class="more-dropdown notifiction-custom more-with-triangle header-notification-dropdown">
                        <div class=" ui-block-title ui-block-title-small">
                            <h6 class="title">Notifications</h6>
                        </div>
                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            <ul class="notification-list realtime-notification">
                                <br>
                                <p class="text-center"><img src='{{asset('/img/ajax-loader.gif')}}'></p>
                            </ul>
                        </div>
                        <a href="{{route('notification')}}" class="view-all bg-primary">View All Notifications</a>
                    </div>
                </div>
            @endif
            @if(Auth::check())
                <div class="author-page author vcard inline-items more">
                    <div class="author-thumb">
                        @if(Auth::user()->profile !== null)
                            <img alt="author" src="{{ asset(Auth::user()->profile) }}"
                                 class="avatar profile_change_append">
                        @endif

                        <div class="more-dropdown more-with-triangle">
                            <div class="ui-block-title">
                                <h6 class="title"> @if(Auth::user()->first_name !== null AND Auth::user()->last_name !== null ){{ ucfirst(Auth::user()->first_name) .' '. ucfirst(Auth::user()->last_name)  }} @elseif(Auth::user()->name !== null){{ucfirst(Auth::user()->name) }} @endif</h6>
                            </div>
                            <ul class="account-settings">
                                <li>


                                    <a href="{{ route('profile',Auth::user()->name) }}">
                                        <svg class="olymp-menu-icon">
                                            <use xlink:href="{{asset('assets/icons/icons.svg#olymp-menu-icon')}}"></use>
                                        </svg>
                                        <span>Profile</span>
                                    </a>

                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <svg class="olymp-chat---messages-icon">
                                            <use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use>
                                        </svg>
                                        <span>Messages</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('profile.edit') }}">
                                        <svg class="olymp-settings-icon">
                                            <use xlink:href="{{asset('assets/icons/icons.svg#olymp-settings-icon')}}"></use>
                                        </svg>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}">
                                        <svg class="olymp-logout-icon">
                                            <use xlink:href="{{asset('assets/icons/icons.svg#olymp-logout-icon')}}"></use>
                                        </svg>
                                        <span>Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @else
                <a class="btn btn-primary mobile-nav-button" href="{{ route('login') }}">
                    Login
                </a>

                <a href="{{route("register")}}" style="margin-left: 5px;" class="btn btn-secondary mobile-nav-button">
                    Register
                </a>
            @endif
        </div>

    </div>
</header>

@if(Auth::check())
<input type="hidden" id="user_id" value="{{Auth::id()}}">
<input type="hidden" id="my-alert" value="{{Auth::user()->id}}"/>
@endif
<!-- End Header -->
<!-- responsive navbar -->
<header class="header header-responsive" id="site-header-responsive">
    <div class="header-content-wrapper container">
        <ul class="nav nav-tabs mobile-app-tabs" role="tablist">

            <li class="nav-item pl-0">
                <!-- logo -->

                <a href="{{route('home')}}" class="nav-link header-brand pl-0 mr-0"
                   style="min-width: 35px; padding-left: 10px!important;">
                    <img src="{{asset('assets/images/newsfeed.png')}}" alt="" style="width: 21px;margin-top: 8px;"/>
                </a>

            </li>
            <li class="nav-item">
                @if(Auth::check())
                    {{--<a class="nav-link" data-toggle="tab" href="#tab_messages" role="tab">--}}
                    <a class="nav-link launching_soon" data-toggle="tab" href="#" role="tab">
                        <div class="control-icon has-items">
                            <i class="fa fa-envelope-o"></i>
                            <div class="label-avatar bg-primary" style="display: none;">5</div>
                        </div>
                    </a>
                @endif
            </li>

            <li class="nav-item">
                @if(Auth::check())
                    <a class="nav-link" href="{{route('notification')}}">
                        <div class="control-icon has-items">
                            <i class="fa fa-bell-o"></i>
                            <div class="label-avatar bg-primary notification-badge" style="display: none;">2</div>
                        </div>
                    </a>
                @endif
            </li>

            <li class="nav-item">
                @if(Auth::check())
                    <a class="nav-link" data-toggle="tab" href="#tab_search" role="tab">
                        <div class="control-icon mb-0">
                            <i class="fa fa-search olymp-magnifying-glass-icon text-center"
                               style="height: auto;width: 100%;"></i>
                            <i class="fa fa-close olymp-close-icon text-center" style="height: auto;width: 100%;"></i>
                        </div>
                    </a>
                @endif
            </li>

            <li class="nav-item">
                @if(Auth::check())
                    <a class="nav-link" data-toggle="tab" href="#header-nav" role="tab">
                        <div class="control-icon mb-0">
                            <i class="fa fa-bars olymp-magnifying-glass-icon text-center"
                               style="height: auto;width: 100%;"></i>
                            <i class="fa fa-close olymp-close-icon text-center" style="height: auto;width: 100%;"></i>
                        </div>
                    </a>
                @endif
            </li>

            <li class="nav-item">
                @if(Auth::check())
                    <a class="nav-link author-page p-0 m-0" data-toggle="tab" href="#header-nav-user" role="tab">
                        <div class="author-thumb">
                            @if(Auth::user()->profile !== null)
                                <img alt="author" src="{{ asset(Auth::user()->profile) }}" class="avatar">
                            @else
                                <img alt="author" src="{{asset('/assets/images/user-photo.jpg')}}" class="avatar">
                            @endif
                        </div>
                    </a>
                @else
                    <a class="btn btn-primary mobile-nav-button" href="{{ route('login') }}">
                        Login
                    </a>

                    <a href="{{route("register")}}" class="btn btn-secondary mobile-nav-button">
                        Register
                    </a>
                @endif
            </li>

        </ul>

    </div>

{{-- Show Messages, Notification & User Profile tabs only when user is loggedin --}}
@if(Auth::check())
    <!-- Tab panes -->
        <div class="tab-content tab-content-responsive">
            <!-- messages -->
            <div class="tab-pane" id="tab_messages" role="tabpanel">
                <div class="ui-block-title ui-block-title-small">
                    <h6 class="title">New Messages</h6>
                </div>
                <!-- notification-list-only-header -->
                <ul class="notification-list launching_soon">
                    <!-- <li>
                        <div class="media">
                            <img class="author-thumb" src="../assets/images/avatar-sm-1.jpg" alt="author">
                            <div class="media-body">
                                <div class="notification-event">
                                    <div><a href="#" class="h6 notification-friend">Mathilda Brinker</a></div>
                                    <p>Hi James! It’s Diana, I just wanted to let you know that we have to</p>
                                    <span class="notification-date"><time class="entry-date updated"
                                                                          datetime="2004-07-24T18:18">4 hours ago</time></span>
                                </div>
                                <div class="more">
                                    <svg class="olymp-little-delete">
                                        <use xlink:href="../assets/icons/icons.svg#olymp-little-delete"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </li> -->
                    
                </ul>

                <a href="/myallMSG" class="view-all bg-primary">View All Messages</a>

            </div>
            <!-- notifications -->
            <div class="tab-pane" id="tab_notifications" role="tabpanel">
                <div class=" ui-block-title ui-block-title-small">
                    <h6 class="title">Notifications</h6>
                </div>
                <ul class="notification-list realtime-notification">
                    <br>
                    <p class="text-center">No Notifications</p>
                </ul>

                <a href="{{route('notification')}}" class="view-all bg-primary">View All Notifications</a>

            </div>
            <!-- search -->
            <div class="tab-pane" id="tab_search" role="tabpanel">
                <form class="header-search-form">
                    <input type="text" class="header-search-form-input" placeholder="Search">
                    <button type="button" class="btn header-search-form-btn"><i class="fa fa-search"></i></button>
                    <ul class="header-search account-settings ajax_search mobile">

                    </ul>
                </form>
            </div>
            <!-- nav -->
            <div class="tab-pane fade" id="header-nav" role="tabpanel">
                <ul class="header-nav-responsive">
                    <li class="active">
                        <a href="{{route('competition.find')}}">Find Competition</a>
                    </li>
                    <li class="has-submenu">
                        <a href="#">Announcement</a>
                        <ul class="submenu">
                            <li><a href="{{route('jobList')}}">Job/Internship</a></li>
                            <li><a href="{{route('eventList')}}">Event</a></li>
                           <!--  @if(Auth::user()->user_type != "work_individual")
                                <li><a href="{{route('competitionAdd')}}">Competition</a></li>
                            @endif -->
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- user nav -->
            <div class="tab-pane fade" id="header-nav-user" role="tabpanel">
                <div class="ui-block-title">
                    <h6 class="title"><h6
                                class="title"> @if(Auth::user()->first_name !== null AND Auth::user()->last_name !== null ){{ ucfirst(Auth::user()->first_name) .' '. ucfirst(Auth::user()->last_name)  }} @elseif(Auth::user()->name !== null){{ucfirst(Auth::user()->name) }} @endif</h6>
                    </h6>
                </div>
                <ul class="account-settings">
                    <li>
                        <a href="{{ route('profile') }}">
                            <svg class="olymp-menu-icon">
                                <use xlink:href="{{asset('assets/icons/icons.svg#olymp-menu-icon')}}"></use>
                            </svg>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg class="olymp-chat---messages-icon">
                                <use xlink:href="{{asset('assets/icons/icons.svg#olymp-chat---messages-icon')}}"></use>
                            </svg>
                            <span>Messages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}">
                            <svg class="olymp-settings-icon">
                                <use xlink:href="{{asset('assets/icons/icons.svg#olymp-settings-icon')}}"></use>
                            </svg>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">
                            <svg class="olymp-logout-icon">
                                <use xlink:href="{{asset('assets/icons/icons.svg#olymp-logout-icon')}}"></use>
                            </svg>
                            <span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div><!-- .tab-content -->

        <!-- end tab panes -->
    @endif
</header>

<!-- </responsive navbar -->
