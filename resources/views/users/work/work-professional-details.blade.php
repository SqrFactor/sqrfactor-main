@extends('layouts.app-users')

@section('title')  Professional Details | SqrFactor @endsection
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
                <h3 class="text-center">Add Company/Firm Or College/University</h3>
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
                            <a href="javascript:void(0)" data-form-type="company_college"  class="btn btn-primary btn-submit educationAddCollegeFeedSave">Submit</a>
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
                        <h6 class="title">Professional Details </h6>

                        @if(Auth::user()->is_skip == "n")
                            <a class="btn btn-primary pull-right skip-btn" style="color:white;" data-path="{{ Request::path() }}"  >Skip</a>
                        @endif

                    </div>
                    <div class="ui-block-content">
                        <!-- form -->
                        <form action="{{ route('work.workIndividualProfessionalDetails') }}" method="POST" id="professional_detail_form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">


                                        <div class="form-group label-floating">
                                            <label class="control-label">COA/Registration</label>
                                            <input class="form-control" placeholder="" name="coa_registration" id="coa_registration" type="text" @if(Auth::user()->userDetail->coa_registration != null) value="{{ Auth::user()->userDetail->coa_registration }}" @endif>
                                            <p class="errors" style="color: red;display: none;"></p>

                                        </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label"> Years Since Service</label>
                                        <input class="form-control" placeholder="" name="years_since_service" id="years_since_service" type="text" @if(Auth::user()->userDetail->years_since_service != null) value="{{ Auth::user()->userDetail->years_since_service }}" @endif>
                                        <p class="errors" style="color: red;display: none;"></p>

                                    </div>
                                </div>
                            </div>
                            @if($allProfessionalDetail->count())

                            @foreach($allProfessionalDetail as  $professionalDetail)
                            <div class="row  @if($loop->last) work_professional_detail  @else professional_detail_div_remove @endif">


                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Role*</label>
                                        <input class="form-control" placeholder="" type="text" value="{{ $professionalDetail->role }}" name="role[]">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Company/Firm Or College/Universitssssy*</label>
                                         <input class="form-control" placeholder="" name="company_firm_or_college_university[]" type="text" data-professionaldetail-id="{{$professionalDetail->id}}"
                                        data-after-focus="n"
                                        @if($professionalDetail->company_firm_or_college_university_id == null || empty($professionalDetail->company_firm_or_college_university_id))
                                            value="{{$professionalDetail->company_firm_or_college_university}}"
                                        @else
                                            @if(isset($professionalDetail->usersCompany->name))
                                            value="{{$professionalDetail->usersCompany->name}}"
                                            @elseif(isset($professionalDetail->usersCollege->name))
                                            value="{{$professionalDetail->usersCollege->name}}"
                                            @endif
                                        @endif
                                        >
                                        <input type="hidden" class="type" value="{{ $professionalDetail->company_college_type }}" name="company_firm_or_college_university_type[]">
                                        <input type="hidden" class="id" value="{{ $professionalDetail->company_firm_or_college_university_id }}" name="company_firm_or_college_university_id[]">
                                        <p class="errors" style="color: red;display: none;"></p>
                                        <ul class="account-settings ajax_search college college-company">

                                        </ul>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Start Date</label>
                                        <input class="form-control datetimepicker_start_date" placeholder=""  value="{{ $professionalDetail->start_date }}" type="text" name="start_date[]" >
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">End Date of Working Currently</label>
                                        <input class=" form-control datetimepicker_end_date" name="end_date_of_working_currently[]"   placeholder="" type="text" value="{{ $professionalDetail->end_date_of_working_currently }}">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>

                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Salary/Stripend</label>
                                        <input class="form-control" placeholder="" name="salary_stripend[]" type="text" value="{{ $professionalDetail->salary_stripend }}">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>
                                
                                @if($loop->last)
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <button type="button" class="add_work_professional_detail pull-right btn btn-primary btn-sm font-weight-bold">Add</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <button type="button" class="pull-right     remove_this_professional_detail btn btn-secondary btn-sm font-weight-bold">Remove</button>
                                        </div>
                                    </div>
                                @endif

                                <hr>
                            </div>
                            @endforeach

                                @else
                                <div class="row work_professional_detail">


                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Role*</label>
                                            <input class="form-control" placeholder="" type="text" value="" name="role[]">
                                            <p class="errors" style="color: red;display: none;"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Company/Firm Or College/University*</label>
                                            <input class="form-control" placeholder="" name="company_firm_or_college_university[]" type="text" value="">
                                            <ul class="account-settings ajax_search college college-company"></ul>
                                            <p class="errors" style="color: red;display: none;"></p>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Start Date</label>
                                            <input class=" form-control" placeholder=""  value="" type="text" name="start_date[]" id="datetimepicker_start_date">
                                            <p class="errors" style="color: red;display: none;"></p>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">End Date of Working Currently</label>
                                            <input class=" form-control" name="end_date_of_working_currently[]"  id="datetimepicker_end_date"  placeholder="" type="text" value="">
                                            <p class="errors" style="color: red;display: none;"></p>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Salary/Stripend</label>
                                            <input class="form-control" placeholder="" name="salary_stripend[]" type="text" value="">
                                            <p class="errors" style="color: red;display: none;"></p>
                                        </div>
                                    </div>


                                        <div class="col-md-6">
                                            <div class="form-group label-floating">

                                                <button type="button"  class="add_work_professional_detail pull-right btn btn-primary btn-sm font-weight-bold" >Add +</button>

                                            </div>
                                        </div>


                                    <hr>
                                </div>

                            @endif




                                <button type="button" class="btn btn-primary btn-block font-weight-bold save_work_professional_details">Save</button>

                                
                        </form>
                        <!-- end form -->

                </div>
            </div>
            <!-- End Main Content -->
        </div>
    </div>

@endsection