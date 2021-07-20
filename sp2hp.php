<!DOCTYPE html>
<html lang="en">
<head>
<?php
  session_start();
  include "config/dbconnect.php";
  include "functions/functions.php";
?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Polres Wajo | Lapor</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body>

<!-- Content Wrapper. Contains page content -->
<div class="container mt-4">

    <!-- Main content -->
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col">
          <h2 class="text-center display-4">Cek Perkara Anda</h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-lg" name="keyword" placeholder="Masukkan Nomor Perkara">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default" name="search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

<?php
          if(isset($_POST['search'])){
            $keyword = htmlspecialchars($_POST['keyword']);
            $query = mysqli_query($conn, "SELECT * FROM perkara WHERE nomorperkara = '$keyword' ORDER BY id DESC LIMIT 1");
            while($rows = mysqli_fetch_array($query)){
          ?>
          <div class="card card-success mt-4">
            <div class="card-header">
              <h4 class="card-title"><?= $rows['nomorperkara']?></h4>
            </div>
            <div class="card-body">
              <?php
                $nomorperkara = $rows['id'];
                $query = mysqli_query($conn, "SELECT * FROM detailperkara WHERE idperkara = '$nomorperkara' ORDER BY terakhirdiubah");
                while($rows = mysqli_fetch_array($query)){
              ?>
              <div class="card card-primary mt-4">
                <div class="card-header">
                  <h4 class="card-title"><?= $rows['level']?></h4>
                </div>
                <div class="card-body">
                  <p>Deskripsi &emsp; &emsp; &nbsp;: <b><?=$rows['deskripsi']?></b></p>
                  <p>Tanggal Buat &emsp;: <b><?=$rows['tanggalbuat']?></b></p>
                </div>
              </div>  
              <?php
                }
              ?>
            </div>
          </div>  
          <?php
            }
          }
?>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>    
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>