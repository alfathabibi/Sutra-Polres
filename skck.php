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
  <title>Polres Wajo | SKCK</title>

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
    if(isset($_POST['submit1'])){
      
      $pemohon = htmlspecialchars($_POST['pemohon']);
      $keperluan = htmlspecialchars($_POST['keperluan']);
      $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
      $alias = htmlspecialchars($_POST['alias']);
      $tanggal = htmlspecialchars($_POST['tanggal']);
      $ktp = htmlspecialchars($_POST['ktp']);
      $paspor = htmlspecialchars($_POST['paspor']);
      $agama = htmlspecialchars($_POST['agama']);
      $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
      $umur = htmlspecialchars($_POST['umur']);
      $alamat = htmlspecialchars($_POST['alamat']);
      $kedudukan = htmlspecialchars($_POST['kedudukan']);
      $bapak = htmlspecialchars($_POST['bapak']);
      $ibu = htmlspecialchars($_POST['ibu']);
      $pekerjaan = htmlspecialchars($_POST['pekerjaan']);
      $pasangan = htmlspecialchars($_POST['pasangan']);
      $bapak_pasangan = htmlspecialchars($_POST['bapak_pasangan']);
      $ibu_pasangan = htmlspecialchars($_POST['ibu_pasangan']);
      $alamat_pasangan = htmlspecialchars($_POST['alamat_pasangan']);
      $sanak = htmlspecialchars($_POST['sanak']);
      $alamat_sanak = htmlspecialchars($_POST['alamat_sanak']);
      $anak = htmlspecialchars(addslashes($_POST['anak']));
      $rambut = htmlspecialchars($_POST['rambut']);
      $muka = htmlspecialchars($_POST['muka']);
      $kulit = htmlspecialchars($_POST['kulit']);
      $tinggi = htmlspecialchars($_POST['tinggi']);
      $tanda = htmlspecialchars($_POST['tanda']);
      $sidik = htmlspecialchars($_POST['sidik']);
      $sd = htmlspecialchars($_POST['sd']);
      $smp = htmlspecialchars($_POST['smp']);
      $sma = htmlspecialchars($_POST['sma']);
      $st = htmlspecialchars($_POST['st']);
      $hobi = htmlspecialchars(addslashes($_POST['hobi']));
      $catatan_kriminal = htmlspecialchars(addslashes($_POST['catatan_kriminal']));
      $keterangan_lain = htmlspecialchars(addslashes($_POST['keterangan_lain']));
      $progress = "terkirim";

      $query = mysqli_query($conn, "INSERT INTO skck VALUES (NULL,'$pemohon','$keperluan','$nama_lengkap','$alias','$tanggal','$ktp','$paspor','$agama','$tanggal_lahir','$umur','$alamat','$kedudukan','$bapak','$ibu','$pekerjaan','$pasangan','$bapak_pasangan','$ibu_pasangan','$alamat_pasangan','$sanak','$alamat_sanak','$anak','$rambut','$muka','$kulit','$tinggi','$tanda','$sidik','$sd','$smp','$sma','$st','$hobi','$catatan_kriminal','$keterangan_lain','$progress','',NOW(),0)");
  
      if(mysqli_affected_rows($conn) > 0){
          echo "<script>window.alert('Formulir Bagian 1 Berhasil Dibuat Silakan Isi Formulir Bagian 2')
          window.location='skck.php?id=$ktp'</script>";
        }else{
          $error = "Error: " . $query . "<br>" . $conn->error;
		      echo $error;
          //echo "<script>window.alert('Laporan gagal dibuat')
          //window.location='skck.php'</script>";    
      }

    }

    if(isset($_POST['submit2'])){
      $idskck = "";
      $noktp = $_GET['id'];
      $query = mysqli_query($conn, "SELECT id FROM skck WHERE ktp = '$noktp' LIMIT 1");
      while($rows = mysqli_fetch_array($query)){
        $idskck = $rows['id'];
      }

      $nama = htmlspecialchars($_POST['nama']);
      $tempat = htmlspecialchars($_POST['tempat']);
      $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
      $agama = htmlspecialchars($_POST['agama']);
      $kebangsaan = htmlspecialchars($_POST['kebangsaan']);
      $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
      $perkawinan = htmlspecialchars($_POST['perkawinan']);
      $pekerjaan = htmlspecialchars($_POST['pekerjaan']);
      $alamat = htmlspecialchars($_POST['alamat']);
      $ktp = htmlspecialchars($_POST['ktp']);
      $paspor = htmlspecialchars($_POST['paspor']);
      $kitas = htmlspecialchars($_POST['kitas']);
      $hp = htmlspecialchars($_POST['hp']);
      $nama_pasangan = htmlspecialchars($_POST['nama_pasangan']);
      $umur_pasangan = htmlspecialchars($_POST['umur_pasangan']);
      $agama_pasangan = htmlspecialchars($_POST['agama_pasangan']);
      $kebangsaan_pasangan = htmlspecialchars($_POST['kebangsaan_pasangan']);
      $pekerjaan_pasangan = htmlspecialchars($_POST['pekerjaan_pasangan']);
      $alamat_pasangan = htmlspecialchars($_POST['alamat_pasangan']);
      $nama_bapak = htmlspecialchars($_POST['nama_bapak']);
      $umur_bapak = htmlspecialchars($_POST['umur_bapak']);
      $agama_bapak = htmlspecialchars($_POST['agama_bapak']);
      $kebangsaan_bapak = htmlspecialchars($_POST['kebangsaan_bapak']);
      $pekerjaan_bapak = htmlspecialchars($_POST['pekerjaan_bapak']);
      $alamat_bapak = htmlspecialchars($_POST['alamat_bapak']);
      $nama_ibu = htmlspecialchars($_POST['nama_ibu']);
      $umur_ibu = htmlspecialchars($_POST['umur_ibu']);
      $agama_ibu = htmlspecialchars($_POST['agama_ibu']);
      $kebangsaan_ibu = htmlspecialchars($_POST['kebangsaan_ibu']);
      $pekerjaan_ibu = htmlspecialchars($_POST['pekerjaan_ibu']);
      $alamat_ibu = htmlspecialchars($_POST['alamat_ibu']);
      $saudara_kandung = htmlspecialchars(addslashes($_POST['saudara_kandung']));
      $pendidikan = htmlspecialchars(addslashes($_POST['pendidikan']));
      $pidana1 = htmlspecialchars($_POST['pidana1']);
      $pidana2 = htmlspecialchars($_POST['pidana2']);
      $pidana3 = htmlspecialchars($_POST['pidana3']);
      $pidana4 = htmlspecialchars($_POST['pidana4']);
      $pidana5 = htmlspecialchars($_POST['pidana5']);
      $pelanggaran1 = htmlspecialchars($_POST['pelanggaran1']);
      $pelanggaran2 = htmlspecialchars($_POST['pelanggaran2']);
      $pelanggaran3 = htmlspecialchars($_POST['pelanggaran3']);
      $keterangan_lain1 = htmlspecialchars(addslashes($_POST['keterangan_lain1']));
      $keterangan_lain2 = htmlspecialchars(addslashes($_POST['keterangan_lain2']));
      $keterangan_lain3 = htmlspecialchars($_POST['keterangan_lain3']);
      $sponsor1 = htmlspecialchars($_POST['sponsor1']);
      $sponsor2 = htmlspecialchars($_POST['sponsor2']);
      $sponsor3 = htmlspecialchars($_POST['sponsor3']);
      $sponsor4 = htmlspecialchars($_POST['sponsor4']);

      $query = mysqli_query($conn, "INSERT INTO skck2 VALUES (NULL,'$idskck','$nama','$tempat','$tanggal_lahir','$agama','$kebangsaan','$jenis_kelamin','$perkawinan','$pekerjaan','$alamat','$ktp','$paspor','$kitas','$hp','$nama_pasangan','$umur_pasangan','$agama_pasangan','$kebangsaan_pasangan','$pekerjaan_pasangan','$alamat_pasangan','$nama_bapak','$umur_bapak','$agama_bapak','$kebangsaan_bapak','$pekerjaan_bapak','$alamat_bapak','$nama_ibu','$umur_ibu','$agama_ibu','$kebangsaan_ibu','$pekerjaan_ibu','$alamat_ibu','$saudara_kandung','$pendidikan','$pidana1','$pidana2','$pidana3','$pidana4','$pidana5','$pelanggaran1','$pelanggaran2','$pelanggaran3','$keterangan_lain1','$keterangan_lain2','$keterangan_lain3','$sponsor1','$sponsor2','$sponsor3','$sponsor4')");
  
      if(mysqli_affected_rows($conn) > 0){
          echo "<script>window.alert('Formulir Bagian 2 Berhasil Dibuat')
          window.location='skck.php'</script>";
        }else{
          echo "<script>window.alert('Laporan gagal dibuat')
          window.location='skck.php'</script>";    
      }
    }

    
?>
<!-- Content Wrapper. Contains page content -->
<div class="container mt-4">

    <!-- Main content -->
      <div class="container-fluid">
        <div class="row">
          <div class="col">
          <h2 class="text-center display-6">Cek Status Formulir Anda</h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-md" name="keyword" placeholder="Masukkan Nomor KTP">
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
                <h4 class="card-title">Formulir SKCK</h4>
              </div>
              <?php
              if(!isset($_GET['id'])){
              ?>
              <div class="card-body">
                <!-- form start -->
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="card card-primary mt-3">
                    <div class="card-header">
                      <h4 class="card-title">Formulir I</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Nama Pemohon</label>
                        <input type="text" class="form-control" placeholder="Nama Pemohon" name="pemohon" required>
                      </div>
                      <div class="form-group">
                        <label>Keperluan</label>
                        <input type="text" class="form-control" placeholder="Keperluan" name="keperluan" required>
                      </div>
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap" required>
                      </div>
                      <div class="form-group">
                        <label>Alias</label>
                        <input type="text" class="form-control" placeholder="Alias" name="alias" required>
                      </div>
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" placeholder="Tanggal" name="tanggal" required>
                      </div>
                      <div class="form-group">
                        <label>No. KTP / No. Passpor</label>
                        <input type="text" class="form-control" placeholder="No. KTP" name="ktp" required>
                        <input type="text" class="form-control" placeholder="No. Paspor" name="paspor">
                      </div>
                      <div class="form-group">
                        <label>Agama</label>
                        <input type="text" class="form-control" placeholder="Agama" name="agama" required>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Lahir / Umur</label>
                        <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" required>
                        <input type="text" class="form-control" placeholder="Umur" name="umur" required>
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
                      </div>
                      <div class="form-group">
                        <label>Kedudukan Dalam Keluarga</label>
                        <input type="text" class="form-control" placeholder="Kedudukan dalam keluarga" name="kedudukan" required>
                      </div>
                      <div class="form-group">
                        <label>Nama Bapak & Ibu</label>
                        <input type="text" class="form-control" placeholder="Bapak" name="bapak" required>
                        <input type="text" class="form-control" placeholder="Ibu" name="ibu" required>
                      </div>
                      <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="Pekerjaan" name="pekerjaan" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>A. Nama Suami / Istri</label>
                        <input type="text" class="form-control" placeholder="Nama Suami / Istri" name="pasangan">
                      </div>
                      <div class="form-group ml-4">
                        <label>B. Nama Bapak Suami / Istri</label>
                        <input type="text" class="form-control" placeholder="Nama Bapak Suami / Istri" name="bapak_pasangan">
                      </div>
                      <div class="form-group ml-4">
                        <label>C. Nama Ibu Suami / Istri</label>
                        <input type="text" class="form-control" placeholder="Nama Ibu Suami / Istri" name="ibu_pasangan">
                      </div>
                      <div class="form-group ml-4">
                        <label>D. Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat_pasangan">
                      </div>
                      <div class="form-group">
                        <label>Sanak Saudara yang Menjadi Tanggungan</label>
                        <input type="text" class="form-control" placeholder="Sanak Saudara yang Menjadi Tanggungan" name="sanak">
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat_sanak">
                      </div>
                      <hr>
                      <div class="form-group">
                        <label>Anak-anak</label>
                        <textarea class="form-control" name="anak" placeholder="Nama Anak 1 : ...." rows="10"></textarea>
                      </div>
                      <div class="form-group">
                        <label class="text-lg">Ciri-ciri Badan</label>
                      </div>
                      <div class="form-group ml-4">
                        <label>1. Rambut</label>
                        <input type="text" class="form-control" placeholder="Rambut" name="rambut" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>2. Muka</label>
                        <input type="text" class="form-control" placeholder="Muka" name="muka" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>3. Kulit</label>
                        <input type="text" class="form-control" placeholder="Kulit" name="kulit" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>4. Tinggi</label>
                        <input type="text" class="form-control" placeholder="Tinggi" name="tinggi" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>5. Tanda Istimewa</label>
                        <input type="text" class="form-control" placeholder="Tanda Istimewa" name="tanda">
                      </div>
                      <div class="form-group">
                        <label>Rumus Sidik Jari</label>
                        <input type="text" class="form-control" placeholder="Rumus Sidik Jari" name="sidik" required>
                      </div>
                      <div class="form-group">
                        <label class="text-lg">Riwayat Sekolah:</label>
                      </div>
                      <div class="form-group ml-4">
                        <label>Sekolah Dasar (Tahun Lulus)</label>
                        <input type="text" class="form-control" placeholder="Sekolah Dasar (Tahun Lulus)" name="sd">
                      </div>
                      <div class="form-group ml-4">
                        <label>Sekolah Menengah Pertama (Tahun Lulus)</label>
                        <input type="text" class="form-control" placeholder="Sekolah Menengah Pertama (Tahun Lulus)" name="smp">
                      </div>
                      <div class="form-group ml-4">
                        <label>Sekolah Menengah Atas (Tahun Lulus)</label>
                        <input type="text" class="form-control" placeholder="Sekolah Menengah Atas (Tahun Lulus)" name="sma">
                      </div>
                      <div class="form-group ml-4">
                        <label>Sekolah Tinggi Negeri / Swasta (Tahun Lulus)</label>
                        <input type="text" class="form-control" placeholder="Sekolah Tinggi Negeri / Swasta (Tahun Lulus)" name="st">
                      </div>
                      <div class="form-group">
                        <label>Kesenangan / Kegemaran / Hobi</label>
                        <textarea class="form-control" name="hobi" placeholder="" rows="10"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Catatan Kriminal yang Ada</label>
                        <textarea class="form-control" name="catatan_kriminal" placeholder="" rows="10"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Data / keterangan lain</label>
                        <textarea class="form-control" name="keterangan_lain" placeholder="" rows="10"></textarea>
                      </div>
                    </div>
                  </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit1">Submit</button>
                    </div>
                </form>
                <!-- /.card -->                    
              </div>
              <?php
              }
              else{
              ?>
              <div class="card-body">
                <a href="skck.php"><button type="submit" class="btn btn-secondary">Kembali</button></a>
                <!-- form start -->
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="card card-primary mt-3">
                    <div class="card-header">
                      <h4 class="card-title">Formulir II</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <h2>YANG BERTANDA TANGAN DIBAWAH INI:</h2>
                      </div>
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="" name="nama" required>
                      </div>
                      <div class="form-group">
                        <label>Tempat / Tanggal Lahir</label>
                        <input type="text" class="form-control" placeholder="" name="tempat" required>
                        <input type="date" class="form-control" placeholder="" name="tanggal_lahir" required>
                      </div>
                      <div class="form-group">
                        <label>Agama</label>
                        <input type="text" class="form-control" placeholder="" name="agama" required>
                      </div>
                      <div class="form-group">
                        <label>Kebangsaan</label>
                        <input type="text" class="form-control" placeholder="" name="kebangsaan" required>
                      </div>
                      <div class="form-group">
                        <labe>Jenis Kelamin</label>
                        <select class="custom-select rounded-2" name="jenis_kelamin">
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Status Perkawinan</label>
                        <select class="custom-select rounded-2" name="perkawinan">
                          <option value="Kawin">Kawin</option>
                          <option value="Belum Kawin">Belum Kawin</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="" name="pekerjaan" required>
                      </div>
                      <div class="form-group">
                        <label>Alamat Sekarang</label>
                        <input type="text" class="form-control" placeholder="" name="alamat" required>
                      </div>
                      <div class="form-group">
                        <label>No. Kartu Penduduk</label>
                        <input type="text" class="form-control" placeholder="" name="ktp" required>
                      </div>
                      <div class="form-group">
                        <label>No. Pasport</label>
                        <input type="text" class="form-control" placeholder="" name="paspor" >
                      </div>
                      <div class="form-group">
                        <label>No. KITAS / KITAP</label>
                        <input type="text" class="form-control" placeholder="" name="kitas" >
                      </div>
                      <div class="form-group">
                        <label>No. Telp / HP</label>
                        <input type="text" class="form-control" placeholder="" name="hp" required>
                      </div>
                      <div class="form-group">
                        <h2>MENERANGKAN HAL-HAL SEBAGAI JAWABAN / KETERANGAN ATAS PERTANYAAN-PERTANYAAN DIAJUKAN SEBAGAI BERIKUT:</h2>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group">
                        <h3>I. Hubungan Kekeluargaan (Relationship)</h3>
                      </div>
                      <div class="form-group ml-2">
                        <label>1. Istri / Suami</lable>
                      </div>
                      <div class="form-group ml-4">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="" name="nama_pasangan" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Umur</label>
                        <input type="text" class="form-control" placeholder="" name="umur_pasangan" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Agama</label>
                        <input type="text" class="form-control" placeholder="" name="agama_pasangan" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Kebangsaan</label>
                        <input type="text" class="form-control" placeholder="" name="kebangsaan_pasangan" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="" name="pekerjaan_pasangan" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="" name="alamat_pasangan" required>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group ml-2">
                        <label>2. Bapak Sendiri</lable>
                      </div>
                      <div class="form-group ml-4">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="" name="nama_bapak" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Umur</label>
                        <input type="text" class="form-control" placeholder="" name="umur_bapak" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Agama</label>
                        <input type="text" class="form-control" placeholder="" name="agama_bapak" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Kebangsaan</label>
                        <input type="text" class="form-control" placeholder="" name="kebangsaan_bapak" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="" name="pekerjaan_bapak" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="" name="alamat_bapak" required>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group ml-2">
                        <label>3. Ibu Sendiri</lable>
                      </div>
                      <div class="form-group ml-4">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="" name="nama_ibu" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Umur</label>
                        <input type="text" class="form-control" placeholder="" name="umur_ibu" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Agama</label>
                        <input type="text" class="form-control" placeholder="" name="agama_ibu" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Kebangsaan</label>
                        <input type="text" class="form-control" placeholder="" name="kebangsaan_ibu" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="" name="pekerjaan_ibu" required>
                      </div>
                      <div class="form-group ml-4">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="" name="alamat_ibu" required>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group ml-2">
                        <label>4. Saudara Sekandung / Tiri</lable>
                      </div>
                      <div class="form-group">
                        <label>Nama / Umur / Pekerjaan / Alamat</label>
                        <textarea class="form-control" name="saudara_kandung" placeholder="" rows="10"></textarea>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group ml-2">
                        <label>5. Riwayat Pendidikan</lable>
                      </div>
                      <div class="form-group">
                        <label>Nama Sekolah (Tahun Lulus)</label>
                        <textarea class="form-control" name="pendidikan" placeholder="" rows="10"></textarea>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group">
                        <h3>II. Tersangkut Perkara Pidana dan Pelanggaran</h3>
                      </div>
                      <div class="form-group ml-2">
                        <label>1. Perkara Pidana</lable>
                      </div>
                      <div class="form-group ml-4">
                        <label>a. Apakah Saudara pernah tersangkut perkara pidana? </label>
                        <input type="text" class="form-control" placeholder="" name="pidana1" >
                      </div>
                      <div class="form-group ml-4">
                        <label>b. Dalam perkara apa? </label>
                        <input type="text" class="form-control" placeholder="" name="pidana2" >
                      </div>
                      <div class="form-group ml-4">
                        <label>c. Bagaimana putusannya dan Vonis hakim? </label>
                        <input type="text" class="form-control" placeholder="" name="pidana3" >
                      </div>
                      <div class="form-group ml-4">
                        <label>d. Apakah saudara sedang dalam proses perkara pidana? </label>
                        <input type="text" class="form-control" placeholder="" name="pidana4" >
                      </div>
                      <div class="form-group ml-4">
                        <label>e. Sampai sejauh mana proses hukumnya? </label>
                        <input type="text" class="form-control" placeholder="" name="pidana5" >
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group ml-2">
                        <label>2. Pelanggaran</lable>
                      </div>
                      <div class="form-group ml-4">
                        <label>a. Apakah Saudara pernah melakukan pelanggaran hukum dan atau norma-norma sosial? </label>
                        <input type="text" class="form-control" placeholder="" name="pelanggaran1" >
                      </div>
                      <div class="form-group ml-4">
                        <label>b. Pelanggaran hukum dan atau norma-norma sosial apa? </label>
                        <input type="text" class="form-control" placeholder="" name="pelanggaran2" >
                      </div>
                      <div class="form-group ml-4">
                        <label>c. Sampai sejauh mana prosesnya?</label>
                        <input type="text" class="form-control" placeholder="" name="pelanggaran3" >
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group">
                        <h3>III. Informasi Lain (Other Information)</h3>
                      </div>
                      <div class="form-group">
                        <label>1. Riwayat pekerjaan/ negara-negara yang pernah dikunjungi</label>
                        <textarea class="form-control" name="keterangan_lain1" placeholder="" rows="10"></textarea>
                      </div>
                      <div class="form-group">
                        <label>2. Kesenangan/Kegemaran/Hobi</label>
                        <textarea class="form-control" name="keterangan_lain2" placeholder="" rows="10"></textarea>
                      </div>
                      <div class="form-group">
                        <label>3. Alamat yang mudah dihubungi (no. telp)</label>
                        <input type="text" class="form-control" placeholder="" name="keterangan_lain3" required>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group">
                        <h3>IV. Sponsor(khusus orang asing/foreigners)</h3>
                      </div>
                      <div class="form-group">
                        <label>Disponsori Oleh</label>
                        <input type="text" class="form-control" placeholder="" name="sponsor1" >
                      </div>
                      <div class="form-group">
                        <label>Alamat Sponsor</label>
                        <input type="text" class="form-control" placeholder="" name="sponsor2" >
                      </div>
                      <div class="form-group">
                        <label>Telp / Fax</label>
                        <input type="text" class="form-control" placeholder="" name="sponsor3" >
                      </div>
                      <div class="form-group">
                        <label>Jenis Usaha</label>
                        <input type="text" class="form-control" placeholder="" name="sponsor4" >
                      </div>
                    </div>
                  </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="submit2">Submit</button>
                    </div>
                </form>
                <!-- /.card -->                    
              </div>
              <?php 
              } 
              ?>
            </div>
            <?php
            }
            else{
              $keyword = htmlspecialchars($_POST['keyword']);
              $query = mysqli_query($conn, "SELECT * FROM skck WHERE ktp LIKE '%$keyword%' ORDER BY id DESC LIMIT 1");
              while($rows = mysqli_fetch_array($query)){
            ?>
            <div class="card card-primary mt-4">
              <div class="card-header">
                <h4 class="card-title">Status SKCK</h4>
              </div>
              <div class="card-body">
                <p>Nama &emsp; &emsp; &emsp; &emsp; &emsp; : <b><?=$rows['nama_lengkap']?></b></p>
                <p>No. KTP &emsp; &emsp; &emsp; &emsp; &nbsp; : <b><?=$rows['ktp']?></b></p>
                <p>Tanggal Pengajuan &nbsp; &nbsp;: <b><?=$rows['tanggal']?></b></p>
                <p>Status &emsp; &emsp; &emsp; &emsp; &emsp; : 
                  <b class="<?php
                    if($rows['progress'] === 'terkirim'){
                      echo "text-warning";
                    }
                    elseif($rows['progress'] === 'diproses'){
                      echo "text-primary";
                    }
                    elseif($rows['progress'] === 'selesai'){
                      echo "text-success";
                    }
                    elseif($rows['progress'] === 'batal'){
                      echo "text-danger";
                    }
                  ?>"><?=$rows['progress']?>
                  </b></p>
                  <p>Keterangan &emsp; &emsp; &emsp; &nbsp;: <b><?=$rows['keterangan_progres']?></b></p>
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