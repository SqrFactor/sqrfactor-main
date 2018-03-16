<input type="hidden" class="postLikesUserss" value="{{$likes->count()}}">

@if($likes->count() > 0)
@foreach($likes as $like )
    <li class="inline-items">
    <div class="author-thumb">
        <img src="{{ asset($like->user->profile) }}" alt="">
    </div>
    <div class="notification-event">
        <a href="@if(Auth::id() == $like->user->id){{ route('profile') }} @else {{ route('profileView',$like->user->user_name) }} @endif" class="h6 notification-friend">{{ $like->user->fullName() }}</a>
        {{--<span class="chat-message-item">8 Friends in Common</span>--}}
    </div>
    @if($like->user->id != Auth::id())
    <span class="notification-icon">
                                    <a href="javascript:void(0)" class="accept-request">
                                        <span class="without-text">
                                           <a href="javascript:void(0)" class="btn btn-primary btn-sm follow_ " data-id="{{ $like->user->id }}">
                                               @if($like->user->followingUser($like->user->id) != null)
                                                   Following
                                               @else
                                                   Follow
                                               @endif</a>
                                        </span>
                                    </a>
                                </span>
        @endif
</li>


@endforeach
@endif