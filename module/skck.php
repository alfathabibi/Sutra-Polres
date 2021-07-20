<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Fitur</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Fitur</a></li>
            <li class="breadcrumb-item active">SKCK</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
    if(isset($_POST['updateprogres'])){
      $iddetail = $_POST['id'];
      $progres = $_POST['progres'];
      $keterangan_progres = htmlspecialchars(addslashes($_POST['keterangan_progres']));

      $update = "UPDATE skck SET progress = '$progres', keterangan_progres = '$keterangan_progres' WHERE id = '$iddetail'";
      mysqli_query($conn, $update);

      if(mysqli_affected_rows($conn) > 0){
        echo "<script>window.alert('Progress Berhasil Diupdate !')
        window.location='index.php?module=skck&detail=$iddetail'</script>";
      }
    }
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php
            if(!isset($_GET['detail'])){
            ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title font-weight-bold">Data SKCK</h3>
              </div>
              <!-- /.card-header -->
              <?php
                $query = "SELECT * FROM skck ORDER BY tanggal DESC";
                $select = mysqli_query($conn, $query);
              ?>
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>No. Identitas</th>
                    <th>Nama Lengkap</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        $index = 1;
                        while($rows = mysqli_fetch_array($select)){
                    ?> 
                  <tr>
                    <td><?= $index ?></td>
                    <td><?= $rows['ktp'] ?></td>        
                    <td><?= $rows['nama_lengkap'] ?></td>
                    <td class="
                    <?php
                    if($rows['progress'] === 'terkirim'){
                      echo "text-warning";
                    }
                    elseif($rows['progress'] === 'diproses'){
                      echo "text-primary";
                    }
                    elseif($rows['progress'] === 'selesai'){
                      echo "text-sucess";
                    }
                    elseif($rows['progress'] === 'batal'){
                      echo "text-danger";
                    }
                    ?>
                    "><?= $rows['progress'] ?></td>
                    <td>  <a href="index.php?module=skck&detail=<?=$rows['id']?>"><span class="badge badge-info">Detail</span></a> <a href="deleteskck.php?action=delete&id=<?=$rows['id']?>" onclick="return confirm('anda yakin akan hapus data ini?')" class="text-danger"><span class="badge badge-danger">Hapus</span></a></td>
                  </tr>
                    <?php
                        $index++;
                        }
                    ?>  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php
            }
            else{
            ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail SKCK</h3>
              </div>
              <?php
                $id =  $_GET['detail'];
                $query = "SELECT * FROM skck WHERE id = '$id'";
                $select = mysqli_query($conn, $query);
                while($rows = mysqli_fetch_array($select)){
                  $dilihat = $rows['dilihat'];
                  if(!$dilihat){
                    $update = "UPDATE skck SET dilihat = 1 WHERE id = '$id'";
                    mysqli_query($conn, $query);
                  }
              ?>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card card-warning mt-3">
                    <div class="card-header">
                      <h4 class="card-title">Status</h4>
                    </div>
                    <div class="card-body">
                      <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $rows['id'] ?>">
                        <div class="form-group">
                          <label for="progres">Status</label>
                          <select class="custom-select rounded-2" id="progres" name="progres">
                          <?php
                            for($i = 0; $i < 4; $i++){
                              $value = "";
                              $progres = $rows['progress'];
                              if($i == 0){
                                $value = "terkirim";
                              }elseif($i == 1){
                                $value = "diproses";
                              }
                              elseif($i == 2){
                                $value = "selesai";
                              }
                              elseif($i == 3){
                                $value = "batal";
                              }
                                
                          ?>
                            <option value="<?=$value?>" <?php if($value === $progres) echo "selected" ?>> <?=$value?> </option>
                          <?php
                            }
                          ?>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_progres">Keterangan Progres</label>
                            <textarea name="keterangan_progres" class="form-control" id="keterangan_progres" rows="5" placeholder="Tambahkan Keterangan Progres..."><?= $rows['keterangan_progres']?></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="updateprogres">Submit</button>
                        </div>
                      </form>
                    </div>
                </div> 
                  <div class="card card-primary mt-3">
                    <div class="card-header">
                      <h4 class="card-title">Formulir I</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Nama Pemohon</label>
                        <input type="text" class="form-control" placeholder="Nama Pemohon" value="<?= $rows['pemohon'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Keperluan</label>
                        <input type="text" class="form-control" placeholder="Keperluan" value="<?= $rows['keperluan'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" value="<?= $rows['nama_lengkap'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Alias</label>
                        <input type="text" class="form-control" placeholder="Alias" value="<?= $rows['alias'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" placeholder="Tanggal" value="<?= $rows['tanggal'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>No. KTP / No. Passpor</label>
                        <input type="text" class="form-control" placeholder="No. KTP" value="<?= $rows['ktp'] ?>" readonly>
                        <input type="text" class="form-control" placeholder="No. Paspor" value="<?= $rows['paspor'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Agama</label>
                        <input type="text" class="form-control" placeholder="Agama" value="<?= $rows['agama'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Lahir / Umur</label>
                        <input type="date" class="form-control" placeholder="Tanggal Lahir" value="<?= $rows['tanggal_lahir'] ?>" readonly>
                        <input type="text" class="form-control" placeholder="Umur" value="<?= $rows['umur'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" value="<?= $rows['alamat'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Kedudukan Dalam Keluarga</label>
                        <input type="text" class="form-control" placeholder="Kedudukan dalam keluarga" value="<?= $rows['kedudukan'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Nama Bapak & Ibu</label>
                        <input type="text" class="form-control" placeholder="Bapak" value="<?= $rows['bapak'] ?>" readonly>
                        <input type="text" class="form-control" placeholder="Ibu" value="<?= $rows['ibu'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="Pekerjaan" value="<?= $rows['pekerjaan'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>A. Nama Suami / Istri</label>
                        <input type="text" class="form-control" placeholder="Nama Suami / Istri" value="<?= $rows['pasangan'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>B. Nama Bapak Suami / Istri</label>
                        <input type="text" class="form-control" placeholder="Nama Bapak Suami / Istri" value="<?= $rows['bapak_pasangan'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>C. Nama Ibu Suami / Istri</label>
                        <input type="text" class="form-control" placeholder="Nama Ibu Suami / Istri" value="<?= $rows['ibu_pasangan'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>D. Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" value="<?= $rows['alamat_pasangan'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Sanak Saudara yang Menjadi Tanggungan</label>
                        <input type="text" class="form-control" placeholder="Sanak Saudara yang Menjadi Tanggungan" value="<?= $rows['sanak'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" value="<?= $rows['alamat_sanak'] ?>" readonly>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label>Anak-anak</label>
                        <textarea class="form-control" placeholder="Nama Anak 1 : ...." rows="10"><?= $rows['anak'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label class="text-lg">Ciri-ciri Badan</label>
                      </div>
                      <div class="form-group ml-4">
                        <label>1. Rambut</label>
                        <input type="text" class="form-control" placeholder="Rambut" value="<?= $rows['rambut'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>2. Muka</label>
                        <input type="text" class="form-control" placeholder="Muka" value="<?= $rows['muka'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>3. Kulit</label>
                        <input type="text" class="form-control" placeholder="Kulit" value="<?= $rows['kulit'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>4. Tinggi</label>
                        <input type="text" class="form-control" placeholder="Tinggi" value="<?= $rows['tinggi'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>5. Tanda Istimewa</label>
                        <input type="text" class="form-control" placeholder="Tanda Istimewa" value="<?= $rows['tanda'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Rumus Sidik Jari</label>
                        <input type="text" class="form-control" placeholder="Rumus Sidik Jari" value="<?= $rows['sidik'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label class="text-lg">Riwayat Sekolah:</label>
                      </div>
                      <div class="form-group ml-4">
                        <label>Sekolah Dasar (Tahun Lulus)</label>
                        <input type="text" class="form-control" placeholder="Sekolah Dasar (Tahun Lulus)" value="<?= $rows['sd'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Sekolah Menengah Pertama (Tahun Lulus)</label>
                        <input type="text" class="form-control" placeholder="Sekolah Menengah Pertama (Tahun Lulus)" value="<?= $rows['smp'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Sekolah Menengah Atas (Tahun Lulus)</label>
                        <input type="text" class="form-control" placeholder="Sekolah Menengah Atas (Tahun Lulus)" value="<?= $rows['sma'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Sekolah Tinggi Negeri / Swasta (Tahun Lulus)</label>
                        <input type="text" class="form-control" placeholder="Sekolah Tinggi Negeri / Swasta (Tahun Lulus)" value="<?= $rows['st'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Kesenangan / Kegemaran / Hobi</label>
                        <textarea class="form-control" value="<?= $rows['hobi'] ?>" placeholder="" rows="10" readonly><?= $rows['hobi'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Catatan Kriminal yang Ada</label>
                        <textarea class="form-control" value="<?= $rows['catatan_kriminal'] ?>" placeholder="" rows="10" readonly><?= $rows['catatan_kriminal'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Data / keterangan lain</label>
                        <textarea class="form-control" value="<?= $rows['keterangan_lain'] ?>" placeholder="" rows="10" readonly><?= $rows['keterangan_lain'] ?></textarea>
                      </div>
                    </div>
                  </div>
                    <!-- /.card-body -->
                  <?php
                }
                  $id =  $_GET['detail'];
                  $query = "SELECT * FROM skck2 WHERE idskck = '$id'";
                  $select = mysqli_query($conn, $query);
                  while($rows = mysqli_fetch_array($select)){
                  ?>
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
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['nama'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Tempat / Tanggal Lahir</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['tempat'] ?>" readonly>
                        <input type="date" class="form-control" placeholder="" value="<?= $rows['tanggal_lahir'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Agama</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['agama'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Kebangsaan</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['kebangsaan'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <labe>Jenis Kelamin</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['jenis_kelamin'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Status Perkawinan</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['perkawinan'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pekerjaan'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Alamat Sekarang</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['alamat'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>No. Kartu Penduduk</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['ktp'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>No. Pasport</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['paspor'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>No. KITAS / KITAP</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['kitas'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>No. Telp / HP</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['hp'] ?>" readonly>
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
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['nama_pasangan'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Umur</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['umur_pasangan'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Agama</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['agama_pasangan'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Kebangsaan</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['kebangsaan_pasangan'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pekerjaan_pasangan'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['alamat_pasangan'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group ml-2">
                        <label>2. Bapak Sendiri</lable>
                      </div>
                      <div class="form-group ml-4">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['nama_bapak'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Umur</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['umur_bapak'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Agama</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['agama_bapak'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Kebangsaan</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['kebangsaan_bapak'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pekerjaan_bapak'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['alamat_bapak'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group ml-2">
                        <label>3. Ibu Sendiri</lable>
                      </div>
                      <div class="form-group ml-4">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['nama_ibu'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Umur</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['umur_ibu'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Agama</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['agama_ibu'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Kebangsaan</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['kebangsaan_ibu'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pekerjaan_ibu'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['alamat_ibu'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group ml-2">
                        <label>4. Saudara Sekandung / Tiri</lable>
                      </div>
                      <div class="form-group">
                        <label>Nama / Umur / Pekerjaan / Alamat</label>
                        <textarea class="form-control" value="<?= $rows['saudara_kandung'] ?>" placeholder="" rows="10" readonly><?= $rows['saudara_kandung'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group ml-2">
                        <label>5. Riwayat Pendidikan</lable>
                      </div>
                      <div class="form-group">
                        <label>Nama Sekolah (Tahun Lulus)</label>
                        <textarea class="form-control" value="<?= $rows['pendidikan'] ?>" placeholder="" rows="10" readonly><?= $rows['pendidikan'] ?></textarea>
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
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pidana1'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>b. Dalam perkara apa? </label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pidana2'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>c. Bagaimana putusannya dan Vonis hakim? </label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pidana3'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>d. Apakah saudara sedang dalam proses perkara pidana? </label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pidana4'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>e. Sampai sejauh mana proses hukumnya? </label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pidana5'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group ml-2">
                        <label>2. Pelanggaran</lable>
                      </div>
                      <div class="form-group ml-4">
                        <label>a. Apakah Saudara pernah melakukan pelanggaran hukum dan atau norma-norma sosial? </label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pelanggaran1'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>b. Pelanggaran hukum dan atau norma-norma sosial apa? </label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pelanggaran2'] ?>" readonly>
                      </div>
                      <div class="form-group ml-4">
                        <label>c. Sampai sejauh mana prosesnya?</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['pelanggaran3'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group">
                        <h3>III. Informasi Lain (Other Information)</h3>
                      </div>
                      <div class="form-group">
                        <label>1. Riwayat pekerjaan/ negara-negara yang pernah dikunjungi</label>
                        <textarea class="form-control" value="<?= $rows['keterangan_lain1'] ?>" placeholder="" rows="10" readonly><?= $rows['keterangan_lain1'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>2. Kesenangan/Kegemaran/Hobi</label>
                        <textarea class="form-control" value="<?= $rows['keterangan_lain2'] ?>" placeholder="" rows="10" readonly><?= $rows['keterangan_lain2'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>3. Alamat yang mudah dihubungi (no. telp)</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['keterangan_lain3'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <hr>
                      </div>
                      <div class="form-group">
                        <h3>IV. Sponsor(khusus orang asing/foreigners)</h3>
                      </div>
                      <div class="form-group">
                        <label>Disponsori Oleh</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['sponsor1'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Alamat Sponsor</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['sponsor2'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Telp / Fax</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['sponsor3'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label>Jenis Usaha</label>
                        <input type="text" class="form-control" placeholder="" value="<?= $rows['sponsor4'] ?>" readonly>
                      </div>
                    </div>
                  </div>
                    <!-- /.card-body -->
              </div>
              <?php
                }
              ?>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
