<?php
include("config/config.php");

session_start();
$logStatus = $_SESSION['logStatus'] ?? 0;
$username = $_SESSION['username'] ?? '';
$userId = $_SESSION['userId'] ?? null;
$profile = $_SESSION['profile_picture'] ?? null;

$id = intval($_GET['id']); // Ensure that the ID is an integer to prevent SQL Injection

// Default for checkbox selections
$selectedSkinTypes = [];

// Pagination setup
$limit = 8; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page or default to 1
$offset = ($page - 1) * $limit; // Calculate the offset for the query

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['skinTypes'])) {
    $selectedSkinTypes = array_filter($_POST['skinTypes'], 'is_string'); // Ensure all selected skin types are strings

    if (!empty($selectedSkinTypes)) {
        // Create placeholders for SQL query
        $placeholders = implode(',', array_fill(0, count($selectedSkinTypes), '?'));

        // Fetch the total number of products based on selected skin types
        $totalQuery = "SELECT COUNT(DISTINCT products.id) as total 
                        FROM products 
                        INNER JOIN analysis ON analysis.product_id = products.id 
                        INNER JOIN problems ON problems.id = analysis.problems_id 
                        WHERE categories_id = ? AND problems.problems IN ($placeholders)";
        $stmt = $conn->prepare($totalQuery);

        // Create an array for bind_param arguments
        $bindParams = array_merge([$id], $selectedSkinTypes);

        // Define the types for bind_param
        $types = 'i' . str_repeat('s', count($selectedSkinTypes)); // 'i' for integer (category id), 's' for strings (skin types)

        // Convert all bind parameters to references
        $bindParamsRef = [];
        array_walk($bindParams, function(&$value) use (&$bindParamsRef) {
            $bindParamsRef[] = &$value;
        });

        // Use call_user_func_array to bind parameters dynamically
        call_user_func_array([$stmt, 'bind_param'], array_merge([$types], $bindParamsRef));

        $stmt->execute();
        $totalResult = $stmt->get_result();
        $totalRow = $totalResult->fetch_assoc();
        $totalProducts = $totalRow['total'];
        $stmt->close();

        // Calculate total pages
        $totalPages = ceil($totalProducts / $limit);

        $sql = "SELECT DISTINCT products.*, problems.problems 
        FROM products 
        INNER JOIN analysis ON analysis.product_id = products.id 
        INNER JOIN problems ON problems.id = analysis.problems_id 
        WHERE categories_id = ? AND problems.problems IN ($placeholders)
        LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);

        // Add limit and offset to bindParams
        $bindParams = array_merge([$id], $selectedSkinTypes, [$limit, $offset]);

        // Define the types for bind_param
        $types = 'i' . str_repeat('s', count($selectedSkinTypes)) . 'ii';

        // Convert all bind parameters to references
        $bindParamsRef = [];
        array_walk($bindParams, function(&$value) use (&$bindParamsRef) {
            $bindParamsRef[] = &$value;
        });

        // Use call_user_func_array to bind parameters dynamically
        call_user_func_array([$stmt, 'bind_param'], array_merge([$types], $bindParamsRef));

        $stmt->execute();
        $productResult = $stmt->get_result();
        $stmt->close();
    } else {
        // Handle the case where no skin types are selected
        $productResult = [];
        $totalProducts = 0;
        $totalPages = 1;
    }
} else {
    // Fetch total number of products without filters
    $totalQuery = "SELECT COUNT(*) as total FROM products WHERE categories_id = ?";
    $stmt = $conn->prepare($totalQuery);
    $stmt->bind_param('i', $id); // Bind category ID as an integer
    $stmt->execute();
    $totalResult = $stmt->get_result();
    $totalRow = $totalResult->fetch_assoc();
    $totalProducts = $totalRow['total'];
    $stmt->close();

    // Calculate total pages
    $totalPages = ceil($totalProducts / $limit);

    // Query for products without filters
    $productQuery = "SELECT * FROM products WHERE categories_id = ? LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($productQuery);
    $stmt->bind_param('iii', $id, $limit, $offset); // Bind category ID, limit, and offset
    $stmt->execute();
    $productResult = $stmt->get_result();
    $stmt->close();
}

// Fetch categories and brands for the navbar
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
        <!-- <div class="row">
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
            </div> -->

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
                            <a class="page-link" href="categories.php?id=<?= $id ?>&page=<?= $page - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="categories.php?id=<?= $id ?>&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="categories.php?id=<?= $id ?>&page=<?= $page + 1 ?>" aria-label="Next">
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