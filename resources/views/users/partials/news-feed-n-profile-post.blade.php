<div class="ui-block data_this this_{{ $post->shared_id }} box-shadow2" data-class="this_{{ $post->shared_id }}"
     data-is-shared="{{ $post->is_shared }}" data-users_post_id="{{ $post->user_post_id }}"
     data-id="{{ $post->shared_id }}" data-type="users_post_share" data-post_slug="{{ $post->slug }}">
    <article class="hentry post break-word-text">
        <div class="post__author author vcard inline-items">
            <img class="profile_change_append data-user_image"
                 src="@if(!empty($post->user->profile)){{ asset($post->user->profile)}} @else {{ asset('assets/images/avatar.png') }} @endif"
                 alt="">
            @if($post->is_shared == 'y')
                <div class="author-date">
                    <a class="h6 post__author-name fn"
                       href="@if(Auth::id() == $post->sharedUser->id){{ route('profile') }} @else {{ route('profileView',$post->sharedUser->user_name) }} @endif ">  {{ $post->sharedUser->fullName() }}   </a>
                    shared @if($post->sharedUser->id == Auth::id())  this @else <strong>{{ $post->user->fullName() }}
                        's</strong> @endif post
                    <div class="post__date">
                        <time class="published" datetime="2017-03-24T18:18">
                            {{ $post->created_at->diffForHumans() }}
                        </time>
                    </div>
                </div>
            @else
                <div class="author-date">
                    <a class="h6 post__author-name fn"
                       href="@if(Auth::id() == $post->user->id){{ route('profile') }} @else {{ route('profileView',$post->user->user_name) }} @endif ">  {{ $post->user->fullName() }}   </a>
                    <div class="post__date">
                        <time class="published" datetime="2017-03-24T18:18">
                            {{ $post->created_at->diffForHumans() }}
                        </time>
                    </div>
                </div>
            @endif
            @if(Auth::id() == $post->user->id)
                {{--Three dots dropdown options--}}
                @include("users.partials.post-dropdown-options")
            @endif
        </div>
        {{--{{ dd($post->is_shared) }}--}}


        @if($post->type == 'design' || $post->type == 'article')
            <h5 class="break-word-text"><strong class="title-post">
                    {{ str_limit(ucfirst($post->title),"150") }}
                </strong></h5><br>
            <h6 class="break-word-text"><strong class="title-post">
                    {{ ucfirst($post->short_description) }}
                </strong></h6>
            @if(!empty($post->banner_image))
                <!-- <div class="image_frame" style="cursor: pointer;">
                    <img src="{{asset($post->banner_image)}}" alt="">
                </div> -->
                <div class="image_frame" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.8)),url({{asset($post->banner_image)}});background-size: 100%;">   
                    <i class="fa fa-chevron-double-up"></i><h4 class="display-5" style="color: white; width:100%;padding-top: 30%; text-align:center;"><br>Know More</h3>
                <img src="{{asset('/img/up-img.png')}}"></div>
            @endif

        @endif
        <p>
            @if($post->type == 'design' && $post->designDetail != null)
                @include('users.partials.design-detail-table')

            @elseif($post->type == 'status')
                {!! $post->description !!}
            @endif
        </p>
        @if(!empty($post->image))
            <div class="post-thumb">
                <img src="{{ asset($post->image) }}">
            </div>
        @endif
        <div class="post-additional-info inline-items">
            {{--@if($post->isThisLike($post->id) != null)--}}
            @if(array_key_exists($post->shared_id,$user_like_posts_array))
                <a href="javascript:void(0)" class="post-add-icon inline-items like_  hk_like_post like_color">
                    <i class="fa fa-caret-up"></i></a>
                <span class="like uses_like pointer hk-margin hk_like_post like_color">{{ $post->likes->count() }}
                    Like</span>
            @else
                <a href="javascript:void(0)" class="post-add-icon inline-items like_ hk_like_post">
                    <i class="fa fa-caret-up "></i>
                </a>
                <span class="like uses_like pointer hk-margin hk_like_post ">{{ $post->likes->count() }} Like</span>
            @endif
            <a href="javascript:void(0)" class="post-add-icon inline-items add-comment-btn "
               data-textarea-post-id="this_class_{{ $post->id }}">
                <i class="fa fa-circle"></i>
            </a>

            <span class="comment_count more-comments-post pointer hk-margin">{{ $post->commentsLimited->count() }}
                Comments</span>

            <a href="javascript:void(0)" {{--onclick='showSweetMessage("Coming soon..","success")'--}}
            class="post-add-icon inline-items sweetAlertShare user_post_share_">
                <i class="fa fa-square"></i>
                <span>Share</span>
            </a>


            {{--@if(array_key_exists($post->id,$user_like_posts_array))
                <br/>

            <span><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                <a href="javascript:void(0)" class="uses_like uses_likesName"> <span class="post_likes">You and {{ $post->likes->count() }}  others like</span>  </a>
            </span>
             @else
                <div class="showDivPost" @if($post->likes->count()==0) style="display: none;"  @endif >
                    <br/>
                    <span ><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                <a href="javascript:void(0)" class="uses_like uses_likesName"> <span class="post_likes">{{ $post->likes->count() }} others like</span>  </a>
            </span>
                </div>


        @endif--}}
        </div>
    </article>


    {{--comment--}}
    <ul class="comments-list hello comment-li ">

        {{--comments--}}
        @include('users.partials.comments-li')
        {{-- end comments--}}


    </ul>
    @if($post->comments_count > 2)
        <a href="javascript:void(0)" class="more-comments more-comments-post">View more comments <span>+</span></a>
    @endif
    <form class="comment-form media">
        <img class="d-flex mr-3 post__author profile_change_append"
             src="@if(Auth::check()) {{ asset(Auth::user()->profile) }} @else {{ asset($user->profile) }} @endif"
             alt="">
        <div class="media-body">
            <div class="alert alert-success comment_text_success" style="display: none;">
                <strong>Success!</strong> Commented Successfully.
            </div>

            <div class="form-group with-icon-right is-empty">
                <div class="inline-comment-form this_class_{{ $post->id }}">
                    <textarea class="form-control comment_text" name="comment_text"
                              placeholder="Comment here..!"></textarea>
                </div>

                <p class="errors" style="color:red;display: none;"></p>
                {{--<div class="add-options-message">
                    <a href="javascript:void(0)" class="options-message" data-toggle="modal" data-target="#update-header-photo">
                        <svg class="olymp-camera-icon">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ asset('assets/icons/icons.svg#olymp-camera-icon') }}"></use>
                        </svg>
                    </a>
                </div>--}}
                <span class="material-input"></span>
                <span class="material-input"></span></div>
            <button type="button" class="btn btn-primary btn-sm font-weight-bold comment_">Post Reply</button>
        </div>
    </form>
    {{--end comment--}}

</div>