<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PeerToPeer Registration</title>

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

    <div>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="/login">Peer to Peer Donation</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                
            </ul>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Signup
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="/login">

                            <div class="form-group">
                                <label>FirstName</label>
                                <input type="text" class="form-control" placeholder="Your FirstName" required="" value="John">
                            </div>

                            <div class="form-group">
                                <label>LastName</label>
                                <input type="text" class="form-control" placeholder="Your LastName" required="" value="Mathew">
                            </div>

                            <div class="form-group">
                                <label>E-Mail Address</label>
                                <input type="email" class="form-control" placeholder="email@mail.com" required="" value="someemail@gmail.com">
                            </div>

                            <div class="form-group">
                                <label>PhoneNo.</label>
                                <input type="text" class="form-control" placeholder="Your PhoneNo." required="" value="+22424535353553">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="********" required="" value="password">
                            </div>


                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder="********" required="" value="password">
                            </div>


                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" class="form-control" placeholder="Bank Name" required="" value="INT Bank">
                            </div>

                            <div class="form-group">
                                <label>Account No.</label>
                                <input type="text" class="form-control" placeholder="Your Account No" required="" value="04907897987986">
                            </div>

                            <div class="form-group">
                                <label>Bank Account Phone No.</label>
                                <input type="text" class="form-control" placeholder="Phone No." required="" value="+868545666">
                            </div>

                            <div class="form-group">
                                <label>Referrer E-Mail Address</label>
                                <input type="email" class="form-control" placeholder="email@mail.com" required="" value="someemail@gmail.com">
                            </div>



                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>

                        </form>

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

</body>

</html>
