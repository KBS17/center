<?php
include("config/config.php");
session_start(); // เริ่มต้นเซสชัน

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $a1 = $_POST['answer1'];
    $a2 = $_POST['answer2'];
    $a3 = $_POST['answer3'];
    $a4 = $_POST['answer4'];
    $a5 = $_POST['answer5'];
    $member = $_SESSION['userId'];

    // ตัดคำหลังช่องว่าง
    $a1 = strtok($a1, ' ');
    $a2 = strtok($a2, ' ');
    $a3 = strtok($a3, ' ');
    $a4 = strtok($a4, ' ');
    $a5 = strtok($a5, ' ');

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare("INSERT INTO log_analy_answer (member_id, answer_1, answer_2, answer_3, answer_4,answer_5) VALUES (?, ?, ?, ?, ?, ?)");

    // ตรวจสอบความสำเร็จของการเตรียมคำสั่ง
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // ผูกพารามิเตอร์
    $stmt->bind_param("ssssss", $member, $a1, $a2, $a3, $a4,$a5);

    // ดำเนินการคำสั่ง
    if ($stmt->execute()) {
        header("Location: analysis.php");
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
