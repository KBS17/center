<?php
include("../config/config.php");

$sql1 = "SELECT * FROM products ";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM problems ";
$result2 = mysqli_query($conn, $sql2);

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

                <!-- Content Example -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Analysis</h6>
                        </div>
                        <div class="card-body">
                            <form action="insert_analysis.php" method="post">
                                <div class="col">
                                    <!-- Product Categories -->
                                    <div class="mb-3">
                                        <label for="product" class="form-label">Products</label>
                                        <select class="form-select" name="product" aria-label="product" required>
                                            <option selected disabled>Select Products</option>
                                            <?php while ($products = $result1->fetch_assoc()): ?>
                                                <option value=<?= $products['id'] ?>><?= $products['pro_name'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <!-- Product Brands -->
                                    <div class="mb-3">
                                        <label for="skin" class="form-label">Skin</label>
                                        <select class="form-select" name="skin" aria-label="skin" required>
                                            <option selected disabled>Select Skin</option>
                                            <?php while ($problems = $result2->fetch_assoc()): ?>
                                                <option value=<?= $problems['id'] ?>><?= $problems['problems'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="my-5">
                                    <!-- Save and Cancel Buttons -->
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a href="products.php" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- End of Main Content -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>