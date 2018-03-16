
@extends('layouts.app-news-feed')

@section('title') {{$userJob->job_title}} | Job | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')

<div class="modal fade" id="applicant-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Applicants Details</h5>
                <button type="button" class="close myModalkkkClode" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">
                <div class="row" id="applicant-detail">
               
            </div>
        </div>
    </div>
</div>
</div>
<div class="header-spacer"></div>
    <div class="job-detail font-color-gray">
      <div class="container">
        <div class="row">
          <!-- main content -->
          <div class="col-xl-8 col-lg-9 col-md-10">
            <div>
              <h1 class="h2 mb-4" style="font-size: 1.875rem;">Experienced project Manager</h1>
              <div class="row job-detail-list">
                <div class="col-md-3 title">Job Title/Position</div>
                <div class="col-md-9">
                  <p>{{ucfirst($userJob->job_title)}}</p>
                </div>
                <!--  -->
                <div class="col-md-3 title">Category</div>
                <div class="col-md-9">
                  <p>{{ucfirst($userJob->category)}}</p>
                </div>
                <!--  -->
                <div class="col-md-3 title">Type of position</div>
                <div class="col-md-9">
                  <p>{{ucfirst($userJob->type_of_position)}}</p>
                </div>
                <!--  -->
                <div class="col-md-3 title">Skills</div>
                <div class="col-md-9">
                  <p>{{ucfirst($skill)}}</p>
                </div>
                <!--  -->
                <div class="col-md-3 title">Educational Qualification</div>
                <div class="col-md-9">
                  <p>{{ucfirst($qualifaiction)}}</p>
                </div>
                <!--  -->
                <div class="col-md-3 title">Firm</div>
                <div class="col-md-9">
                  <p>{{ucfirst($userJob->firm)}}</p>
                </div>
                <!--  -->
                <div class="col-md-3 title">Location</div>
                <div class="col-md-9">
                  <p>{{$userJob->country->name}}/ {{$userJob->state->name}} / {{$userJob->city->name}}</p>
                </div>
                <!--  -->
                <div class="col-md-3 title">Job expires on</div>
                <div class="col-md-9">
                  <p>{{$userJob->job_offer_expires_on}}</p>
                </div>

                <div class="col-md-3 title">Expect salary</div>
                <div class="col-md-9">
                  <p>{{$userJob->maximum_salary.' to '.$userJob->minimum_salary.' '.$userJob->salary_type}}</p>
                </div>
                <!--  -->
                <!-- <div class="col-md-3 title">Apply through</div>
                <div class="col-md-9">
                  <p>Jobs@mccleandesign.com</p>
                </div> -->
                <!--  -->
              </div>
              <p>{{ucfirst($userJob->description)}}</p>
            
            
               <input type="hidden" name="user_job_id" id="user_job_id" value="{{$userJob->id}}">

               <button class="btn btn-primary btn-submit mt-4" id="jobApply">Apply Now</button>
               @if(Auth::id() == $userJob->user_id)
                <button class="btn btn-primary btn-submit mt-4" id="view-applicant">View Applicant</button>
                @endif
              <!-- <a href="#" class="btn btn-primary btn-submit mt-4" >Apply Now</a> -->
               
           
            </div>
          </div>
          <!-- end main content -->
        </div>
      </div>
    </div>
    @endsection