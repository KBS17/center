<?php
include("config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $age = trim($_POST["age"]);
    $number = trim($_POST["number"]);
    $email = trim($_POST["email"]);

    // กำหนดเส้นทางรูปภาพโปรไฟล์เริ่มต้น
    $profile_picture_path = "default_profile_picture.png"; // รูปเริ่มต้น

    // ตรวจสอบการอัปโหลดรูปโปรไฟล์
    if (isset($_FILES["Profilepicture"]) && $_FILES["Profilepicture"]["error"] == 0) {
        $file_tmp = $_FILES["Profilepicture"]["tmp_name"];
        $file_name = basename($_FILES["Profilepicture"]["name"]);
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");
        $max_file_size = 2 * 1024 * 1024; // จำกัดขนาด 2MB

        // ตรวจสอบขนาดไฟล์
        if ($_FILES["Profilepicture"]["size"] > $max_file_size) {
            echo "ขนาดไฟล์เกิน 2MB.";
            exit();
        }

        // ตรวจสอบชนิดไฟล์
        if (!in_array($file_type, $allowed_types)) {
            echo "ชนิดไฟล์ไม่ถูกต้อง. อนุญาตเฉพาะไฟล์ JPG, JPEG, PNG, และ GIF เท่านั้น.";
            exit();
        }

        $upload_dir = "uploads/user/";

        // สร้างไดเรกทอรีอัปโหลดหากยังไม่มี
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // สร้างชื่อไฟล์ที่ไม่ซ้ำกัน
        $profile_picture_name = uniqid() . "." . $file_type;
        $profile_picture_path = $profile_picture_name;

        // ย้ายไฟล์ที่อัปโหลดไปยังไดเรกทอรีเป้าหมาย
        if (!move_uploaded_file($file_tmp, $upload_dir . $profile_picture_name)) {
            echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ.";
            exit();
        }
    }

    // แฮชรหัสผ่านอย่างปลอดภัย
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare("INSERT INTO members (username, password, age, number, email, profile_picture) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $hashed_password, $age, $number, $email, $profile_picture_path);

    // ดำเนินการคำสั่งและตรวจสอบข้อผิดพลาด
    if ($stmt->execute()) {
        header("Location: form_login.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }

    // ปิด statement และ connection
    $stmt->close();
    $conn->close();
} else {
    echo "คำขอไม่ถูกต้อง.";
}
?>
