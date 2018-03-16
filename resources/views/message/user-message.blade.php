@extends('layouts.app-news-feed')

@section('content')
    <div class="header-spacer"></div>
    <div class="container">
        <div class="ui-block">
            <div class="ui-block-title">
                <h6 class="title">Chat / Messages</h6>
            </div>
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12 padding-r-0">
                    <!-- message list -->
                    <ul class="notification-list chat-message">
                        @if($currentChannels->from_id == Auth::id())
                            {{-- To user --}}
                            <li class="active">
                                <div class="author-thumb">
                                    <img src="{{asset( $currentChannels->to_user->profile)}}" alt="author">
                                </div>
                                <div class="notification-event">
                                    <a href="{{route('viewMessage',$currentChannels->channel)}}"
                                       class="h6 notification-friend mb-1" id="channel"
                                       data-channel-attr="{{$currentChannels->channel}}">{{ $currentChannels->to_user->user_name}} </a>
                                </div>
                                <span class="notification-icon">
                            </li>
                        @else
                            {{-- From User --}}
                            <li class="active">
                                <div class="author-thumb">
                                    <img src="{{asset( $currentChannels->from_user->profile)}}" alt="author">
                                </div>
                                <div class="notification-event">
                                    <a href="{{route('viewMessage',$currentChannels->channel)}}"
                                       class="h6 notification-friend mb-1" id="channel"
                                       data-channel-attr="{{$currentChannels->channel}}">{{ $currentChannels->from_user->user_name}} </a>
                                </div>
                            </li>
                        @endif

                        @foreach($chatChannels as $channel)
                            @if($channel->from_id == Auth::id())
                                {{-- To user --}}
                                <li>
                                    <div class="author-thumb">
                                        <img src="{{asset( $channel->to_user->profile)}}" alt="author">
                                    </div>
                                    <div class="notification-event">
                                        <a href="{{route('viewMessage',$channel->channel)}}"
                                           class="h6 notification-friend mb-1" id="channel"
                                           data-channel-attr="{{$channel->channel}}">{{ $channel->to_user->user_name}} </a>
                                    </div>
                                    <span class="notification-icon">
                                </li>
                            @else
                                {{-- From User --}}
                                <li>
                                    <div class="author-thumb">
                                        <img src="{{asset( $channel->from_user->profile)}}" alt="author">
                                    </div>
                                    <div class="notification-event">
                                        <a href="{{route('viewMessage',$channel->channel)}}"
                                           class="h6 notification-friend mb-1" id="channel"
                                           data-channel-attr="{{$channel->channel}}">{{ $channel->from_user->user_name}} </a>
                                    </div>
                                </li>
                            @endif

                        @endforeach

                    </ul>
                    <!-- end message list -->

                    <!-- get user detail for firebase -->
                    <input type="hidden" name="username" value="{{Auth::user()->user_name}}">

                    <input type="hidden" name="name" value="{{Auth::user()->fullName()}}">

                    <input type="hidden" name="userid" value="{{Auth::user()->id}}">

                    <input type="hidden" name="channel" value="{{$currentChannels->channel}}">

                    @if($currentChannels->from_id == Auth::id())
                        <input type="hidden" name="to_userid" value="{{$currentChannels->to_id}}">
                    @else
                        <input type="hidden" name="to_userid" value="{{$currentChannels->from_id}}">
                    @endif

                    <!--end here  -->
                </div>
                <!-- right column -->
                <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-xs-12 b-l-0">
                    <!-- padding-l-0 -->
                    <!-- chat field -->
                    <div class="chat-field">
                        <div class="ui-block-title">
                            @if($currentChannels->from_id == Auth::id())
                                <h6 class="title">{{$currentChannels->to_user->fullName()}}</h6>
                            @else
                                <h6 class="title">{{$currentChannels->from_user->fullName()}}</h6>
                            @endif
                        </div>
                        <div class="mCustomScrollbar" data-mcs-theme="dark">
                            <ul class="notification-list chat-message chat-message-field" id="chat-div" style="height: 350px;overflow-y: scroll;">
                                <br>
                                <p class="text-center">Loading..</p>
                            </ul>
                        </div>
                        <form class="clearfix">
                            <div class="form-group label-floating mb-2">
                                <label class="control-label">Write your reply here...</label>
                                <textarea class="form-control" placeholder="" id="message-text"></textarea>
                            </div>
                            <div class="add-options-message">
                                <button class="btn btn-primary btn-sm message-btn" type="button" id="chat_send">Send</button>
                            </div>
                        </form>
                    </div>
                    <!-- end chat field -->
                </div>
                <!-- end right column -->
            </div>
        </div>
    </div>
@endsection