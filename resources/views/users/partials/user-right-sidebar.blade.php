<div class="col-xl-3 col-lg-6">
   <div class="ui-block w-featured-competitions">
        <div class="ui-block-title">
            <h6 class="title">Featured Competition</h6>
        </div>
        <div class="ui-block-content">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($featured_compitions as $feature)
                    <div class="swiper-slide">
                        <h5 class="title" data-swiper-parallax="-100">
                            <a href="{{route('competition',$feature->slug)}}">{{$feature->competition_title}}</a>
                        </h5>
                        <p data-swiper-parallax="-500">{!! str_limit(strip_tags($feature->brief),80)!!}</p>
                    </div>
                    @endforeach
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <!-- Friend Suggestions -->
    @if(Auth::check())
        <div class="ui-block">
            <div class="ui-block-title">
                <h6 class="title">Follow Suggestions</h6>
                {{--<a href="javascript:void(0)" class="more">--}}
                    {{--<svg class="olymp-three-dots-icon">--}}
                        {{--<use xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>--}}
                    {{--</svg>--}}
                {{--</a>--}}
            </div>
            <ul class="widget w-friend-pages-added notification-list friend-requests">
                @if(isset($friend_suggestions) && count($friend_suggestions) > 0)
                    @foreach($friend_suggestions as $friend)
                        <li class="inline-items">
                            <div class="author-thumb">
                                <img src="{{ URL::asset($friend->profile) }}"
                                     @if($friend->id == Auth::id()) class="profile_change_append" @endif alt="">
                            </div>
                            <div class="notification-event">
                                <a href="@if(Auth::id() == $friend->id){{ route('profile') }} @else {{ route('profileView',$friend->user_name) }} @endif "
                                   class="h6 notification-friend">{{ $friend->fullName() }}</a>
                                <span class="chat-message-item">{{ $friend->userType($friend->id) }}</span>
                            </div>
                          {{-- <span class="notification-icon">
                           <a href="#" class="accept-request">
                                <span class="without-text">
                                    <img src="{{ asset('assets/icons/add-friend.svg') }}" alt="">
                                </span>
                            </a>
                            </span>--}}
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>


    @endif
</div>