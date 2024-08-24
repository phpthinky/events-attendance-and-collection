
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
<link rel="apple-touch-icon" sizes="57x57" href="<?=assets_url()?>img/icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?=assets_url()?>img/icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?=assets_url()?>img/icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?=assets_url()?>img/icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?=assets_url()?>img/icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?=assets_url()?>img/icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?=assets_url()?>img/icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?=assets_url()?>img/icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?=assets_url()?>img/icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?=assets_url()?>img/icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=assets_url()?>img/icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?=assets_url()?>img/icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=assets_url()?>img/icon/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

    <title>Student Organization Collections and Events Monitoring Sytem</title>

    <!-- Bootstrap -->
    <link href="<?=base_url()?>/template/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>/template/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url()?>/template/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">

    <?php if (isset($hasCharts)): ?>
      
    <!-- iCheck -->
    <link href="<?=base_url()?>/template/gentelella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- dropzone upload -->
    <link href="<?=base_url()?>/template/gentelella/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="<?=base_url()?>/template/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?=base_url()?>/template/gentelella/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?=base_url()?>/template/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <?php elseif(isset($hasTable)): ?>
   
    <?php endif ?>

    <link href="<?=base_url()?>/template/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css"></link>

    <!-- Custom Theme Style -->
    <link href="<?=base_url()?>/template/gentelella/build/css/custom.min.css" rel="stylesheet">

    <?php include_once('css.php'); ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?=site_url()?>" class="site_title"><img src="<?=base_url('assets/img/org-logo-sidebar.png')?>"></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=base_url('assets/img/user.png')?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?=$this->session->userdata('username') ? $this->session->userdata('username') : 'Juan Dela Cruz'?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=site_url()?>">Login</a></li>
                    </ul>
                  </li>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?=site_url('login/signout')?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
              </ul>

            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="print-header">
            <div class="row">Student Organization Collections of Events and Monitring System</div>
          </div>
          <?php $this->load->view($content); ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right d-none">
            Student Organization Collections of Events and Monitring System <a href="https://phpthinky.net"></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?=base_url()?>/template/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url()?>/template/gentelella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?=base_url()?>/template/gentelella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?=base_url()?>/template/gentelella/vendors/nprogress/nprogress.js"></script>

    <!-- dropzone upload -->
    <script src="<?=base_url()?>/template/gentelella/vendors/dropzone/dist/min/dropzone.min.js"></script>
  
    <!-- Chart.js -->
    <script src="<?=base_url()?>/template/gentelella/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?=base_url()?>/template/gentelella/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?=base_url()?>/template/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <?php if (isset($hasCharts)): ?>
    
    <!-- iCheck -->
    <script src="<?=base_url()?>/template/gentelella/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?=base_url()?>/template/gentelella/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?=base_url()?>/template/gentelella/vendors/Flot/jquery.flot.js"></script>
    <script src="<?=base_url()?>/template/gentelella/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?=base_url()?>/template/gentelella/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?=base_url()?>/template/gentelella/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?=base_url()?>/template/gentelella/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?=base_url()?>/template/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?=base_url()?>/template/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?=base_url()?>/template/gentelella/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?=base_url()?>/template/gentelella/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?=base_url()?>/template/gentelella/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?=base_url()?>/template/gentelella/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?=base_url()?>/template/gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<?php elseif(isset($hasTable)): ?>
   
  

    
    <?php endif ?>    
    <script type="text/javascript" src="<?=base_url('assets')?>/plugins/html5-qrcode/html5-qrcode.min.js"></script>

  <script src="<?=base_url()?>/template/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>/template/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="<?=assets_url()?>plugins/notify/notify.js"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="<?=base_url()?>/template/gentelella/vendors/moment/min/moment.min.js"></script>
    <script src="<?=base_url()?>/template/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?=base_url()?>/template/gentelella/build/js/custom.js"></script>
    <!-- -->
    <script type="text/javascript">
     <?php include_once('js.php') ?>
      <?php $this->load->view('core/js.php'); ?>
    </script>
  </body>
</html>
