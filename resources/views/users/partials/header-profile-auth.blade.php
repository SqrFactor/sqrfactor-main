<div class="ui-block profile-header">
    <div class="top-header top-header-favorit">
        <div class="top-header-thumb">
            <div class="container">
                <div class="clearfix" style="word-wrap: break-word;">
                    <div class="top-header-caption" >
                        <a href="javascript:void(0)" class="short_bio_model short_bio_content"
                           style="color: white;"> {!! Auth::user()->userDetail->short_bio !!} </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="top-header-author">
                <div class="author-thumb loggedIn ">
                    <img alt="author" src="{{ asset(Auth::user()->profile) }}" class="profile_change profile_change_append ">
                </div>
                <div class="author-content">
                    <a href="javascript:void(0)" class="author-name h4 font-weight-bold d-inline-block mb-1">
                        @if(!empty(Auth::user()->first_name) && !empty(Auth::user()->last_name)) {{ ucfirst(Auth::user()->first_name) .' '. ucfirst(Auth::user()->last_name)  }}  @elseif(!empty(Auth::user()->name)) {{ ucfirst(Auth::user()->name) }} @endif
                    </a>
                    <div class="country">
                        @if(Auth::user()->userDetail->city_id != null && Auth::user()->userDetail->state_id != null && Auth::user()->userDetail->country_id != null)


                            {{ Auth::user()->userDetail->city->name }}, {{ Auth::user()->userDetail->state->name }}
                            , {{ Auth::user()->userDetail->country->name }}({{ Auth::user()->userType(Auth::id())}})
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="profile-section">
                <div class="control-block-button">
                    <a href="{{ route('profile.edit') }}" class="btn btn-control">
                        Edit Profile
                    </a>

                </div>
                <ul class="profile-menu">
                    <li>
                        <a href="{{route("profileView",['user' => Auth::user()->user_name])}}"><span class="number">{{Auth::user()->blueprintCount()}}</span>BluePrint</a></li>
                    </li>
                    <li>
                        <a href="{{route("portfolio",['user' => Auth::user()->user_name])}}"><span class="number count_portfolio">{{Auth::user()->portfolioCount()}}</span>Portfolio</a>
                    </li>


                    <li>
                        <a href="@if(Auth::user()->follower->count() > 0)
                        {{ route('follow',[
                        'action' => 'followers',
                        'user' => Auth::user()->user_name,
                        ]) }} @else javascript:void(0) @endif" ><span class="number follower_count">{{ Auth::user()->follower->count() }}</span>Followers</a>
                    </li>

                    <li>
                        <a href="@if(Auth::user()->following->count() > 0)
                       {{ route('follow',[
                        'action' => 'following',
                        'user' => Auth::user()->user_name,
                        ]) }} @else javascript:void(0) @endif"><span class="number following_count">{{ Auth::user()->following->count() }}</span>Following</a>
                    </li>
                    <li>
                        <div class="more">
                            <svg class="olymp-three-dots-icon">
                                <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
                            </svg>
                            <ul class="more-dropdown more-with-triangle">
                                <li>
                                    <a href="{{ route('aboutProfile',Auth::user()->user_name) }}">About
                                        @if(!empty(Auth::user()->first_name) && !empty(Auth::user()->last_name)) {{ ucfirst(Auth::user()->first_name) .' '. ucfirst(Auth::user()->last_name)  }}  @elseif(!empty(Auth::user()->name)) {{ Auth::user()->name }} @endif

                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('competition',Auth::user()->user_name)}}">Competition</a>
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