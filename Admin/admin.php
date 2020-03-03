
<?php
session_start(); 
if(!isset($_SESSION["username"]))  
{  
  header("location:../login.php");  
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Brgy Kalipay Birthing InFormation System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
   <!-- Morris chart -->
   <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
   <!-- jvectormap -->
   <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
   <!-- Date Picker -->
   <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue-light sidebar-mini" style="font-size: 14px">
  <div class="wrapper">





    <!-- *******************************************************************************************************************-->
    <!--                                           MAIN HEADER                                                            -->
    <!--********************************************************************************************************************-->
    <header class="main-header">
      <!-- Logo -->
      <a href="admin.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>CT</b>RL</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>CONTROL PANEL</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->


            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               
                <span class="hidden-xs">WELCOME <?php echo strtoupper($_SESSION["username"]);  ?> </span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                

                  <p>
                   <?php echo strtoupper($_SESSION["username"]);  ?>
                   <small><?php echo strtoupper($_SESSION["type"]);  ?> </small>
                 </p>
               </li>
               <!-- Menu Body -->

               <!-- Menu Footer-->
               <li class="user-footer">

                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat" >SIGN OUT</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->





  <!-- *******************************************************************************************************************-->
  <!--                                           MAIN SIDEBAR                                                            -->
  <!--********************************************************************************************************************-->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="admin.php">
            <i class="fa fa-dashboard"></i> <span>ADMIN TOOLS</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li>
        <li>
          <a href="patient.php">
            <i class="fa fa-medkit"></i> <span>PATIENTS</span>
            <span class="pull-right-container">

            </span>
          </a>
        </li>
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>ACCOUNTS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="user_account.php"><i class="fa fa-list-alt"></i> User Accounts</a></li>
            <li><a href="admin_account.php"><i class="fa fa-list-alt"></i>Admin Accounts</a></li>
          </ul>
        </li>


      </section>
      <!-- /.sidebar -->
    </aside>




    <!-- *******************************************************************************************************************-->
    <!--                                           MAIN CONTENT                                                           -->
    <!--********************************************************************************************************************-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          ADMIN TOOLS
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> ADMIN</a></li>
          <li class="active">ADMIN TOOLS</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->

        <!-- Main row -->
        <div class="row">


        </div>
        <!-- /.row (main row) -->



        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Admin </span>
                <?php 
                require('../functions/controller.php'); 
                echo CountAdministrator();?>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-medkit"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Patients</span>
                <?php

                echo CountPatients();  ?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">USERS</span>
                <?php

                echo CountUser();  ?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Requests</span>
                <?php echo CountRequest();?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-add">
          <i class="fa fa-bullhorn"></i>&nbsp MAKE ANNOUNCEMENT
        </button>
        &nbsp &nbsp 
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-add">
          <i class="fa fa-envelope-o"></i> NOTIFY
        </button>


        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">ADMISSION REQUESTS</h3>

                <div class="box-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">

                    <div class="input-group-btn">

                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last_Name</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>

                  <?php Request_tbl(); 
                    ValidRequest();
                    DeleteRequest();
                  ?>


                </tbody>


              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>  


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->








  <!-- *******************************************************************************************************************-->
  <!--                                           MAIN FOOTER                                                            -->
  <!--********************************************************************************************************************-->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

 <!-- jQuery 3 -->



 <script src="../bower_components/jquery/dist/jquery.min.js"></script>
 <!-- Bootstrap 3.3.7 -->
 <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
 <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
 <script src="../bower_components/jquery/dist/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
