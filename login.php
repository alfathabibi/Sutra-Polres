<!DOCTYPE html>
<html lang="en">
<head>
<?php
  session_start();
  include "config/dbconnect.php";
?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Polres Wajo | Masuk</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">


<div class="login-box">
<?php
  if(isset($_POST['submit'])){
    $username = htmlspecialchars($_POST['username']);
    $password = md5(htmlspecialchars($_POST['password']));

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password' LIMIT 1";
    $select =  mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($select);
    if (!empty($user)){
      $_SESSION['id_user'] = $user['id'];
      $_SESSION['role'] = $user['role']; 
      $_SESSION['login_status'] = true;

      if($user['role'] == 1){
        echo " <script>window.location.href='index.php?module=dashboard'</script> ";
      }
      elseif($user['role'] == 2){
        echo " <script>window.location.href='index.php?module=dashboar'</script> ";
      }
      elseif($user['role'] == 3){
        echo " <script>window.location.href='index.php?module=dashboard'</script> ";
      }
    }
    else{
      ?>
      
      <div class="alert alert-danger">
        <center><strong>Maaf!</strong> Username & password anda salah. tolong ulangi!</center>
      </div>

      <?php
    }
  }
?>
  <div class="login-logo">
    <img src="dist/img/logo_sutra_wajo.png" class="img-fluid" style="width: 150px; heigh: 150px">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Selamat datang ! <br> <b> Sistem Unggulan dan Transaparan Polres </br> </p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Ingat saya
              </label>
            </div>
          </div>
        </div>
        <div class="social-auth-links text-center mb-3">
          <button type="submit" class="btn btn-primary btn-block" name="submit"> Masuk </button>
        </div>
      </form>
      <p class="mb-1">
        <a href="forgot-password.html">Lupa password?</a>
      </p>

      <div class="container-fluid text-center mb-3">
        <p>- ATAU -</p>
        <a href="sp2hp.php" class="btn btn-success">
          Cek Perkara
        </a>
        <a href="skck.php" class="btn btn-secondary">
          SKCK
        </a>
        <a href="lapor.php" class="btn btn-danger">
          Buat Laporan
        </a>
      </div>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
