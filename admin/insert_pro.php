<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proname = $_POST["proname"];
    $proprice = $_POST["proprice"];
    $description = $_POST["description"];
    
    // Debugging variables
    echo "$proname===== $proprice======== $description======== $proid";
    
    // Prepare the SQL statement with placeholders for the INSERT operation
    $stmt = $conn->prepare("INSERT INTO product (pro_name, pro_price, description) VALUES (?, ?, ?)");
    
    // Bind the parameters (i for integer, s for string, d for double/float)
    $stmt->bind_param("sds", $proname, $proprice, $description);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect before sending any output
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
