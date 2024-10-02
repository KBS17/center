<?php
include("config/config.php");


session_start();
$logStatus = isset($_SESSION['logStatus']) ? $_SESSION['logStatus'] : 0;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$profile = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : null;
if ($logStatus == 0) {
    header("Location: form_login.php");
}


$sql1 = "SELECT * FROM categories";
$result1 = mysqli_query($conn, $sql1);


$sql2 = "SELECT * FROM brands";
$result2 = mysqli_query($conn, $sql2);


$sql3 = "SELECT * FROM products";
$result3 = mysqli_query($conn, $sql3);


$products = [];
while ($row = $result3->fetch_assoc()) {
    $products[] = $row;
}


$id1 = isset($_GET['id1']) ? intval($_GET['id1']) : 0;
$id2 = isset($_GET['id2']) ? intval($_GET['id2']) : 0;

$productDetail1 = null;
$productDetail2 = null;

//ดึงข้อมูลสินค้า โดยใช้ id1
if ($id1 > 0) {
    $stmt1 = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt1->bind_param("i", $id1);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $productDetail1 = $result1->fetch_assoc();
}


if ($id2 > 0) {
    $stmt2 = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt2->bind_param("i", $id2);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $productDetail2 = $result2->fetch_assoc();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body> 
    <?php
 include("nav.php");

 ?>


    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-5 mx-3 rounded p-3">
                <div class="mb-3">
                    <label for="Products1" class="form-label">Product 1</label>
                    <select class="form-select" name="Products1" aria-label="Products1" onchange="window.location.href='?id1='+this.value+'&id2=<?= $id2 ?>';">
                        <option selected disabled>Select Product</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= htmlspecialchars($product['id']) ?>" <?= ($id1 == $product['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($product['pro_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <hr>
                </div>

                <?php if ($productDetail1): ?>
                    <div class="card" style="width: 100%;">
                        <img src="uploads/products/<?= htmlspecialchars($productDetail1['picture_name']) ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($productDetail1['pro_name']) ?></h5>
                            <h5 class="card-title">Price: <?= htmlspecialchars($productDetail1['pro_price']) ?> ฿ .-</h5>
                            <footer class="blockquote-footer mt-2">Description</footer>
                            <p class="card-text"><?= htmlspecialchars($productDetail1['description']) ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-center">Please select a product to view details.</p>
                <?php endif; ?>
            </div>

            <div class="col-lg-5 mx-3 rounded p-3">
                <div class="mb-3">
                    <label for="Products2" class="form-label">Product 2</label>
                    <select class="form-select" name="Products2" aria-label="Products2" onchange="window.location.href='?id1=<?= $id1 ?>&id2='+this.value;">
                        <option selected disabled>Select Product</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= htmlspecialchars($product['id']) ?>" <?= ($id2 == $product['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($product['pro_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <hr>
                </div>

                <?php if ($productDetail2): ?>
                    <div class="card" style="width: 100%;">
                        <img src="uploads/products/<?= htmlspecialchars($productDetail2['picture_name']) ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($productDetail2['pro_name']) ?></h5>
                            <h5 class="card-title">Price: <?= htmlspecialchars($productDetail2['pro_price']) ?> ฿ .-</h5>
                            <footer class="blockquote-footer mt-2">Description</footer>
                            <p class="card-text"><?= htmlspecialchars($productDetail2['description']) ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-center">Please select a product to view details.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzeytrw3tBTwtTfGxpyMIe7Cw9OrtxEWbEpP1WJHltgJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-rbsA2VBKQQUU/ujLRBgnz3j5UQU6sdmU4aYi5y3pcrlm6GFa8dql4PMSvM5lcC2x" crossorigin="anonymous"></script>
</body>

</html>

