<div class="ui-block profile-header">
    <div class="top-header top-header-favorit">
        <div class="top-header-thumb">
            <div class="container">
                <div class="clearfix" style="word-wrap: break-word;">
                    <div class="top-header-caption">
                        <a href="javascript:void(0)" class="short_bio_model short_bio_content"
                           style="color: white;"> {!! $user->userDetail->short_bio !!} </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="top-header-author">
                <div class="author-thumb @if(Auth::check()) loggedIn @endif ">
                    <img alt="author" src="{{ asset($user->profile) }}" class="profile_change profile_change_append ">
                </div>
                <div class="author-content">
                    <a href="javascript:void(0)" class="author-name h4 font-weight-bold d-inline-block mb-1">
                        @if(!empty($user->first_name) && !empty($user->last_name)) {{ ucfirst($user->first_name) .' '. ucfirst($user->last_name)  }}  @elseif(!empty($user->name)) {{ ucfirst($user->name) }} @endif
                    </a>
                    <div class="country">
                        @if($user->userDetail->city_id != null && $user->userDetail->state_id != null && $user->userDetail->country_id != null)


                            {{ $user->userDetail->city->name }}, {{ $user->userDetail->state->name }}
                            , {{ $user->userDetail->country->name }}({{ $user->userType($user->id)}})
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="profile-section">
                <div class="control-block-button">
                    @if(Auth::check())
                    <a href="{{ route('profile.edit') }}" class="btn btn-control">
                        Edit Profile
                    </a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-control follow_ " data-id="5">
                            Following
                            <div class="ripple-container"></div>
                        </a>
                        <a href="#" class="btn btn-control launching_soon" data-toggle="modal" data-target="#myModal">
                            Message
                            <div class="ripple-container"></div>
                        </a>
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                              </div>
                              <div class="modal-body">
                                <p>Some text in the modal.</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endif

                </div>
                <ul class="profile-menu">
                    <li>
                        <a href="{{route("profileView",['user' => $user->user_name])}}"><span class="number">{{$user->blueprintCount()}}</span>BluePrint</a></li>
                    </li>
                    <li>
                        <a href="{{route("portfolio",['user' => $user->user_name])}}"><span class="number count_portfolio">{{$user->portfolioCount()}}</span>Portfolio</a>
                    </li>
                    <li>
                        <a href="@if($user->follower->count() > 0)
                        {{ route('follow',[
                        'action' => 'followers',
                        'user' => $user->user_name,
                        ]) }} @else javascript:void(0) @endif"><span class="number follower_count">{{ $user->follower->count() }}</span>Followers</a>
                    </li>

                    <li>
                        <a href="@if($user->following->count() > 0)
                       {{ route('follow',[
                        'action' => 'following',
                        'user' => $user->user_name,
                        ]) }} @else javascript:void(0) @endif"><span class="number following_count">{{ $user->following->count() }}</span>Following</a>
                    </li>
                    <li>
                        <div class="more">
                            <svg class="olymp-three-dots-icon">
                                <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
                            </svg>
                            <ul class="more-dropdown more-with-triangle">
                                <li>
                                    <a href="@if(Auth::check()){{ route('aboutProfile',$user->user_name) }} @else {{ route('login') }} @endif" >About
                                        @if(!empty($user->first_name) && !empty($user->last_name)) {{ ucfirst($user->first_name) .' '. ucfirst($user->last_name)  }}  @elseif(!empty($user->name)) {{ $user->name }} @endif

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