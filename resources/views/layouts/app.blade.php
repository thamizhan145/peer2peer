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
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
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
                    <a class="" href="{{ url('/') }}">
                        <!-- {{ config('app.name', '1helpzone') }} -->
                        <img style="margin: 5px; max-width: 30%;" src="/images/logo.png"/>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
<!--                     <ul class="nav navbar-nav">
                        &nbsp;
                    </ul> -->

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
<!--                             <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                            <li><a href="/">Dashboard</a></li>
                            <!-- <li><a href="/account">Account</a></li> -->
                            <li><a href="/gethelp">Get Help</a></li>
                            <li><a href="/providehelp">Provide Help</a></li>
                            @if(Auth::user()->role)
                                <li><a href="/matching">Matching</a></li>
                                <li><a href="/users">Users List</a></li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ ucfirst(Auth::user()->fname) }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    
                                    <li>
                                        <a href="/myprofile">My Profile</a>
                                    </li>

                                    <li>
                                        <a href="/myrefs">My Referrals</a>
                                    </li>

                                    <li>
                                        <a href="/account">My Account</a>
                                    </li>

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
                <span>
                    <a type="button" data-toggle="modal" onClick="setuser({{ Auth::user()->id }})" data-target="#suspended_model" title="Send Email to Support" style="cursor: pointer;">Send Email</a>
                </span>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="suspended_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mail to Support</h4>
                  </div>
                  <div class="modal-body">

                    <form class="form-group">
                        {{csrf_field()}}
                        <input type="hidden" name="Uid" id="Uid">
                        <label for="msg">Your Message</label>
                        <div class="form-group">
                            <textarea id="msg" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="button" id="submit_sus" class="btn btn-primary">Submit</button>                
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                            <span style="display: none;"  class="alert alert-success" role="alert" id="Msg_Sucess">Mail Successfully!!</span>
                            <span style="display: none;"   class="alert alert-danger" role="alert" id="Msg_Failure">Problem with Sending E-Mail!!</span>
                        </div>


                    </form>
                  </div>

                </div>
              </div>
            </div>
        @else
            @yield('content')
        @endif
    </div>
    
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
    <script src="/js/jquery-1.12.4.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap.min.js"></script>
    <script src="/js/dataTables.responsive.min.js"></script>
    <script src="/js/responsive.bootstrap.min.js"></script>

    <script src="/js/japp.js"></script>

    <!-- Scripts -->
    <!-- <script src="/js/app.js"></script> -->

    <script type="text/javascript" src="/js/angular.min.js"></script>
    <script type="text/javascript" src="/js/dirPagination.js"></script>
    <script type="text/javascript" src="/js/ngDialog.min.js"></script>
    <script type="text/javascript" src="/js/spin.min.js"></script>
    <script type="text/javascript" src="/js/angular-spinner.min.js"></script>
    <script type="text/javascript" src="/js/angular-loading-spinner.js"></script>

    <script type="text/javascript" src="/js/ctlr/help.js"></script>
    <script type="text/javascript" src="/js/app-ng.js"></script>
</body>
</html>
