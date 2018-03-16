@extends('layouts.app-news-feed')

@section('content')
    <div class="header-spacer hidden-xs-down"></div>
    <div class="header-spacer-fit hidden-sm-up"></div>
    <div class="container">
        <div class="newsfeed-main-buttons">
            <div class="row">
                <div class="col-4">
                    <a href="#" class="btn btn-block active">News Feed</a>
                </div>
                <div class="col-4">
                    <a href="#" class="btn btn-block">Discussion Board</a>
                </div>
                <div class="col-4">
                    <a href="#" class="btn btn-block">What's Red ?</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-xl-6 push-xl-3 ">
                <!-- newsfeed form -->
                <div class="ui-block box-shadow">
                    <div class="news-feed-form">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active inline-items" data-toggle="tab" href="#form_status" role="tab" aria-expanded="true">
                                    <svg class="olymp-status-icon">
                                        <use xlink:href="../assets/icons/icons.svg#olymp-status-icon"></use>
                                    </svg>
                                    <span>Status</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link inline-items"  href="{{ route('designPost.add') }}" role="tab" aria-expanded="false">
                                    <svg class="olymp-multimedia-icon">
                                        <use xlink:href="../assets/icons/icons.svg#olymp-multimedia-icon"></use>
                                    </svg>
                                    <span>Design</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active inline-items"  href="{{ route('articlePost.add') }}" role="tab" aria-expanded="true">
                                    <svg class="olymp-status-icon">
                                        <use xlink:href="../assets/icons/icons.svg#olymp-status-icon"></use>
                                    </svg>
                                    <span>Article</span>
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="form_status" role="tabpanel" aria-expanded="true">
                                <form enctype="multipart/form-data" id="post_ad_form">
                                    <div class="author-thumb">
                                        <img src="@if(!empty(Auth::user()->profile)){{ Auth::user()->profile }} @endif" alt="author">
                                    </div>
                                    <div class="form-group with-icon label-floating">
                                        <label class="control-label">Share what you are thinking here...</label>
                                        <textarea class="form-control c-white" placeholder="" style="" name="description" id="post_description"></textarea>
                                        <p class="errors" style="display: none;color:red;"></p>


                                    </div>
                                    {{-- Input file --}}
                                    <input type="file" name="image"
                                           style="display: none;" id="image_open">
                                    {{-- Inpyt file --}}

                                    <div class="add-options-message">

                                        <a href="#"  class="options-message image_icon_open" data-toggle="modal" data-target="#update-header-photo" data-toggle="tooltip" data-placement="top" title="" data-original-title="ADD PHOTOS">
                                            <svg class="olymp-camera-icon">
                                                <use xlink:href="../assets/icons/icons.svg#olymp-camera-icon "></use>
                                            </svg>

                                        </a>
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" title="" data-original-title="TAG YOUR FRIENDS">
                                            <svg class="olymp-computer-icon">
                                                <use xlink:href="../assets/icons/icons.svg#olymp-happy-face-icon"></use>
                                            </svg>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm font-weight-bold {{--post_saved--}} post_ad_save_data" style="margin-left: 300px;">Post Status</a>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="form_design" role="tabpanel" aria-expanded="true">
                                <form>
                                    <div class="author-thumb">
                                        <img src="../assets/images/user-photo.jpg" alt="author">
                                    </div>
                                    <div class="form-group with-icon label-floating">
                                        <label class="control-label">Share what you are thinking here...</label>
                                        <textarea class="form-control" placeholder="" ></textarea>
                                    </div>
                                    <div class="add-options-message">
                                        <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo" data-toggle="tooltip" data-placement="top" title="" data-original-title="ADD PHOTOS">
                                            <svg class="olymp-camera-icon">
                                                <use xlink:href="../assets/icons/icons.svg#olymp-camera-icon"></use>
                                            </svg>
                                        </a>
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" title="" data-original-title="TAG YOUR FRIENDS">
                                            <svg class="olymp-computer-icon">
                                                <use xlink:href="../assets/icons/icons.svg#olymp-computer-icon"></use>
                                            </svg>
                                        </a>
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" title="" data-original-title="ADD LOCATION">
                                            <svg class="olymp-small-pin-icon">
                                                <use xlink:href="../assets/icons/icons.svg#olymp-small-pin-icon"></use>
                                            </svg>
                                        </a>
                                        <button class="btn btn-primary btn-sm btn-md-2">Post Status</button>
                                        <button class="btn btn-md-2 btn-sm btn-border-think btn-transparent c-grey">Preview</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- newsfeed -->
                <div id="newsfeed-items-grid" class="post-data" >

                    @foreach($posts as $post )
                        <div class="ui-block ">
                            <article class="hentry post ">
                                <div class="post__author author vcard inline-items">
                                    <img src="@if(!empty($post->user->profile)){{ asset($post->user->profile)}} @else {{ asset('assets/images/avatar.png') }} @endif" alt="">
                                    <div class="author-date">
                                        <a class="h6 post__author-name fn" href="{{ route('postDetail',$post->slug) }}">{{ ucfirst($post->user->first_name) }} {{ ucfirst($post->user->last_name) }} </a>
                                        <div class="post__date">
                                            <time class="published" datetime="2017-03-24T18:18">
                                                {{ $post->created_at->diffForHumans() }}
                                            </time>
                                        </div>
                                    </div>
                                    <div class="more">
                                        <svg class="olymp-three-dots-icon">
                                            <use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use>
                                        </svg>
                                        <ul class="more-dropdown">
                                            <li>
                                                <a href="#">Edit Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Delete Post</a>
                                            </li>
                                            <li>
                                                <a href="#">Turn Off Notifications</a>
                                            </li>
                                            <li>
                                                <a href="#">Select as Featured</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p>
                                    {!! $post->description !!}
                                </p>
                                @if(!empty($post->image))
                                    <div class="post-thumb">
                                        <img src="{{ asset($post->image) }}" alt="">
                                    </div>
                                @endif
                                <div class="post-additional-info inline-items">
                                    <a href="#" class="post-add-icon inline-items">
                                        <i class="fa fa-caret-up"></i>
                                        <span>16 Like</span>
                                    </a>
                                    <a href="#" class="post-add-icon inline-items">
                                        <i class="fa fa-circle"></i>
                                        <span>16 Comments</span>
                                    </a>
                                    <a href="#" class="post-add-icon inline-items">
                                        <i class="fa fa-square"></i>
                                        <span>Share</span>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach

                </div>
                <a id="load-more-button" href="#" class="btn btn-control btn-more" data-container="newsfeed-items-grid">
                    <svg class="olymp-three-dots-icon">
                        <use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use>
                    </svg>
                </a>
            </div>
            <!-- Left Sidebar -->
            <div class="col-xl-3 pull-xl-6 col-lg-6">
                <!-- Personal Info -->
                <div class="ui-block box-shadow">
                    <div class="ui-block-title ">
                        <h6 class="title">Announcements</h6>
                    </div>
                    <!-- <ul class="widget w-activity-feed notification-list w-announcements">
                        <li>
                            <div class="author-thumb">
                                <img src="../assets/images/avatar-6.jpg" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a> Reinventing Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan Shar....<a href="#" class="link-inverse">readmore</a>.
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">2 mins ago</time></span>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="../assets/images/avatar-5.jpg" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a> Reinventing Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan Shar....<a href="#" class="link-inverse">readmore</a>.
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">5 mins ago</time></span>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="../assets/images/avatar-2.jpg" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a> Reinventing Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan Shar....<a href="#" class="link-inverse">readmore</a>.
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">12 mins ago</time></span>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="../assets/images/avatar-3.jpg" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Reinventing Gwalior’16 Event</a> Reinventing Gwalior’16 Event was held in Gwalior on 28th and 29th of May 2016. Karan Shar....<a href="#" class="link-inverse">readmore</a>.
                                <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">1 hour ago</time></span>
                            </div>
                        </li>
                    </ul> -->
                </div>
                <div class="ui-block box-shadow">
                    <div class="ui-block-title ui-block-title-sm ">
                        <h6>Featured Competition</h6>
                    </div>
                    <div class="ui-block-content ui-block-content-sm">
                        <div class="h6 mb-3">Reinventing Gwalior’16 Event</div>
                        <img src="../assets/images/featured-announcement.jpg" alt="">
                        <p class="mt-3">I'm sending you the designs for the Mobile interface. Please check them and let me know what would be the price and when would you be Find the attachment fo estimation sheet. </p>
                    </div>
                </div>
                <div class="ui-block">
                    <div class="ui-block-content ui-block-content-sm">
                        <form>
                            <div class="form-group mb-3">
                                <input class="form-control form-control-lg" placeholder="Invite your friends" type="text">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold mb-0" style="height: 40px;">Send Invitation</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Left Sidebar -->
            <!-- Right Sidebar -->
            <div class="col-xl-3 col-lg-6">
                <!-- Featured competitions -->
                <div class="ui-block w-featured-competitions box-shadow">
                    <div class="ui-block-title">
                        <h6 class="title">Featured Competition</h6>
                        <a href="#" class="more">
                            <svg class="olymp-three-dots-icon">
                                <use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="ui-block-content">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <h5 class="title" data-swiper-parallax="-100"><a href="#">Make a architecture design for my home</a></h5>
                                    <p data-swiper-parallax="-500">Hello all, I am seeking a architect design for home. Attached you will find details. </p>
                                </div>
                                <div class="swiper-slide">
                                    <h5 class="title" data-swiper-parallax="-100"><a href="#">Make a architecture design for my home</a></h5>
                                    <p data-swiper-parallax="-500">Hello all, I am seeking a architect design for home. Attached you will find details. </p>
                                </div>
                                <div class="swiper-slide">
                                    <h5 class="title" data-swiper-parallax="-100"><a href="#">Make a architecture design for my home</a></h5>
                                    <p data-swiper-parallax="-500">Hello all, I am seeking a architect design for home. Attached you will find details. </p>
                                </div>
                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
                <!-- Friend Suggestions -->
                <div class="ui-block box-shadow">
                    <div class="ui-block-title">
                        <h6 class="title">Friend Suggestions</h6>
                        <a href="#" class="more">
                            <svg class="olymp-three-dots-icon">
                                <use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use>
                            </svg>
                        </a>
                    </div>
                    <ul class="widget w-friend-pages-added notification-list friend-requests">
                        <li class="inline-items">
                            <div class="author-thumb">
                                <img src="../assets/images/avatar-1.jpg" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Francine Smith</a>
                                <span class="chat-message-item">8 Friends in Common</span>
                            </div>
                            <span class="notification-icon">
                <a href="#" class="accept-request">
                    <span class="without-text">
                        <img src="../assets/icons/add-friend.svg" alt="">
                    </span>
                </a>
                </span>
                        </li>
                        <li class="inline-items">
                            <div class="author-thumb">
                                <img src="../assets/images/avatar-2.jpg" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Francine Smith</a>
                                <span class="chat-message-item">8 Friends in Common</span>
                            </div>
                            <span class="notification-icon">
                <a href="#" class="accept-request">
                    <span class="without-text">
                        <img src="../assets/icons/add-friend.svg" alt="">
                    </span>
                </a>
                </span>
                        </li>
                        <li class="inline-items">
                            <div class="author-thumb">
                                <img src="../assets/images/avatar-3.jpg" alt="">
                            </div>
                            <div class="notification-event">
                                <a href="#" class="h6 notification-friend">Karen Masters</a>
                                <span class="chat-message-item">6 Friends in Common</span>
                            </div>
                            <span class="notification-icon">
                <a href="#" class="accept-request">
                    <span class="without-text">
                        <img src="../assets/icons/add-friend.svg" alt="">
                    </span>
                </a>
                </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endsection