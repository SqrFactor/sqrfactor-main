@extends('layouts.app-users')
@section('title')  Education Details | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')
<!-- feed modal -->
    <div class="modal fade" id="educationAddCollege">
        <div class="modal-dialog ui-block window-popup" style="width: 800px;">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon">
                    <use xlink:href="{{ asset('assets/icons/icons.svg#olymp-close-icon') }}"></use>
                </svg>
            </a>
            <div class="container p-4 p-lg-5">
                <h3 class="text-center">Add College/University</h3>


                <br>
                <form method="post">
                    <div class="row form-group">
                        <label class="col-lg-3 col-form-label h6">Name</label>
                        <div class="col-lg-8">
                            <div class="form-group is-select mb-lg-0">
                                <input type="text" placeholder="College Name" class="form-control" name="feed_college_name">
                                <p class="feed_college_name errors" style="display: none;color: red;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 col-form-label h6">Email</label>
                        <div class="col-lg-8">
                            <div class="form-group is-select mb-lg-0">
                                <input type="text" placeholder="Email" class="form-control" name="feed_college_email">
                                <p class="feed_college_email errors" style="display: none;color: red;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-lg-3 col-form-label h6">Mobile</label>
                        <div class="col-lg-8">
                            <div class="form-group is-select mb-lg-0">
                                <input type="text" placeholder="Mobile" class="form-control" name="feed_college_mobile">
                                <p class="feed_college_mobile errors" style="display: none;color: red;"></p>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row pt-2">
                        <p class="errors" id="error_global" style="display: none;color: red;"></p>
                        <div class="col-lg-12 offset-lg-3">
                            <a href="javascript:void(0)" data-form-type="college"  class="btn btn-primary btn-submit educationAddCollegeFeedSave">Submit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- </feed modal -->

    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            @include('users.partials.left-sidebar')
                    <!-- End Left Sidebar -->
            <!-- Main Content -->
            <div class="col-xl-9">
                <div class="ui-block">
                    @include('sqrfactor.partials.message')
                    <div class="ui-block-title">
                        <h6 class="title">Education Details  </h6>
                        @if(Auth::user()->is_skip == "n")
                            <a class="btn btn-primary pull-right skip-btn" style="color:white;" data-path="{{ Request::path() }}"  >Skip</a>
                        @endif
                    </div>
                    <div class="ui-block-content">
                        <!-- form -->
                        <form id="work_education_details_form">
                            {{ csrf_field()   }}
                            @if($allEducationDetails->count())
                            @foreach($allEducationDetails as $educationDetails)
                            <div class="row @if($loop->last) work_education_details @else work_education_details_remove_div  @endif">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Course*</label>
                                        <input class="form-control " placeholder="" value="{{ $educationDetails->course }}" name="course[]" id="course"   type="text">
                                        <p class="errors" style="color: red;display: none;" ></p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating" style="position: relative;">
                                        <label class="control-label">College/University*</label>
                                        <input class="form-control" placeholder="" 
                                        data-professionaldetail-id="{{$educationDetails->id}}"
                                        data-after-focus="n"
                                        name="college_university[]" type="text" id="college_university"
                                        @if(!empty($educationDetails->college_university_id))
                                        value="{{$educationDetails->usersCollege->name}}"
                                        @else
                                        value="{{$educationDetails->college_university}}"
                                        @endif
                                        
                                        >
                                        <input type="hidden" class="id" name="college_university_id[]" value="{{$educationDetails->college_university_id}}">
                                        <ul class="account-settings ajax_search college college-company" >
                                        </ul>
                                        
                                        <p class="errors" style="color: red;display: none;" ></p>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating hello is-select">
                                        <label class="control-label">Year Of Admission*</label>
                                        <input class="form-control year_of_admission" placeholder="" value="{{ $educationDetails->year_of_admission }}" name="year_of_admission[]" type="text" id="year_of_admission">
                                        <p class="errors" style="color: red;display: none;" ></p>

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group label-floating hello is-select">
                                        <label class="control-label">Year Of Graduation*</label>
                                        <input class="form-control year_of_graduation" placeholder="" value="{{ $educationDetails->year_of_graduation }}" name="year_of_graduation[]" id="year_of_graduation" type="text">
                                        <p class="errors" style="color: red;display: none;" ></p>

                                    </div>
                                </div>


                                @if($loop->last)

                                    <div class="col-md-12">
                                        <button type="button" class="pull-right add_work_education_details btn btn-primary btn-sm font-weight-bold">Add</button>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <button type="button" class="pull-right  remove_this_education_details btn btn-secondary btn-sm font-weight-bold">Remove</button>
                                        </div>
                                    </div>
                                @endif

                                <hr style="width:100%;">

                            </div>
                            @endforeach

                            @else
                                <div class="row work_education_details">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Course*</label>
                                            <input class="form-control" placeholder="" value="" name="course[]" type="text">
                                            <p class="errors" style="color: red;display: none;" ></p>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group label-floating">

                                            <label class="control-label">College/University*</label>
                                            <input class="form-control " placeholder="" value="" name="college_university[]" type="text">
                                            <input type="hidden" class="id" name="college_university_id[]" value="">
                                            <ul class="account-settings ajax_search college college-company" >
                                            </ul>

                                            <p class="errors" style="color: red;display: none;" ></p>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating hello is-select">
                                            <label class="control-label">Year Of Admission*</label>
                                            <input class="form-control year_of_admission" placeholder="" value="" name="year_of_admission[]" type="text" id="year_of_admission">
                                            <p class="errors" style="color: red;display: none;" ></p>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group label-floating hello is-select">
                                            <label class="control-label">Year Of Graduation*</label>
                                            <input class="form-control year_of_graduation" placeholder="" value="" name="year_of_graduation[]" id="year_of_graduation" type="text">
                                            <p class="errors" style="color: red;display: none;" ></p>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" class="pull-right add_work_education_details btn btn-primary btn-sm font-weight-bold">Add</button>
                                    </div>

                                    <hr style="width:100%;">

                                </div>

                            @endif

                            <button type="button" class="btn btn-primary btn-block font-weight-bold work_education_details_save">Save & Next</button>
                                
                        </form>
                        <!-- end form -->

                </div>
            </div>
            <!-- End Main Content -->
              
                
                
           
		</div>
        </div>
    </div>

@endsection

@section('scripts')


    {{--<script>


      $('#year_of_admission').datetimepicker({
            format: 'YYYY',


        })
        $('#year_of_graduation').datetimepicker({
            format: 'YYYY',


        })

    </script>
--}}

@endsection




