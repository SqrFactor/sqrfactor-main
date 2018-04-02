@extends('layouts.app-users')
@section('title') Other Details | SqrFactor @endsection
@section('content_description')An online platform for architects, interior designers, teachers and students to showcase their skills, apply for jobs/internships, participate in architecture competitions,follow experts and stay updated!@endsection

@section('content')


    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            @include('users.partials.left-sidebar')
                    <!-- End Left Sidebar -->
            <!-- Main Content -->
            <div class="col-xl-9">
                <div class="ui-block">
                    @include('sqrfactor.partials.message')
                    <div class="alert alert-success other_detail_success" style="display: none;">
                        <strong>Success!</strong> Saved successfully.
                    </div>
                    <div class="ui-block-title">
                        <h6 class="title"> Other Details </h6>

                        @if(Auth::user()->is_skip == "n")
                            <a class="btn btn-primary pull-right skip-btn" style="color:white;" data-path="{{ Request::path() }}"  >Skip</a>
                        @endif
                    </div>
                    <div class="ui-block-content">

                        <!-- form -->

                        <form   id="other_detail_form">


                            @if($allOtherDetail->count())

                            @foreach($allOtherDetail as $otherDetail)


                            <div class="row  @if($loop->last)  other_detail @endif other_detail_div_remove">



                                    <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Awards</label>
                                        <input class="form-control" placeholder="" name="award[]" type="text" value="{{ $otherDetail->award }}">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Award Name </label>
                                        <input class="form-control" placeholder="" name="award_name[]" type="text" value="{{ $otherDetail->award_name }}">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Project Name</label>
                                        <input class="form-control" placeholder="" name="project_name[]" type="text" value="{{ $otherDetail->project_name }}">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>


                                 <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Services Offered </label>
                                        <input class="form-control" placeholder="" name="services_offered[]" type="text" value="{{ $otherDetail->services_offered }}">
                                        <p class="errors" style="color: red;display: none;"></p>
                                    </div>
                                </div>

                                @if($loop->last)
                                    <div class="col-md-12">
                                        <button type="button" class="pull-right add_other_detail btn btn-primary btn-sm font-weight-bold">Add</button>
                                    </div>
                                    @else
                                    <div class="col-md-12">
                                        <button type="button" class="pull-right  remove_this_other_detail btn btn-secondary btn-sm font-weight-bold">Remove</button>
                                    </div>
                                @endif
                                <br />
                                <br />
                                <hr />
                            </div>

                            @endforeach
                            @else

                                <div class="row other_detail ">



                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Awards</label>
                                            <input class="form-control" placeholder="" name="award[]" type="text" value="">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Award Name </label>
                                            <input class="form-control" placeholder="" name="award_name[]" type="text" value="">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Project Name</label>
                                            <input class="form-control" placeholder="" name="project_name[]" type="text" value="">

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Services Offered </label>
                                            <input class="form-control" placeholder="" name="services_offered[]" type="text" value="">

                                        </div>
                                    </div>


                                    

                                    <br />
                                    <br />
                                    <hr style="width:100%;">
                                </div>
                                     <div class="col-md-12 add_edu_button" style="text-align: center; ">
                                        <button type="button" style="width: 5em" class=" add_other_detail btn btn-primary btn-sm font-weight-bold">Add</button>
                                    </div>

                            @endif

                            <button type="button" class="btn btn-primary btn-block font-weight-bold other_detail_save">Save </button>
                        </form>
                        <!-- end form -->
                </div>
            </div>
            <!-- End Main Content -->
        </div>
    </div>
@endsection