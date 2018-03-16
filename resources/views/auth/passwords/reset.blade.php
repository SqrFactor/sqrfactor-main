<!DOCTYPE html>
<html>
<head>
    @include('sqrfactor.partials.head')
</head>
<body class="login-page" data-base="http://localhost:8000/">
<!-- header -->

<div class="container">

    <div class="clearfix">
        <div class="header-landing header-login">
            <a href="{{ route('login') }}" class="logo">
                <img src="{{ asset('assets/images/logo.jpg') }}" alt="" />
            </a>
        </div>
    </div>
</div>
<div class="container">



    <div class="col-lg-8 pull-right reset_password" >
        <div class="panel panel-default">
            <div class="panel-heading"><h3>Reset Password</h3></div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success" style="width:400px; ">
                        <strong>Success!</strong> {{ session('status') }}
                    </div>

                @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                         <div class="row">

                             <div class="col-md-6">
                                {{-- <label for="email" class="col-md-4 control-label">E-Mail</label>--}}
                                 <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email">

                                 @if ($errors->has('email'))
                                     <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                    </span>
                                 @endif
                             </div>
                         </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6">
                                {{--<label for="email" class="col-md-4 control-label">Password</label>--}}
                                <input id="password" type="password" placeholder="Password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6">
                                {{--<label for="email" class="col-md-4 control-label">Confirm Password</label>--}}
                                <input id="password_confirmation" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" >

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>

</div>
@include('sqrfactor.partials.footer-script')


</body>
</html>

