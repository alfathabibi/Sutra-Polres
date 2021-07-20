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
            <li class="breadcrumb-item active">SP2HP</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
        if(!isset($_GET['action']) && !isset($_GET['id'])){
    ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title font-weight-bold">Data SP2HP</h3>
              </div>
              <!-- /.card-header -->
              <?php
                $query = "SELECT * FROM perkara ORDER BY id DESC";
                $select = mysqli_query($conn, $query);
              ?>
              <div class="card-body">
                <div class="col mb-2">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah Perkara</button>
                </div>
                <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nomor Perkara</th>
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
                    <td><?= $rows['nomorperkara'] ?></td>
                    <td><a href="index.php?module=sp2hp&action=info&id=<?= $rows['id']?>" class="text-info"><span class="badge badge-info">Detail</span></a> <a href="deleteperkara.php?action=delete&id=<?=$rows['id']?>" onclick="return confirm('anda yakin akan hapus data ini?')" class="text-danger"><span class="badge badge-danger">Hapus</span></a></a></td>
                    
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
        </div>
        </div>
    </section>

    <?php
        }
        elseif ($_GET['action'] == 'info' && isset($_GET['id'])) {
            $idperkara = $_GET['id'];
            $query = mysqli_query($conn, "SELECT * FROM perkara WHERE id = '$idperkara' limit 1");
            $nomorperkara = "";
            while($rows = mysqli_fetch_array($query)){
                $nomorperkara = $rows['nomorperkara'];
            }
    ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title font-weight-bold"><?= $nomorperkara ?></h3>
              </div>
              <!-- /.card-header -->
              <?php
                $query = "SELECT * FROM detailperkara WHERE idperkara = '$idperkara' ORDER BY terakhirdiubah DESC";
                $select = mysqli_query($conn, $query);
              ?>
              <div class="card-body">
                <div class="col mb-2">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-level-baru">Tambah Tahapan</button>
                </div>
                <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Isi</th>
                    <th>Tahapan</th>
                    <th>Berkas</th>
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
                    <td><?= $rows['deskripsi'] ?></td>
                    <td><span class="badge badge-info"><?= $rows['level'] ?></span></td>
                    <?php
                      if($rows['file'] != ''):
                    ?>
                    <td><a href="fileupload/<?=$rows['file']?>"><span class="badge badge-success">Download</span></a></td>        
                    <?php
                      else :
                    ?>
                    <td> </td>
                    <?php
                      endif;
                    ?>
                    <td><a href="" data-toggle="modal" data-target="#modal-edit" data-iddetail="<?= $rows['id']?>" data-tahapan="<?=$rows['level']?>" data-isi="<?=$rows['deskripsi']?>" id="detail-modal"><span class="badge badge-warning">Edit</span></a> <a href="deletedetailperkara.php?action=delete&id=<?=$rows['id']?>&idperkara=<?=$idperkara?>" onclick="return confirm('anda yakin akan hapus data ini?')" class="text-danger"><span class="badge badge-danger">Hapus</span></a></a></td>
                    
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
        </div>
        </div>
    </section>    

    <?php            
        }
    ?>
</div>
<!-- /.content-wrapper -->

<?php
  if(isset($_POST['submit'])){
    $nomorperkara = htmlspecialchars($_POST['nomorperkara']);

    $query = mysqli_query($conn, "INSERT INTO perkara VALUES (NULL,'$nomorperkara'  )");

    if(mysqli_affected_rows($conn) > 0){
      echo "<script>window.alert('Perkara Berhasil Ditambahkan !')
      window.location='index.php?module=sp2hp'</script>";
    }else{
      echo "<script>window.alert('Perkara Gagal Ditambahkan !')
      window.location='index.php?module=sp2hp'</script>";    
    }

  }
  elseif(isset($_POST['submitlevel'])){
    $idperkara = $_GET['id'];
    $level = htmlspecialchars($_POST['level']);
    $deskripsi = htmlspecialchars(addslashes($_POST['deskripsi']));
    
    $file = '';
    if(!$_FILES['uploadfile']['error'] == 4){
      $file = upload();
    }

    if($file === 'gagal'){
      echo "<script>window.alert('Perkara Gagal Ditambahkan !')
      window.location='index.php?module=sp2hp&action=info&id=$idperkara'</script>";
      die();
    }

    $query = mysqli_query($conn, "INSERT INTO detailperkara VALUES (NULL,'$idperkara','$level','$deskripsi','$file', NOW(), NOW())");
    if(mysqli_affected_rows($conn) > 0){
      echo "<script>window.alert('Perkara Berhasil Ditambahkan !')
      window.location='index.php?module=sp2hp&action=info&id=$idperkara'</script>";
    }else{
      echo "<script>window.alert('Perkara Gagal Ditambahkan !')
      window.location='index.php?module=sp2hp&action=info&id=$idperkara'</script>";
    }
  }
  elseif(isset($_POST['updatelevel'])){
    $iddetail = $_POST['iddetailperkara'];
    $level = htmlspecialchars($_POST['level']);
    $deskripsi = htmlspecialchars(addslashes($_POST['deskripsi']));

    $file = '';
    if(!$_FILES['uploadfile']['error'] == 4){
      $file = upload();
    }

    if($file === 'gagal'){
      echo "<script>window.alert('Perkara Gagal Ditambahkan !')
      window.location='index.php?module=sp2hp&action=info&id=$idperkara'</script>";
      die();
    }
    
    $query = "UPDATE detailperkara SET `level` = '$level', `deskripsi` = '$deskripsi', `file` = '$file', `terakhirdiubah` = NOW() WHERE id = '$iddetail'";

    if($file == ''){
      $query = "UPDATE detailperkara SET `level` = '$level', `deskripsi` = '$deskripsi', `terakhirdiubah` = NOW() WHERE id = '$iddetail'";
    }

    $effort = mysqli_query($conn, $query);
    if(mysqli_affected_rows($conn) > 0){
      echo "<script>window.alert('Perkara Berhasil Diupdate !')
      window.location='index.php?module=sp2hp&action=info&id=$idperkara'</script>";
    }else{
      echo "<script>window.alert('Perkara Gagal Diupdate !')
      window.location='index.php?module=sp2hp&action=info&id=$idperkara'</script>";
    }
  }
?>

<!-- Modal -->
<div class="modal fade" id="modal-level-baru">
  <div class="modal-dialog">
    <!-- general form elements -->
    <div class="modal-content card card-primary">
      <div class="card-header">
        <h3 class="card-title">Tambah Perkara</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Tahapan</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Tahapan" name="level" autocomplete="off" required>
          </div>
          <!-- textarea -->
          <div class="form-group">
            <label>Isi</label>
            <textarea class="form-control" rows="3" placeholder="Isi..." name="deskripsi" required></textarea>
          </div>
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
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" name="submitlevel">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <!-- general form elements -->
    <div class="modal-content card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Perkara</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <input type="hidden" class="form-control" id="iddetail" placeholder="Tahapan" name="iddetailperkara" autocomplete="off" required>
          <div class="form-group">
            <label for="exampleInputEmail1">Tahapan</label>
            <input type="text" class="form-control" id="tahapanedit" placeholder="Tahapan" name="level" autocomplete="off" required>
          </div>
          <!-- textarea -->
          <div class="form-group">
            <label>Isi</label>
            <textarea class="form-control" rows="3" id="isiedit" placeholder="Isi..." name="deskripsi" required></textarea>
          </div>
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
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" name="updatelevel">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <!-- general form elements -->
    <div class="modal-content card card-primary">
      <div class="card-header">
        <h3 class="card-title">Perkara Baru</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="" method="post">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Nomor Perkara</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nomor Perkara" name="nomorperkara" autocomplete="off" required>
          </div>
          <!-- textarea -->
            <!-- <div class="form-group">
              <label>Isi</label>
              <textarea class="form-control" rows="3" placeholder="Isi..." name="deskripsi" required></textarea>
            </div> -->
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->