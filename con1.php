<?php
session_start();
include "../config/config.php";

$sql = "SELECT * FROM notify";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>