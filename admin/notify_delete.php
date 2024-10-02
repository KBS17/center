<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $notifyId = $_GET["id"]; // Receive notifyId

    // Function to delete notification record
    function deleteNotification($conn, $notifyId) {
        // Prepare SQL statement to delete notification record
        $stmt = $conn->prepare("DELETE FROM notify WHERE id = ?");
        $stmt->bind_param("i", $notifyId);
        $stmt->execute();
        $stmt->close();
    }

    // Check if the notification ID exists
    $stmt = $conn->prepare("SELECT id FROM notify WHERE id = ?");
    $stmt->bind_param("i", $notifyId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("Invalid notification ID. The notification does not exist.");
    }
    $stmt->close();

    // Delete notification record
    deleteNotification($conn, $notifyId);

    // Redirect to notifications management page
    header("Location: notify.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
