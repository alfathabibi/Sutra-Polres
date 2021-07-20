<?php
    if(isset($_GET['name'])){
        $namafile = $_GET['name'];
        header("content-type: application/pdf");
        readfile("../fileupload/$namafile");
    }
?>