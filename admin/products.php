<?php
session_start();
include "../config/config.php";

// Fetch members data
$sql = "SELECT * FROM products ";
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
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion px-2" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"> Admin </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-archive-fill"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="products.php"><i class="bi bi-archive-fill"></i><span>จัดการข้อมูลเครื่องสำอาง</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="edit_m.php"><i class="bi bi-archive-fill"></i><span>จัดการข้อมูลสมาชิก</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="skin.php"><i class="bi bi-archive-fill"></i><span>จัดการข้อมูลเครื่องสำอางสำหรับผิวหน้า</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="problems_m.php"><i class="bi bi-archive-fill"></i><span>ข้อมูลการแนะนำเครื่องสำอาง</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="review_mes.php"><i class="bi bi-archive-fill"></i><span>จัดการข้อมูลการรีวิว</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <!-- <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-box-arrow-right"></i><span>logout </span></a>
            </li> -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="d-flex justify-content-between  align-items-center  card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">จัดการข้อมูลเครื่องสำอาง</h6>
                            <a href="pro_add.php" class="btn btn-outline-success"> Add Product</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                            <th>Types</th>
                                            <th>Catagories</th>
                                            <th>Brands</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td class="description-cell">
                                                    <?php if (!empty($row['picture_name'])): ?>
                                                        <div class="text-center">
                                                            <img src="../uploads/products/<?= htmlspecialchars($row['picture_name']) ?>" style="max-height: 50px;" class="rounded img-fluid">
                                                        </div>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                                <td class="description-cell"><?= !empty($row['pro_name']) ? htmlspecialchars($row['pro_name']) : 'N/A' ?></td>
                                                <td><?= !empty($row['pro_price']) ? htmlspecialchars($row['pro_price']) : 'N/A' ?></td>
                                                <td class="description-cell"><?= !empty($row['description']) ? htmlspecialchars($row['description']) : 'N/A' ?></td>
                                                <td><?= !empty($row['type_id']) ? htmlspecialchars($row['type_id']) : 'N/A' ?></td>
                                                <td><?= !empty($row['categories_id']) ? htmlspecialchars($row['categories_id']) : 'N/A' ?></td>
                                                <td><?= !empty($row['brand_id']) ? htmlspecialchars($row['brand_id']) : 'N/A' ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button class="btn btn-danger mx-2" onclick="deleteProduct(<?= htmlspecialchars($row['id']) ?>)">
                                                            <i class="bi bi-trash3-fill"></i>
                                                        </button>
                                                        <button class="btn btn-warning mx-2" onclick="window.location.href='pro_edit.php?id=<?= htmlspecialchars($row['id']) ?>'">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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




    <script>
        function deleteProduct(proId) {
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = 'pro_delete.php?id=' + proId;
            }
        }
    </script>

</body>

</html>

<?php
$stmt->close();
$conn->close(); // Close the database connection
?>