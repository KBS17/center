<?php
session_start();
include "../config/config.php";

// Fetch members data
$sql = "SELECT * FROM members";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap5.css" />
</head>

<body id="page-top">
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="container-fluid">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">จำนวนผู้ใช้</h6>

                                <div style="text-align: right;">
                                    <a href="index.php" class="btn btn-dark">Back</a>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable table-hover" id="dataTable"
                                        width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th> <!-- เปลี่ยนจาก id เป็น # เพื่อแสดงลำดับ -->
                                                <th>Profile</th>
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>Number</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $counter = 1; // เริ่มนับลำดับจาก 1
                                                 while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?= $counter ?></td> <!-- แสดงลำดับของผู้ใช้ -->
                                                <td>
                                                    <div class="text-center">
                                                        <img src="../uploads/user/<?= htmlspecialchars($row['profile_picture']) ?>"
                                                            style="max-height: 50px;" class="rounded img-fluid">
                                                    </div>
                                                </td>
                                                <td><?= htmlspecialchars($row['username']) ?></td>
                                                <td><?= htmlspecialchars($row['age']) ?></td>
                                                <td><?= htmlspecialchars($row['number']) ?></td>
                                                <td><?= htmlspecialchars($row['email']) ?></td>
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
                <!-- End of Content Wrapper -->
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js">
        </script>
        <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap5.js"></script>


        <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "searching": true
            });
        });
        </script>

</body>

</html>

<?php
$stmt->close();
$conn->close(); // Close the database connection
?>