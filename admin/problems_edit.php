<?php
session_start();
include "../config/config.php";

$sql = "SELECT * FROM problems ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Check if an ID is provided
if (!isset($_GET['id'])) {
    header('Location: problems_m.php');
    exit();
}

$id = intval($_GET['id']);

// Fetch current data for the provided ID
$sql = "SELECT * FROM problems WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];

    // Update the description
    $sql = "UPDATE problems SET description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $description, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: problems_m.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Problem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<br>
<br>

<body>
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="d-flex justify-content-between  align-items-center  card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">จัดการข้อมูลคำแนะนำผิวหน้า</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable table-hover" id="dataTable" width="100%"
                        cellspacing="0">


                        <form method="post">
                            <div class="mb-3">
                                <label for="problems" class="form-label">problems</label>
                                <textarea class="form-control" id="problems" name="problems" rows="4">
                    <?php echo htmlspecialchars($data['problems']); ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="10">
                    <?php echo htmlspecialchars($data['description']); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="problems_m.php" class="btn btn-secondary">Cancel</a>
                        </form>
                </div>
</body>

</html>

<?php $conn->close(); ?>