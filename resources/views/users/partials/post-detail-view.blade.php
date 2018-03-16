@include('users.partials.medium-editor-css')
<div class="popup-social ui-block data_this this_{{ $post->id }}" data-class="this_{{ $post->id }}" data-is-shared="{{ $post->is_shared }}"  data-users_post_id="{{ $post->user_post_id }}" data-id="{{ $post->shared_id }}"
     data-type="users_post_share" data-post_slug="{{ $post->slug }}"  >
    <div class="popup-social-content" style="word-wrap: break-word;">
        <div class="popup-social-content-inner mCustomScrollbar comment_parent" data-mcs-theme="dark">
            {{-- @if($post->type == 'status')
                @if($post->image != null)
                    <img src="{{ asset($post->image) }}" alt="">
                @endif
                @if($post->title != null)
                    <h6 class="h6 mt-4">{{ $post->title }}</h6>
                @endif
                <p>
                    {!!  $post->description !!}
                </p>

              @endif--}}




            @if(!empty($post->image))
                <div class="post-thumb"><img src="{{asset($post->image)}}"></div>
            @endif

            @if($post->type == 'design' || $post->type == 'article')
                <h4><strong>{{ucfirst($post->title)}}</strong></h4>

                <h5>{{ $post->short_description  }}</h5>

                {{--<div class="image_frame">--}}
                    {{--<img src="{{asset($post->banner_image)}}" alt="">--}}
                {{--</div>--}}

                {!! $post->description !!}

            @endif

            @if($post->type == 'design' && $post->designDetail != null)
                {{--<table class="table table-bordered table-condensed">
                    <td><b>Status</b></td>
                    <td>{{$post->designDetail->status}}</td>
                    <tr/>
                    <td><b>Building Program</b></td>
                    <td>{{$post->designDetail->building_program}}</td>
                    <tr/>
                   <!-- <td><b>Date</b></td>
                    <td>{{$post->designDetail->start_year}}
                        to {{$post->designDetail->end_year}}</td>
                    <tr/>
                    <td><b>Budget</b></td>
                    <td>{{$post->designDetail->total_budget}} {{$post->designDetail->currency}}</td>
                    <tr/>  -->
                </table>--}}
                <p>
                    @include('users.partials.design-detail-table')

                    @elseif($post->type == 'status')
                        {!! $post->description !!}
                    @endif
                </p>


        </div>
    </div>


    <div class="popup-social-conversation " style="background-color:white;">
        <div class="popup-social-conversation-header ">
            <!-- Start -->
            <div class="post__author author vcard inline-items">
                <img class="profile_change_append data-user_image"
                     src="@if(!empty($post->user->profile)){{ asset($post->user->profile)}} @else {{ asset('assets/images/avatar.png') }} @endif"
                     alt="">
               {{-- @if($post->usersPostShare->is_shared == 'y') share this post @endif--}}
                {{--@if($post->is_shared == 'y') share this post  @endif--}}
                @if($post->is_shared == 'y')
                <div class="author-date">
                    <a class="h6 post__author-name fn"
                       href="{{ route('profile') }}"> {{ $post->user->fullName() }}   </a>
                    <div class="post__date">
                        <time class="published" datetime="2017-03-24T18:18">
                            {{ $post->created_at->diffForHumans() }}
                        </time>
                    </div>
                </div>
                @else
                    <div class="author-date">
                        <a class="h6 post__author-name fn"
                           href="{{ route('profile') }}"> {{ $post->user->fullName() }}   </a>
                        <div class="post__date">
                            <time class="published" datetime="2017-03-24T18:18">
                                {{ $post->created_at->diffForHumans() }}
                            </time>
                        </div>
                    </div>
                @endif

                @include('users.partials.post-dropdown-options')
            </div>
            <!-- End --->

            <div class="post-additional-info inline-items"
                 style="border-bottom: 1px solid #e6ecf5; border-top: 1px solid #e6ecf5; padding-bottom:8px;">

               {{--<a href="javascript:void(0)" class="post-add-icon inline-items like_">
                    <i class="fa fa-caret-up"></i> </a>
                    <span class="like uses_like pointer hk-margin">{{ $post->likes->count() }} Like</span>--}}

                @if(array_key_exists($post->shared_id,$user_like_posts_array))
                    <a href="javascript:void(0)" class="post-add-icon inline-items like_ like_color hk_like_post" >
                        <i class="fa fa-caret-up"></i></a>
                    <span  class="like uses_like pointer like_color  hk-margin hk_like_post" >{{ $post->likes->count() }} Like</span>
                @else
                    <a href="javascript:void(0)" class="post-add-icon inline-items like_ hk_like_post" >
                        <i class="fa fa-caret-up "></i>
                    </a>
                    <span  class="like uses_like pointer hk-margin hk_like_post" >{{ $post->likes->count() }} Like</span>
                @endif

                <a href="javascript:void(0)" class="post-add-icon inline-items">
                    <i class="fa fa-circle"></i>
                    <span class="comment_count">{{ $post->commentsLimited->count() }} Comments</span>

                </a>
                <a href="javascript:void(0)"
                   class="post-add-icon inline-items user_post_share_">
                    <i class="fa fa-square"></i>
                    <span>Share</span>
                </a>
            </div>
        </div><!-- .popup-social-conversation-header -->
        <div class="comment-list-wrapper mCustomScrollbar">

            <ul class="comments-list hello comment-li" id="boxes">


                {{--comments--}}
                @include('users.partials.comments-li-model')
                {{-- end comments--}}

            </ul><!-- comment-list -->
        </div>

        <form class="comment-form media">
            <img class="d-flex mr-3 post__author" src="" alt="">
            <div class="media-body">
                <div class="alert alert-success comment_text_success" style="display: none;">
                    <strong>Success!</strong> Commented Successfully.
                </div>
                <div class="form-group with-icon-right is-empty">
                    <textarea class="form-control comment_text" name="comment_text"
                              placeholder="Comment here..! "></textarea>
                    <p class="errors" style="display:none;color: red;"></p>
                    {{--<div class="add-options-message">
                        <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
                            <svg class="olymp-camera-icon"><use xlink:href="../assets/icons/icons.svg#olymp-camera-icon"></use></svg>
                        </a>
                    </div>--}}
                    <span class="material-input"></span>
                </div>
                <button type="button" class="btn btn-primary btn-sm font-weight-bold comment_">Post Reply</button>
            </div>

        </form>
    </div>
</div>