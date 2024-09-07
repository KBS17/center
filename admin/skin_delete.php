<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve and sanitize input value
    $analysis_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

    if ($analysis_id > 0) {
        // Prepare and execute SQL query
        $stmt = $conn->prepare("DELETE FROM analysis WHERE id = ?");
        
        if ($stmt) {
            $stmt->bind_param("i", $analysis_id);

            if ($stmt->execute()) {
                // Record deleted successfully
                $stmt->close();
                header("Location: skin.php");
                exit();
            } else {
                echo "Error executing statement: " . $stmt->error;
            }
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Invalid ID provided.";
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
