@extends('layouts.app-users')
@section('title') Basic Details | SqrFactor @endsection
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
                    <h6 class="title">Firm Information</h6>
                </div>
                <div class="ui-block-content">
                    <!-- form -->
                    <form>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Name Of The Company/Firm*</label>
                                    <input class="form-control" placeholder="" type="text">
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">Address</label>
                                    <input class="form-control" placeholder="" type="text" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Phone Number*</label>
                                    <input class="form-control" placeholder="" type="text">
                                </div>
                                <div class="form-group label-floating">
                                    <label class="control-label">Pin Code</label>
                                    <input class="form-control" placeholder="" type="text">
                                </div>
                            </div>
                            @if(Auth::user()->country_id !== null && Auth::user()->state_id !== null && Auth::user()->city_id !== null  )

                                <div class="col-md-4">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Your Country</label>
                                        <select class="selectpicker form-control" name="country">
                                            <option selected disabled>Select Country*</option>
                                            @if($countries->count())
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}"  @if(Auth::user()->country_id == $country->id) selected @endif>{{ $country->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Your State / Province*</label>
                                        <select class="selectpicker form-control state" name="state">
                                            <option selected disabled>Select State</option>
                                            @if($states->count())
                                                @foreach($states as $state)
                                                    <option value="{{ $state->id }}" @if(Auth::user()->state_id == $state->id) selected @endif >{{ $state->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Your City*</label>
                                        <select class="selectpicker form-control city" name="city">
                                            <option selected disabled>Select City</option>
                                            @if($states->count())
                                                @foreach($states as $state)
                                                    <option value="{{ $state->id }}" @if(Auth::user()->state_id == $state->id) selected @endif >{{ $state->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>



                            @else
                                <div class="col-md-4">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Your Country*</label>
                                        <select class="selectpicker form-control" name="country">
                                            <option selected disabled>Select Country</option>
                                            @if($countries->count())
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" >{{ $country->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Your State / Province*</label>
                                        <select class="selectpicker form-control state" name="state">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Your City*</label>
                                        <select class="selectpicker form-control city" name="city">
                                        </select>
                                    </div>
                                </div>



                            @endif
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Short Bio (150 Words)</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>

                           <!-- <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Business Description(400-500 Words)</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Firm/Company Registration Number</label>
                                    <input class="form-control" placeholder="" type="text">
                                </div>
                            

                            <div class="col-md-12">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label">Type Of Firm/Company</label>
                                    <select class="selectpicker form-control">
                                        <option value="india" selected></option>
                                        <option value="Pvt"> Sole Propritorship </option>
                                        <option value="Ltd"> Partnership </option>
                                         <option value="LLP"> Limited Liability Partnership(LLP) </option>
                                           <option value="LLP"> Limited Liability Companies (LLC) </option>
                                          <option value="Ltd"> Private Limited Company</option>
                                         <option value="LLP"> Public Limited Company</option>
                                        <option value="LLP"> Registered outside India</option>
                                        <option value="LLP"> Not Registered</option>
                                        <option value="LLP"> Other</option>
                                        
                                    </select>
                                </div>
                            </div>

                            

                           


                        </div>
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">Save & Next</button>
                    </form>
                    <!-- end form -->
                </div>
            </div>
        </div>
        <!-- End Main Content -->
    </div>
</div>

@endsection