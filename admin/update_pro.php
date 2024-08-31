<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proname = $_POST["proname"];
    $proprice = $_POST["proprice"];
    $description = $_POST["description"];
    $proid = $_POST["proid"];
    
    // Use print_r to debug the variables, and add a semicolon to avoid syntax errors
    echo "$proname===== $proprice======== $description======== $proid"; // Corrected line
    
    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("UPDATE product SET pro_name = ?, pro_price = ?, description = ? WHERE pro_id = ?");
    
    // Bind the parameters (s for string, d for double/float, i for integer)
    $stmt->bind_param("sdsd", $proname, $proprice, $description, $proid);

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
