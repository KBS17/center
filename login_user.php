<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include "config/config.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM members WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Verify the entered password with the hashed password from the database
        if (password_verify($password, $row['password'])) {
            $_SESSION['logStatus'] = 1;
            $_SESSION['userId'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['profile_picture'] = $row['profile_picture'];

            // Redirect to the logged-in page
            header('Location: index.php');
            exit();
        } else {
            // Handle login failure
            echo "Login failed. Please check your username and password.";
        }
    } else {
        // Handle login failure
        echo "Login failed. Please check your username and password.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
