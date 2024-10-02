<?php
include("config/config.php");

// ตรวจสอบสถานะการเข้าสู่ระบบ, ชื่อผู้ใช้ และ userId จาก session
session_start();
$logStatus = $_SESSION['logStatus'] ?? 0;
$username = $_SESSION['username'] ?? '';
$userId = $_SESSION['userId'] ?? null;
$profile = $_SESSION['profile_picture'] ?? null;
// กำหนดค่าเริ่มต้นสำหรับการเลือก skin types (ประเภทผิว)
$selectedSkinTypes = [];

$limit = 8; // จำนวนสินค้า
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
$offset = ($page - 1) * $limit; 
// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['skinTypes'])) {
    $selectedSkinTypes = array_filter($_POST['skinTypes'], 'is_string');
// ดึงข้อมูล skin types ที่ผู้ใช้เลือกมา
    if (!empty($selectedSkinTypes)) {
        
        $placeholders = implode(',', array_fill(0, count($selectedSkinTypes), '?'));

        // ดึงจำนวนสินค้าทั้งหมดที่ตรงกับประเภทผิวที่เลือก
        $totalQuery = "SELECT COUNT(DISTINCT products.id) as total 
                        FROM products 
                        INNER JOIN analysis ON analysis.product_id = products.id 
                        INNER JOIN problems ON problems.id = analysis.problems_id 
                        WHERE products.type_id = 1 AND problems.problems IN ($placeholders)";
        $stmt = $conn->prepare($totalQuery);
        $stmt->bind_param(str_repeat('s', count($selectedSkinTypes)), ...$selectedSkinTypes);
        $stmt->execute();
        $totalResult = $stmt->get_result();
        $totalRow = $totalResult->fetch_assoc();
        $totalProducts = $totalRow['total'];
        $stmt->close();

        
        $totalPages = ceil($totalProducts / $limit);

        // Query สำหรับดึงสินค้าที่ตรงกับประเภทผิวที่เลือก
        $sql = "SELECT DISTINCT products.*, problems.problems 
FROM products 
INNER JOIN analysis ON analysis.product_id = products.id 
INNER JOIN problems ON problems.id = analysis.problems_id 
WHERE products.type_id = 1 AND problems.problems IN ($placeholders)
LIMIT ? OFFSET ?";

        $stmt = $conn->prepare($sql);

        
        $bindParams = array_merge($selectedSkinTypes, [$limit, $offset]);

        
        $types = str_repeat('s', count($selectedSkinTypes)) . 'ii';

        
        $stmt->bind_param($types, ...$bindParams);

        $stmt->execute();
        $productResult = $stmt->get_result();
        $stmt->close();
    } else {
        // กรณีที่ไม่มีประเภทผิวที่ถูกเลือก
        $productResult = [];
        $totalProducts = 0;
        $totalPages = 1;
    }
} else {
    // กรณีที่ไม่มีการใช้ฟิลเตอร์, ดึงจำนวนสินค้าทั้งหมด
    $totalQuery = "SELECT COUNT(*) as total FROM products WHERE type_id = 1";
    $totalResult = $conn->query($totalQuery);
    $totalRow = $totalResult->fetch_assoc();
    $totalProducts = $totalRow['total'];


    $totalPages = ceil($totalProducts / $limit);

    // Query สำหรับดึงสินค้าทั้งหมด
    $productQuery = "SELECT * FROM products WHERE type_id = 1 LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($productQuery);
    $stmt->bind_param('ii', $limit, $offset);
    $stmt->execute();
    $productResult = $stmt->get_result();
    $stmt->close();
}


$queries = [
    "categories" => "SELECT * FROM categories",
    "brands" => "SELECT * FROM brands"
];
$results = [];
foreach ($queries as $key => $query) {
    $results[$key] = $conn->query($query);
    if (!$results[$key]) {
        die("Error executing query: " . $conn->error);
    }
}

$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cosmetic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
 include("nav.php");

 ?>


    <!-- Main Content Section -->
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-md-3">
                <h5>สภาพผิว</h5>
                <hr>
                <form method="POST" action="">
                    <?php
                    $skinTypes = ['ผิวธรรมดา', 'ผิวปกติ', 'ผิวแห้ง', 'ผิวมัน', 'ผิวผสม', 'ผิวเเพ้ง่าย'];
                    foreach ($skinTypes as $index => $type): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="skinTypes[]" value="<?= htmlspecialchars($type) ?>" id="flexCheck<?= $index ?>"
                                <?= in_array($type, $selectedSkinTypes) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="flexCheck<?= $index ?>"><?= htmlspecialchars($type) ?></label>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary mt-2">ค้นหา</button>
                    <hr>
                </form>
            </div>

            <div class="col-md">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                    <?php if ($productResult->num_rows > 0): ?>
                        <?php while ($product = $productResult->fetch_assoc()): ?>
                            <a href="details.php?id=<?= htmlspecialchars($product['id']) ?>" class="link-underline link-underline-opacity-0">
                                <div class="col">
                                    <div class="card">
                                        <img src="uploads/products/<?= htmlspecialchars($product['picture_name']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['pro_name']) ?>">
                                        <div class="card-body">
                                        <h5 class="card-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            <?= htmlspecialchars($product['pro_name']) ?>
                                        </h5>                                            
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





                

                <!-- Pagination Links -->
                <nav aria-label="Page navigation" class="mt-2">
                    <ul class="pagination justify-content-center mt-4">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="container-fluid bg-light mt-5 py-3 text-center">
        <p class="mb-0">All rights reserved @CSUBooK Shop. 2024</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>