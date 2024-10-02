<?php
include("config/config.php");

// Validate and sanitize input
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

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

$sqlImages = "SELECT picture_name FROM picture WHERE product_id = ?";
$stmtImages = $conn->prepare($sqlImages);
if ($stmtImages === false) {
    die("Prepare failed: " . $conn->error);
}
$stmtImages->bind_param("i", $id);
$stmtImages->execute();
$resultImages = $stmtImages->get_result();

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include("nav.php"); ?>

<div class="container">
    <div class="album">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-sm-8 col-lg-6 pt-5 text-center">
                    <img src="uploads/products/<?= htmlspecialchars($row['picture_name']) ?>" alt="<?= htmlspecialchars($row['pro_name']) ?>" width="400" height="400" class="img-fluid rounded">

                    <div class="rounded p-2 mt-5 d-flex g-3 justify-content-center">
                        <?php if ($resultImages->num_rows > 0): ?>
                            <?php while ($image = $resultImages->fetch_assoc()): ?>
                                <button class="border border-0 bg-transparent">
                                    <img src="uploads/products/<?= htmlspecialchars($image['picture_name']) ?>" class="rounded float-start" width="70" alt="Thumbnail">
                                </button>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No additional images available.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 pt-5">
                    <h1 class="display-5 fw-bold"><?= htmlspecialchars($row['pro_name']) ?></h1>
                    <h4 class="fw-bold">ราคา <?= htmlspecialchars($row['pro_price']) ?> ฿</h4>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
