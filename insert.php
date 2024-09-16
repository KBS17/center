<?php
session_start();
include "config/config.php"; 

if (isset($_POST['notify'])) {
    $noti = $_POST['notify'];

  
    $query = "INSERT INTO notify (notify) VALUES (?)";


    if ($stmt = $conn->prepare($query)) {

        $stmt->bind_param('s', $noti);

        if ($stmt->execute()) {
            header("Location: index_noti.php");
        } else {
            echo json_encode('error');
        }


        $stmt->close();
    } else {
        echo json_encode('error');
    }

    $conn->close();
}
?>
