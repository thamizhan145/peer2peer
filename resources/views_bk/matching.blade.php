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
            
            @include('menu', ['p'=>'matching'])


            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" ng-controller="HelpCtrl">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Match Help
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <form name="matchingForm">
                <div class="row">
         
                    <div class="panel panel-info col-md-4">
                        <div class="panel-heading">
                            <h4 class="panel-title">Get Help</h4>
                        </div>
                        <div class="panel-body">

                            <p class="line-brk" ng-repeat="(k1,v1) in getHelpPpl">
                                <input type="checkbox" ng-model="v1[3]"> @{{v1['name']}}
                                (@{{v1['helpNeed']}})
                            </p>


                        </div>
                    </div>

                    <div class="col-md-2">
                        
                    </div>

                    <div class="panel panel-info col-md-4">
                        <div class="panel-heading">
                            <h4 class="panel-title">Provide Help</h4>
                        </div>
                        <div class="panel-body">

                            <p class="line-brk" ng-repeat="(k1,v1) in provideHelpPpl">
                                <input type="checkbox" ng-model="v1[3]"> @{{v1['name']}}
                            </p>

                        </div>
                    </div>






                </div>


                <div class="row">
                    
                    <div class="col-md-3">
                        <button type="submit" ng-click="matchify()" class="btn btn-info">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>

                    <div class="col-md-9">
                        <div ng-show="success_match" class="alert alert-success">
                            <p>
                                <strong>Success!</strong>Help Matched.
                            </p>
                        </div>
                    </div>                    
                </div>

                


                <!-- /.row -->
                </form>
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
