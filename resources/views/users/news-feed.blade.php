@extends('layouts.app-news-feed')

@section('title') New's Feed | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('styles')
<style>
    
        .image_frame{
        position: relative;

    }
    #know_more_banner{
    position: absolute;
    bottom: 0;
    vertical-align: bottom;
    text-align: center;
    width: inherit;
    height: inherit;
    display: none;
    color: white;
    cursor: pointer;

    }
    .knw{
        display: none;
        position:absolute;
        bottom: -35%;
        margin: auto;
        color: white;
        left: 42%;
    }
    .image_frame:hover .knw{
        display: block;
    }
    
    .image_frame:hover #know_more_banner{
        display:  block;
        background:linear-gradient(to bottom, rgba(0, 0, 0, 0) 70%,rgba(0, 0, 0, 0.6) 100%);background-size:100%;
    }

</style>
@endsection

@section('content')
    <div class="header-spacer hidden-xs-down"></div>

    <div class="header-spacer-fit hidden-sm-up"></div>


    <div class="container">


        {{--users like model--}}
        @include('users.partials.users-like')

        @include('users.partials.required-filed')




        <div class="newsfeed-main-buttons">
            <div class="row">
                <div class="col-6">
                    <a href="{{ route('home') }}" class="btn btn-block active">New's Feed</a>
                </div>
                <div class="col-6">
                    <a href="{{ route('whatsRed') }}" class="btn btn-block">What's Red ?</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row pagination-parents">
            <!-- Main Content -->
            <div class="col-xl-6 push-xl-3 ">

            {{-- include news feed form--}}
            @include("users.partials.news-feed-post-from")

            <!-- newsfeed -->
                <div id="newsfeed-items-grid">


                    @if(count($posts) >0)
                        @foreach($posts as $post )
                            {{-- Design --}}

                            @include("users.partials.news-feed-n-profile-post",compact('post'))
                            {{-- /Design --}}
                        @endforeach
                    @endif
                </div>

                <input type="hidden" id="newsfeed-counter" value="1">

                <a id="newsfeed-load-more" href="#" class="btn btn-control btn-more btn-load-new"
                   data-container="newsfeed-items-grid">
                   Load more
                    <div class="ripple-container"></div>
                </a>
                <p class="text-center load-more-text" style="display: none !important;"></p>
            </div>
            <!-- Left Sidebar -->
            @include('users.partials.user-left-sidebar2')
            <!-- End Left Sidebar -->
            @include('users.partials.user-right-sidebar')
        </div>
    </div>
    @include('users.partials.post-detail-view-model')
@endsection

@section('scripts')
<script type="text/javascript">
    // $(".image_frame").hover(function(){
    // $('.imgframe1').attr('style','background-image:linear-gradient(to bottom, rgba(0, 0, 0, 0) 70%,rgba(0, 0, 0, 0.6) 100%);background-size:100%');
    // $('#know_more_banner').html('<b>KNOW MORE</b>');
    // });

</script>

@endsection
