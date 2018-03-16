
@if($post->commentsLimited->count())




    @foreach($post->commentsLimited as $key => $comment)


        @if($key == '0')

            {{--{{ dd($post->commentsLimited) }}--}}
            <li class="this{{ $comment->id }} comment_li comment" data-class="this{{ $comment->id }}" data-id="{{ $comment->id }}" data-post-id="{{ $comment->commentable_id }}" data-type="comments" >
                <div class="post__author author vcard inline-items">
                    <img src="{{ asset($comment->user->profile) }}" alt="" class="profile_change_append">
                    <div class="author-date">


                        <a class="h6 post__author-name fn "
                           @if(Auth::check() && Auth::id() == $comment->user->id)
                           href="{{ route('profile') }}"
                           @else
                           href="{{ route('profileView',$comment->user->user_name) }}"
                                @endif>{{ $comment->user->fullName() }}</a>
                        <div class="post__date">
                            <time class="published" datetime="2017-03-24T18:18">
                                {{ $comment->created_at->diffForHumans() }}
                            </time>
                        </div>
                    </div>

                    @if(Auth::check() &&  Auth::id() == $comment->user->id || Auth::check() &&   $post->user_id == Auth::user()->id)
                        <div class="more">
                            <svg class="olymp-three-dots-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
                            </svg>

                            <ul class="more-dropdown">


                                <li>
                                    <a href="javascript:void(0)" class="delete_post_comment">Delete</a>
                                </li>

                            </ul>
                        </div>
                    @endif

                </div>
                {{--comment description--}}
                <p class="break-word-text"> {!! $comment->body !!}</p>
                {{--end comment description--}}

                {{--@if($comment->isThisLike($comment->id) != null)--}}
                @if(array_key_exists($comment->id,$user_like_posts_array))
                    <a href="javascript:void(0)" class="post-add-icon inline-items like_comment like_color hk_like">
                        <i class="fa fa-caret-up"></i>  </a>
                    <span class="like-comment uses_like_comments like_color pointer hk-margin hk_like">{{ $comment->likes->count() }} Like</span>

                @else
                    <a href="javascript:void(0)" class="post-add-icon inline-items like_comment hk_like">
                        <i class="fa fa-caret-up"></i> </a>
                    <span class="like-comment uses_like_comments pointer hk-margin hk_like">{{ $comment->likes->count() }} Like</span>

                @endif
                {{-- <a href="javascript:void(0)" class="reply">Reply</a>--}}
            </li>

        @elseif($key == '1')

            {{--{{ dd($post->commentsLimited) }}--}}
            <li class="this{{ $comment->id }} comment_li comment" data-class="this{{ $comment->id }}" data-id="{{ $comment->id }}" data-post-id="{{ $comment->commentable_id }}" data-type="comments">
                <div class="post__author author vcard inline-items">
                    <img src="{{ asset($comment->user->profile) }}" alt="" class="profile_change_append">
                    <div class="author-date">


                        <a class="h6 post__author-name fn "
                           @if(Auth::check() &&  Auth::id() == $comment->user->id)
                           href="{{ route('profile') }}"
                           @else
                           href="{{ route('profileView',$comment->user->user_name) }}"
                                @endif>{{ $comment->user->fullName() }}</a>
                        <div class="post__date">
                            <time class="published" datetime="2017-03-24T18:18">
                                {{ $comment->created_at->diffForHumans() }}
                            </time>
                        </div>
                    </div>

                    @if(Auth::check() &&  Auth::id() == $comment->user->id)
                        <div class="more">
                            <svg class="olymp-three-dots-icon">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
                            </svg>

                            <ul class="more-dropdown">


                                <li>
                                    <a href="javascript:void(0)" class="delete_post_comment">Delete</a>
                                </li>

                            </ul>
                        </div>
                    @endif

                </div>
                {{--comment description--}}
                <p class="break-word-text"> {!! $comment->body !!}</p>
                {{--end comment description--}}

                {{--@if($comment->isThisLike($comment->id) != null)--}}
                @if(array_key_exists($comment->id,$user_like_posts_array))
                    <a href="javascript:void(0)" class="post-add-icon inline-items like_comment like_color hk_like">
                        <i class="fa fa-caret-up"></i>  </a>
                    <span class="like-comment uses_like_comments like_color pointer hk-margin hk_like">{{ $comment->likes->count() }} Like</span>

                @else
                    <a href="javascript:void(0)" class="post-add-icon inline-items like_comment hk_like">
                        <i class="fa fa-caret-up"></i> </a>
                    <span class="like-comment uses_like_comments pointer hk-margin hk_like">{{ $comment->likes->count() }} Like</span>

                @endif
                {{-- <a href="javascript:void(0)" class="reply">Reply</a>--}}
            </li>


        @endif


    @endforeach

@endif