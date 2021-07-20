<?php
session_start();
include 'config/dbconnect.php';
if(($_GET['action'])){
    $id = $_GET['id'];
    $idperkara = $_GET['idperkara'];
    $query = mysqli_query($conn, "DELETE FROM detailperkara WHERE id = '$id'");
    if(mysqli_affected_rows($conn) > 0){
        echo "<script>window.alert('Hapus Detail Perkara Berhasil !')
        window.location='index.php?module=sp2hp&action=info&id=$idperkara'</script>";
    }
    else{
        echo "<script>window.alert('Hapus Detail Perkara Gagal !')
        window.location='index.php?module=sp2hp&action=info&id=$idperkara'</script>";
    }
}