
    <!-- Personal Info -->
    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Personal Info</h6>
        </div>
        <div class="ui-block-content">
            <ul class="widget w-personal-info item-block">
                <li>
                    <span class="title"> @if(Auth::user()->first_name !== null AND Auth::user()->last_name !== null ){{ ucfirst(Auth::user()->first_name) .' '. ucfirst(Auth::user()->last_name)  }} @elseif(Auth::user()->name !== null){{ucfirst(Auth::user()->name) }} @endif</span>
                    <div class="text">
                        @if(Auth::user()->userDetail->short_bio != null)
                            {{ Auth::user()->userDetail->short_bio }}
                        @endif

                    </div>
                </li>
                {{--<li>
                    <span class="title">Studied at:</span>
                    <div class="text">
                        Siddaganga Institute of Technology, Tumkur
                        <hr/> Laurent Lim Architects, Kuala Lumpur
                    </div>
                </li>--}}
                {{--<li>
                    <span class="title">Work at:</span>
                    <div class="text">Self employed</div>
                </li>--}}
                <li>
                    <span class="title">Follower:</span>
                    <div class="text follower_count">{{ Auth::user()->follower->count() }} </div>
                </li>
                <li>
                    <span class="title ">Following:</span>

                    <div class="text following_count"> {{ Auth::user()->following->count() }} </div>
                </li>
                {{--<li>
                    <span class="title">Profile ID:</span>
                    <div class="text">sqrfctr458B</div>
                </li>--}}
            </ul>
        </div>
    </div>
