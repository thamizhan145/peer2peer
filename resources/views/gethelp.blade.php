<!DOCTYPE html>
<html lang="en" ng-app="p2p">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

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
                            <a href="login"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="/dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="/account"><i class="fa fa-fw fa-bar-chart-o"></i> Account</a>
                    </li>
                    <li>
                        <a href="/providehelp"><i class="fa fa-fw fa-table"></i> Provide Help</a>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-fw fa-edit"></i> Get Help</a>
                    </li>
                    <li>
                        <a href="/myreferrerals"><i class="fa fa-fw fa-desktop"></i>My Referrerals</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" ng-controller="HelpCtrl">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Get Help
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row" ng-show="getHelpAcceptMsg">
                    <div class="jumbotron">
                        <p>By clicking the Submit button,<br />
I confirm that I agree with the Terms and conditions of This community. Else, Click the Cancel button to exit.</p>
                        <button ng-click="getHelp()" class="btn btn-primary btn-lg" role="button">Submit</button>
                        <button class="btn btn-default btn-lg" role="button">Cancel</button>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="panel panel-info" ng-show="pay_confirm">
                            <div class="panel-heading">
                                <h4 class="panel-title">PAYER 1</h4>
                            </div>
                            <div class="panel-body">
                                <p>
                                    PAYER’S NAME : xxxx <br />
                                    PHONE NUMBER : xxxx<br />                                
                                </p>
                                <div>
                                    <a href="#">View Receipt</a>
                                </div>

                                <div ng-show="received1">
                                    <p>
                                        Did you receive the money ?
                                        <button type="button" ng-click="received1_y()" class="btn btn-info">Yes</button>
                                        <button type="button" ng-click="received1_n()" class="btn btn-default">No</button>                                        
                                    </p>

                                </div>

                                <div ng-show="r1_y" class="alert alert-success">
                                    <span>You have confirmed</span>
                                </div>

                                <div ng-show="r1_n" class="alert alert-danger">
                                    <span>You have Declined!</span>
                                </div>



                            </div>
                        </div>                        
                    </div>

                    <div class="col-md-4">
                        <div class="panel panel-info" ng-show="pay_confirm">
                            <div class="panel-heading">
                                <h4 class="panel-title">PAYER 2</h4>
                            </div>
                            <div class="panel-body">
                                <p>
                                    PAYER’S NAME : xxxx <br />
                                    PHONE NUMBER : xxxx<br />                                
                                </p>
                                <div>
                                    <a href="#">View Receipt</a>
                                </div>

                                <div ng-show="received2">
                                    <p>
                                        Did you receive the money ?
                                        <button type="button" ng-click="received2_y()" class="btn btn-info">Yes</button>
                                        <button type="button" ng-click="received2_n()" class="btn btn-default">No</button>                                        
                                    </p>
                                </div>

                                <div ng-show="r2_y" class="alert alert-success">
                                    <span>You have confirmed</span>
                                </div>

                                <div ng-show="r2_n" class="alert alert-danger">
                                    <span>You have Declined!</span>
                                </div>
                            </div>
                        </div>                        
                    </div>


                </div>
                    


                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/lib/angular.min.js"></script>
    <script type="text/javascript" src="js/lib/dirPagination.js"></script>
    <script type="text/javascript" src="js/lib/ngDialog.min.js"></script>
    <script type="text/javascript" src="js/lib/spin.min.js"></script>
    <script type="text/javascript" src="js/lib/angular-spinner.min.js"></script>
    <script type="text/javascript" src="js/lib/angular-loading-spinner.js"></script>
    <script type="text/javascript" src="js/lib/angular.min.js"></script>

    <script type="text/javascript" src="js/ctlr/help.js"></script>
    <script type="text/javascript" src="js/app-ng.js"></script>

</body>

</html>
