@extends('layouts.app-news-feed')

@section('title') Competition | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')
    <div class="header-spacer"></div>


    @if(Auth::user()->user_type != 'work_individual')

    <div class="container mb-4">
        <div class="text-center">
            <a href="{{route('competitionAdd')}}" class="btn btn-lg btn-primary font-weight-bold">&nbsp;&nbsp;Launch Competition&nbsp;&nbsp;</a>
        </div>
    </div>
    @endif
    <div class="container">


        <div class="competition-list font-color-gray">
            <div class="row sorting-container" data-layout="masonry">
                <!-- competition-item 1 -->
                @foreach($competitionList as $list)



                <div class="col-lg-6 sorting-item">
                    <div class="competition-item ui-block">
                        <div class="competition-item-content">
                            <div class="row"><div class="col-10">
                                    <h6 class="title" style="
    display: inline-block;
">{{$list->competition_title}}</h6>
                                </div>
                                <div class="col-2 text-center">
                                    <div class="more" style="
">
                                        <svg class="olymp-three-dots-icon">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="{{ URL::asset('assets/icons/icons.svg#olymp-three-dots-icon') }}"></use>
                                        </svg>
                                        <ul class="more-dropdown">
                                            <li><a href="{{route('competition',$list->slug)}}">Full View</a></li>
                                            @if(Auth::id() == $list->user_id)
                                                <li>
                                                    <a href="{{route('competition',$list->slug)}}">Edit
                                                        Competition</a>
                                                </li>
                                                <li>
                                                    <a
                                                            onclick="postCompetitionDelete('{{$list->slug}}','{{ $list->id }}')"   >Delete Post</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div></div>
                            {{--<h6 class="title"></h6>--}}

                            <div class="date">7 hours ago</div>
                            <img src="{{asset($list->cover_image)}}" class="competition-item-img" style="width: 502px;height: 292px;">
                            <ul>
                                <li>Last Date of Submission: {{$list->schedule_closing_date_of_project_submission}}</li>
                               
                                <li>Last Date of Registration: {{$list->schedule_close_date_of_registration}}</li>

                                <li>@if(!empty($list->usersCompetitionsAward) && count($list->usersCompetitionsAward) > 0)


                                @if($list->usersCompetitionsAward->where("award_type","1_prize")->first()->award_amount != 0) 

                                Prizes: {{$list->usersCompetitionsAward->where("award_type","1_prize")->first()->award_amount}}
                                @else
                                Prizes : Not applicable
                                @endif
                                    
                                @else
                                Prizes : Not applicable

                                 @endif</li>
                                <li>Type: {{$list->competition_type}}</li>
                            </ul>
                           <a href="{{route('competition',$list->slug)}}" class="btn btn-white-shadow btn-sm font-weight-bold">Read More</a>&nbsp;&nbsp;&nbsp;
                            <a href="{{route('competition',$list->slug)}}" class="btn btn-primary btn-sm font-weight-bold">Participate</a>
                        </div>
                        <div class="competition-item-footer d-flex flex-wrap">
                            {{--<div class="inline-items mr-auto">
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
                            </div>--}}
                            <div class="inline-items social-share text-right">
                                <a  href="{{Share::load(route('competition',$list->slug), $list->competition_title)->facebook()}}" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="{{Share::load(route('competition',$list->slug), $list->competition_title)->twitter()}}" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="{{Share::load(route('competition',$list->slug),$list->competition_title)->gplus()}}" target="_blank"><i class="fa fa-google-plus"></i></a>
                                <a href="{{Share::load(route('competition',$list->slug),$list->competition_title)->linkedin()}}" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- end competition-item 1 -->
               
            </div>
        </div>
    </div>


@endsection