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
    <?php
            include("nav.php");
        ?>


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
                            <h6 class="m-0 font-weight-bold text-primary">เพิ่มเครื่องสำอาง</h6>
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
                                            <label for="ProductName" class="form-label">ชื่อเครื่องสำอาง</label>
                                            <input type="text" class="form-control" name="proname" id="ProductName"required>
                                        </div>
                                        <!-- Product price -->
                                        <div class="mb-3">
                                            <label for="ProductPrice" class="form-label">ราคา</label>
                                            <input type="number" class="form-control" name="proprice" id="ProductPrice"required>
                                        </div>

                                        <!-- Product Type -->
                                        <div class="mb-3">
                                            <label for="ProductType" class="form-label">ประเภท</label>
                                            <select class="form-select" name="type_id" aria-label="ProductType" required>
                                                <option selected disabled></option>
                                                <?php while ($typeProducts = $result3->fetch_assoc()): ?>
                                                    <option value=<?= $typeProducts['id'] ?>><?= $typeProducts['type_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <!-- Product Categories -->
                                        <div class="mb-3">
                                            <label for="ProductCategories" class="form-label">หมวดหมู่</label>
                                            <select class="form-select" name="categories_id" aria-label="ProductCategories" required>
                                                <option selected disabled></option>
                                                <?php while ($categories = $result1->fetch_assoc()): ?>
                                                    <option value=<?= $categories['id'] ?>><?= $categories['categories_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <!-- Product Brands -->
                                        <div class="mb-3">
                                            <label for="ProductBrands" class="form-label">แบรนด์</label>
                                            <select class="form-select" name="brand_id" aria-label="ProductBrands" required>
                                                <option selected disabled></option>
                                                <?php while ($brand = $result2->fetch_assoc()): ?>
                                                    <option value=<?= $brand['id'] ?>><?= $brand['brand_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <!-- Product Description -->
                                        <div class="mb-3">
                                            <label for="ProductDescription" class="form-label">รายละเอียด</label>
                                            <textarea class="form-control" name="description" id="ProductDescription" rows="5" required></textarea>
                                        </div>

                                        <!-- Main Product Picture Upload -->
                                        <!-- <div class="mb-3">
                                            <label for="showimages" class="form-label">รูปเครื่องสำอางหลัก</label>
                                            <input type="file" class="form-control" id="showimages" name="showimages" accept="image/*" required>
                                        </div> -->






















                                        <!-- Additional Product Pictures Upload -->
                                        <div class="mb-3">
                                            <label for="images" class="form-label">รูปเครื่องสำอางรอง</label>
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