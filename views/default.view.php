<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="icon" href="views/img/template/icono-negro.png">

 <!-- =============================================
 =                   CSS                   =
 ============================================= -->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. -->
    <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="views/plugins/iCheck/all.css">
    <!-- Custon Css -->
    <link rel="stylesheet" href="views/css/custom.css">
    <!-- ============  End of CSS  ============= -->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- =============================================
  =                   scripts                   =
  ============================================= -->
    <!-- jQuery 3 -->
    <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>    
    <!-- FastClick -->
    <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="views/dist/js/demo.js"></script> -->

    <!-- DataTables -->
    <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
    
    <!-- sweetalert2 -->
    <script src="views/plugins/sweetalert2/sweetalert2.js"></script>

    <!-- iCheck 1.0.1 -->
    <script src="views/plugins/iCheck/icheck.min.js"></script>
  <!-- ============  End of scripts  ============= -->
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini <?= isset($_SESSION["logged"]) && $_SESSION["logged"]=="ok" ? "":"login-page"?>">
  
  
  <?php
    if(isset($_SESSION["logged"]) && $_SESSION["logged"]== "ok"){


    if (isset($_SESSION['user'])) {
      $name = $_SESSION['user']["name"];
      $userName = $_SESSION['user']["userName"];
      $avatar = (empty($_SESSION['user']["avatar"]) ? 'views/img/users/default/anonymous.png' : $_SESSION['user']["avatar"]);
    } else {
      $name = 'Anonymous';
      $userName = 'Anonymous';
      $avatar = 'views/img/users/default/anonymous.png';
    };            


      // <!-- Site wrapper -->
      echo "<div class='wrapper'>";

      /*=============================================
      =                   HEADER                    =
      =============================================*/
      include "views/modules/header.module.php";
  
  
      /*=============================================
      =                   SIDEBAR                   =
      =============================================*/
      include "views/modules/sidebar.module.php";
  
  
      /*=============================================
      =                  CONTENT                    =
      =============================================*/
      if(isset($_GET["ruta"])){
  
        if($_GET["ruta"] == "inicio" ||
           $_GET["ruta"] == "usuarios" ||
           $_GET["ruta"] == "categorias" ||
           $_GET["ruta"] == "productos" ||
           $_GET["ruta"] == "clientes" ||
           $_GET["ruta"] == "ventas" ||
           $_GET["ruta"] == "crear-venta" ||
           $_GET["ruta"] == "reportes" ||
           $_GET["ruta"] == "salir"){
  
          include "views/modules/".$_GET["ruta"].".module.php";
  
        }else{
  
          include "views/modules/404.module.php";
  
        }
  
      }else{
  
        include "views/modules/inicio.module.php";
  
      }
  
      include "views/modules/footer.module.php";
  
      echo "</div>";
      // <!-- ./wrapper -->
    }else {
      include "views/modules/login.module.php";
    }

  ?>

<script src="views/js/custom.js"></script>
<script src="views/js/users.js"></script>
<script src="views/js/categories.js"></script>
<script src="views/js/products.js"></script>
</body>
</html>
