



<?php
session_start(); 


require '../functions/controller.php';

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
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" type="text/css" href="../css/amarin.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Accounts

          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Accounts</a></li>
            <li class="active">User Accounts </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-add">
                    <i class="fa fa-plus"></i>&nbsp ADD USER
                  </button>
                </div>


                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"></h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Contact Number</th>
                          
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        echo UserTable();
                    
                        ?>

                      </tbody>
                      <tfoot>
                        <tr>
                          <th>ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Contact Number</th>
                          
                          <th>Actions</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Create the tabs -->
          <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
              <h3 class="control-sidebar-heading">Recent Activity</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                      <p>Will be 23 on April 24th</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-user bg-yellow"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                      <p>New phone +1(800)555-1234</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                      <p>nora@example.com</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                      <p>Execution time 5 seconds</p>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- /.control-sidebar-menu -->

              <h3 class="control-sidebar-heading">Tasks Progress</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Custom Template Design
                      <span class="label label-danger pull-right">70%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Update Resume
                      <span class="label label-success pull-right">95%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Laravel Integration
                      <span class="label label-warning pull-right">50%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Back End Framework
                      <span class="label label-primary pull-right">68%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
              <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Report panel usage
                    <input type="checkbox" class="pull-right" checked>
                  </label>

                  <p>
                    Some information about this general settings option
                  </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Allow mail redirect
                    <input type="checkbox" class="pull-right" checked>
                  </label>

                  <p>
                    Other sets of options are available
                  </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Expose author name in posts
                    <input type="checkbox" class="pull-right" checked>
                  </label>

                  <p>
                    Allow the user to show his name in blog posts
                  </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Show me as online
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Turn off notifications
                    <input type="checkbox" class="pull-right">
                  </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Delete chat history
                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                  </label>
                </div>
                <!-- /.form-group -->
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
        </aside>
        <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->



  <!-- *******************************************************************************************************************-->
  <!--                                           MODAL                                                            -->
  <!--********************************************************************************************************************-->


  
  <div class="modal modal-warning fade" id="modal-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">ADD USER</h4>
          </div>
          <div class="modal-body">
            <div class="box-body">
              <form role="form" method="post">

                <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name" name="first_name" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name" name="last_name" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Contact Number</label>
                  <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="contact_number" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1"> Confirm Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password2" required="">
                </div>
                <?php echo Add_User();?>

              </div>
            </div>
            <div class="modal-footer">
              <button  class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              <button  class="btn btn-outline" type="submit" name="add_user">Save changes</button>
            </div>

          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal modal-danger fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">DELETE USER</h4>
            </div>
            <div class="modal-body">
              <p><h3>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Are You Sure To Delete This Record?</h3></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Yes</button>
              <button type="button" class="btn btn-outline">No</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




      <!-- jQuery 3 -->
      <script src="../bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- DataTables -->
      <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <!-- SlimScroll -->
      <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
      <!-- FastClick -->
      <script src="../bower_components/fastclick/lib/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="../dist/js/adminlte.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="../dist/js/demo.js"></script>
      <!-- page script -->
      <script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
        })
      </script>

    </body>
    </html>
