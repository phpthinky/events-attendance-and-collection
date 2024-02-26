
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <title>SOE! | </title>

    <!-- Bootstrap -->
    <link href="<?=base_url()?>/template/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>/template/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url()?>/template/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?=base_url()?>/template/gentelella/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url()?>/template/gentelella/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
<?php $this->load->view($content); ?>
    </div>
    <script src="<?=base_url()?>/template/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?=assets_url()?>/plugins/notify/notify.min.js"></script>

    <script type="text/javascript">
      <?php $this->load->view('core/js.php'); ?>

    </script>
  </body>
</html>
