<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Admin SKCK</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Admin SKCK</h3>
              </div>
              <!-- /.card-header -->
              <?php
                $query = "SELECT * FROM user WHERE role = 3";
                $select = mysqli_query($conn, $query);
              ?>
              <div class="card-body">
                <div class="col mb-2">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah User</button>
                </div>
                <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
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
                    <td><?= $rows['fullname'] ?></td>        
                    <td><?= $rows['username'] ?></td>
                    <td> <a href="deleteuser.php?action=delete&id=<?=$rows['id']?>" onclick="return confirm('anda yakin akan hapus data ini?')" class="text-danger"><span class="badge badge-danger">Hapus</span></a></td>
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
</div>
<!-- /.content-wrapper -->
  <?php
  
  if(isset($_POST['tambah_user'])){
    $fullname = htmlspecialchars($_POST['fullname']);
    $username = htmlspecialchars($_POST['username']);
    $password = md5(htmlspecialchars($_POST['password']));
    $password2 = md5(htmlspecialchars($_POST['password2']));
    $role = htmlspecialchars($_POST['role']);

    if($password2 != $password){
      ?>
      <script>
        alert('Password tidak sesuai');
      <?php
    }else{
      $query = mysqli_query($conn, "INSERT INTO user VALUES (NULL,'$fullname','$username','$password','$role')");

      if(mysqli_affected_rows($conn) > 0){
        echo "<script>window.alert('Penambahan User Berhasil !')
        window.location='index.php?module=superadmin'</script>";
      }else{
       echo "<script>window.alert('Gagal menambahkan user')
        window.location='media.php?module=superadmin'</script>";    
      }
    }
  }
  
  ?>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body register-card-body">

          <form action="" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Nama Lengkap" name="fullname" autocomplete="off" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Ulangi password" name="password2" autocomplete="off" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <select class="custom-select rounded-0" id="exampleSelectRounded0" name="role">
              <?php
                $sql = mysqli_query($conn, "SELECT * FROM role where id = 3");
                while($rows = mysqli_fetch_array($sql)){
              ?>
              <option value="<?= $rows['id'] ?>"><?= $rows['name']?></option>
              <?php
                }
              ?>  
              </select>
            </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary" name="tambah_user">Tambah</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
