<?php
$servername = "localhost";
$username = "root";
$password = "Project@040824";
$dbname = "center";


$servername = "45.136.253.223";
$username = "bellpup";
$password = "Project@040824";
$dbname = "center";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
