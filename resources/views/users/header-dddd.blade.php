<div class="header-spacer-fit"></div>
<div class="ui-block profile-header">
    <div class="top-header top-header-favorit">
        <div class="top-header-thumb">
            <div class="container">
                <div class="clearfix">

                    <div class="top-header-caption ">
                        @if(Request::path() == isset($user) && 'profile/detail/'.$user->user_name || Request::path() == isset($user) && 'about/'.$user->user_name)
                            @if($user->id != Auth::user()->id)

                                {!! $user->userDetail->short_bio !!}
                            @else
                                <a href="javascript:void(0)" class="short_bio_model short_bio_content"
                                   style="color: white;"> {!! Auth::user()->userDetail->short_bio !!} </a>
                            @endif
                        @else
                            <a href="javascript:void(0)" class="short_bio_model short_bio_content"
                               style="color: white;"> {!! Auth::user()->userDetail->short_bio !!} </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="top-header-author">
                @if(Request::path() == isset($user) && 'profile/detail/'.$user->user_name  || Request::path() == isset($user) && 'about/'.$user->user_name)
                    @if($user->id != Auth::user()->id)
                        <div class="author-thumb  @if(Auth::user()->id == $user->id ) loggedIn @endif ">
                            <img alt="author" src="{{ asset($user->profile) }}" class="view_profile">
                        </div>
                    @else
                        <div class="author-thumb loggedIn ">
                            <img alt="author" src="{{ asset(Auth::user()->profile) }}" class="profile_change profile_change_append ">
                        </div>
                    @endif
                @else
                    <div class="author-thumb loggedIn ">
                        <img alt="author" src="{{ asset(Auth::user()->profile) }}" class="profile_change profile_change_append ">
                    </div>
                @endif
                <div class="author-content">
                    <a href="javascript:void(0)" class="author-name h4 font-weight-bold d-inline-block mb-1">
                        @if(Request::path() == isset($user) && 'profile/detail/'.$user->user_name  || Request::path() == isset($user) && 'about/'.$user->user_name)
                            @if($user->first_name != null && $user->last_name != null)

                                {{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }}
                            @else
                                {{ ucfirst($user->name) }}

                            @endif

                        @else
                            @if(!empty(Auth::user()->first_name) && !empty(Auth::user()->last_name)) {{ ucfirst(Auth::user()->first_name) .' '. ucfirst(Auth::user()->last_name)  }}  @elseif(!empty(Auth::user()->name)) {{ ucfirst(Auth::user()->name) }} @endif

                        @endif

                    </a>


                    <div class="country">
                        @if(Request::path() == isset($user) && 'profile/detail/'.$user->user_name  || Request::path() == isset($user) && 'about/'.$user->user_name)
                            @if($user->userDetail->city_id != null && $user->userDetail->state_id != null && $user->userDetail->country_id != null)
                                {{ $user->userDetail->city->name.', '.$user->userDetail->state->name.', '.$user->userDetail->country->name}}
                                ({{ $user->userType($user->id) }})
                            @endif
                        @else


                            @if(Auth::user()->userDetail->city_id != null && Auth::user()->userDetail->state_id != null && Auth::user()->userDetail->country_id != null)


                                {{ Auth::user()->userDetail->city->name }}, {{ Auth::user()->userDetail->state->name }}
                                , {{ Auth::user()->userDetail->country->name }}({{ Auth::user()->userType(Auth::id())}})
                            @endif

                        @endif


                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="profile-section">
                <div class="control-block-button">

                    @if(Request::path() == isset($user) && 'profile/detail/'.$user->user_name   || Request::path() == isset($user) && 'about/'.$user->user_name )

                        @if($user->id != Auth::user()->id)
                            <a href="javascript:void(0)" class="btn btn-control follow_ " data-id="{{ $user->id }}">
                                @if($user->followingUser($user->id) != null)
                                    Following
                                @else
                                    Follow
                                @endif

                            </a>
                            <a href="#" class="btn btn-control" data-toggle="modal" data-target="#myModal">
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
                        @else
                            <a href="{{ route('profile.edit') }}" class="btn btn-control">
                                Edit Profile
                            </a>
                        @endif


                    @else

                        <a href="{{ route('profile.edit') }}" class="btn btn-control">
                            Edit Profile
                        </a>
                    @endif

                </div>
                <ul class="profile-menu">
                    <li>
                        <a href="javascript:void(0)"><span class="number">0</span>BluePrint</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><span class="number">0</span>Portfolio</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><span class="number follower_count">{{ Auth::user()->follower->count() }}</span>Followers</a>
                    </li>

                    <li>
                        <a href="{{ route('following',Auth::user()->user_name) }}"><span class="number follower_count">{{ Auth::user()->following->count() }}</span>Following</a>
                    </li>

                    <li>
                        <div class="more">
                            <svg class="olymp-three-dots-icon">
                                <use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use>
                            </svg>
                            <ul class="more-dropdown more-with-triangle">

                                @if(Request::path() == isset($user) && 'profile/detail/'.$user->user_name)                  @if($user->id != Auth::user()->id)
                                    <li>
                                        <a href="{{ route('aboutProfile',$user->user_name) }}">About
                                            @if($user->first_name != null && $user->last_name != null)

                                                {{ $user->first_name.' '.$user->last_name }}
                                            @else
                                                {{ $user->name }}

                                            @endif
                                        </a>
                                    </li>                                                                                      @else
                                    <li>
                                        <a href="{{ route('aboutProfile',$user->user_name) }}">About
                                            @if($user->first_name != null && $user->last_name != null)

                                                {{ $user->first_name.' '.$user->last_name }}
                                            @else
                                                {{ $user->name }}

                                            @endif
                                        </a>
                                    </li>
                                @endif



                                @else
                                    <li>
                                        <a href="{{ route('aboutProfile',Auth::user()->user_name) }}">About
                                            @if(!empty(Auth::user()->first_name) && !empty(Auth::user()->last_name)) {{ ucfirst(Auth::user()->first_name) .' '. ucfirst(Auth::user()->last_name)  }}  @elseif(!empty(Auth::user()->name)) {{ Auth::user()->name }} @endif

                                        </a>
                                    </li>

                                @endif



                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- .profile-section -->
    </div>
</div>