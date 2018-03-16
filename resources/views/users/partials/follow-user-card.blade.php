<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <div class="ui-block">
        <div class="friend-item">
            <div class="friend-item-content">
                <div class="more">
                    <svg class="olymp-three-dots-icon">
                        <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
                    </svg>
                    <ul class="more-dropdown">
                        <li>
                            <a href="javascript:void(0)" class="launching_soon">Report
                                Profile</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="launching_soon">Block
                                Profile</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="launching_soon">Turn Off
                                Notifications</a>
                        </li>
                    </ul>
                </div>
                <div class="friend-avatar">
                    <div class="author-thumb">
                        @if($type == "followers")
                            <img src="{{ asset($follow->followingUser->profile) }}" alt="">
                        @else
                            <img src="{{ asset($follow->followerUser->profile) }}" alt="">
                        @endif
                    </div>
                    <div class="author-content">
                        @if($type == "followers")
                            <a href="{{ route('profileView',$follow->followingUser->user_name) }}"
                               class="h6 author-name">{{ $follow->followingUser->fullName() }}</a>

                            <div class="country">
                                @if($follow->followingUser->fullAddress() != null)
                                    {{ $follow->followingUser->fullAddress() }}
                                @else
                                    <div style="height: 21px;width: 1px;"></div>
                                @endif
                            </div>
                        @else
                            <a href="{{ route('profileView',$follow->followerUser->user_name) }}"
                               class="h6 author-name">{{ $follow->followerUser->fullName() }}</a>

                            <div class="country">
                                @if($follow->followerUser->fullAddress() != null)
                                    {{ $follow->followerUser->fullAddress() }}
                                @else
                                    <div style="height: 21px;width: 1px;"></div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                @if($type == "followers")
                    <div class="friend-count" data-swiper-parallax="-500">
                        <a href="{{ route('profileView',$follow->followingUser->user_name) }}" class="friend-count-item">
                            <div class="h6">{{$follow->followingUser->posts->count()}}</div>
                            <div class="title">Posts</div>
                        </a>
                        <a href="{{route('portfolio',$follow->followingUser->user_name)}}" class="friend-count-item">
                            <div class="h6">{{$follow->followingUser->portfolioPost->count()}}</div>
                            <div class="title">Portfolio</div>
                        </a>
                    </div>
                @else
                    <div class="friend-count" data-swiper-parallax="-500">
                        <a href="{{ route('profileView',$follow->followerUser->user_name) }}" class="friend-count-item">
                            <div class="h6">{{$follow->followerUser->posts->count()}}</div>
                            <div class="title">Posts</div>
                        </a>
                        <a href="{{route('portfolio',$follow->followerUser->user_name)}}" class="friend-count-item">
                            <div class="h6">{{$follow->followerUser->portfolioPost->count()}}</div>
                            <div class="title">Portfolio</div>
                        </a>
                    </div>
                @endif

                {{--<div class="control-block-button launching_soon"--}}
                {{--data-swiper-parallax="-100">--}}
                {{--<a href="javascript:void(0)" class="btn btn-control">--}}

                {{--<i class="fa fa-square"></i>--}}
                {{--</a>--}}
                {{--<a href="javascript:void(0)" class="btn btn-control launching_soon">--}}
                {{--<i class="fa fa-circle"></i>--}}
                {{--</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>