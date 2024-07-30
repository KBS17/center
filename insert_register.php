<?php
include("config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    $Profilepicture = $_POST["Profilepicture"];

    // Hash the password
    $hashed_password = hash('sha256', $password);

    $stmt = $conn->prepare("INSERT INTO member (m_name, m_password, m_Age, m_number, m_Email, m_profile_picture) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $hashed_password, $age, $number, $email, $Profilepicture);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    echo "Survey submitted successfully!";
    header("Location: login.php");
} else {
    echo "Invalid request.";
}
?>
