<div class="competition-submission-item ui-block"> 
    <a href="#" data-toggle="modal" class="competition-submission-img competitionModal-detail"
       style="background-image: url('{{asset($item->cover)}}');" data-submission-id="{{$item->id}}">
    </a>
    @if(Auth::id() == $item->user_id)
    <div class="pull-right"> {{--Three dots dropdown options--}}
        @include("users.partials.submission-post-dots")
    </div>
    @endif
       
     @if(!empty($user_submission))  

    <div class="competition-submission-content" style="margin-bottom: -20px !important">
        <div class="title h6 font-weight-bold">
            <a class="link-inverse competitionModal-detail" href="#" data-submission-id="{{$item->id}}"
               data-toggle="modal">{{$item->competition->competition_title}}</a>
        </div>
       
        <div class="title h6 font-weight-bold">
            <a class="link-inverse" data-toggle="modal">

                    @if(!empty($item->participation->participate_name1) && $item->participation->participate_name1)
                        @if(!empty($item->participation->participate_name2) && $item->participation->participate_name2)

                            @if(!empty($item->participation->participate_name3) && $item->participation->participate_name3)
                                @if(!empty($item->participation->participate_name4) && $item->participation->participate_name4)
                                    @if(!empty($item->participation->participate_name5) && $item->participation->participate_name5)
                                    {{$item->participation->participate_name1}},{{$item->participation->participate_name2}},{{$item->participation->participate_name3}},{{$item->participation->participate_name4}},{{$item->participation->participate_name5}}
                                    @else
                                    {{$item->participation->participate_name1}},{{$item->participation->participate_name2}},{{$item->participation->participate_name3}},{{$item->participation->participate_name4}}
                                    @endif
                                @else
                                 {{$item->participation->participate_name1}},{{$item->participation->participate_name2}},{{$item->participation->participate_name3}}
                                  @endif
                            @else
                            {{$item->participation->participate_name1}},{{$item->participation->participate_name2}}
                             @endif
                        @else
                        {{$item->participation->participate_name1}}
                         @endif
                    @else
                    {{"no participate found"}}
                    @endif


            </a>
        </div>
        <div class="title h6 font-weight-bold">
            <a class="link-inverse" data-toggle="modal">{{$item->code}}</a>
        </div>
        <!-- @if(isset($submissionFlag) != 'y')
        @if(isset($item->participation))
        @if(isset($item->participation->participate_name1) && $item->participation->participate_name1 != null)
        {{$item->participation->participate_name1}}
        @endif
        @if(isset($item->participation->participate_name2) && $item->participation->participate_name2 != null)
            , {{$item->participation->participate_name2}}
        @endif
        @if(isset($item->participation->participate_name3) && $item->participation->participate_name3 != null)
            , {{$item->participation->participate_name3}}
        @endif
        @if(isset($item->participation->participate_name4) && $item->participation->participate_name4 != null)
            , {{$item->participation->participate_name4}}
        @endif
        @if(isset($item->participation->participate_name5) && $item->participation->participate_name5 != null)
            , {{$item->participation->participate_name5}}
        @endif
        @endif
        <br>
        @if(isset($submissionFlag) != 'y')
        <strong>Mentor</strong> :
        @if(!isset($item->participation->mentor_name1) && $item->participation->mentor_name1 == null || isset($item->participation->mentor_name2) &&  $item->participation->mentor_name2 == null)
            Not mentioned
        @else
            
            @if(isset($item->participation->mentor_name1) && $item->participation->mentor_name1 != null)
                , {{$item->participation->mentor_name1}}
            @endif
            @if(isset($item->participation->mentor_name2) && $item->participation->mentor_name2 != null)
                , {{$item->participation->mentor_name2}}
            @endif
        @endif
        @endif
        @endif -->
    </div>
    @else

    <div class="competition-submission-content" style="margin-bottom: -20px !important">
        <div class="title h6 font-weight-bold">
            <a class="link-inverse competitionModal-detail" href="#" data-submission-id="{{$item->id}}"
               data-toggle="modal">{{$item->title}}</a>
        </div>
       
        <div class="title h6 font-weight-bold">
            <a class="link-inverse" data-toggle="modal">{{$item->code}}</a>
        </div>
        <!-- @if(isset($submissionFlag) != 'y')
        @if(isset($item->participation))
        @if(isset($item->participation->participate_name1) && $item->participation->participate_name1 != null)
        {{$item->participation->participate_name1}}
        @endif
        @if(isset($item->participation->participate_name2) && $item->participation->participate_name2 != null)
            , {{$item->participation->participate_name2}}
        @endif
        @if(isset($item->participation->participate_name3) && $item->participation->participate_name3 != null)
            , {{$item->participation->participate_name3}}
        @endif
        @if(isset($item->participation->participate_name4) && $item->participation->participate_name4 != null)
            , {{$item->participation->participate_name4}}
        @endif
        @if(isset($item->participation->participate_name5) && $item->participation->participate_name5 != null)
            , {{$item->participation->participate_name5}}
        @endif
        @endif
        <br>
        @if(isset($submissionFlag) != 'y')
        <strong>Mentor</strong> :
        @if(!isset($item->participation->mentor_name1) && $item->participation->mentor_name1 == null || isset($item->participation->mentor_name2) &&  $item->participation->mentor_name2 == null)
            Not mentioned
        @else
            
            @if(isset($item->participation->mentor_name1) && $item->participation->mentor_name1 != null)
                , {{$item->participation->mentor_name1}}
            @endif
            @if(isset($item->participation->mentor_name2) && $item->participation->mentor_name2 != null)
                , {{$item->participation->mentor_name2}}
            @endif
        @endif
        @endif
        @endif -->
    </div>
    @endif


    <div class="competition-submission-footer">
        <div class=" post-additional-info ">
            @if(count($user_like_posts_array) && array_key_exists($item->id,$user_like_posts_array))
                <a class="post-add-icon inline-items  like_color submisson-like" data-likable-id="{{$item->id}}">
                    <i class="fa fa-caret-up"></i>
                </a>
                <span class="like_color like-count view-like-modal" data-like-id="{{$item->id}}"
                      style="margin-left: -10px !important;">
                        @if($item->likes->count() == 1 || $item->likes->count() == 0)
                        {{$item->likes->count()}} Like
                    @else
                        {{$item->likes->count()}} Likes
                    @endif
                        </span>
            @else
                <a class="post-add-icon inline-items submisson-like" data-likable-id="{{$item->id}}">
                    <i class="fa fa-caret-up"></i>
                </a>
                <span class="like-count view-like-modal" data-like-id="{{$item->id}}"
                      style="margin-left: -10px !important;">
                        @if($item->likes->count() == 1 || $item->likes->count() == 0)
                        {{$item->likes->count()}} Like
                    @else
                        {{$item->likes->count()}} Likes
                    @endif
                        </span>
            @endif


            @if(count($user_comments_posts_array) > 0 && array_key_exists($item->id,$user_comments_posts_array))
                <a href="#" class="post-add-icon competitionModal-detail like_color" data-submission-id="{{$item->id}}"
                   data-toggle="modal">
                    <i class="fa fa-circle"></i>

                </a>
                <span class="like_color comments-margin">
                        @if($item->comments->count() == 1 || $item->comments->count() == 0)
                        {{$item->comments->count()}} Comment
                    @else
                        {{$item->comments->count()}} Comments
                    @endif
                        </span>
            @else
                <a href="#" class="post-add-icon competitionModal-detail " data-submission-id="{{$item->id}}"
                   data-toggle="modal">
                    <i class="fa fa-circle"></i>
                </a>
                <span class=" comments-margin ">
                        @if($item->comments->count() == 1 || $item->comments->count() == 0)
                        {{$item->comments->count()}} Comment
                    @else
                        {{$item->comments->count()}} Comments
                    @endif
                        </span>
        @endif

        <!--  <a href="#" class="post-add-icon">
                        <i class="fa fa-square"></i>
                        <span>Share</span>
                    </a> -->
        </div>
    </div>
</div>