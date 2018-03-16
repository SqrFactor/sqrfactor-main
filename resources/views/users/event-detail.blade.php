@extends('layouts.app-news-feed')

@section('title') {{$event->event_title}} | detail | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')

<div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Event Details</h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">
                <div class="row" id="event-detail">
               
            </div>
        </div>
    </div>
</div>
</div>

    <div class="header-spacer"></div>
    <div class="event-detail font-color-gray">
        <div class="container">
            <div class="row">
              
                <!-- main content -->
                <div class="col-md-9 push-md-3 col-xl-8 push-xl-3 mb-5 pl-lg-5">
                    <div class="event-detail-content text-article">
                            @if(!empty($event->event_title))
                        <h1 class="h2 mb-4" style="font-size: 1.875rem;">{{ $event->event_title }}</h1>
                            @endif

                         @if(!empty($event->cover_image))
                        <img src="{{ URL::asset($event->cover_image) }}" class="mb-4" alt="">
                         @endif
                          @if(!empty($event->description))
                          <p>{!! $event->description  !!}</p>
                          @endif
                    </div>
                </div>
                <!-- end main content -->
               
                <!-- Right side -->
                <div class="col-md-3 pull-md-9 col-xl-3 pull-xl-8">
                    <a href="#" class="btn btn-primary btn-size-18 btn-block mb-4 font-weight-bold" id="eventApply"  >Register for event</a>
                    @if(Auth::id() == $event->user_id)
                     <a href="#" class="btn btn-primary btn-size-18 btn-block mb-4 font-weight-bold" id="viewEventUser"  >View register user</a>
                    <input type="hidden" id="event-id" value="{{$event->id}}">
                    @endif
                    <ul class="widget w-personal-info item-block">
                        @if(!empty($event->venue))
                        <li>
                            <span class="title">Venu</span>
                            <div class="text">
                                <p>{{ $event->venue }}</p>
                                {{--<a href="#" class="link-inverse"><u>Add to calendar</u> <i class="fa fa-map-marker"></i></a>--}}
                            </div>
                        </li>
                        @endif
                       
                            @if(!empty($event->date) && !empty($event->start_time) && !empty($event->end_time) )
                        <li>
                            <span class="title">Date & Time</span>
                            <div class="text">
                                <p>
                              <!--  date_format(date_create($event->date), 'd-M-Y')   -->
                                    {{$event->date}}
                                    <br> {{ $event->start_time }} – {{ $event->end_time }}
                                </p>
                                {{--<a href="#" class="link-inverse"><u>Add to calendar</u> <i class="fa fa-calendar-o"></i></a>--}}
                            </div>
                        </li>
                            @endif

                            @if(!empty($event->event_organizer))
                            <li>
                                <span class="title">Event Organizer</span>
                                <div class="text">{{ $event->event_organizer }}</div>
                            </li>
                            @endif
                            @if(!empty($event->event_type))
                            <li>
                                <span class="title">Event Type</span>
                                <div class="text">{{ $event->event_type }}</div>
                            </li>
                            @endif

                            @if(!empty($event->admission))
                            <li>
                                <span class="title">Admission</span>
                                <div class="text">{{ $event->admission }}</div>
                            </li>
                            @endif
                            @if(!empty($event->price))
                            <li>
                                <span class="title">Price</span>
                                <div class="text"><i class="fa fa-rupee"></i> {{ $event->price }}</div>
                            </li>
                           @endif
                    </ul>
                </div>
                <!-- End Right side -->
            </div>
        </div>
    </div>

@endsection

