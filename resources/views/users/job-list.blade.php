@extends('layouts.app-news-feed')

@section('title') joblist | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')
    <div class="header-spacer"></div>
    <div class="container mb-4">
        <div class="text-center">
            @if(Auth::user()->user_type == 'work_individual')

                <a id="job-intern" href="#" class="btn btn-lg btn-primary font-weight-bold">Post Job</a>
            @else
              <a href="{{route('job')}}" class="btn btn-lg btn-primary font-weight-bold">Post Job</a>   
            @endif

        </div>
    </div>
    <div class="container">
        <div class="competition-list job-list font-color-gray">
            <div class="row sorting-container" data-layout="masonry">
                <!-- job-item 1 -->
                @foreach($joblist as $list)
                    <div class="col-lg-6 sorting-item">
                        <div class="competition-item job-item ui-block">
                            <div class="competition-item-content">
                                <h6 class="title">{{$list->job_title}}</h6>
                                <div class="date">{{$list->created_at->diffForHumans()}}</div>
                                <ul>
                                    <li><span class="font-weight-medium">Job title/Position</span>:{{$list->job_title}}
                                    </li>
                                    <li><span class="font-weight-medium">Category</span>: {{$list->category}}</li>
                                    <li>
                                        <span class="font-weight-medium">Type of position</span>: {{$list->type_of_position}}
                                    </li>
                                    <li>
                                        <span class="font-weight-medium">Work experience</span>: {{$list->work_experience}}
                                    </li>
                                    <li><span class="font-weight-medium">Type</span>: Open</li>
                                </ul>
                                <p>
                                    {{$list->description}}
                                </p>
                                <a href="{{route('jobDetail',$list->slug)}}"
                                   class="btn btn-primary btn-sm font-weight-bold">See detail</a>
                            </div>

                        </div>
                    </div>
            @endforeach

            <!--  end job-item 1 -->

            </div>
        </div>
        <div class="text-center">
            {{$joblist->links()}}
        </div>
    </div>
@endsection