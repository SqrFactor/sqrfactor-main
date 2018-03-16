@extends('layouts.app-news-feed')

@section('content').
<div class="header-spacer"></div>
<div class="container">
    <div class="ui-block">
        <div class="ui-block-title">
            <h6 class="title">Chat / Messages</h6>
        </div>
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12 padding-r-0">
                <!-- message list -->
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <ul class="notification-list chat-message">
                    @foreach($chatChannels as $channel)
                        @if($channel->from_id == Auth::id())
                            {{-- To user --}}

                            <li>
                                <div class="author-thumb">
                                    <img src="{{asset( $channel->to_user->profile)}}" alt="author">
                                </div>
                                <div class="notification-event">
                                    <a href="{{route('viewMessage',$channel->channel)}}" class="h6 notification-friend mb-1" id="channel"
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
                                    <a href="{{route('viewMessage',$channel->channel)}}" class="h6 notification-friend mb-1" id="channel"
                                       data-channel-attr="{{$channel->channel}}">{{ $channel->from_user->user_name}} </a>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <!-- end message list -->
            </div>
        </div>
    </div>
</div>
@endsection