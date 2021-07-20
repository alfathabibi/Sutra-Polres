<?php

function upload(){
    $namafile = $_FILES['uploadfile']['name'];
    $ukuranfile = $_FILES['uploadfile']['size'];
    $error = $_FILES['uploadfile']['error'];
    $tmpName = $_FILES['uploadfile']['tmp_name'];


    //cek ekstensi
    $ekstensiFileValid = ['doc','docx','pdf','jpg', 'jpeg', 'png'];
    $ekstensiFile = explode('.',$namafile);
    $namafile = $ekstensiFile[0];
    $ekstensiFile = strtolower(end($ekstensiFile)); 

    if(!in_array($ekstensiFile, $ekstensiFileValid)){
        echo "<script>alert('Jenis File tidak sesuai !')
        </script>";
        return 'gagal';
    }

    if ($ukuranfile > 10000000){
        echo "<script>alert('Ukuran File terlalu besar !')
        </script>";
        return 'gagal';
    }

    $namafilebaru = $namafile;
    $namafilebaru .= '-';
    $namafilebaru .= uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensiFile;

    //upload
    move_uploaded_file($tmpName,'fileupload/' . $namafilebaru);

    return $namafilebaru;
}

function uploadbanner($banner){
    $namafile = $_FILES['uploadfile']['name'];
    $ukuranfile = $_FILES['uploadfile']['size'];
    $error = $_FILES['uploadfile']['error'];
    $tmpName = $_FILES['uploadfile']['tmp_name'];


    //cek ekstensi
    $ekstensiFileValid = ['jpg', 'jpeg', 'png', 'jpeg'];
    $ekstensiFile = explode('.',$namafile);
    $namafile = $ekstensiFile[0];
    $ekstensiFile = strtolower(end($ekstensiFile)); 

    if(!in_array($ekstensiFile, $ekstensiFileValid)){
        echo "<script>alert('Jenis File tidak sesuai !')
        </script>";
        return 'gagal';
    }

    if ($ukuranfile > 10000000){
        echo "<script>alert('Ukuran File terlalu besar !')
        </script>";
        return 'gagal';
    }

    $namafilebaru = $banner;
    $namafilebaru .= '.';
    $namafilebaru .= 'jpg';

    //upload
    move_uploaded_file($tmpName,'banner/' . $namafilebaru);

    return $namafilebaru;
}
?>