<!-- <?php -->
// การตั้งค่าการเชื่อมต่อกับฐานข้อมูล
// $servername = "45.136.253.223";
// $username = "adminroot";
// $password = "Project@040824";
// $dbname = "center";

// สร้างการเชื่อมต่อ
// $conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// รับค่าจากฟอร์ม
// $message = $_POST['message'];

// เตรียม SQL statement เพื่อเก็บข้อมูล
// $sql = "INSERT INTO message (message) VALUES ('$message')";

// if ($conn->query($sql) === TRUE) {
//     echo "บันทึกข้อความของท่านเรียบร้อยแล้ว";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// ปิดการเชื่อมต่อ
// $conn->close();
// ?>

<!-- index.html -->
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Textarea Box</title>
    <style>
        textarea {
            width: 300px;
            height: 150px;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container {
            margin: 20px;
        }
    </style>
</head>
<body>

    <h2>Enter your message:</h2>
    <div class="form-container">
        <form action="submit_message.php" method="POST">
            <textarea name="message" placeholder="Type your message here..." required></textarea><br>
            <input type="submit" value="Submit">
        </form>
    </div>

</body>
</html> -->

