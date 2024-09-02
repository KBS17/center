<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $memberid = $_GET["id"];

    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("DELETE FROM member WHERE m_id = ?");
    
    // Bind the parameters (i for integer)
    $stmt->bind_param("i", $memberid);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect before sending any output
        header("Location: edit_m.php");
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
