<?php
include("config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $number = $_POST["number"];
    $email = $_POST["email"];

    // Handle profile picture upload
    if (isset($_FILES["Profilepicture"]) && $_FILES["Profilepicture"]["error"] == 0) {
        $file_tmp = $_FILES["Profilepicture"]["tmp_name"];
        $file_name = basename($_FILES["Profilepicture"]["name"]);
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");

        // Validate file type
        if (in_array($file_type, $allowed_types)) {
            $upload_dir = "uploads/";

            // Create upload directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate unique file name to prevent collisions
            $profile_picture_path = $upload_dir . uniqid() . "." . $file_type;

            // Move uploaded file to the target directory
            if (move_uploaded_file($file_tmp, $profile_picture_path)) {
                // File uploaded successfully
            } else {
                echo "Error uploading the profile picture.";
                exit();
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit();
        }
    } else {
        // Assign a default profile picture if none was uploaded
        $profile_picture_path = "uploads/default_profile_picture.png"; // Ensure this file exists
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO members (username, password, age, number, email, profile_picture) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $hashed_password, $age, $number, $email, $profile_picture_path);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Survey submitted successfully!";
        header("Location: form_login.php");
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
