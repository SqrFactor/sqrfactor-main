<div class="header-spacer-fit"></div>
@if(Request::path() == isset($user) && 'profile/detail/'.$user->user_name || Request::path() == isset($user) && 'about/'.$user->user_name)


    @if(Auth::check() && $user->id != Auth::user()->id)

        <div class="ui-block profile-header">
            <div class="top-header top-header-favorit">
                <div class="top-header-thumb">
                    <div class="container">
                        <div class="clearfix" style="word-wrap: break-word;">
                            <div class="top-header-caption">
                                {!! $user->userDetail->short_bio !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="top-header-author">
                        <div class="author-thumb  @if(Auth::user()->id == $user->id ) loggedIn @endif ">
                            <img alt="author" src="{{ asset($user->profile) }}" class="view_profile">
                        </div>
                        <div class="author-content">
                            <a href="javascript:void(0)" class="author-name h4 font-weight-bold d-inline-block mb-1">
                                @if($user->first_name != null && $user->last_name != null)

                                    {{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}
                                @else
                                    {{ ucfirst($user->name) }}

                                @endif

                            </a>
                            <div class="country">
                                @if($user->userDetail->city_id != null && $user->userDetail->state_id != null && $user->userDetail->country_id != null)
                                    {{ $user->userDetail->city->name.', '.$user->userDetail->state->name.', '.$user->userDetail->country->name}}
                                    ({{ $user->userType($user->id) }})
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="profile-section">
                        <div class="control-block-button">
                            <a href="javascript:void(0)" class="btn btn-control follow_ " data-id="{{ $user->id }}">
                                @if($user->followingUser($user->id) != null)
                                    Following
                                @else
                                    Follow
                                @endif

                            </a>

                            <a href="{{ route('sendMessage',$user->user_name) }}" class="btn btn-control">
                                Message
                                <div class="ripple-container"></div>
                            </a>
                           <!-- <a href="javascript:void(0)" id="message" class="btn btn-control" data-attr-user-id ="{{$user->id}}" >
                                Message
                                <div class="ripple-container"></div>
                            </a>-->
                        </div>
                        <ul class="profile-menu">
                            <li>
                                <a href="{{route("profileView",['user' => $user->user_name])}}"><span
                                            class="number">{{$user->blueprintCount()}}</span>BluePrint</a></li>
                            <li>
                                <a href="{{route("portfolio",['user' => $user->user_name])}}"><span
                                            class="number count_portfolio">{{$user->portfolioCount()}}</span>Portfolio</a>
                            </li>


                            <li>
                                <a href=" @if($user->follower->count() > 0){{ route('follow',[
                        'action' => 'followers',
                        'user' => $user->user_name,
                        ]) }} @else javascript:void(0) @endif"><span
                                            class="number follower_count">{{ $user->follower->count() }}</span>Followers</a>
                            </li>


                            <li>
                                <a href="@if($user->following->count() > 0){{ route('follow',[
                        'action' => 'following',
                        'user' => $user->user_name,
                        ]) }} @else javascript:void(0) @endif"><span
                                            class="number following_count">{{ $user->following->count() }}</span>Following</a>
                            </li>

                            <li>
                                <div class="more">
                                    <svg class="olymp-three-dots-icon">
                                        <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
                                    </svg>
                                    <ul class="more-dropdown more-with-triangle">
                                        <li>
                                            <a href="{{ route('aboutProfile',$user->user_name) }}">About
                                                @if($user->first_name != null && $user->last_name != null)

                                                    {{ $user->first_name.' '.$user->last_name }}
                                                @else
                                                    {{ $user->name }}

                                                @endif
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('competition',$user->user_name)}}">Competition</a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- .profile-section -->
            </div>
        </div>

    @else
        {{--{{ dd('false2') }}--}}





        @include('users.partials.header-profile-unauth')
    @endif

@else
    {{-- {{ dd('true') }}--}}






    @include('users.partials.header-profile-auth')

@endif
