<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include "config/config.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    echo "tast",$username,$password;
    // Prepare and execute the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM member WHERE m_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Verify the entered password with the hashed password from the database
        if (password_verify($password, $row['m_password'])) {
            $_SESSION['m_name'] = 1;

            // If you want to retrieve and use the profile picture
            $_SESSION['m_profile_picture'] = $row['m_profile_picture'];

            header('Location: index_log.php');
            exit();
        } else {
            echo "Login failed1. Please check your username and password.";
        }
    } else {
        echo "Login failed2. Please check your username and password.";
    }

    // Close the statement
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>