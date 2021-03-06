<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user'] == "")
    http_response_code(404);
    include 'functions.php';
    $con = connect1($config);
    if(!$con)die("Database connection aborted");
    $conn = connect($config);
    if(!$conn)die("Database connection aborted");
    $conn1 = connect4($config);
    if(!$conn1)die("Database connection aborted");
    $data= get('homebakers', $conn1, 'id');
    $counter = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Batcave 2.0</title>
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .aler{
        color: red;
        font-weight: 300;
        font-size: 14px;
        float: right;
    }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Batcave v2.0</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">                          
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i></i> <?php echo $_SESSION['user']['name']; ?></a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">                      
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> FTI Forms<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="fb_invites.php">FB Invits <span class="aler"><?php 
                                       if(countnum('Fb_data', $conn, 'f_status')!=0)
                                            echo countnum('Fb_data', $conn, 'f_status');
                                    ?></span></a>
                                </li>
                                <li>
                                    <a href="contact.php">Contact <span class="aler"><?php 
                                        if(countnum('contact', $conn, 'status')!=0)
                                            echo countnum('contact', $conn, 'status');
                                    ?></span></a>
                                </li>
                                <li>
                                    <a href="advertisement.php">Advertisement <span class="aler"><?php 
                                        if(countnum('adv', $conn, 'status')!=0)
                                            echo countnum('adv', $conn, 'status');
                                    ?></span></a>
                                </li>
                                <li>
                                    <a href="bad_customer.php">Bad Customer <span class="aler"><?php 
                                        if(countnum('bad', $con, 'status')!=0)
                                            echo countnum('bad', $con, 'status');
                                    ?></span></a>
                                </li>
                                <li>
                                    <a class="active" href="event_data.php">Event data</a>
                                </li>
                                <li>
                                    <a href="handriks.php">Handricks Gin</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> FTP Forms<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                        <a href="homebaker.php">Hombakers form</a>
                                    </li>
                                    <li>
                                    <a href="foodtruck.php">Food Trucks form</a>
                                </li>
                                <li>
                                    <a href="res.php">Restaurant form</a>
                                </li>
                                <li>
                                    <a href="app_data.php">App Data</a>
                                </li>
                                <li>
                                    <a href="app_request.php">App Request</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> MasterChef<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="mc1.php">Contest1</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                                <a href="#"><i class="fa fa-files-o fa-fw"></i>Delhi Live<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                <li>
                                        <a href="delhiliveapplication.php"> new application form</a>
                                    </li>
                                    <li>
                                        <a href="delhi_live.php">Form1</a>
                                    </li>
                                    <li>
                                        <a href="contact_dl.php">Contact Info</a>
                                    </li>
                                    <li>
                                        <a href="application_delhilive.php">Application Form</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="vendors.php">Vendor Managment</a>
                            </li>
                            <li>
                                <a href="media.php">Media Managment</a>
                            </li>
                            <li>
                                <a href="bloggers.php">Bloggers Managment</a>
                            </li>
                            <li>
                                <a href="influencer.php">Influencer Managment</a>
                            </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Events data
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Food Talk Id</th>
                                            <th>Establishment Name</th>
                                            <th>Establishment type</th>
                                            <th>Contact Number</th>
                                            <th>Website</th>
                                            <th>Address</th>
                                            <th>Cusine</th>
                                            <th>Dine in</th>
                                            <th>Take Away</th>
                                            <th>Delivery</th>
                                            <th>Cost for Two</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($data){
                                        foreach ($data as $key) { 
                                        ?>
                                        <tr>
                                            <td><?php echo $counter; ?></td>
                                            <td><?php echo $key['name']; ?></td>
                                            <td><?php echo $key['phone']; ?></td>
                                            <td><?php echo $key['email'] ?></td>
                                            <td><?php echo $key['foodtalkid'] ?></td>
                                            <td><?php echo $key['e_name'] ?></td>
                                            <td><?php echo $key['type']; ?></td>
                                            <td><?php echo $key['e_phone']; ?></td>
                                            <td><?php echo $key['website']; ?></td>
                                            <td><?php echo $key['address']; ?></td>
                                            <td><?php echo $key['cusine']; ?></td>
                                            <td><?php echo $key['dinein']; ?></td>
                                            <td><?php echo $key['takeaway']; ?></td>
                                            <td><?php echo $key['dilivery']; ?></td>
                                            <td><?php echo $key['cost']; ?></td>
                                            <td><?php echo $key['remarks']; ?></td>
                                        </tr>
                                        <?php 
                                            $counter++;
                                        }} ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                 <!-- /.col-lg-12 -->
            </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    
</body>
</html>
