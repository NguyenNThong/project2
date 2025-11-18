<?php
$host="localhost:3306";
$user="root";
$pass="";
$database="eoi";
$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>