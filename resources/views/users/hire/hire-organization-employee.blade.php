@extends('layouts.app-users')

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
                        <h6 class="title">Employee Details</h6>
                    </div>
                    <div class="ui-block-content">
                        <!-- form -->
                        <form action="{{ route('hire.hireOrganizationEmployeeDetail') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">First Name*</label>
                                        <input class="form-control" placeholder="" value="{{ old('first_name') }}" name="first_name" type="text">
                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('first_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Last Name*</label>
                                        <input class="form-control" placeholder="" value="{{ old('last_name') }}" name="last_name" type="text">
                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label">Profile </label>
                                        <input class="form-control" placeholder=""  name="profile" type="file">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Role*</label>
                                        <input class="form-control" name="role" placeholder="" value="{{ old('role') }}" type="text">
                                        @if ($errors->has('role'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('role') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label"> Mobile Number *</label>
                                        <input class="form-control" placeholder="" name="phone_number" value="{{ old('phone_number') }}" type="text">
                                        @if ($errors->has('phone_number'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label"> Aadhar Id  </label>
                                        <input class="form-control" placeholder="" value="{{ old('aadhar_id') }}" type="text" name="aadhar_id">
                                        @if ($errors->has('aadhar_id'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('aadhar_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label"> Email Address  </label>
                                        <input class="form-control" placeholder="" type="text" value="{{ old('email') }}" name="email">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>



                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your Country</label>
                                            <select class="selectpicker form-control" name="country"  data-live-search="true">
                                                <option selected disabled>Select Country</option>
                                                @if($countries->count())
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" >{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('country'))
                                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('country') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your State / Province</label>
                                            <select class="selectpicker form-control state" data-live-search="true" name="state">
                                            </select>
                                            @if ($errors->has('state'))
                                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('state') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label">Your City</label>
                                            <select class="selectpicker form-control city  fghfghfghf" name="city" data-live-search="true">
                                            </select>
                                            @if ($errors->has('city'))
                                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('city') }}</strong>
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