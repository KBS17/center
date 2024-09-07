<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input values
    $product_id = isset($_POST["product"]) ? intval($_POST["product"]) : 0;
    $problems_id = isset($_POST["skin"]) ? intval($_POST["skin"]) : 0;

    // Prepare and execute SQL query
    $stmt = $conn->prepare("INSERT INTO analysis (problems_id, product_id) VALUES (?, ?)");
    
    if ($stmt) {
        $stmt->bind_param("ii", $problems_id, $product_id);
        
        if ($stmt->execute()) {
            echo "Record inserted successfully.";
            header("Location: skin.php");
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
