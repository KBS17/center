<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include "config/config.php";

    $username = $_POST['admin_id'];
    $password = $_POST['admin_password'];

    // Log the username being used for login
    error_log("Attempted login with username: " . $username);

    // Prepare and execute the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Log retrieved database record
        error_log("User found: " . print_r($row, true));

        // Verify the entered password with the hashed password from the database
        if (password_verify($password, $row['password'])) {
            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id();

            $_SESSION['admin'] = 1;

            error_log("Login successful for user: " . $username);
            header('Location: admin/edit_m.php');
            exit();
        } else {
            error_log("Password verification failed for user: " . $username);
            echo "Login failed 1 Please check your username and password.";
        }
    } else {
        error_log("No user found with username: " . $username);
        echo "Login failed 2 Please check your username and password.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
    error_log("Invalid request method.");
}
?>
