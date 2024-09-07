<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input values
    $productId = isset($_POST["proid"]) ? intval($_POST["proid"]) : 0;
    $proname = isset($_POST["proname"]) ? $_POST["proname"] : NULL;
    $proprice = isset($_POST["proprice"]) ? $_POST["proprice"] : NULL;
    $description = isset($_POST["description"]) ? $_POST["description"] : NULL;
    $brandId = isset($_POST["brand_id"]) ? intval($_POST["brand_id"]) : NULL;
    $typeId = isset($_POST["type_id"]) ? intval($_POST["type_id"]) : NULL;
    $categoriesId = isset($_POST["categories_id"]) ? intval($_POST["categories_id"]) : NULL;

    // Handle file uploads
    $mainImage = $_FILES['showimages'];
    $additionalImages = $_FILES['images'];

    // Set upload directory and create it if it doesn't exist
    $uploadDir = "../uploads/products/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Allowed file extensions
    $allowedExtensions = ["jpg", "jpeg", "png", "gif"];

    // Function to get file extension
    function getFileExtension($filename)
    {
        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }

    // Delete old images
    function deleteOldImages($conn, $productId, $uploadDir)
    {
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
    }

    // Handle the main image upload
    if ($mainImage['error'] == UPLOAD_ERR_OK) {
        $mainImageExt = getFileExtension($mainImage['name']);
        if (in_array($mainImageExt, $allowedExtensions)) {
            $mainImageName = uniqid() . '.' . $mainImageExt;
            $mainImagePath = $uploadDir . $mainImageName;
            if (move_uploaded_file($mainImage['tmp_name'], $mainImagePath)) {
                // Success
            } else {
                // Handle file move error
                $mainImageName = 'default-image.png';
            }
        } else {
            $mainImageName = 'default-image.png'; // Handle invalid file type
        }
    } else {
        $mainImageName = 'default-image.png'; // Handle error or set default image
    }

    // Delete old images
    deleteOldImages($conn, $productId, $uploadDir);

    // Prepare and execute the SQL statement to update the product
    $sql = "UPDATE products
            SET pro_name = COALESCE(?, pro_name),
                pro_price = COALESCE(?, pro_price),
                description = COALESCE(?, description),
                picture_name = COALESCE(?, picture_name),
                categories_id = COALESCE(?, categories_id),
                brand_id = COALESCE(?, brand_id),
                type_id = COALESCE(?, type_id)
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssiiii", $proname, $proprice, $description, $mainImageName, $categoriesId, $brandId, $typeId, $productId);

    if ($stmt->execute()) {
        // Handle additional image uploads
        if (!empty($additionalImages['name'][0])) {
            foreach ($additionalImages['tmp_name'] as $key => $tmpName) {
                if ($additionalImages['error'][$key] == UPLOAD_ERR_OK) {
                    $imageExt = getFileExtension($additionalImages['name'][$key]);
                    if (in_array($imageExt, $allowedExtensions)) {
                        $imageName = uniqid() . '.' . $imageExt;
                        $imagePath = $uploadDir . $imageName;
                        if (move_uploaded_file($tmpName, $imagePath)) {
                            // Insert additional images into the picture table
                            $stmt4 = $conn->prepare("INSERT INTO picture (product_id, picture_name) VALUES (?, ?)");
                            $stmt4->bind_param("is", $productId, $imageName);
                            $stmt4->execute();
                            $stmt4->close();
                        } else {
                            echo "Error moving file: $imageName";
                        }
                    } else {
                        echo "Invalid file type: " . $additionalImages['name'][$key];
                    }
                } else {
                    echo "Error uploading file: " . $additionalImages['error'][$key];
                }
            }
        }

        // Redirect to products page
        header("Location: products.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
