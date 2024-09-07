<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proname = $_POST["proname"];
    $proprice = $_POST["proprice"];
    $description = $_POST["description"];
    $brandId = $_POST["brand_id"];
    $typeId = $_POST["type_id"];
    $categoriesId = $_POST["categories_id"];

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
    function getFileExtension($filename) {
        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
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

    // Prepare and execute the SQL statement to insert the product
    $stmt = $conn->prepare("INSERT INTO products (pro_name, pro_price, description, picture_name, categories_id, brand_id, type_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssiii", $proname, $proprice, $description, $mainImageName, $categoriesId, $brandId, $typeId);

    if ($stmt->execute()) {
        $productId = $stmt->insert_id; // Get the ID of the newly inserted product

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
                            $stmt1 = $conn->prepare("INSERT INTO picture (product_id, picture_name) VALUES (?, ?)");
                            $stmt1->bind_param("is", $productId, $imageName);
                            $stmt1->execute();
                            $stmt1->close();
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
