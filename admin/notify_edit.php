<?php
session_start();
include "../config/config.php";

// Check if an ID is provided
if (!isset($_GET['id'])) {
    header('Location: notify.php');
    exit();
}

$id = intval($_GET['id']);

// Fetch current data for the provided ID
$sql = "SELECT * FROM notify WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notify = $_POST['notify'];

    // Validate input
    if (!empty($notify)) {
        // Update the notify column
        $sql = "UPDATE notify SET notify = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $notify, $id);
        $stmt->execute();
        $stmt->close();

        header('Location: notify.php');
        exit();
    } else {
        $error_message = "Notification field cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.bootstrap5.css" />
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
            include("nav.php");
        ?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div class="container">
            <div class="card shadow mb-4">
                <div class="d-flex justify-content-between align-items-center card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Notification</h6>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-4">
                            <label for="notify" class="form-label">Notify</label>
                            <textarea class="form-control" id="notify" name="notify"
                                rows="10"><?php echo htmlspecialchars($data['notify']); ?></textarea>
                        </div>
                        <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($error_message); ?>
                        </div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="notify.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
            </div>
            <!-- End of Content Wrapper -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap5.js"></script>



</body>

</html>

