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