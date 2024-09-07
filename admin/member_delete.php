<?php
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $memberId = $_GET["id"]; // รับ memberId

    // Set upload directory
    $uploadDir = "../uploads/user/";

    // Function to delete old profile picture
    function deleteProfilePicture($conn, $memberId, $uploadDir) {
        // Get the profile picture path
        $stmt = $conn->prepare("SELECT profile_picture FROM members WHERE id = ?");
        $stmt->bind_param("i", $memberId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $profilePicture = $row['profile_picture'];
            $stmt->close();
            
            // Check if the profile picture exists and is not the default picture
            if ($profilePicture && $profilePicture !== 'uploads/default_profile_picture.png') {
                $profilePicturePath = $uploadDir . basename($profilePicture);
                if (file_exists($profilePicturePath)) {
                    unlink($profilePicturePath); // Delete old profile picture file
                }
            }
        } else {
            $stmt->close();
        }

        // Delete the member record from the database
        $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
        $stmt->bind_param("i", $memberId);
        $stmt->execute();
        $stmt->close();
    }

    // ตรวจสอบการมีอยู่ของ member_id
    $stmt = $conn->prepare("SELECT id FROM members WHERE id = ?");
    $stmt->bind_param("i", $memberId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("Invalid member ID. The member does not exist.");
    }
    $stmt->close();

    // Delete profile picture (if exists) and member data
    deleteProfilePicture($conn, $memberId, $uploadDir);

    // Redirect to members page
    header("Location: edit_m.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
