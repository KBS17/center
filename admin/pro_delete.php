<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $productId = $_GET["id"]; // รับ productId

    // Set upload directory
    $uploadDir = "../uploads/products/";

    // Function to delete old images
    function deleteOldImages($conn, $productId, $uploadDir) {
        // Delete the old main image
        $stmt = $conn->prepare("SELECT picture_name FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $oldMainImageName = $row['picture_name'];
            $stmt->close();
            
            if ($oldMainImageName && $oldMainImageName !== 'default-image.png') {
                $oldMainImagePath = $uploadDir . $oldMainImageName;
                if (file_exists($oldMainImagePath)) {
                    unlink($oldMainImagePath); // Delete old main image file
                }
            }
        }

        // Delete old additional images
        $stmt = $conn->prepare("SELECT picture_name FROM picture WHERE product_id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $oldImagePath = $uploadDir . $row['picture_name'];
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Delete old additional image file
            }
        }
        $stmt->close();

        // Remove old records from the database
        $stmt = $conn->prepare("DELETE FROM picture WHERE product_id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $stmt->close();

        // Delete the product from the products table
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $stmt->close();
    }

    // ตรวจสอบการมีอยู่ของ product_id
    $stmt = $conn->prepare("SELECT id FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("Invalid product ID. The product does not exist.");
    }
    $stmt->close();

    // Delete old images and product
    deleteOldImages($conn, $productId, $uploadDir);

    // Redirect to products page
    header("Location: products.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
