<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "45.136.253.223";
$username = "adminroot";
$password = "Project@040824";
$dbname = "center";

$conn = new mysqli($servername, $username, $password, $dbname);
// Handle form submission
// บันทึกข้อความ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
// ตัวอย่างการตรวจสอบการเก็บ username ในเซสชัน
session_start(); // ให้แน่ใจว่าเริ่มเซสชัน
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'linelogin';


    if (!empty($message)) {
        // ใช้ username ในคำสั่ง INSERT สำหรับตาราง message
        $sql = "INSERT INTO message (message, username) VALUES ('$message', '$username')"; 

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>บันทึกข้อความของท่านเรียบร้อยแล้ว</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning' role='alert'>ไม่ได้รับข้อความจากฟอร์ม</div>";
    }
}




$sql = "SELECT message.message, message.created_at, members.username 
        FROM message 
        LEFT JOIN members ON message.username = members.username"; // แก้ไขตรงนี้


$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reviews</title>
    <link href="style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap5.css" />


    <style>
    .message-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 18px;
        text-align: left;
    }

    .message-table th,
    .message-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .message-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .message-table th {
        background-color: #4CAF50;
        color: white;
    }
    </style>
</head>

<body id="page-top">


<?php
 include("nav.php");

 ?>

        
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <!-- <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                    </ul>
                </nav> -->


                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <!-- <div class="card shadow mb-4"> -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">รีวิว</h6>
                    </div>
                    <div class="card-body">
                        <!-- Message Form -->


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>รายละเอียด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td>
                                                <strong>@</strong>
                                                <?= htmlspecialchars($row['username'] ?? '') ?><br>
                                                <strong></strong>
                                                <?= htmlspecialchars($row['message']) ?><br>
                                                <strong></strong>
                                                <?= htmlspecialchars($row['created_at']) ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>






                        <form method="post" action="">
                            <div class="mb-3">
                                <div class=" ms-4">

                                <label for="message" class="form-label">รายละเอียดการรีวิว</label>
                                <textarea class="form-control" id="message" name="message" rows="5"
                                    style="height: 150px; width: 50%;" required></textarea>
                                    </div>
                            </div>

                            <div class=" ms-4">
                            <button type="submit" class="btn btn-primary ">Submit</button>
                            <a href="index.php" class="btn btn-dark">Back</a>
                            </div>
                        </form>
                        












                    </div>
                    <!-- /.container-fluid -->
                    <!-- </div> -->
                    <!-- End of Main Content -->
                </div>
                <!-- End of Content Wrapper -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap5.js"></script>


</body>

</html>

<?php
$stmt->close();
$conn->close(); // Close the database connection
?>