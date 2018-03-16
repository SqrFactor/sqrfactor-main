@extends('layouts.app-users')

@section('title') Company Firm Details  | SqrFactor @endsection
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
                <div class="ui-block-title">
                    <h6 class="title">Company Firm Details</h6>
                    @if(Auth::user()->is_skip == "n")
                    <a class="btn btn-primary pull-right skip-btn" style="color:white;" data-path="{{ Request::path() }}"  >Skip</a>
                   @endif

                </div>

                <div class="ui-block-content">
                    <!-- form -->
                    <form action="{{ route('work.workArchitectureCompanyFirmDetails') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Years in Service</label>
                                    <input class="form-control" value="@if(!empty(Auth::user()->userDetail->year_in_service)){{ Auth::user()->userDetail->year_in_service }} @endif" placeholder="" name="year_in_service" type="text">
                                    @if ($errors->has('year_in_service'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('year_in_service') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">Services Offered</label>
                                    <input class="form-control" name="services_offered" value="@if(!empty(Auth::user()->userDetail->services_offered)){{ Auth::user()->userDetail->services_offered }} @endif" placeholder="" type="text" >
                                    @if ($errors->has('services_offered'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('services_offered') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Firm Size </label>
                                    <input class="form-control" name="firm_size" value="@if(!empty(Auth::user()->userDetail->firm_size)){{ Auth::user()->userDetail->firm_size }} @endif" placeholder="" type="text">
                                    @if ($errors->has('firm_size'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('firm_size') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label"> Asset Served</label>
                                    <input class="form-control" name="asset_served" value="@if(!empty(Auth::user()->userDetail->asset_served)){{ Auth::user()->userDetail->asset_served }} @endif" placeholder="" type="text">
                                    @if ($errors->has('asset_served'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('asset_served') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">City Served </label>
                                    <input class="form-control" placeholder="" name="city_served" value="@if(!empty(Auth::user()->userDetail->city_served)){{ Auth::user()->userDetail->city_served }} @endif" type="text">
                                    @if ($errors->has('city_served'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('city_served') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                            </div>
                            
                             <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Award Name </label>
                                    <input class="form-control" placeholder="" name="award_name" value="@if(!empty(Auth::user()->userDetail->award_name)){{ Auth::user()->userDetail->award_name }} @endif" type="text">
                                    @if ($errors->has('award_name'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('award_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                            </div>

                             <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Project Name  </label>
                                    <input class="form-control" name="project_name" value="@if(!empty(Auth::user()->userDetail->project_name)){{ Auth::user()->userDetail->project_name }} @endif" placeholder="" type="text">
                                    @if ($errors->has('project_name'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('project_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">Save all Changes</button>
                    </form>
                    <!-- end form -->
                </div>
            </div>
        </div>
        <!-- End Main Content -->
    </div>
</div>

@endsection

