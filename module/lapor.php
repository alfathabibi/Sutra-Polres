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
            <li class="breadcrumb-item active">Laporan</li>
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

      $update = "UPDATE laporan SET status = '$progres', keterangan_status = '$keterangan_progres' WHERE id = '$iddetail'";
      mysqli_query($conn, $update);

      if(mysqli_affected_rows($conn) > 0){
        echo "<script>window.alert('Progress Berhasil Diupdate !')
        window.location='index.php?module=lapor&detail=$iddetail'</script>";
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
                <h3 class="card-title font-weight-bold">Data Laporan</h3>
              </div>
              <!-- /.card-header -->
              <?php
                $query = "SELECT * FROM laporan";
                $select = mysqli_query($conn, $query);
              ?>
              <div class="card-body">

                <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>No. Identitas</th>
                    <th>Nama Lengkap</th>
                    <th>Isi Laporan</th>
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
                    <td><?= $rows['identitas'] ?></td>        
                    <td><?= $rows['namalengkap'] ?></td>
                    <td><?= $rows['isilaporan'] ?></td>
                    <?php
                        // $fileSrc = "";
                        // if(!$rows['foto'] === ''){
                        //     $fileSrc = "fileupload/";
                        //     $fileSrc .= $rows['foto'];
                        // }
                    ?>
                    <!-- <td> <a href="" data-target="#modal-default" data-toggle="modal" data-idlapor="<?= $rows['id']?>" data-identitas="<?= $rows['identitas']?>" data-nama="<?= $rows['namalengkap']?>" data-nohp="<?= $rows['nohp']?>" data-alamat="<?= $rows['alamat']?>" data-email="<?= $rows['email']?>" data-isi="<?= $rows['isilaporan']?>" data-foto="<?php if ($rows['foto'] !== '') echo "fileupload/$rows[foto]";?>" id="detail-laporan" class="text-info"><span class="badge badge-info">Detail</span></a> <a href="deleteuser.php?action=delete&id=<?=$rows['id']?>" onclick="return confirm('anda yakin akan hapus data ini?')" class="text-danger"><span class="badge badge-danger">Hapus</span></a> </td> -->
                    <td>  <a href="index.php?module=lapor&detail=<?=$rows['id']?>"><span class="badge badge-info">Detail</span></a> <a href="deletelapor.php?action=delete&id=<?=$rows['id']?>" onclick="return confirm('anda yakin akan hapus data ini?')" class="text-danger"><span class="badge badge-danger">Hapus</span></a></td>
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
                <h3 class="card-title">Detail Laporan</h3>
              </div>
              <!-- /.card-header -->
              <?php
                $id =  $_GET['detail'];
                $query = "SELECT * FROM laporan WHERE id = '$id'";
                $select = mysqli_query($conn, $query);
                while($rows = mysqli_fetch_array($select)){
                  $dilihat = $rows['dilihat'];
                  if(!$dilihat){
                    $update = "UPDATE laporan SET dilihat = 1 WHERE id = '$id'";
                    mysqli_query($conn, $update);
                  }
              ?>
              <div class="card-body">
              <!-- form respon -->
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
                              $progres = $rows['status'];
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
                            <textarea name="keterangan_progres" class="form-control" id="keterangan_progres" rows="5" placeholder="Tambahkan Keterangan Status..."><?= $rows['keterangan_status']?></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="updateprogres">Submit</button>
                        </div>
                      </form>
                    </div>
                </div>

                
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Identitas</label>
                            <input type="text" class="form-control" value="<?= $rows['identitas'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" class="form-control" value="<?= $rows['namalengkap'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No. HP</label>
                            <input type="text" class="form-control" value="<?= $rows['nohp'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" value="<?= $rows['alamat'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="text" class="form-control" value="<?= $rows['email'] ?>" readonly>
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                            <label>Isi</label>
                            <textarea class="form-control" rows="10" readonly><?= $rows['isilaporan'] ?></textarea>
                        </div>
                        <?php
                        if($rows['foto'] !== ''){
                        ?>
                        <div class="form-group">
                        <a href="fileupload/<?=$rows['foto']?>"><span class="badge badge-success">Lihat Foto</span></a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- /.card-body -->
                  </form>
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

<!-- Modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <!-- general form elements -->
    <div class="modal-content card card-primary">
      <div class="card-header">
        <h3 class="card-title">Detail Laporan</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">No. Identitas</label>
                    <input type="text" class="form-control" id="no_identitas" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No. HP</label>
                    <input type="text" class="form-control" id="no_hp" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" class="form-control" id="alamat" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" class="form-control" id="email" readonly>
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Isi</label>
                    <textarea class="form-control" rows="10" placeholder="Isi Laporan" name="isi_laporan" id="isilaporan" readonly></textarea>
                </div>

                <div class="form-group">
                    <a id="foto_laporan"><span class="badge badge-success">Lihat Foto</span></a>
                </div>
                
            </div>
            <!-- /.card-body -->
        </form>
                <!-- /.card -->             
    </div>
    <!-- /.card -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
