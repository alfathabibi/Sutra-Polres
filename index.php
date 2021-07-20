
<!DOCTYPE html>
<html lang="en">
<head>

  <?php
    session_start();
    include "config/dbconnect.php";
    include "functions/functions.php";

    if($_SESSION['login_status'] != true){
      header('location:login.php');
    }

    if(!isset($_GET['module'])){
      if($_SESSION['role'] == '1'){
        header('location:index.php?module=dashboard');
      }
      elseif($_SESSION['role'] == '2'){
        header('location:index.php?module=dashboard');
      }
      elseif($_SESSION['role'] == '3'){
        header('location:index.php?module=dashboard');
      }
    }
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SUTRA Polres</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<style>
  
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <?php
        $notiflapor = 0;
        $notifskck = 0;

        $query = "SELECT * FROM skck WHERE dilihat = 0";
        $result = mysqli_query($conn, $query);
        $notifskck = mysqli_num_rows($result);

        $query = "SELECT * FROM laporan WHERE dilihat = 0";
        $result = mysqli_query($conn, $query);
        $notiflapor = mysqli_num_rows($result);
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php
          if($notiflapor != 0 || $notifskck != 0){
            $countnotif=0
          ?>
          <span class="badge badge-warning navbar-badge">
          <?php
            if($notiflapor != 0){
              $countnotif++;
            }
            if($notifskck != 0){
              $countnotif++;
            }
            echo $countnotif;
          ?>
          </span>
          <?php
          }
          ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php
          if($notiflapor != 0){
          ?>
          <a href="index.php?module=lapor" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?= $notiflapor?> Laporan Baru
          </a>
          <?php
          }
          ?>
          <div class="dropdown-divider"></div>
          <?php
          if($notifskck != 0){
          ?>
          <a href="index.php?module=skck" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?= $notifskck?> SKCK Baru
          </a>
          <?php
          }
          ?>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="#" class="dropdown-item">
          <ion-icon name="person-outline" class="mr-1"></ion-icon> Profil
          </a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item text-danger">
            <ion-icon name="log-in-outline" class="mr-1"></ion-icon> Keluar
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/logo_sutra_wajo.png" alt="AdminLTE Logo" class="brand-image">
      <span class="brand-text font-weight-light"> Polres</span>
    </a>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <?php
            if($_GET['module'] == 'dashboard'){
            ?>
            <a href="index.php?module=dashboard" class="nav-link active">
            <?php
            }else{
            ?>
            <a href="index.php?module=dashboard" class="nav-link">
            <?php
            }
            ?>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Users</li>
          <li class="nav-item menu-open">
            <?php 
              if($_GET['module'] == 'superadmin' || $_GET['module'] == 'adminsp2hp' || $_GET['module'] == 'adminskck' || $_GET['module'] == 'adminlapor') {
            ?>
            <a href="#" class="nav-link active">
            <?php
              }else{
                ?>
            <a href="#" class="nav-link">    
                <?php
              }
            ?>
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php
              if($_SESSION['role'] == 1){
                ?>
                <li class="nav-item">
                <?php
                  if($_GET['module'] == 'superadmin'){
                ?>
                <a href="index.php?module=superadmin" class="nav-link active">
                <?php
                  }else{
                    ?>
                    <a href="index.php?module=superadmin" class="nav-link">
                    <?php
                  }
                ?>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Super Admin</p>
                </a>
              </li>  
                <?php
              }
            ?>
            <?php
              if($_SESSION['role'] == 2 || $_SESSION['role'] == 1){
                ?>
                <li class="nav-item">
                <?php
                  if($_GET['module'] == 'adminsp2hp'){
                ?>
                <a href="index.php?module=adminsp2hp" class="nav-link active">
                <?php
                  }else{
                    ?>
                    <a href="index.php?module=adminsp2hp" class="nav-link">
                    <?php
                  }
                ?>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin SP2HP</p>
                </a>
                </li>  
                <?php
              }
            ?>
            <?php
              if($_SESSION['role'] == 3 || $_SESSION['role'] == 1){
                ?>
                <li class="nav-item">
                <?php
                  if($_GET['module'] == 'adminskck'){
                ?>
                <a href="index.php?module=adminskck" class="nav-link active">
                <?php
                  }else{
                    ?>
                    <a href="index.php?module=adminskck" class="nav-link">
                    <?php
                  }
                ?>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin SKCK</p>
                </a>
                </li>  
                <?php
              }
            ?>
            <?php
              if($_SESSION['role'] == 4 || $_SESSION['role'] == 1){
                ?>
                <li class="nav-item">
                <?php
                  if($_GET['module'] == 'adminlapor'){
                ?>
                <a href="index.php?module=adminskck" class="nav-link active">
                <?php
                  }else{
                    ?>
                    <a href="index.php?module=adminlapor" class="nav-link">
                    <?php
                  }
                ?>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin Lapor</p>
                </a>
                </li>  
                <?php
              }
            ?>    
            </ul>
          </li>
          <li class="nav-header">Fitur</li>
          <?php
              if($_SESSION['role'] == 1){
                ?>
                <li class="nav-item">
                <?php
                  if($_GET['module'] == 'uploadbanner'){
                ?>
                <a href="index.php?module=uploadbanner" class="nav-link active">
                <?php
                  }else{
                    ?>
                    <a href="index.php?module=uploadbanner" class="nav-link">
                    <?php
                  }
                ?>
                  <i class="nav-icon far fa-file"></i>
                  <p>Upload Banner</p>
                </a>
                </li>  
                <?php
              }
            ?>
            <?php
              if($_SESSION['role'] == 2 || $_SESSION['role'] == 1){
                ?>
                <li class="nav-item">
                <?php
                  if($_GET['module'] == 'sp2hp'){
                ?>
                <a href="index.php?module=sp2hp" class="nav-link active">
                <?php
                  }else{
                    ?>
                    <a href="index.php?module=sp2hp" class="nav-link">
                    <?php
                  }
                ?>
                  <i class="nav-icon far fa-file"></i>
                  <p>SP2HP</p>
                </a>
                </li>  
                <?php
              }
            ?>
            <?php
              if($_SESSION['role'] == 3 || $_SESSION['role'] == 1){
                ?>
                <li class="nav-item">
                <?php
                  if($_GET['module'] == 'skck'){
                ?>
                <a href="index.php?module=skck" class="nav-link active">
                <?php
                  }else{
                    ?>
                    <a href="index.php?module=skck" class="nav-link">
                    <?php
                  }
                ?>
                  <i class="nav-icon far fa-file"></i>
                  <p>SKCK</p>
                </a>
                </li>  
                <?php
              }
            ?>
            <?php
              if($_SESSION['role'] == 4 || $_SESSION['role'] == 1){
                ?>
                <li class="nav-item">
                <?php
                  if($_GET['module'] == 'lapor'){
                ?>
                <a href="index.php?module=lapor" class="nav-link active">
                <?php
                  }else{
                    ?>
                    <a href="index.php?module=lapor" class="nav-link">
                    <?php
                  }
                ?>
                  <i class="nav-icon far fa-file"></i>
                  <p>Lapor</p>
                </a>
                </li>  
                <?php
              }
            ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <?php
      if($_GET['module'] == 'superadmin' && $_SESSION['role'] == '1'){
        include "module/superadmin.php";
      }
      elseif($_GET['module'] == 'adminsp2hp' && ($_SESSION['role'] == '1' || $_SESSION['role'] == '2')){
        include "module/adminsp2hp.php";
      }
      elseif($_GET['module'] == 'adminskck' && ($_SESSION['role'] == '1' || $_SESSION['role'] == '3')){
        include "module/adminskck.php";
      }
      elseif($_GET['module'] == 'adminlapor' && ($_SESSION['role'] == '1' || $_SESSION['role'] == '4')){
        include "module/adminlapor.php";
      }
      elseif($_GET['module'] == 'sp2hp' && ($_SESSION['role'] == '1' || $_SESSION['role'] == '2')){
        include "module/sp2hp.php";
      }
      elseif($_GET['module'] == 'skck' && ($_SESSION['role'] == '1' || $_SESSION['role'] == '3')){
        include "module/skck.php";
      }
      elseif($_GET['module'] == 'lapor' && ($_SESSION['role'] == '1' || $_SESSION['role'] == '4')){
        include "module/lapor.php";
      }
      elseif($_GET['module'] == 'dashboard'){
        include "module/dashboard.php";
      }
      elseif($_GET['module'] == 'uploadbanner' && $_SESSION['role'] == '1'){
        include "module/uploadbanner.php";
      }
      else{
        include "module/404.php";
      }
    ?>    

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </aside>

</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toast -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- ion icon -->
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- Dashboard -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script>
  $(function () {
    $("#datatable").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": true
    }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<script>
  $(document).ready(function(){
    $(document).on('click', '#detail-modal', function(){
      var iddetail = $(this).data('iddetail');
      var tahapan = $(this).data('tahapan');
      var isi = $(this).data('isi');
      $('#iddetail').val(iddetail);
      $('#tahapanedit').val(tahapan);
      $('#isiedit').val(isi);
    })
  })
</script>

<script>
  $(document).ready(function(){
    $(document).on('click', '#banner-modal1', function(){
      var type_banner = $(this).data('banner');
      $('#type_banner').val(type_banner);
    })
  })
</script>

<script>
  $(document).ready(function(){
    $(document).on('click', '#banner-modal2', function(){
      var type_banner = $(this).data('banner');
      $('#type_banner').val(type_banner);
    })
  })
</script>

<script>
  $(document).ready(function(){
    $(document).on('click', '#banner-modal3', function(){
      var type_banner = $(this).data('banner');
      $('#type_banner').val(type_banner);
    })
  })
</script>

<script>
  $(document).ready(function(){
    $(document).on('click', '#banner-modal4', function(){
      var type_banner = $(this).data('banner');
      $('#type_banner').val(type_banner);
    })
  })
</script>

<script>
  $(document).ready(function(){
    $(document).on('click', '#banner-modal5', function(){
      var type_banner = $(this).data('banner');
      $('#type_banner').val(type_banner);
    })
  })
</script>


<script>
  $(document).ready(function(){
    $(document).on('click', '#detail-laporan', function(){
      var identitas = $(this).data('identitas');
      var nama = $(this).data('nama');
      var nohp = $(this).data('nohp');
      var alamat = $(this).data('alamat');
      var email = $(this).data('email');
      var isilaporan = $(this).data('isi');
      var imageSrc = $(this).data('foto');
      $('#no_identitas').val(identitas);
      $('#nama_lengkap').val(nama);
      $('#no_hp').val(nohp);
      $('#alamat').val(alamat);
      $('#email').val(email);
      $('#isilaporan').val(isilaporan);
      var a = document.getElementById('foto_laporan');
      a.setAttribute("href",imageSrc);
    })
  })
</script>
</body>
</html>
