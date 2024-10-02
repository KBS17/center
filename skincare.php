<?php
include("config/config.php");

session_start();
$logStatus = $_SESSION['logStatus'] ?? 0;
$username = $_SESSION['username'] ?? '';
$userId = $_SESSION['userId'] ?? null;
$profile = $_SESSION['profile_picture'] ?? null;

$selectedSkinTypes = [];

// กำหนดจำนวนสินค้า
$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // กำหนดหมายเลขหน้าที่จะแสดง ถ้าไม่มีกำหนดค่าให้ตั้งเป็นหน้าแรก 
$offset = ($page - 1) * $limit;


function fetchPreparedResult($sql, $types, $params, $conn) {
    $stmt = $conn->prepare($sql);
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

// ตรวจสอบว่ามีการส่งแบบฟอร์มสภาพผิวเข้ามาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['skinTypes'])) {
    $selectedSkinTypes = array_filter($_POST['skinTypes'], 'is_string');
// ถ้ามีการเลือกสภาพผิว
    if (!empty($selectedSkinTypes)) {
        $placeholders = implode(',', array_fill(0, count($selectedSkinTypes), '?'));
        $types = str_repeat('s', count($selectedSkinTypes));

        // ดึงจำนวนสินค้าทั้งหมดที่ตรงกับสภาพผิวที่เลือก
        $totalQuery = "SELECT COUNT(DISTINCT products.id) as total
                       FROM products
                       INNER JOIN analysis ON analysis.product_id = products.id
                       INNER JOIN problems ON problems.id = analysis.problems_id
                       WHERE products.type_id = 2 AND problems.problems IN ($placeholders)";
        $totalResult = fetchPreparedResult($totalQuery, $types, $selectedSkinTypes, $conn); // ดึงข้อมูลผลลัพธ์จากคำสั่ง SQL โดยใช้ฟังก์ชัน fetchPreparedResult
        $totalRow = $totalResult->fetch_assoc(); // ดึงแถวข้อมูลจำนวนสินค้าทั้งหมด
        $totalProducts = $totalRow['total']; // เก็บค่าจำนวนสินค้าทั้งหมด

        // คำนวณจำนวนหน้าทั้งหมด
        $totalPages = ceil($totalProducts / $limit);

        // ดึงสินค้าที่ตรงกับสภาพผิวที่เลือก
        $sql = "SELECT DISTINCT products.*, problems.problems
                FROM products
                INNER JOIN analysis ON analysis.product_id = products.id
                INNER JOIN problems ON problems.id = analysis.problems_id
                WHERE products.type_id = 2 AND problems.problems IN ($placeholders)
                LIMIT ? OFFSET ?";
        $params = array_merge($selectedSkinTypes, [$limit, $offset]);
        $types .= 'ii';
        $productResult = fetchPreparedResult($sql, $types, $params, $conn);
    } else {
        $productResult = [];
        $totalProducts = 0;
        $totalPages = 1;
    }
} else {
    // ดึงจำนวนสินค้าทั้งหมดในหมวด type_id 2 โดยไม่ใช้ตัวกรองสภาพผิว
    $totalQuery = "SELECT COUNT(*) as total FROM products WHERE type_id = 2";
    $totalResult = $conn->query($totalQuery);
    $totalRow = $totalResult->fetch_assoc();
    $totalProducts = $totalRow['total'];


    $totalPages = ceil($totalProducts / $limit);

    // ดึงสินค้าทั้งหมดโดยไม่ใช้ตัวกรองสภาพผิว
    $productQuery = "SELECT * FROM products WHERE type_id = 2 LIMIT ? OFFSET ?";
    $productResult = fetchPreparedResult($productQuery, 'ii', [$limit, $offset], $conn);
}

// ฟังก์ชันดึงข้อมูลหมวดหมู่และยี่ห้อสำหรับเมนูนำทาง
function fetchNavbarData($queries, $conn) {
    $results = [];
    foreach ($queries as $key => $query) {
        $results[$key] = $conn->query($query);
        if (!$results[$key]) {
            die("Error executing query: " . $conn->error);
        }
    }
    return $results;
}

$queries = [
    "categories" => "SELECT * FROM categories",
    "brands" => "SELECT * FROM brands"
];

$results = fetchNavbarData($queries, $conn);
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
