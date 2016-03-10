<?php
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user'] == "")
     http_response_code(404);


                    include 'functions.php';

                    $con = connect1($config);

                    if(!$con)die("Database connection aborted");
                    $conn = connect($config);
                    if(!$conn)die("Database connection aborted");

                    $result = get('collected_data', $con, 'id');
                    $data = 0;
                    if($result!= NULL){
                        foreach ($result as $k) {
                            $data++;
                        }
                    }

    $url = "http://foodtalkplus.com/forms/2/API/save.api.php";
    //  Initiate curl
    $ch = curl_init();
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);

    // Will dump a beauty json :3
    $ftp= json_decode($result, true);


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Baatcave 2.0</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .facebook{
            background-color: #3b5998 !important;
            color: #ffffff;
        }
        .twitter{
            background-color: #1dcaff !important;
            color: #ffffff;
        }
        .insta{
            background-color: #3f729b !important;
            color: #ffffff;
        }
        .mailchimp{
            background-color: #febe12 !important;
            color: #ffffff;
        }
        .ftp{
            background-color: #db3a12 !important;
            color: #ffffff;
        }
        .fti{
            background-color: #212121 !important;
            color: #ffffff;
        }
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
               
               <!--  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts notification">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        
                    </ul>
                     /.dropdown-alerts
                </li> --> 
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['user']['name']; ?></a>
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
                        
                        <li  class="active">
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
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
                                    <a href="event_data.php">Event data</a>
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
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="panel facebook">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-facebook fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge" id="result-like">
                                            <?php
						function getFacebookDetails($url){
						        $source_url = 'https://www.facebook.com/foodtalkindia';
							$rest_url = "http://api.facebook.com/restserver.php?format=json&method=links.getStats&urls=".urlencode($source_url);
							$json = json_decode(file_get_contents($rest_url),true);
						return $json;
						}
						$data1 = getFacebookDetails("http://mycodingtricks.com/html5/html5-inline-edit-with-mysql-php-jquery-and-ajax/");
						
						$likes  = $data1[0]['like_count'];
						echo $likes;
						?>
                                        </div>
                                        <div>Facebook</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="panel insta">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-instagram fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                                require 'Instagram.php';
                                                use MetzWeb\Instagram\Instagram;
                                                $instagram = new Instagram('4fb089cf7e8b4244a17b8e3080ed4f20');
                                                $result = $instagram->getUser(359128846);
                                                $res = (array) $result;
                                                echo $res['data']->counts->followed_by;
                                            ?>
                                        </div>
                                        <div>Instagram</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="panel twitter">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-twitter fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php   
                                                //step1
                                                $curl = curl_init(); 
                                                //step2
                                                curl_setopt($curl,CURLOPT_URL,"http://api.twittercounter.com/?twitter_id=1372754112&apikey=26eab4ab5b71bc8892c8c64164294467");
                                                curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                                                curl_setopt($curl,CURLOPT_HEADER, false); 
                                                //step3
                                                $twr=curl_exec($curl);
                                                curl_close($curl);
                                                //step4
                                                $tw = json_decode($twr, true);
                                                //step5
                                                echo $tw['followers_current'];
                                                ?>
                                        </div>
                                        <div>Twitter</div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="panel fti">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa  fa-cutlery fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $data; ?></div>
                                        <div>Food Talk India</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="panel ftp">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-mobile-phone fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $ftp; ?></div>
                                        <div>Food Talk Plus</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="panel mailchimp">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-envelope fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php   
                                            //step1
                                                $url = "https://us11.api.mailchimp.com/3.0/lists/4b6d309d13?apikey=0f6bb07f190a211c30c7012985cf05f7-us11";
                                                $ch = curl_init();
                                                // Disable SSL verification
                                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                                // Will return the response, if false it print the response
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                // Set the url
                                                curl_setopt($ch, CURLOPT_URL,$url);
                                                // Execute
                                                $mailc=curl_exec($ch);
                                                // Closing
                                                curl_close($ch);
                                                $mi = json_decode($mailc);
                                                echo $mi->stats->member_count;
                                            ?>
                                        </div>
                                        <div>Mail Chimp</div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notifications Panel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-warning fa-fw"></i> Server Not Responding
                                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-money fa-fw"></i> Payment Received
                                    <span class="pull-right text-muted small"><em>Yesterday</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>
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

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
<script data-rocketsrc="http://connect.facebook.net/en_US/all.js" type="text/rocketscript"></script>


    
    

</body>

</html>