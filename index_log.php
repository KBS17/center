<?php
session_start();
include "config/config.php";

if (!isset($_SESSION['m_name'])) {
    header('Location: form_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>ศูนย์กลางเครื่องสำอาง</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
  <link href="style.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
      integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
      crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>



<header class="w-100 bg-D9D9D9 px-5 " style="height: 80px;">
        <nav class="navbar navbar-expand-lg container">
            <div class="d-flex flex-wrap w-100 justify-content-between align-items-center">
                <a href="#">
                    <img src="img/logo.png" alt="">
                </a>
                <ul class="nav nav-pills">
                    <li class="nav-item mx-4"><a href="#" 
                            class=" fs-4 fw-normal text-BF6159 text-decoration-none" aria-current="page">Home</a></li>
                    <li class="nav-item mx-4"><a href="#"
                            class="fs-4 fw-normal text-BF6159 text-decoration-none">Products</a></li>
                            <div class="d-flex justify-content-center align-items-center">
                            <ul class="nav nav-pills">
                                
                    <a href="#"><button type="button" class="btn btn-success ">
                            <?php echo "Account : " . $_SESSION['m_name']; ?></button></a>


                    <li class="nav-item mx-4"><a href="logout.php"
                            class="fs-4 fw-normal text-BF6159 text-decoration-none">Logout</a></li>
                            
                </ul>
            </div>
        </nav>
    </header>




          
                
                    <div class="d-flex justify-content-center align-items-center">
                            <ul class="nav nav-pills">
                    <a href="#"><button type="button" class="btn btn-success me-2">
                            <?php echo "Account : " . $_SESSION['m_name']; ?></button></a>
                </ul>
                <ul class="nav nav-pills">
                    <a href="logout.php"><button type="button" class="btn btn-danger me-4">Logout</button></a></li>
                </ul>
            </div>
        </nav>
    </header>



    <!-- <div class="container">
        <header class="d-flex flex-wrap justify-content-between align-item-center py-4 mb-3 border-bottom">
            <div>
                <a href="../index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <img src="../img/logo.png" width="300px" alt="" srcset="">
                </a>
            </div>


            <div class="d-flex justify-content-center align-items-center">
                <ul class="nav nav-pills">
                    <a href="#"><button type="button" class="btn btn-success me-2">
                            <?php echo "Account : " . $_SESSION['m_name']; ?></button></a>
                </ul>
                <ul class="nav nav-pills">
                    <a href="logout.php"><button type="button" class="btn btn-danger me-2">Logout</button></a>
                </ul>
            </div>
        </header>
    </div> -->

</body>

</html>