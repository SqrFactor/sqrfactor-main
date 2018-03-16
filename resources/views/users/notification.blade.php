@extends('layouts.app-news-feed')

@section('content')
    <div class="header-spacer hidden-xs-down"></div>
    <div class="header-spacer-fit hidden-sm-up"></div>

    <div class="container">
        <div class="row" class="pagination-parents">
            <!-- Main Content -->
            <div class="col-xl-6 push-xl-3 ">
                {{-- Notification --}}

                <div class="ui-block">
                    <div class="ui-block-title">
                        <h6 class="title"> All Notifications</h6>
                        <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg></a>
                    </div>

                    <ul class="notification-list all-notification">
                        <br>
                        <p class="text-center">No Notification</p>
                    </ul>

                </div>

                {{-- / Notification --}}
            </div>

            <!-- Left Sidebar -->
            <div class="col-xl-3 pull-xl-6 col-lg-6">
                <!-- Personal Info -->
                <div class="ui-block">
                    <div class="ui-block-title">
                        <h6 class="title">Announcements</h6>
                    </div>
                    <ul class="widget w-activity-feed notification-list w-announcements">
                        <li class="text-center">Launching Feature soon!</li>
                    <!--<li>
                            <div class="author-thumb">
                                <img src="{{ asset('assets/images/avatar-6.jpg') }}" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a>
                                Reinventing Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan
                                Shar....<a href="#" class="link-inverse">readmore</a>.
                                <span class="notification-date"><time class="entry-date updated"
                                                                      datetime="2004-07-24T18:18">2 mins ago</time></span>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{ asset('assets/images/avatar-5.jpg') }}" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a>
                                Reinventing Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan
                                Shar....<a href="#" class="link-inverse">readmore</a>.
                                <span class="notification-date"><time class="entry-date updated"
                                                                      datetime="2004-07-24T18:18">5 mins ago</time></span>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{ asset('assets/images/avatar-2.jpg') }}" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a>
                                Reinventing Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan
                                Shar....<a href="#" class="link-inverse">readmore</a>.
                                <span class="notification-date"><time class="entry-date updated"
                                                                      datetime="2004-07-24T18:18">12 mins ago</time></span>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{ asset('assets/images/avatar-3.jpg') }}" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a>
                                Reinventing Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan
                                Shar....<a href="#" class="link-inverse">readmore</a>.
                                <span class="notification-date"><time class="entry-date updated"
                                                                      datetime="2004-07-24T18:18">1 hour ago</time></span>
                            </div>
                        </li> -->
                    </ul>


                </div>

                <div class="ui-block">
                    <div class="ui-block-content ui-block-content-sm">
                        <form>
                            <div class="form-group mb-3">
                                <input class="form-control form-control-lg" placeholder="Invite your friends"
                                       type="text">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold mb-0"
                                    style="height: 40px;">Send Invitation
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Left Sidebar -->


            @include('users.partials.user-right-sidebar')

        </div>
    </div>
@endsection


