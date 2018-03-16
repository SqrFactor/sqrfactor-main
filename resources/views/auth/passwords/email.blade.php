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

                                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Send Password Reset Link
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

