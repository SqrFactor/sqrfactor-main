

<div class="popup-social-content">
    <div class="popup-social-content-inner mCustomScrollbar" data-mcs-theme="dark">
        <img src="{{asset($usersSubmissiondetail->cover)}}" alt=""><br>
        @if($usersSubmissiondetail->pdf != null && !empty($usersSubmissiondetail->pdf))
        <div style="text-align: center;margin-top: 20px">
            <iframe src="https://docs.google.com/gview?url={{asset($usersSubmissiondetail->pdf)}}&embedded=true" 
            style="width:100%; height:500px;" frameborder="0"></iframe>
        </div>
        @endif
        <h4 class="h6 mt-4 text-center">{{$usersSubmissiondetail->title}}</h4>
        <h6 class="h6 mt-4 text-center">{{$usersSubmissiondetail->code}}</h6>
        <p>{!!$usersSubmissiondetail->body!!}</p>
    </div>
</div>
<div class="popup-social-conversation">
    <div class="popup-social-conversation-header">
        <h6 class="h6 title">{{$usersSubmissiondetail->title}}</h6>
        <h6 class="h6 title">{{$usersSubmissiondetail->code}}</h6>
        <div class="post__date">
            <time class="published" datetime="2017-03-24T18:18">
                {{$usersSubmissiondetail->created_at->diffForHumans()}}
            </time>
        </div>
        <div class="post-additional-info inline-items">

            @if(array_key_exists($usersSubmissiondetail->id,$user_like_posts_array))
                <a class="post-add-icon inline-items  like_color submisson-like"
                   data-likable-id="{{$usersSubmissiondetail->id}}">
                    <i class="fa fa-caret-up"></i>
                </a>
                <span class="like_color like-count view-like-modal" data-like-id="{{$usersSubmissiondetail->id}}"
                      style="margin-left: -10px !important;">
            @if($usersSubmissiondetail->likes->count() == 1 || $usersSubmissiondetail->likes->count() == 0)
                        {{$usersSubmissiondetail->likes->count()}} Like
                    @else
                        {{$usersSubmissiondetail->likes->count()}} Likes
                    @endif
            </span>
            @else
                <a class="post-add-icon inline-items submisson-like" data-likable-id="{{$usersSubmissiondetail->id}}">
                    <i class="fa fa-caret-up"></i>
                </a>
                <span class="like-count view-like-modal" data-like-id="{{$usersSubmissiondetail->id}}"
                      style="margin-left: -10px !important;">
                @if($usersSubmissiondetail->likes->count() == 1 || $usersSubmissiondetail->likes->count() == 0)
                        {{$usersSubmissiondetail->likes->count()}} Like
                    @else
                        {{$usersSubmissiondetail->likes->count()}} Likes
                    @endif
                </span>
            @endif
            @if(array_key_exists($usersSubmissiondetail->id,$user_comments_posts_array))
                <a href="#" class="post-add-icon like_color" data-submission-id="{{$usersSubmissiondetail->id}}"
                   data-toggle="modal">
                    <i class="fa fa-circle"></i>

                </a>
                <span class="like_color comments-margin">
                @if($usersSubmissiondetail->comments->count() == 1 || $usersSubmissiondetail->comments->count() == 0)
                        {{$usersSubmissiondetail->comments->count()}} Comment
                    @else
                        {{$usersSubmissiondetail->comments->count()}} Comments
                    @endif
                </span>
            @else
                <a href="#" class="post-add-icon " data-submission-id="{{$usersSubmissiondetail->id}}"
                   data-toggle="modal">
                    <i class="fa fa-circle"></i>
                </a>
                <span class=" comments-margin ">
                @if($usersSubmissiondetail->comments->count() == 1 || $usersSubmissiondetail->comments->count() == 0)
                        {{$usersSubmissiondetail->comments->count()}} Comment
                    @else
                        {{$usersSubmissiondetail->comments->count()}} Comments
                    @endif
                </span>
        @endif
        <!--  <a href="#" class="post-add-icon inline-items">
                <i class="fa fa-square"></i>
                <span>Share</span>
            </a> -->
        </div>
    </div><!-- .popup-social-conversation-header -->
    <div class="comment-list-wrapper mCustomScrollbar">

        <ul class="comments-list append-comment">
            @foreach($usersSubmissiondetail->comments as $comment)
           
                <li>
                    <div class="post__author author vcard inline-items">
                        <img src="{{asset($comment->user->profile)}}" alt="">

                        <div class="author-date">
                            <a class="h6 post__author-name fn" href="{{route('profileView',$comment->user->user_name)}}">{{$comment->user->fullName()}}</a>
                            <div class="post__date">
                                <time class="published" datetime="2017-03-24T18:18">
                                    {{$comment->created_at->diffForHumans()}}
                                </time>
                            </div>
                        </div>

                        <a href="#" class="more">
                            <svg class="olymp-three-dots-icon">
                                <use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use>
                            </svg>
                        </a>

                    </div>

                    <p>{{$comment->body}}</p>

                    <!--  <a href="#" class="post-add-icon inline-items">
                         <i class="fa fa-caret-up"></i>
                         <span>3</span>
                     </a>
                     <a href="#" class="reply">Reply</a> -->
                </li>
            @endforeach

        </ul><!-- comment-list -->
    </div>

    <form class="comment-form media">
        <img class="d-flex mr-3 post__author" src="{{asset(Auth::user()->profile)}}" alt="">
        <div class="media-body">
            <div class="form-group with-icon-right is-empty">
                <textarea class="form-control" placeholder="" id="comment-text"></textarea>
                <div class="add-options-message">
                    <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
                        <svg class="olymp-camera-icon">
                            <use xlink:href="../assets/icons/icons.svg#olymp-camera-icon"></use>
                        </svg>
                    </a>
                </div>
                <span class="material-input"></span>
            </div>
            <button type="button" class="btn btn-primary btn-sm font-weight-bold" id="comment-reply"
                    value="{{$usersSubmissiondetail->id}}">Post Reply
            </button>
        </div>

    </form>
</div>
            