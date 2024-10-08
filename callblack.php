<?php
session_start();
require_once('LineLogin.php');

$line = new LineLogin();
$get = $_GET;

$code = $get['code'];
$state = $get['state'];
$token = $line->token($code, $state);

if ($token === false || property_exists($token, 'error')) {

    header('location: index.php');
    exit(); 
}

if ($token->id_token) {
    $profile = $line->profileFormIdToken($token);
    
    $_SESSION['line'] = $profile;
    $_SESSION['logStatus'] = 1;
    header('location: index.php');
    exit(); // Add exit to prevent further execution
}

