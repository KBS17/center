<?php
include("config/config.php");

session_start();
$logStatus = $_SESSION['logStatus'] ?? 0;
$username = $_SESSION['username'] ?? '';
$userId = $_SESSION['userId'] ?? null;
$profile = $_SESSION['profile_picture'] ?? null;

$selectedSkinTypes = [];

// Pagination setup
$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Function to execute and fetch result set from a prepared statement
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

// Fetch total number of products based on the selected skin types
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['skinTypes'])) {
    $selectedSkinTypes = array_filter($_POST['skinTypes'], 'is_string');

    if (!empty($selectedSkinTypes)) {
        $placeholders = implode(',', array_fill(0, count($selectedSkinTypes), '?'));
        $types = str_repeat('s', count($selectedSkinTypes));

        // Fetch total number of products
        $totalQuery = "SELECT COUNT(DISTINCT products.id) as total
                       FROM products
                       INNER JOIN analysis ON analysis.product_id = products.id
                       INNER JOIN problems ON problems.id = analysis.problems_id
                       WHERE products.type_id = 2 AND problems.problems IN ($placeholders)";
        $totalResult = fetchPreparedResult($totalQuery, $types, $selectedSkinTypes, $conn);
        $totalRow = $totalResult->fetch_assoc();
        $totalProducts = $totalRow['total'];

        // Calculate total pages
        $totalPages = ceil($totalProducts / $limit);

        // Fetch products based on selected skin types
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
    // Fetch total number of products without filters
    $totalQuery = "SELECT COUNT(*) as total FROM products WHERE type_id = 2";
    $totalResult = $conn->query($totalQuery);
    $totalRow = $totalResult->fetch_assoc();
    $totalProducts = $totalRow['total'];

    // Calculate total pages
    $totalPages = ceil($totalProducts / $limit);

    // Fetch products without filters
    $productQuery = "SELECT * FROM products WHERE type_id = 2 LIMIT ? OFFSET ?";
    $productResult = fetchPreparedResult($productQuery, 'ii', [$limit, $offset], $conn);
}

// Fetch categories and brands for the navbar
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
    <title>Cosmetic | ศูนย์กลางเครื่องสำอาง</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navbar Section -->
    <header class="px-5 bg-light">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/center">
                    <img src="img/logo.png" width="100" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="conmetic.php">Cosmetic</a></li>
                        <li class="nav-item"><a class="nav-link" href="skincare.php">Skin care</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
                            <ul class="dropdown-menu">
                                <?php while ($category = $results['categories']->fetch_assoc()): ?>
                                    <li><a class="dropdown-item" href="categories.php?id=<?= htmlspecialchars($category['id']) ?>"><?= htmlspecialchars($category['categories_name']) ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Brands</a>
                            <ul class="dropdown-menu">
                                <?php while ($brand = $results['brands']->fetch_assoc()): ?>
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
                    <div class="d-flex">
                        <?php if ($logStatus == 1): ?>
                            <div class="d-flex align-items-center">
                                <div class="text-center">
                                    <img src="uploads/user/<?= htmlspecialchars($profile) ?>" style="max-height:40px;" class="rounded-circle me-2 img-fluid">
                                </div>
                                <span class="me-3 fs-5 border-end border-1 border-secondary pe-3 ">@<?= htmlspecialchars($username) ?></span>
                                <a href="logout.php" class="btn btn-outline-danger  " style="width: auto;"> <i class="bi bi-box-arrow-right"></i> Logout</a>
                            </div>
                        <?php else: ?>
                            <a href="form_login.php" class="btn btn-outline-success me-2">Login</a>
                            <a href="form_register.php" class="btn btn-primary">Register</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

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
