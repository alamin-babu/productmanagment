<?php 

$servername = "localhost";
$username = "root";
$password = "alamin";
$dbname = "product";

//make a comection & check the connection

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("connection failed " .$conn->connect_error);
}

?>