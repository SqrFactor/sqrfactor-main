@extends('layouts.app-users')

@section('title')
    @if($_REQUEST['action'] == 'following')
        Following
        @elseif($_REQUEST['action'] == 'followers')
        Followers
    @endif
     | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')


    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-xl-12">
                <div class="ui-block responsive-flex">
                    <div class="ui-block-title pt-3 pb-3">
                        <div class="h6 title">
                            @if($_GET['action'] == 'followers')
                                Followers ({{ $follows->count() }})
                            @elseif($_GET['action'] == 'following')
                                Following ({{ $follows->count() }})
                            @endif

                        </div>

                        @if($_GET['action'] == 'followers')
                            <form class="w-search">
                                <div class="form-group">
                                    <input class="form-control search_friend" type="text"
                                           placeholder="Search Friends..." data-search_type='followers'
                                           data-user_id="{{ $user->id }}">
                                    {{-- <button>
                                         <svg class="olymp-magnifying-glass-icon">
                                             <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-magnifying-glass-icon') }}"></use>
                                         </svg>
                                     </button>--}}
                                </div>
                            </form>
                        @elseif($_GET['action'] == 'following')
                            <form class="w-search">
                                <div class="form-group ">
                                    <input class="form-control search_friend" type="text"
                                           placeholder="Search Friends..." data-search_type='following'
                                           data-user_id="{{ $user->id }}">
                                    {{-- <button>
                                         <svg class="olymp-magnifying-glass-icon">
                                             <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-magnifying-glass-icon') }}"></use>
                                         </svg>
                                     </button>--}}
                                </div>
                            </form>

                        @endif

                        <a href="javascript:void(0)" class="more">
                            <svg class="olymp-three-dots-icon">
                                <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Followers -->
                <div class="row follow-search-data js"></div>
                <div class="row follow-search-data php">


                    @if($_GET['action'] == 'followers')
                        @if($follows->count())
                            @foreach($follows as $follow)
                                @include('users.partials.follow-user-card',[
                                    'type' => 'followers',
                                    'follow' => $follow
                                ])
                            @endforeach
                        @endif

                    @elseif($_GET['action'] == 'following')

                        @if($follows->count())
                            @foreach($follows as $follow)
                                @include('users.partials.follow-user-card',[
                                    'type' => 'following',
                                    'follow' => $follow
                                ])
                            @endforeach
                        @endif

                    @endif

                </div>
                {{--<a id="load-more-button" href="#" class="btn btn-control btn-more" data-container="newsfeed-items-grid">
                    <svg class="olymp-three-dots-icon">
                        <use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use>
                    </svg>
                </a>--}}
            </div>
            <!-- End Main Content -->

        </div>
    </div>

@endsection