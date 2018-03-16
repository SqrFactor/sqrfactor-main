@extends('layouts.app-users')

@section('title'){{ $user->fullName() }} | SqrFactor @endsection
@section('content_description')
    @if($user->userDetail->short_bio != null)
        {{ $user->userDetail->short_bio }}
    @else An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!
    @endif
@endsection

@section('content')
    <div class="header-spacer-fit hidden-sm-up"></div>
    <div class="container">
        {{--users like model--}}
        @include('users.partials.users-like')

        @include('users.partials.required-filed')

        <div class="row">
            <!-- Main Content -->
            <div class="col-xl-6 push-xl-3 ">
                <!-- newsfeed form -->

                <!-- newsfeed -->
                <div id="newsfeed-items-grid" class="post-data">
                    @foreach($posts as $post)
                        {{-- Design --}}
                        @include("users.partials.news-feed-n-profile-post",compact('post'))
                        {{-- /Design --}}
                    @endforeach

                </div>

                {{ $posts->links() }}

            </div>
            <!-- Left Sidebar -->
             @include('users.partials.user-left-sidebar2')

            <!-- End Left Sidebar -->
            <!-- Right Sidebar -->
            @include('users.partials.user-right-sidebar')
        </div>
    </div>

    @include('users.partials.post-detail-view-model')

@endsection
