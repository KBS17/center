<?php
include("config/config.php");
session_start();

$logStatus = isset($_SESSION['logStatus']) ? $_SESSION['logStatus'] : 0;
$name = isset($_SESSION['username']) ? $_SESSION['username'] : 'linelogin';
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$line = isset($_SESSION['line']) ? $_SESSION['line'] : null;
$profile = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'lineloginuser.png';

// Fetch categories and brands from the database
$sql1 = "SELECT * FROM categories";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM brands";
$result2 = mysqli_query($conn, $sql2);

// Fetch notifications
$query = "SELECT * FROM notify ORDER BY id DESC";
$notifications = mysqli_query($conn, $query)->fetch_all(MYSQLI_ASSOC);
?>

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
                        <a class="nav-link text-BF6159 lh-1 mb-1" style="font-size: 20px;" href="conmetic.php">Cosmetic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-BF6159 lh-1 mb-1" style="font-size: 20px;" href="skincare.php">Skin care</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-BF6159 lh-1 mb-1" style="font-size: 20px;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu">
                            <?php while ($category = $result1->fetch_assoc()): ?>
                            <li><a class="dropdown-item lh-1 mb-1" style="font-size: 20px;" href="categories.php?id=<?= htmlspecialchars($category['id']) ?>"><?= htmlspecialchars($category['categories_name']) ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-BF6159 lh-1 mb-1" style="font-size: 20px;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Brands</a>
                        <ul class="dropdown-menu">
                            <?php while ($brand = $result2->fetch_assoc()): ?>
                            <li><a class="dropdown-item lh-1 mb-1" style="font-size: 20px;" href="brands.php?id=<?= htmlspecialchars($brand['id']) ?>"><?= htmlspecialchars($brand['brand_name']) ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </li>

                    <?php if ($logStatus == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link text-BF6159 lh-1 mb-1" style="font-size: 20px;" href="compare.php">Compare</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-BF6159 lh-1 mb-1" style="font-size: 20px;" href="poll.php">Skin Test</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-BF6159 lh-1 mb-1" style="font-size: 20px;" href="submit_message.php">Reviews</a>
                    </li>
                    <?php endif; ?>
                </ul>

                <!-- Notification bell and dropdown -->
                <div class="notification-container">
                    <div class="bell-icon" onclick="toggleNotifications()">
                        <img src="notification.png" alt="Notification Bell" width="20">
                        <span class="badge"><?= count($notifications); ?></span>
                    </div>
                    <div id="notification-list" class="notification-list">
                        <ul>
                            <?php foreach ($notifications as $notification): ?>
                            <li class="notification-item"><?= htmlspecialchars($notification['notify']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- User authentication controls -->
                <?php if ($logStatus == 1): ?>
                <div class="d-flex align-items-center">
                    <div class="text-center">
                        <img src="uploads/user/<?= htmlspecialchars($profile) ?>" style="max-height:40px;" class="rounded-circle me-2 img-fluid">
                    </div>
                    <span class="me-3 fs-5 border-end border-1 border-secondary pe-3">@<?= htmlspecialchars($name) ?></span>
                    <a href="logout.php" class="btn btn-outline-danger" style="width: auto;">Logout</a>
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

<style>
.notification-container {
    position: relative;
}
.bell-icon {
    cursor: pointer;
}
.notification-list {
    display: none;
    position: absolute;
    top: 30px;
    left: 0;
    width: 300px;
    border: 1px solid #ccc;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 100;
}
.notification-item {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 5px;
    border-radius: 5px;
    background-color: #f9f9f9;
}
</style>

<script>
function toggleNotifications() {
    var notificationList = document.getElementById('notification-list');
    notificationList.style.display = (notificationList.style.display === 'block') ? 'none' : 'block';
}
</script>
