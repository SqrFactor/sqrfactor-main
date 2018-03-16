@extends('layouts.app-news-feed')

@section('title') Event-list | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')

    <div class="header-spacer"></div>
    <div class="container mb-4">
        <div class="text-center">
             @if(Auth::user()->user_type == 'work_individual')
                 <a id="job-intern" href="#" class="btn btn-lg btn-primary font-weight-bold">&nbsp;&nbsp;Launch Event&nbsp;&nbsp;</a>
             @else
                 <a href="{{ route('eventAdd') }}" class="btn btn-lg btn-primary font-weight-bold">&nbsp;&nbsp;Launch Event&nbsp;&nbsp;</a>
             @endif
           
        </div>
    </div>
    <div class="container">
        <div class="competition-list event-list font-color-gray">
            <div class="row sorting-container" data-layout="masonry">
                @if($events->count())
               @foreach($events as $event)
                <!-- event-list-item 1 -->
                <div class="col-lg-6 sorting-item">
                    <div class="competition-item event-list-item ui-block">
                        <div class="competition-item-content">
                            @if(!empty($event->event_title))
                            <h6 class="title">{{ $event->event_title }}</h6>
                            @endif
                            @if(!empty($event->created_at))
                            <div class="date">{{ $event->created_at->diffForHumans() }}</div>
                            @endif

                            @if(!empty($event->cover_image))
                            <img src="{{ URL::asset($event->cover_image) }}" class="competition-item-img" alt="">
                            <ul>
                            @endif
                                {{--<li>Last Date of Submission: July 23, 2017</li>
                                <li>Last Date of Registration: June 23, 2017</li>--}}
                                @if(!empty($event->venue))
                                <li>Location: {{ $event->venue }} </li>
                                @endif
                                @if(!empty($event->price))
                                <li>Prizes: {{ $event->price }} </li>
                                @endif
                                @if(!empty($event->event_type))
                                <li>Type: {{ $event->event_type }} </li>
                                @endif
                            </ul>
                            @if(!empty($event->description))
                            <p>{!! $event->description  !!}</p>
                            @endif
                            <a href="{{ route('eventDetail',$event->slug) }}" class="btn btn-primary btn-sm font-weight-bold">Read More</a>
                        </div>
                        {{--<div class="competition-item-footer d-flex flex-wrap">
                            <div class="inline-items mr-auto">
                                <a href="#" class="post-add-icon">
                                    <i class="fa fa-caret-up"></i>
                                    <span>16 Like</span>
                                </a>
                                <a href="#" class="post-add-icon">
                                    <i class="fa fa-circle"></i>
                                    <span>16 Comments</span>
                                </a>
                                <a href="#" class="post-add-icon">
                                    <i class="fa fa-square"></i>
                                    <span>Share</span>
                                </a>
                            </div>
                            <div class="inline-items social-share text-right">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>--}}
                    </div>
                </div>
                <!--  end event-list-item 1 -->
              @endforeach
                    @else
                    <h3>No Events yet !</h3>
               @endif

            </div>
        </div>
        <div class="text-center">
            <a id="load-more-button" href="#" class="btn btn-control btn-more" data-container="newsfeed-items-grid">
                <svg class="olymp-three-dots-icon">
                    <use xlink:href="../assets/icons/icons.svg#olymp-three-dots-icon"></use>
                </svg>
            </a>
        </div>
    </div>

@endsection

