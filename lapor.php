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

<?php
    if(isset($_POST['submit'])){
        $noidentitas = htmlspecialchars($_POST['no_identitas']); 
        $namalengkap = htmlspecialchars($_POST['nama_lengkap']);
        $nohp = htmlspecialchars($_POST['no_hp']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $email = htmlspecialchars($_POST['email']);
        $isilaporan = htmlspecialchars(addslashes($_POST['isi_laporan']));

        $file = '';
        if(!$_FILES['uploadfile']['error'] == 4){
        $file = upload();
        }

        if($file === 'gagal'){
        echo "<script>window.alert('Laporan gagal dibuat !')
        window.location='lapor.php'</script>";
        die();
        }

        $query = mysqli_query($conn, "INSERT INTO laporan (`id`, `identitas`, `namalengkap`, `nohp`, `alamat`, `email`, `isilaporan`, `foto`) VALUES (NULL,'$noidentitas','$namalengkap','$nohp','$alamat','$email','$isilaporan','$file')");
        
        if(mysqli_affected_rows($conn) > 0){
            echo "<script>window.alert('Laporan berhasial dibuat')
            window.location='lapor.php'</script>";
          }else{
           echo "<script>window.alert('Laporan gagal dibuat')
            window.location='lapor.php'</script>";    
          }

    }
?>
<!-- Content Wrapper. Contains page content -->
<div class="container mt-4">

    <!-- Main content -->
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <h2 class="text-center display-6">Cek Laporan Anda</h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-md" name="keyword" placeholder="Masukkan Nomor Identitis">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-md btn-default" name="search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <?php
            if(!isset($_POST['search'])){
            ?>
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Formulir Lapor Polisi</h4>
              </div>
              <div class="card-body">
                <!-- form start -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Identitas</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="NIK/SIM/KITAS" name="no_identitas" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. HP</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="No. HP" name="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Isi</label>
                            <textarea class="form-control" rows="10" placeholder="Isi Laporan" name="isi_laporan" required></textarea>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Unggah Berkas</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="uploadfile">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Unggah</span>
                                </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
                <!-- /.card -->                    
              </div>
            </div>
            <?php
            } 
            else{
              $keyword = htmlspecialchars($_POST['keyword']);
              $query = mysqli_query($conn, "SELECT * FROM laporan WHERE identitas LIKE '%$keyword%' ORDER BY id");
              while($rows = mysqli_fetch_array($query)){
              ?>
              <div class="card card-primary mt-4">
                <div class="card-header">
                  <h4 class="card-title">Status Laporan</h4>
                </div>
                <div class="card-body">
                  <p>Nama &emsp; &emsp; &emsp; &emsp; &emsp; : <b><?=$rows['namalengkap']?></b></p>
                  <p>No. KTP &emsp; &emsp; &emsp; &emsp; &nbsp; : <b><?=$rows['identitas']?></b></p>
                  <p>Tanggal Pengajuan &nbsp; &nbsp;: <b><?=$rows['tanggal']?></b></p>
                  <p>Status &emsp; &emsp; &emsp; &emsp; &emsp; : 
                    <b class="<?php
                      if($rows['status'] === 'terkirim'){
                        echo "text-warning";
                      }
                      elseif($rows['status'] === 'diproses'){
                        echo "text-primary";
                      }
                      elseif($rows['status'] === 'selesai'){
                        echo "text-success";
                      }
                      elseif($rows['status'] === 'batal'){
                        echo "text-danger";
                      }
                    ?>"><?=$rows['status']?>
                    </b></p>
                    <p>Keterangan &emsp; &emsp; &emsp; &nbsp;: <b><?=$rows['keterangan_status']?></b></p>
                    <p>Isi Laporan &emsp; &emsp; &emsp; &nbsp; : <b><?=$rows['isilaporan']?></b></p>
                </div>
              </div>  
              <?php
              }
            }
            ?>
          </div>
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