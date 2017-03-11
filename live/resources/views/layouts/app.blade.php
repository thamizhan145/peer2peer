<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" ng-app="p2p">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '1helpzone') }}</title>

    <!-- Styles -->
    <link href="/public/css/app.css" rel="stylesheet">
    <link href="/public/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/public/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', '1helpzone') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
<!--                             <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <li><a href="/">Dashboard</a></li>
                            <li><a href="/account">Account</a></li>
                            <li><a href="/gethelp">Get Help</a></li>
                            <li><a href="/providehelp">Provide Help</a></li>
                            @if(Auth::user()->role)
                                <li><a href="/matching">Matching</a></li>
                                <li><a href="/users">Users List</a></li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->fname }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @if(!Auth::guest() && Auth::user()->status == 2)
            <div class="alert alert-danger">
                <span>Your account get suspended!</span>
                <br>
                <span>Please Contact Support!</span>
            </div>
        @else
            @yield('content')
        @endif
    </div>
    
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
    <script src="/public/js/jquery-1.12.4.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/jquery.dataTables.min.js"></script>
    <script src="/public/js/dataTables.bootstrap.min.js"></script>
    <script src="/public/js/dataTables.responsive.min.js"></script>
    <script src="/public/js/responsive.bootstrap.min.js"></script>

    <script src="/public/js/japp.js"></script>

    <!-- Scripts -->
    <!-- <script src="/js/app.js"></script> -->

    <script type="text/javascript" src="/public/js/angular.min.js"></script>
    <script type="text/javascript" src="/public/js/dirPagination.js"></script>
    <script type="text/javascript" src="/public/js/ngDialog.min.js"></script>
    <script type="text/javascript" src="/public/js/spin.min.js"></script>
    <script type="text/javascript" src="/public/js/angular-spinner.min.js"></script>
    <script type="text/javascript" src="/public/js/angular-loading-spinner.js"></script>

    <script type="text/javascript" src="/public/js/ctlr/help.js"></script>
    <script type="text/javascript" src="/public/js/app-ng.js"></script>
</body>
</html>
