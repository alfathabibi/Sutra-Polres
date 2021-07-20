<?php
session_start();
include 'config/dbconnect.php';
if(($_GET['action'])){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM skck WHERE id = '$id'");

    if(mysqli_affected_rows($conn) > 0){
        echo "<script>window.alert('Hapus SKCK Berhasil !')
        window.location='index.php?module=skck'</script>";
    }else{
        echo "<script>window.alert('Hapus SKCK Gagal !')
        window.location='index.php?module=skck'</script>";
    }
}