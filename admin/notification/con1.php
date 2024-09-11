<?php
session_start();
include "../config/config.php";

$sql = "SELECT * FROM message";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>