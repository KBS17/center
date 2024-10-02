<?php
include("../config/config.php");

$sql1 = "SELECT * FROM notify ";
$result1 = mysqli_query($conn, $sql1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Notify</title>
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
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Content Example -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Notify</h6>
                        </div>
                        <div class="card-body">
                            <form action="insert_notify.php" method="post" enctype="multipart/form-data">
                                <div class="d-flex">

                                    <div class="col">
                                        <!-- Notify Description -->
                                        <div class="mb-3">
                                            <label for="NotifyDescription" class="form-label">Notify Description</label>
                                            <textarea class="form-control" name="description" id="NotifyDescription"
                                                placeholder="Notify description" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="my-5">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a href="notify.php" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- End of Main Content -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
