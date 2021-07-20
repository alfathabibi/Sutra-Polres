<?php
session_start();
include 'config/dbconnect.php';
if(($_GET['action'])){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM user WHERE id = '$id'");

    if(mysqli_affected_rows($conn) > 0){
        echo "<script>window.alert('Hapus User Berhasil !')
        window.location='index.php'</script>";
    }else{
        echo "<script>window.alert('Hapus User Gagal !')
        window.location='index.php?module=superadmin'</script>";
    }
}