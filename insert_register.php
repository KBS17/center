<?php
include("config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    
    // Handle profile picture upload
    if(isset($_FILES["Profilepicture"]) && $_FILES["Profilepicture"]["error"] == 0){
        $file_tmp = $_FILES["Profilepicture"]["tmp_name"];
        $file_name = basename($_FILES["Profilepicture"]["name"]);
        $upload_dir = "uploads/";
        
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $profile_picture_path = $upload_dir . $file_name;

        if(move_uploaded_file($file_tmp, $profile_picture_path)){
            // File uploaded successfully
        } else {
            echo "Error uploading the profile picture.";
            exit();
        }
    } else {
        // Assign a default profile picture if none was uploaded
        $profile_picture_path = "uploads/default_profile_picture.png"; // Ensure this file exists
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO member (m_name, m_password, m_Age, m_number, m_Email, m_profile_picture) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $hashed_password, $age, $number, $email, $profile_picture_path);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo "Survey submitted successfully!";
    header("Location: form_login.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
