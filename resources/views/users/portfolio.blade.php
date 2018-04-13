@extends('layouts.app-users')

@section('content')
    <div class="header-spacer-fit hidden-sm-up"></div>

    <div class="container">


        <div class="ui-block responsive-flex">
            <div class="ui-block-title pt-3 pb-3">
                <div class="h6 title">

                    @if($user)
                    {{$user->fullName()}} Portfolio <sapn class="count_portfolio">({{ $posts->count() }})</sapn>
                    @endif
                </div>
               {{-- <form class="w-search">
                    <div class="form-group with-button">
                        <input class="form-control" type="text" placeholder="Search Designs and Articles">
                        <button>
                            <svg class="olymp-magnifying-glass-icon">
                                <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-magnifying-glass-icon') }}"></use>
                            </svg>
                        </button>
                    </div>
                </form>
                <a href="javascript:void(0)" class="more">
                    <svg class="olymp-three-dots-icon">
                        <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
                    </svg>
                </a>--}}
            </div>
        </div>



        <div class="photo-album-wrapper">

         @if(Auth::id() == $user->id)
           <div class="photo-album-item-wrap col-4-width" >
                <div class="photo-album-item create-album" data-mh="album-item" style="border-radius:0px;height: 384px;">

                    <a href="#" data-toggle="modal" data-target="#create-photo-album" class="  full-block"></a>

                    <div class="content">

                        <a href="#" class="btn btn-control bg-primary" data-toggle="modal" data-target="#create-photo-album">
                            <svg class="olymp-plus-icon"><use xlink:href="icons/icons.svg#olymp-plus-icon"></use></svg>
                        </a>

                        <a href="#" class="title h5" data-toggle="modal" data-target="#create-photo-album">Create Portfolio</a>
                        <span class="sub-title">Showcase your featured work here!</span>

                    </div>

                </div>
            </div>
         @endif
        

            {{-- all featured post --}}
            @if(!empty($posts))
                @foreach($posts as $post)
                <div class="photo-album-item-wrap remove-featured col-4-width">

                    <div class="photo-album-item" data-mh="album-item" style="border-radius:0px;height: 384px;">

                        <div class="photo-item" >
                            <a href="{{ route('postDetail',$post->usersPostShare->usersPost->slug) }}">
                                <img src=" {{ asset($post->usersPostShare->usersPost->banner_image) }}" style="max-width: 100%;height: 108px;" alt="photo">
                            </a>

                             {{--  <div class="overlay overlay-dark"></div>--}}


                            {{--<a href="javascript:void(0)" data-toggle="modal" data-target="#open-photo-popup-v2" class="  full-block"></a>--}}
                        </div>
                        <span style="background-color:#f84343; color:white; padding:4px 8px; font-size:16px;">{{ ucfirst($post->usersPostShare->usersPost->type) }}</span>
                        @if(Auth::id() == $user->id)
                        <div class="more">
                            <svg class="olymp-three-dots-icon pull-right" style="margin-right: 10px;margin-top: -10px;">                            
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{asset('assets/icons/icons.svg#olymp-three-dots-icon')}}"></use>
                            </svg>
                            <ul class="more-dropdown more-with-triangle">
                                    <li>
                                        <a href="javascript:void(0)" class="select_as_featured" data-post-id="{{ $post->users_post_id }}" data-portfolio-remove="remove_form_featured">Remove From Featured
                                            </a>
                                    </li>
                                    <li>
                                        
                                        <a href="@if($post->usersPostShare->usersPost->type == 'status') {{ route('post.status.edit',$post->usersPostShare->usersPost->slug) }} @elseif($post->usersPostShare->usersPost->type == 'article') {{ route('post.article.edit',$post->usersPostShare->usersPost->slug) }} @elseif($post->usersPostShare->usersPost->type == 'design') {{ route('post.design.edit',$post->usersPostShare->usersPost->slug) }} @endif ">Edit Post</a>
                                        }
                                    </li>

                            </ul>
                        </div>
                        @endif
                        <div class="content">

                            <a href="{{ route('postDetail',$post->usersPostShare->usersPost->slug) }}" class="title h5">{{ ucfirst(str_limit($post->usersPostShare->usersPost->title,15)) }}</a>
                            @if($post->usersPostShare->usersPost->type == 'design')
                            <span class="sub-title">
                                Status - {{ $post->usersPostShare->usersPost->designDetail->status }} |
                                Type - {{ $post->usersPostShare->usersPost->designDetail->select_design_type }} |
                                Program -  {{ $post->usersPostShare->usersPost->designDetail->building_program }}</span>
                            @endif
                            @if($post->usersPostShare->usersPost->type == 'article')
                            <span class="sub-title">{!! str_limit($post->usersPostShare->usersPost->description,100)  !!}</span>
                            @endif

                            <div class="swiper-container">


                                <div class="swiper-slide">
                                    <div class="friend-count" data-swiper-parallax="-500">

                                       {{-- @if($post->isThisLike($post->id) != null)
                                            <a href="javascript:void(0)" class="post-add-icon inline-items like_ like_color">
                                                <i class="fa fa-caret-up"></i>
                                                <span class="like">{{ $post->likes->count() }} Like</span>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="post-add-icon inline-items like_">
                                                <i class="fa fa-caret-up"></i>
                                                <span class="like ">{{ $post->likes->count() }} Like</span>
                                            </a>

                                        @endif--}}
                                        <a href="javascript:void(0)" class="friend-count-item">
                                            <div class="h6">{{ $post->usersPostShare->usersPost->likes->count() }}</div>
                                            <div class="title">Likes</div>
                                        </a>
                                        <a href="javascript:void(0)" class="friend-count-item">
                                            <div class="h6">{{$post->usersPostShare->usersPost->comments->count()}}</div>
                                            <div class="title">Comments</div>
                                        </a>
                                        <!--<a href="#" class="friend-count-item">
                                            <div class="h6">16</div>
                                            <div class="title">Share</div>
                                        </a> -->
                                    </div>
                                </div>


                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>

                    </div>
                </div>

                @endforeach
                @else
                    <div class="photo-album-item-wrap col-12-width text-center" style="width: 74%;">
                        <div class="col-sm-12 col-xs-12">
                            <div class="friend-item"><h3 class="text-center"> No Record In Portfolio</h3></div>
                        </div>
                    </div>

            @endif



        </div>


    </div>

    <!-- Window-popup Create Photo Album -->

    <div class="modal fade" id="create-photo-album">
        <div class="modal-dialog ui-block window-popup create-photo-album">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
            </a>

            <div class="ui-block-title">
                <h6 class="title">Create Portfolio</h6>
            </div>
            <img src="{{ asset('img/sqrfactor.gif') }}" alt="">

            <div class="ui-block-content">



            </div>
        </div>
    </div>

    @include('users.partials.post-detail-view-model')


@endsection