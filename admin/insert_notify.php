<?php
include("../config/config.php");

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $description = trim($_POST['description']);

    // Validate input
    if (!empty($description)) {
        // Prepare SQL statement to prevent SQL injection
        $sql = "INSERT INTO notify (notify) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $description);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to another page or display a success message
            header('Location: notify.php'); // Redirect to the manage notifications page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Notification description cannot be empty.";
    }
} else {
    // Redirect to the form if accessed directly
    header('Location: notify.php');
    exit();
}

// Close the database connection
$conn->close();
?>
