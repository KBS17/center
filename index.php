<?php
include("config/config.php");

session_start();
$logStatus = isset($_SESSION['logStatus']) ? $_SESSION['logStatus'] : 0;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$userud = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$profile = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : null;
$sql1 = "SELECT * FROM categories ";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM brands ";
$result2 = mysqli_query($conn, $sql2);




?>




<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ศูนย์กลางเครื่องสำอาง</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>


<body>
  <header class="px-5 d-flex align-items-center" style="background-color: #D9D9D9;">
    <nav class="navbar navbar-expand-lg" style="width: 100%;">
      <div class="container-fluid">
        <a class="navbar-brand" href="/center">
          <img src="img/logo.png" width="100" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="conmetic.php">Cosmetic</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="skincare.php">Skin care</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categories
              </a>
              <ul class="dropdown-menu">
                <?php while ($categories = $result1->fetch_assoc()): ?>
                  <li><a class="dropdown-item" href="categories.php?id=<?= htmlspecialchars($categories['id']) ?>"><?= htmlspecialchars($categories['categories_name']) ?></a></li>
                <?php endwhile; ?>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Brands
              </a>
              <ul class="dropdown-menu">
                <?php while ($brands = $result2->fetch_assoc()): ?>
                  <li><a class="dropdown-item" href="brands.php?id=<?= htmlspecialchars($brands['id']) ?>"><?= htmlspecialchars($brands['brand_name']) ?></a></li>
                <?php endwhile; ?>
              </ul>
            </li>

            <?php if ($logStatus == 1): ?>
              <li class="nav-item">
                <a class="nav-link " href="compare.php">Compare</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="poll.php">Poll</a>
              </li>
            <?php else: ?>

            <?php endif; ?>
          </ul>

          <?php if ($logStatus == 1): ?>
            <div class="d-flex align-items-center">
              <div class="text-center">
                <img src="uploads/user/<?= htmlspecialchars($profile) ?>" style="max-height:40px;" class="rounded-circle me-2 img-fluid">
              </div>
              <span class="me-3 fs-5 border-end border-1 border-secondary pe-3 ">@<?= htmlspecialchars($username) ?></span>
              <a href="logout.php" class="btn btn-outline-danger  " style="width: auto;"> <i class="bi bi-box-arrow-right"></i> Logout</a>
            </div>
          <?php else: ?>
            <div>
              <a href="form_login.php" class="btn btn-outline-success" style="width: auto;">Login</a>
              <a href="form_register.php" class="btn btn-primary" style="width: auto;">Register</a>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </nav>
  </header>

  <div class="container">

    <div class=" container-fluid px-5 row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="img/11.png" alt="" width="700" height="500">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-BF6159 lh-1 mb-3">Care For Your Skin, Care For Your Beauty</h1>
        <br>
        <p class="text-9a9794 lead">ยินดีต้อนรับทุกท่านเข้าสู่หน้าเพจของเรา
          เราเป็นสถานที่ที่ทุกคนสามารถค้นพบความงามและความมั่นใจในตัวเองได้
          ที่นี่เรามุ่งมั่นที่จะนำเสนอผลิตภัณฑ์เครื่องสำอางที่มีคุณภาพและปลอดภัย
          เพื่อให้คุณได้สัมผัสประสบการณ์ที่ดีในการดูแลและปรับปรุงลุคของคุณ ไม่ว่าจะเป็นเครื่องสำอางที่ทำให้ใบหน้าสดใส
          ลิปสติกที่เปล่งประกาย มาร่วมค้นพบและสร้างความสวยใหม่กับเราวันนี้!</p>
      </div>
    </div>


    <!-- <div class="container px-4 " id="featured-7">
      <br>
      <h2 class="pb-2 border-bottom text-center">skin care</h2>
    </div>

    <div class="row g-5 py-6 row-cols-2 row-cols-lg-6 pt-5">
      <div class="feature col ">
        <div class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3">
          <img src="img/3.jpg" class="rounded-circle" alt="" width="110" height="120">
        </div>
        <h6 class="fs-6 text-body-emphasis text-center">Laneige Water Sleeping Mask</h6>
        </a>
      </div>



      <div class="feature col">
        <div class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3">
          <img src="img/4.png" class="rounded-circle" alt="" width="110" height="120">
        </div>
        <h6 class="fs-6 text-body-emphasis text-center">L'OREAL PARIS 1.5% Hyaluron</h6>
        </a>
      </div>


      <div class="feature col">
        <div class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3">
          <img src="img/5.png" class="rounded-circle" alt="" width="110" height="120">
        </div>
        <h6 class="fs-6 text-body-emphasis text-center">La Roche-Posay EFFACLAR SERUM</h6>
        </a>
      </div>


      <div class="feature col">
        <div class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3">
          <img src="img/6.png" class="rounded-circle" alt="" width="110" height="120">
        </div>
        <h6 class="fs-6 text-body-emphasis text-center">MizuMi Dry Rescue Intense Melt-In Cream Anti-Pollution</h6>
        </a>
      </div>


      <div class="feature col">
        <div class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3">
          <img src="img/7.png" class="rounded-circle" alt="" width="110" height="120">
        </div>
        <h6 class="fs-6 text-body-emphasis text-center">Garnier Anti-Acne Booster Serum</h6>
        </a>
      </div>


      <div class="feature col">
        <div class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3">
          <img src="img/8.png" class="rounded-circle" alt="" width="110" height="120">
        </div>
        <h6 class="fs-6 text-body-emphasis text-center">The Ordinary Peeling Solution</h6>
        </a>
      </div>

    </div>






    <div class="album py-5 bg-body-tertiary">
      <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <div class="col">
            <div class="card shadow-sm">
              <div
                class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3 pt-5">
                <img src="img/image 1.png" alt="" width="150" height="150">
              </div>

              <div class="card-body">
                <p class="card-text">SKINTIFIC 5X Ceramide Barrier Moisture Gel</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">

                  </div>

                </div>
              </div>
            </div>
          </div>


          <div class="col">
            <div class="card shadow-sm">
              <div
                class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3 pt-5">
                <img src="img/image 2.png" alt="" width="150" height="150">
              </div>

              <div class="card-body">
                <p class="card-text">LA ROCHE-POSAY ANTHELIOS DRY TCH GEL</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">

                  </div>

                </div>
              </div>
            </div>
          </div>


          <div class="col">
            <div class="card shadow-sm">
              <div
                class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3 pt-5">
                <img src="img/image 3.jpeg" alt="" width="150" height="150">
              </div>

              <div class="card-body">
                <p class="card-text">DAZZLE ME The World Traveler Eyeshadow </p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">

                  </div>

                </div>
              </div>
            </div>
          </div>


          <div class="col">
            <div class="card shadow-sm">
              <div
                class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3 pt-5">
                <img src="img/image 4.jpeg" alt="" width="150" height="150">
              </div>

              <div class="card-body">
                <p class="card-text">Rare Beauty’s Soft Pinch Liquid Blush</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">

                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card shadow-sm">
              <div
                class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3 pt-3">
                <img src="img/image 5.jpeg" alt="" width="150" height="175">
              </div>

              <div class="card-body">
                <p class="card-text">L’Oréal Paris UV Defender Invisible Fluid SPF50+ </p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">

                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card shadow-sm">
              <div
                class=" container-fluid feature-icon d-inline-flex align-items-center justify-content-center  fs-2 mb-3">
                <img src="img/image 6.jpeg" alt="" width="150" height="185">
              </div>

              <div class="card-body">
                <p class="card-text">La Roche-Posay EFFACLAR SERUM</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class=" container-fluid px-5 row flex-lg-row align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="img/bg55.png" alt="" width="700" height="500">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-normal text-body-emphasis lh-1 mb-3 font-cuba ">How to check what our facial skin is like?
        </h1>
        <p class="lead font-cuba">วิธีตรวจสอบสภาพผิวและลักษณะผิวหน้าเราเป็นแบบไหน ได้แก่ ผิวแห้ง ผิวธรรมดาและผิวมัน
          เพื่อให้ดูแล
          ผิวหน้าของตนเองได้อย่างถูกต้องและดียิ่งขึ้น อย่าลืมเลือกใช้ผลิตภัณฑ์ที่เหมาะสมกับสภาพผิวของตนเอง😊😊😊😊😊</p>

      </div>
    </div> -->

    <!-- <div class="container px-4 " id="featured-7 pt-5">
      <br>
      <h2 class="pb-2 border-bottom text-center">Lipstick</h2>
    </div>

    <div class="row justify-content-center pt-5">
      <div class="col-lg-2">
        <img src="img/l1.png" alt="" width="130" height="140">
        <br>
        <p>4U2 jelly tint
          Little Yoy</p>
        <p>159฿</p>
        <br>
        <p>Read more ></p>


      </div>

      <div class="col-lg-2">
        <img src="img/l22.png" alt="" width="130" height="140">
        <p>A4U2 jelly tint
          Sour Apple</p>
        <p>159฿</p>
        <br>
        <p>Read more ></p>


      </div>
      <div class="col-lg-2">
        <img src="img/l3.png" alt="" width="130" height="140">
        <p>4U2 jelly tint
          Berry Berry</p>
        <p>159฿</p>
        <br>
        <p>Read more ></p>

      </div>

      <div class="col-lg-2">
        <img src="img/l3.png" alt="" width="130" height="140">
        <p>4U2 jelly tint
          Frenchy </p>
        <p>159฿</p>
        <br>
        <p>Read more ></p>

      </div>

      <div class="col-lg-2">
        <img src="img/l3.png" alt="" width="130" height="140">
        <p>4U2 jelly tint
          Happy </p>
        <p>159฿</p>
        <p>Read more ></p>
      </div>
    </div> -->


    <div class="container px-4 pt-5 " id="featured-7 ">
      <br>
      <h2 class="pb-2 border-bottom text-center">Correct facial skin care</h2>
    </div>

    <div class=" container-fluid px-5 row flex-lg-row align-items-center g-5 py-5 pt-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="img/ผิว1.png" alt="" width="60" height="70">
      </div>
      <div class="col-lg-6">
        <p class="lead font-cuba">การดูแลผิวแห้ง :
          ควรเลือกใช้ผลิตภัณฑ์มอยส์เจอไรเซอร์เนื้อออยล์หรือเนื้อครีม เลือกใช้ผลิตภัณฑ์ที่อ่อนโยนต่อผิวและไม่ก่อให้เกิดการระคายเคือง
          หลีกเลี่ยงผลิตภัณฑ์ที่มีส่วนผสมของแอลกอฮอล์เพื่อรักษา
          ความชุ่มชื้นให้ผิวโดยการดื่มน้ำเพื่อสุขภาพให้เพียงพอและใช้ครีม
          บำรุงผิวที่มีส่วนผสมช่วยรักษาความชุ่มชื้นของผิว</p>

      </div>
    </div>

    <div class=" container-fluid px-5 row flex-lg-row align-items-center g-5 py-5 pt-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="img/ผิว2.png" alt="" width="60" height="70">
      </div>
      <div class="col-lg-6">
        <p class="lead font-cuba">การดูแลผิวธรรมดา : สามารถใช้ผลิตภัณฑ์มอยส์เจอไรเซอร์ได้ทุกรูปแบบตามสภาพอากาศแต่ละฤดูได้สามารถเพิ่มการดูแลผิวหน้าอย่างสม่ำเสมอได้โดยการใช้มาส์ก
          หน้า2ครั้งต่อสัปดาห์เพื่อรักษาความสมดุลของผิววิธีมาส์กหน้าที่ถูก
          ต้องและทาครีมกันแดดเป็นประจำทุกวันเพื่อป้องกันปัญหาผิวจาก
          แสงแดดในระยะยาว วิธีทาครีมกันแดด</p>

      </div>
    </div>


    <div class=" container-fluid px-5 row flex-lg-row align-items-center g-5 py-5 pt-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="img/ผิว3.png" alt="" width="60" height="70">
      </div>
      <div class="col-lg-6">
        <p class="lead font-cuba">การดูแลผิวผสม :
          เลือกใช้ผลิตภัณฑ์มอยส์เจอไรเซอร์เนื้อบางเบาในรูปแบบเนื้อน้ำ นม เซรั่ม และเจลในตอนกลางวันเพื่อไม่ให้เกิดความมันส่วนเกิน
          บนใบหน้าและเลือกใช้ผลิตภัณฑ์มอยส์เจอไรเซอร์เนื้อหนักใน
          รูปแบบออยล์และเนื้อครีมในตอนกลางคืนเพื่อบำรุงผิวบริเวณ
          ที่ขาดความชุ่มชื้น</p>

      </div>
    </div>



    <div class=" container-fluid px-5 row flex-lg-row align-items-center g-5 py-5 pt-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="img/ผิว4.png" alt="" width="60" height="70">
      </div>
      <div class="col-lg-6">
        <p class="lead font-cuba">การดูแลผิวมัน :
          เลือกใช้ผลิตภัณฑ์บำรุงผิวเนื้อบางเบาที่สบายผิวในรูปแบบเนื้อน้ำ นม เซรั่ม และเจล เลือกใช้ผลิตภัณฑ์ที่มีส่วนช่วยในการควบคุม
          ความมันเพื่อทำความสะอาดผิวหน้าให้สะอาดหมดจด
          เพื่อลดการเกิดปัญหาสิว</p>

      </div>
    </div>



    <div class=" container-fluid px-5 row flex-lg-row-reverse align-items-center g-5 py-5 pt-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="img/p1.png" alt="" width="400" height="500">
      </div>
      <div class="col-lg-6">
        <h1 class="display-7 fw-bold text-body-emphasis lh-1 mb-3">ผิวแพ้ง่าย มีอาการระคายเคือง แห้งกร้าน
          ลอกเป็นขุย เกิดเป็นผื่นแดง แสบร้อน และอักเสบ</h1>
        <br>
        <p class="lead">ครีมบำรุง ควรเลือกใช้ มอยส์เจอร์ไรเซอร์ เอสเซ้นส์ เซรั่ม ครีมบำรุงผิว
          ที่มีส่วนผสมของไฮยาลูรอนิค แอซิด, เซราไมด์, วิตามินอี, วิตามินซี ที่พร้อมช่วยให้ผิว
          มีสุขภาพที่แข็งแรงมากยิ่งขึ้น แต่ทั้งนี้ต้องเลือกให้เหมาะสมกับสภาพผิวด้วย เช่น
          คนผิวแห้งควรทามอยส์เจอร์ไรเซอร์ที่ให้ความชุ่มชื้นได้ดี หรือมีสารที่ช่วยกักเก็บความชุ่มชื้น
          ไว้ที่ผิว หรือ คนผิวมันควรเลือกใช้ผลิตภัณฑ์ที่มีเนื้อบางเบา และเป็นสูตร oil-free เป็นต้น</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        </div>
      </div>

      <div class=" container-fluid px-5 row flex-lg-row align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
          <img src="img/p2.png" alt="" width="400" height="500">
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-normal text-body-emphasis lh-1 mb-3 font-cuba ">ผิวธรรมดา จะชุ่มชื้นอยู่ตลอดเวลานุ่มเด้ง
            เนียนนุ่มเรียบเนียนละเอียดลูบแล้วไม่เป็นขุย
            ไม่สาก รูขุมขนดูกระชับ</h1>
          <p class="lead font-cuba">ครีมบำรุง ควรเลือกใช้ มอยส์เจอร์ไรเซอร์ เอสเซ้นส์ เซรั่ม ครีมบำรุงผิว ที่มีส่วนผสมของไฮยาลูรอนิค
            แอซิด, เซราไมด์, วิตามินอี, วิตามินซี ที่พร้อมช่วยให้ผิว
            มีสุขภาพที่แข็งแรงมากยิ่งขึ้น แต่ทั้งนี้ต้องเลือกให้เหมาะสมกับสภาพผิวด้วย
            เช่น คนผิวแห้งควรทามอยส์เจอร์ไรเซอร์ที่ให้ความชุ่มชื้นได้ดี หรือมีสารที่ช่วยกักเก็บความชุ่มชื้น
            ไว้ที่ผิว หรือ คนผิวมันควรเลือกใช้ผลิตภัณฑ์ที่มีเนื้อบางเบา และเป็นสูตร oil-free เป็นต้น
          </p>
        </div>
      </div>

      <div class="container px-4 pt-5 " id="featured-7 ">
        <br>
        <h2 class="pb-2 border-bottom text-center"></h2>
      </div>



      <p>ช่องทางการติดต่อ
        tel: 122333333333_
      </p>

          <!-- Footer Section -->
    <footer class="container-fluid bg-light mt-5 py-3 text-center">
        <p class="mb-0">All rights reserved @CSUBooK Shop. 2024</p>
    </footer>


    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>