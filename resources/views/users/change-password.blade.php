@extends('layouts.app-users')

@section('title') Change Password  | SqrFactor @endsection
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
                        <h6 class="title">Change Password</h6>
                    </div>
                    <div class="ui-block-content">
                        <!-- form -->
                        <form action="{{ route('change.password') }}" method="POST">
                            {{ csrf_field()   }}
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label">Old Password</label>
                                        <input class="form-control" placeholder="" name="old_password" type="password" value="">
                                        @if ($errors->has('old_password'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('old_password') }}</strong>
                                        </span>
                                        @endif
                                        @if (Session::has('old_password_wrong'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ Session::get('old_password_wrong') }}</strong>
                                        </span>
                                        @endif
                                        <span class="material-input"></span>
                                    </div>
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label"> New Password</label>
                                        <input class="form-control" placeholder="" name="new_password" type="password" value="">
                                        @if ($errors->has('new_password'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('new_password') }}</strong>
                                        </span>
                                        @endif
                                        <span class="material-input"></span>
                                    </div>
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label"> Confirm Password </label>
                                        <input class="form-control" placeholder="" name="new_password_confirmation" type="password" value="">
                                        @if ($errors->has('new_password_confirmation'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('new_password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                        <span class="material-input"></span>
                                    </div>

                                </div>

                                <div class="col-md-3">
                                </div>



                                <button type="submit" class="btn btn-primary btn-block font-weight-bold">Change</button>


                        <!-- end form -->
                    </div>
                        </form>

                </div>
            </div>
            <!-- End Main Content -->
        </div>
    </div>

@endsection

