<?php
include("config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    
    // Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    if (!preg_match('/^[0-9]{10,15}$/', $number)) {
        echo "Invalid phone number.";
        exit();
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO admins (username, password, email, number) VALUES (?, ?, ?, ?)");
    
    // Bind parameters in correct order
    $stmt->bind_param("ssss", $username, $hashed_password, $email, $number);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect before sending any output
        header("Location: form_admin.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>

