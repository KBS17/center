<?php
include("config/config.php");

session_start();
$logStatus = isset($_SESSION['logStatus']) ? $_SESSION['logStatus'] : 0;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$profile = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : null;

// Ensure ID is valid
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Prepare and execute the SQL statement for product details
$sql = "SELECT products.*, type_products.type_name, categories.categories_name, brands.brand_name 
        FROM products 
        INNER JOIN type_products ON products.type_id = type_products.id
        INNER JOIN categories ON products.categories_id = categories.id
        INNER JOIN brands ON products.brand_id = brands.id 
        WHERE products.id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Product not found');
}

$row = $result->fetch_assoc();

// Prepare and execute the SQL statement for product images
$sqlImages = "SELECT * FROM picture WHERE product_id = ?";
$stmtImages = $conn->prepare($sqlImages);
if ($stmtImages === false) {
    die("Prepare failed: " . $conn->error);
}
$stmtImages->bind_param('i', $id);
$stmtImages->execute();
$resultImages = $stmtImages->get_result();

// Fetch categories and brands for the navbar
$sqlCategories = "SELECT * FROM categories";
$sqlBrands = "SELECT * FROM brands";
$resultCategories = $conn->query($sqlCategories);
$resultBrands = $conn->query($sqlBrands);

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ศูนย์กลางเครื่องสำอาง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="px-5 d-flex align-items-center" style="background-color: #D9D9D9;">
        <nav class="navbar navbar-expand-lg" style="width: 100%;">
            <div class="container-fluid">
                <a class="navbar-brand" href="/center">
                    <img src="img/logo.png" width="100" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="conmetic.php">Cosmetic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="skincare.php">Skin care</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                <?php while ($category = $resultCategories->fetch_assoc()): ?>
                                    <li><a class="dropdown-item" href="categories.php?id=<?= htmlspecialchars($category['id']) ?>"><?= htmlspecialchars($category['categories_name']) ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Brands
                            </a>
                            <ul class="dropdown-menu">
                                <?php while ($brand = $resultBrands->fetch_assoc()): ?>
                                    <li><a class="dropdown-item" href="brands.php?id=<?= htmlspecialchars($brand['id']) ?>"><?= htmlspecialchars($brand['brand_name']) ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </li>
                        <?php if ($logStatus == 1): ?>
                            <li class="nav-item">
                                <a class="nav-link " href="compare.php">Compare</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="poll.php">Poll</a>
                            </li>
                        <?php else: ?>

                        <?php endif; ?>
                    </ul>
                    <?php if ($logStatus == 1): ?>
                        <div class="d-flex align-items-center">
                            <div class="text-center">
                                <img src="uploads/user/<?= htmlspecialchars($profile) ?>" style="max-height:40px;" class="rounded-circle me-2 img-fluid">
                            </div>
                            <span class="me-3 fs-5 border-end border-1 border-secondary pe-3 ">@<?= htmlspecialchars($username) ?></span>
                            <a href="logout.php" class="btn btn-outline-danger  " style="width: auto;"> <i class="bi bi-box-arrow-right"></i> Logout</a>
                        </div>
                    <?php else: ?>
                        <div>
                            <a href="form_login.php" class="btn btn-outline-success" style="width: auto;">Login</a>
                            <a href="form_register.php" class="btn btn-primary" style="width: auto;">Register</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="album ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-10 col-sm-8 col-lg-6 pt-5 text-center">
                        <!-- Display main product image -->
                        <img src="uploads/products/<?= htmlspecialchars($row['picture_name']) ?>"
                            alt="<?= htmlspecialchars($row['pro_name']) ?>"
                            width="400" height="400"
                            class="img-fluid rounded">

                        <!-- Thumbnails -->
                        <div class="rounded p-2 mt-5 d-flex g-3 justify-content-center">
                            <?php if ($resultImages->num_rows > 0): ?>
                                <?php while ($image = $resultImages->fetch_assoc()): ?>
                                    <button class="border border-0 bg-transparent">
                                        <img src="uploads/products/<?= htmlspecialchars($image['picture_name']) ?>"
                                            class="rounded float-start"
                                            width="70"
                                            alt="Thumbnail">
                                    </button>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p><i class="bi bi-card-image"></i> No additional images available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6 pt-5">
                        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?= htmlspecialchars($row['pro_name']) ?></h1>
                        <h4 class="fw-bold text-body-emphasis lh-2 mb-3"><?= htmlspecialchars($row['pro_price']) ?> ฿ .-</h4>
                        <p class="fw-lighter"><?= htmlspecialchars($row['description']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>