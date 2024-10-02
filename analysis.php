<?php
include("config/config.php");
session_start();

$logStatus = isset($_SESSION['logStatus']) ? $_SESSION['logStatus'] : 0;

if ($logStatus == 0) {
    header("Location: form_login.php");
}



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

    <?php
 include("nav.php");

 ?>

    <div class="container d-flex justify-content-center align-items-center flex-column mt-5 px-5 py-5">
        <div class="row col-lg-6 text-center" style="max-width: 800px;">
            <?php if ($problemsResult->num_rows > 0): ?>
            <?php while ($problems = $problemsResult->fetch_assoc()): ?>
            <h3 class="fw-bold text-body-emphasis lh-1 mb-3"
                style="text-align: center; word-spacing: -0.02em; letter-spacing: -0.02em;">
                <?= htmlspecialchars($problems['problems']) ?>
            </h3>
            <p class="fs-6 fw-light"
                style="text-align: justify; line-height: 1.6; word-spacing: -0.02em; letter-spacing: -0.02em;">
                <?= htmlspecialchars($problems['description']) ?>
            </p>
            <?php endwhile; ?>
            <?php else: ?>
            <p>No problems found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="container d-flex justify-content-center mt-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            <?php if ($productResult->num_rows > 0): ?>
            <?php while ($product = $productResult->fetch_assoc()): ?>
            <a href="details.php?id=<?= htmlspecialchars($product['id']) ?>"
                class="link-underline link-underline-opacity-0">
                <div class="col">
                    <div class="card text-left">
                        <!-- เปลี่ยนเป็น text-left -->
                        <img src="uploads/products/<?= htmlspecialchars($product['picture_name']) ?>"
                            class="card-img-top" alt="<?= htmlspecialchars($product['pro_name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"
                                style="text-align: left; word-spacing: -0.02em; letter-spacing: -0.02em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?= htmlspecialchars($product['pro_name']) ?>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary" style="text-align: left;">
                                Price <?= htmlspecialchars($product['pro_price']) ?> ฿ .-
                            </h6>
                            <p class="card-text description"
                                style="text-align: left; line-height: 1.6; word-spacing: -0.02em; letter-spacing: -0.02em;">
                                <?= htmlspecialchars($product['description']) ?>
                            </p>
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
    </div>




</body>

</html>