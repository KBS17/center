<?php
require_once('LineLogin.php');
    session_start();
    $line = new LineLogin();
    $line->revoke($profile->access_token);
    session_unset(); // Clear the session data
    session_destroy();
    header('Location: index.php'); // Redirect to login page
    exit();

?>