<?php
session_start();
include 'config/dbconnect.php';
if(isset($_GET['action'])){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM perkara WHERE id = '$id'");

    if(mysqli_affected_rows($conn) > 0){
            echo "<script>window.alert('Hapus Perkara Berhasil !')
            window.location='index.php?module=sp2hp'</script>";
    }else{
        $error = $conn->error;
        echo "<script>window.alert('Hapus Perkara Gagal $error!')
        window.location='index.php?module=sp2hp'</script>";
    }
}