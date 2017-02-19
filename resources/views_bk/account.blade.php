<!DOCTYPE html>
<html lang="en" ng-app="p2p">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Peer to Peer - Account</title>

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

    <div id="wrapper" ng-controller="HelpCtrl">

        @include('menu', ['p'=>'account'])


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-9 col-md-9 ">
                        <h1 class="page-header">
                            Account
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-5" ng-show="account_form">
                        <form role="form">
                            <div class="form-group">
                                <label>Account Name</label>
                                <input type="text" class="form-control" placeholder="John" required="" value="John">
                            </div>
                            <div class="form-group">
                                <label>Account No.</label>
                                <input type="text" class="form-control" placeholder="Your Account No" required="" value="04907897987986">
                            </div>

                            <div class="form-group">
                                <label>Account Type</label>
                                <input type="text" class="form-control" placeholder="Saving" required="" value="Saving">
                            </div>


                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" class="form-control" placeholder="Bank Name" required="" value="INT Bank">
                            </div>

                            <button type="button" ng-click="saveAccount()" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>

                        </form>                        
                    </div>

                    <div  class="col-md-5" ng-show="account_info">
                        <p><strong>Account Name : </strong><span>John</span></p>
                        <p><strong>Account No : </strong><span>04907897987986</span></p>
                        <p><strong>Account Type : </strong><span>Saving</span></p>
                        <p><strong>Bank Name : </strong><span>INT Bank</span></p>

                        <button type="button" ng-click="show_edit_account()" class="btn btn-info">Edit</button>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Footer content here.</p>
      </div>
    </footer>


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
