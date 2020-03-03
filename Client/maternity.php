
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
  <body class="hold-transition skin-blue-light sidebar-mini">
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
            <a href="client.php">
              <i class="fa fa-dashboard"></i> <span>MY ACCOUNT</span>
              <span class="pull-right-container">

              </span>
            </a>
          </li>

          <li class=" treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>SECTIONS</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="prenatal.php"><i class="fa fa-list-alt"></i> Prental Section</a></li>
              <li><a href="maternity.php"><i class="fa fa-list-alt"></i>Maternity Section</a></li>
            </ul>
          </li>



        </section>
        <!-- /.sidebar -->
      </aside>








      <!-- *******************************************************************************************************************-->
      <!--                                           MAIN CONTENT                                                           -->
      <!--********************************************************************************************************************-->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           MATERNITY SECTION

         </h1>
         <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i>SECTION</a></li>

          <li class="active">MATERNITY</li>
        </ol>
      </section>






      <!-- Main content -->
      <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Personal Information</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->


          <?php
          require("../functions/controller.php");
          echo DisplayUser1();

          ?>


        </div>
      </div>
      <!-- /.row -->




      <!-- SELECT2 EXAMPLE -->







      <div class="box">
        <div class="box-header">

          <h3 class="box-title">MATERNITY PROGRESS</h3>

        </div>

        <!-- /.box-header -->
        <div class="box-body">

          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Date</th>
                <th>Progress Notes</th>
                <th>Actions</th>

              </tr>
            </thead>
            <tbody>

              <?php echo DisplayMaternity1();
              AddProgress(); ?>
            </tbody>



            <tfoot>
              <tr>
                <th>Date</th>
                <th>Progress Notes</th>

                <th>Actions</th>
              </tr>
            </tfoot>
          </table>


        </div>
      </div>






    </section>
    <!-- /.content -->
  </div>





  <!-- *******************************************************************************************************************-->
  <!--                                           MAIN FOOTER                                                            -->
  <!--********************************************************************************************************************-->

  <!-- Control Sidebar -->

  <!-- ./wrapper -->








  <!-- jQuery 3 -->



  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Select2 -->
  <script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="../plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- date-range-picker -->
  <script src="../bower_components/moment/min/moment.min.js"></script>
  <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap datepicker -->
  <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- bootstrap color picker -->
  <script src="../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <!-- bootstrap time picker -->
  <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <!-- SlimScroll -->
  <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="../plugins/iCheck/icheck.min.js"></script>
  <!-- FastClick -->
  <script src="../bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- Page script -->

  <!-- Bootstrap 3.3.7 -->
  <script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
        )

        //Date picker
        $('#datepicker').datepicker({
          autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
          showInputs: false
        })
        $('#datepicker1').datepicker({
          autoclose: true
        })
        $('#datepicker2').datepicker({
          autoclose: true
        })

        $('#datepicker3').datepicker({
          autoclose: true
        })
      })
    </script>


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
