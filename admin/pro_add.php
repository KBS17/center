<?php
include("../config/config.php");

$sql1 = "SELECT * FROM categories ";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM brands ";
$result2 = mysqli_query($conn, $sql2);
$sql3 = "SELECT * FROM type_products ";
$result3 = mysqli_query($conn, $sql3);
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
                <a class="nav-link" href="notify.php"><i class="bi bi-archive-fill"></i><span>จัดการข้อมูลการข่าวสาร</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="edit_m.php"><i class="bi bi-archive-fill"></i><span>จัดการข้อมูลสมาชิก</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="skin.php"><i class="bi bi-archive-fill"></i><span>จัดการข้อมูลเครื่องสำอางสำหรับผิวหน้า</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-box-arrow-right"></i><span>Logout</span></a>
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
                            <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                        </div>
                        <div class="card-body">
                            <form action="insert_pro.php" method="post" enctype="multipart/form-data">
                                <div class="d-flex">
                                    <div class="col-10 col-sm-8 col-lg-6 pt-5 text-center">
                                        <img src="img/upload.png" width="400" height="400" class="img-fluid rounded">
                                        <h1 class="text-primary">Upload Images</h1>
                                    </div>

                                    <div class="col">
                                        <!-- Product Name -->
                                        <div class="mb-3">
                                            <label for="ProductName" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" name="proname" id="ProductName"
                                                placeholder="Product name" required>
                                        </div>
                                        <!-- Product price -->
                                        <div class="mb-3">
                                            <label for="ProductPrice" class="form-label">Product Name</label>
                                            <input type="number" class="form-control" name="proprice" id="ProductPrice"
                                                placeholder="Product price" required>
                                        </div>

                                        <!-- Product Type -->
                                        <div class="mb-3">
                                            <label for="ProductType" class="form-label">Product Type</label>
                                            <select class="form-select" name="type_id" aria-label="ProductType" required>
                                                <option selected disabled>Select Product Type</option>
                                                <?php while ($typeProducts = $result3->fetch_assoc()): ?>
                                                    <option value=<?= $typeProducts['id'] ?>><?= $typeProducts['type_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <!-- Product Categories -->
                                        <div class="mb-3">
                                            <label for="ProductCategories" class="form-label">Product Categories</label>
                                            <select class="form-select" name="categories_id" aria-label="ProductCategories" required>
                                                <option selected disabled>Select Product Categories</option>
                                                <?php while ($categories = $result1->fetch_assoc()): ?>
                                                    <option value=<?= $categories['id'] ?>><?= $categories['categories_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <!-- Product Brands -->
                                        <div class="mb-3">
                                            <label for="ProductBrands" class="form-label">Product Brands</label>
                                            <select class="form-select" name="brand_id" aria-label="ProductBrands" required>
                                                <option selected disabled>Select Product Brands</option>
                                                <?php while ($brand = $result2->fetch_assoc()): ?>
                                                    <option value=<?= $brand['id'] ?>><?= $brand['brand_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <!-- Product Description -->
                                        <div class="mb-3">
                                            <label for="ProductDescription" class="form-label">Product Description</label>
                                            <textarea class="form-control" name="description" id="ProductDescription" rows="5" required></textarea>
                                        </div>

                                        <!-- Main Product Picture Upload -->
                                        <div class="mb-3">
                                            <label for="showimages" class="form-label">Main Product Picture</label>
                                            <input type="file" class="form-control" id="showimages" name="showimages" accept="image/*" required>
                                        </div>

                                        <!-- Additional Product Pictures Upload -->
                                        <div class="mb-3">
                                            <label for="images" class="form-label">Other Product Pictures</label>
                                            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
                                        </div>

                                        <!-- Hidden Product ID -->
                                        <input type="hidden" class="form-control" name="proid" id="ProductId">
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