<?php
session_start();
include 'config/dbconnect.php';
if(($_GET['action'])){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM laporan WHERE id = '$id'");

    if(mysqli_affected_rows($conn) > 0){
        echo "<script>window.alert('Hapus Laporan Berhasil !')
        window.location='index.php?module=lapor'</script>";
    }else{
        echo "<script>window.alert('Hapus Laporan Gagal !')
        window.location='index.php?module=lapor'</script>";
    }
}