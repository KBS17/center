<?php
    session_start();
    if ( $_SESSION['logStatus'] != 1) {
        header("Location: index.php");
    }
?>