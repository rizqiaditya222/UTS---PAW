<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "user";

$db = mysqli_connect($hostname,$username,$password,$database_name);

if ($db->connect_error) {
    echo "database tidak terkoneksi";
    die("error!");
}

?>