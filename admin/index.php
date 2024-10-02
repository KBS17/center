<?php
    include "../config/config.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap5.css" />

</head>

<body id="page-top">



    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
            include("nav.php");
        ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <?php

// ดึงข้อมูลจำนวนผู้ใช้
$sql = "SELECT COUNT(*) as username FROM members"; // สมมติว่าชื่อตารางคือ 'members'
$result = $conn->query($sql);

// เก็บจำนวนผู้ใช้ในตัวแปร
$username = 0;
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
}

$sql2 = "SELECT COUNT(*) as product FROM products"; // สมมติว่าชื่อตารางคือ 'members'
$result2 = $conn->query($sql2);

$product = 0;
if ($result2 && $result2->num_rows > 0) {
    $row = $result2->fetch_assoc();
    $product = $row['product'];
}
$sql3 = "SELECT COUNT(*) as problems FROM problems"; // สมมติว่าชื่อตารางคือ 'members'
$result3 = $conn->query($sql3);

$problems = 0;
if ($result3 && $result3->num_rows > 0) {
    $row = $result3->fetch_assoc();
    $problems = $row['problems'];
}
// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <a href="member.php" style="text-decoration: none;">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            MEMBER (สมากชิก)
                                        </div>
                                    </a>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= htmlspecialchars($username) ?>
                                    </div> <!-- แสดงจำนวนผู้ใช้จริง -->
                                </div>
                                <div class="col-auto">
                                    <!-- <a href="img/users.png"> -->
                                        <img src="img/users.png" alt="img/users.png"
                                            style="width: 40px; height: 40px;">
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <a href="productsdash.php" style="text-decoration: none;">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            PRODUCTS (เครื่องสำอาง)
                                        </div>
                                    </a>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= htmlspecialchars($product) ?>
                                    </div> <!-- แสดงจำนวนผู้ใช้จริง -->
                                </div>
                                <div class="col-auto">
                                    
                                        <img src="img/heart.png" alt="img/heart.png"
                                            style="width: 40px; height: 40px;">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <a href="problemsdash.php" style="text-decoration: none;">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            PROBLEMS (ปัญหาผิว)
                                        </div>
                                    </a>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= htmlspecialchars($problems) ?>
                                    </div> <!-- แสดงจำนวนผู้ใช้จริง -->
                                </div>
                                <div class="col-auto">
                                    <!-- <a href="img/edit.png"> -->
                                        <img src="img/edit.png" alt="img/edit.png"
                                            style="width: 40px; height: 40px;">
                                    
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <?php
                    session_start();
                    include "../config/config.php";

                    $sql = "SELECT * FROM problems";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    ?>

                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                เครื่องสำอางสำหรับผิวหน้า</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Skin</th>
                                            <th>Product</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) {
                                            $problemId = $row['id'];
                                            // Prepare and execute the count query
                                            $sql2 = "SELECT COUNT(*) as total FROM analysis WHERE problems_id = ?";
                                            $stmt2 = $conn->prepare($sql2);
                                            $stmt2->bind_param("i", $problemId);
                                            $stmt2->execute();
                                            $result2 = $stmt2->get_result();
                                            $countRow = $result2->fetch_assoc();
                                            $total = $countRow['total'];
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['id']) ?></td>
                                            <td><?= htmlspecialchars($row['problems']) ?></td>
                                            <td><?= htmlspecialchars($total) ?></td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>



                <?php
                    session_start();
                    include "../config/config.php";

                    $sql = "SELECT * FROM admins";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                ?>

                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="container-fluid">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">จำนวนผู้ดูแลระบบ</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable table-hover" id="dataTable"
                                        width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th> <!-- เปลี่ยนจาก id เป็น # เพื่อแสดงลำดับ -->
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $counter = 1; // เริ่มนับลำดับจาก 1
                                                 while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?= $counter ?></td> <!-- แสดงลำดับของผู้ใช้ -->
                                                <td><?= htmlspecialchars($row['username']) ?></td>
                                                <td><?= htmlspecialchars($row['email']) ?></td>
                                                <td><?= htmlspecialchars($row['number']) ?></td>
                                            </tr>
                                            <?php
                        $counter++; // เพิ่มค่า $counter ทีละ 1 ในแต่ละรอบของลูป
                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </div>

                    <!-- End of Main Content -->






                </div>








                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/chart.js/Chart.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/chart-area-demo.js"></script>
                <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>