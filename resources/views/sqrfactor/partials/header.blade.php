<nav class="navbar navbar-toggleable-sm navbar-light fixed-top">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="logo" />
        </a>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav navbar-nav-main m-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">How it Works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FAQ's</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>

            <ul class="navbar-nav navbar-nav-login">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url("login?active=signup") }}"><i class="fa fa-user-plus"></i> &nbsp; Sign Up</a>
                    </li>`
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url("login?active=login") }}"><i class="fa fa-sign-in"></i> &nbsp; Login</a>
                    </li>
            </ul>


        </div>
    </div>
</nav>
<div class="navbar-spacer"></div>

