<?php
include("config/config.php");
session_start();

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $password = $_POST['password'];
    $login = $conn->real_escape_string($_POST['username']);

    // Hash the password
    $hashed_password = hash('sha256', $password);

    // Prepare a statement to get the stored hashed password
    $stmt = $conn->prepare("SELECT m_name, m_password FROM member WHERE m_name = ? LIMIT 1");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_username, $stored_hashed_password);
        $stmt->fetch();

        // Verify the hashed password
        if ($hashed_password === $stored_hashed_password) {
            $_SESSION['logStatus'] = 1;
            header("location:index.php");
            exit();
        } else {
            echo "รหัสผ่านไม่ถูกต้อง <a href='login.php'>ย้อนกลับ</a>";
        }
    } else {
        echo "รหัสผ่านไม่ถูกต้อง <a href='login.php'>ย้อนกลับ</a>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
