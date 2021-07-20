<?php
  if(isset($_POST['submit'])){
    $typebanner = $_POST['type_banner'];
    echo $typebanner;
    $file = '';
    if(!$_FILES['uploadfile']['error'] == 4){
      $file = uploadbanner($typebanner);
    }

    if($file === 'gagal'){
      echo "<script>window.alert('Banner gagal di Upload !')
      window.location='index.php?module=uploadbanner'</script>";
      die();
    }
    else{
      echo "<script>window.alert('Banner berhasil di Upload !')
      window.location='index.php?module=uploadbanner'</script>";
      die();
    }
  }
?>

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
            <li class="breadcrumb-item active">Upload Banner</li>
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
                <h3 class="card-title font-weight-bold">Upload Banner</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <img src="banner/banner1.jpg" class="img-fluid" style="width: 500px;">
                    </div>
                    <a href="" data-toggle="modal" id="banner-modal1" data-banner="banner1" data-target="#modal-banner" class="small-box-footer">Change Banner <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <img src="banner/banner2.jpg" class="img-fluid" style="width: 500px;">
                    </div>
                    <a href="" data-toggle="modal" id="banner-modal2" data-banner="banner2" data-target="#modal-banner" class="small-box-footer">Change Banner <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <img src="banner/banner3.jpg" class="img-fluid" style="width: 500px; max-height: 250px;">
                    </div>
                    <a href="" data-toggle="modal" id="banner-modal3" data-banner="banner3" data-target="#modal-banner" class="small-box-footer">Change Banner <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <img src="banner/banner4.jpg" class="img-fluid" style="width: 500px; max-height: 250px;">
                    </div>
                    <a href="" data-toggle="modal" id="banner-modal4" data-banner="banner4" data-target="#modal-banner" class="small-box-footer">Change Banner About <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <img src="banner.php" class="img-fluid" style="width: 500px; max-height: 250px;">
                    </div>
                    <a href="" data-toggle="modal" id="banner-modal5" data-banner="banner5" data-target="#modal-banner" class="small-box-footer">Change Banner Call Center <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade" id="modal-banner">
  <div class="modal-dialog">
    <!-- general form elements -->
    <div class="modal-content card card-primary">
      <div class="card-header">
        <h3 class="card-title">Banner</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <input type="hidden" id="type_banner" name="type_banner">
          <div class="form-group">
            <label for="exampleInputFile">Unggah Banner</label>
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

