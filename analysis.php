<?php
include("config/config.php");
session_start();

$logStatus = isset($_SESSION['logStatus']) ? $_SESSION['logStatus'] : 0;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$userud = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$profile = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : null;

if ($logStatus == 0) {
    header("Location: form_login.php");
}

$sql1 = "SELECT * FROM categories ";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM brands ";
$result2 = mysqli_query($conn, $sql2);


$a1 = $_GET['q1'];
$a2 = $_GET['q2'];
$a3 = $_GET['q3'];
$a4 = $_GET['q4'];
$a5 = $_GET['q5'];

// Use prepared statements to prevent SQL injection
$stmt1 = $conn->prepare("SELECT * FROM problems WHERE problems IN (?, ?, ?, ?, ?)");
$stmt1->bind_param("sssss", $a1, $a2, $a3, $a4, $a5);
$stmt1->execute();
$problemsResult = $stmt1->get_result();

$stmt2 = $conn->prepare("SELECT DISTINCT products.*, problems.problems 
FROM products 
INNER JOIN analysis ON analysis.product_id = products.id 
INNER JOIN problems ON problems.id = analysis.problems_id 
WHERE problems.problems IN (?, ?, ?, ?, ?)");
$stmt2->bind_param("sssss", $a1, $a2, $a3, $a4, $a5);
$stmt2->execute();
$productResult = $stmt2->get_result();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>ผลวิเคราะ</title>
    <link href="style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header class="px-5 d-flex align-items-center" style="background-color: #D9D9D9;">
        <nav class="navbar navbar-expand-lg" style="width: 100%;">
            <div class="container-fluid">
                <a class="navbar-brand" href="/center">
                    <img src="img/logo.png" width="100" alt="">
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
                                <?php while ($categories = $result1->fetch_assoc()): ?>
                                    <li><a class="dropdown-item" href="categories.php?id=<?= htmlspecialchars($categories['id']) ?>"><?= htmlspecialchars($categories['categories_name']) ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Brands
                            </a>
                            <ul class="dropdown-menu">
                                <?php while ($brands = $result2->fetch_assoc()): ?>
                                    <li><a class="dropdown-item" href="brands.php?id=<?= htmlspecialchars($brands['id']) ?>"><?= htmlspecialchars($brands['brand_name']) ?></a></li>
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

    <div class="container mt-5  px-5 row flex-lg-row-reverse align-items-center g-5 py-5">

        <div class="row  row-col-lg-6">
            <?php if ($problemsResult->num_rows > 0): ?>
                <?php while ($problems = $problemsResult->fetch_assoc()): ?>
                    <h3 class=" fw-bold text-body-emphasis lh-1 mb-3"><?= htmlspecialchars($problems['problems']) ?></h3>
                    <p class=" fs-6  fw-light"><?= htmlspecialchars($problems['description']) ?></p>

                <?php endwhile; ?>
            <?php else: ?>
                <p>No problems found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class=" container row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        <?php if ($productResult->num_rows > 0): ?>
            <?php while ($product = $productResult->fetch_assoc()): ?>
                <a href="details.php?id=<?= htmlspecialchars($product['id']) ?>" class="link-underline link-underline-opacity-0">
                    <div class="col">
                        <div class="card">
                            <img src="uploads/products/<?= htmlspecialchars($product['picture_name']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['pro_name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($product['pro_name']) ?></h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Price <?= htmlspecialchars($product['pro_price']) ?> ฿ .-</h6>
                                <p class="card-text description"><?= htmlspecialchars($product['description']) ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>No data available</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>