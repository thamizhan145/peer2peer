
<!-- Navigation -->

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a class="navbar-brand" href="/">Donations</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="/login"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="{{ ($p == 'dashboard') ? 'active' : '' }}"">
                <a href="/dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="{{ ($p == 'account') ? 'active' : '' }}">
                <a href="/account"><i class="fa fa-fw fa-bar-chart-o"></i> Account</a>
            </li>
            <li class="{{ ($p == 'phelp') ? 'active' : '' }}">
                <a href="/providehelp"><i class="fa fa-fw fa-table"></i> Provide Help</a>
            </li>
            <li class="{{ ($p == 'ghelp') ? 'active' : '' }}">
                <a href="/gethelp"><i class="fa fa-fw fa-edit"></i> Get Help</a>
            </li>
            <li class="{{ ($p == 'myref') ? 'active' : '' }}">
                <a href="/myref"><i class="fa fa-fw fa-desktop"></i> My Referrerals</a>
            </li>
            <li class="{{ ($p == 'matching') ? 'active' : '' }}">
                <a href="/matching"><i class="fa fa-fw fa-desktop"></i> Matching</a>
            </li>
        </ul>
    </div>


    <!-- /.navbar-collapse -->
</nav>