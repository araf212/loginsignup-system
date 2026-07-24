<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "loginsignup_system";
$port = 3307;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Database Connection Failed : " . $conn->connect_error);
}

?>