<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "_polreswajo";


$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn){
    die("error connect to database");
}