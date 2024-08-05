<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Faceskin</title>
    <link href="style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .custom-card {
            background-color: #f5f5f5;
            /* พื้นหลังสีดำ */
            color: #000000;
            /* สีตัวอักษรสีขาว */
            border-radius: 15px;
            /* มุมโค้ง */
            padding: 30px;
            /* ช่องว่างภายใน */
            position: relative;
            /* สำหรับวางภาพ */
            font-size: 1.2em;
            /* ขนาดตัวอักษร */
        }

        .custom-card .highlight {
            color: #BF6159;
            /* สีข้อความไฮไลท์ */
            font-weight: bold;
        }

        .custom-card .title {
            background-color: #BF6159;
            /* สีพื้นหลังของข้อความหัวข้อ */
            color: #fff;
            /* สีข้อความหัวข้อ */
            display: inline-block;
            padding: 5px 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .custom-card .image {
            width: 60px;
            height: 30px;
            border-radius: 10px;
            overflow: hidden;
            display: inline-block;
            vertical-align: middle;
        }

        .custom-card .image img {
            width: 100%;
            height: auto;
        }
    </style>


</head>

<header class="w-100 bg-D9D9D9 px-5 " style="height: 80px;">
    <nav class="navbar navbar-expand-lg container">
        <div class="d-flex flex-wrap w-100 justify-content-between align-items-center">
            <a href="#">
                <img src="img/logo.png" alt="">
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item mx-4"><a href="#" class=" fs-4 fw-normal text-BF6159 text-decoration-none"
                        aria-current="page">Home</a></li>
                <li class="nav-item mx-4"><a href="#"
                        class="fs-4 fw-normal text-BF6159 text-decoration-none">Products</a></li>
                <li class="nav-item mx-4"><a href="#" class="fs-4 fw-normal text-BF6159 text-decoration-none">About</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="container overflow-x-hidden">
    
<div class="container mt-5">
    <div class="custom-card">
        <div class="title">ผิวผสม</div>
        <p><span class="highlight">&#9733;</span> ผิวผสมนั้นคุณควร <span
                class="highlight">ควบคุมไม่ให้ผิวหน้าบริเวณทีโซนมันขึ้น
                แต่ก็ต้องเพิ่มความชุ่มชื้นให้กับผิดบริเวณแก้ม</span> แม้ตวามมันบนใบหน้าที่มากเกินไป เป็นสาเหตุของสิว
            รอยสิว และรูขุมขนที่กว้าง แต่ก็อย่ามุ้งเน้นในการขจัดความมันบริเวณทีโซนมากเกินไป
            เพราะผิวที่แห้งจะเป็นสาเหตุให้เกิดปัญหาผิวต่างๆ เช่น รูขุมขนกว้าง ริ้วรอย ฝ้ากระ จุดด่างดำ
            และความหมองคล้ำตามมา</p>
        <!-- <div class="image">
            <img src="img/skinti1.png" alt="Image 3">
        </div>
        <div class="image">
            <img src="your-image-url-2.jpg" alt="Image 2">
        </div> -->
        <div style="text-align: right; margin-top: 20px;">
            <img src="img/face.png" alt="Signature" style="width: 100px;">
        </div>
    </div>
</div>

<h1 class=" mt-4 text-center">Skincare </h1>
<!-- <p class="text-center">Let our website be a part of helping you decide to use the right cosmetic products for your facial skin type.</p> -->


<!-- <div class="container px-5">
    <h2 class="pb-2  text-center">Top 10 cosmetics</h2> -->

<div class="d-grid justify-content-center">
    <div class="row row-cols-3 row-cols-lg-2 row-cols-md-3 gx-1 ">
        <div class="card border-#BF6159  mb-3 mt-5 mx-4"
            style="max-width: 13rem; min-height: 20rem; border: 2px solid #BF6159; ">
            <!-- <div class="card-header"style="color: #BF6159;">Header</div> -->
            <div class="card-body ">
                <h5 class="card-title" style="color: #BF6159;">Cetaphil Gentle Skin Cleanser</h5>
                <p class="card-text" style="color: #5F5A56;">อ่อนโยน ไม่ระคายเคืองผิว คงความชุ่มชื้น ทำให้ผิวอ่อนนุ่ม เรียบ และแข็งแรง </p>
                <img src="img/ceta1.png" alt="Description" style="max-width: 100%; height: auto;">
            </div>
        </div>
        <div class="card border-#BF6159  mb-3 mt-5 mx-4"
            style="max-width: 13rem; min-height: 20rem; border: 2px solid #BF6159; ">
            <!-- <div class="card-header"style="color: #BF6159;">Header</div> -->
            <div class="card-body ">
                <h5 class="card-title" style="color: #BF6159;">Oily Skin Cleanser</h5>
                <p class="card-text" style="color: #5F5A56;">คลีนเซอร์เนื้อเจลทำความสะอาดผิวได้ล้ำลึก ขจัดสิ่งสกปรกและเครื่องสำอางได้หมดจด</p>
                <img src="img/ceta2.png" alt="Description" style="max-width: 100%; height: auto;">
            </div>
        </div>
        <div class="card border-#BF6159  mb-3 mt-5 mx-4"
            style="max-width: 13rem; min-height: 20rem; border: 2px solid #BF6159; ">
            <!-- <div class="card-header"style="color: #BF6159;">Header</div> -->
            <div class="card-body ">
                <h5 class="card-title" style="color: #BF6159;">Cetaphil Moisturising Lotion</h5>
                <p class="card-text" style="color: #5F5A56;">เนื้อโลชั่นบางเบา ไม่เหนอะหนะ ซึมซาบเร็ว บํารุงและปกป้องผิวตลอดวัน</p>
                <img src="img/ceta3.png" alt="Description" style="max-width: 100%; height: auto;">
            </div>
        </div>
        <div class="card border-#BF6159  mb-3 mt-5 mx-4"
            style="max-width: 13rem; min-height: 20rem; border: 2px solid #BF6159; ">
            <!-- <div class="card-header"style="color: #BF6159;">Header</div> -->
            <div class="card-body ">
                <h5 class="card-title" style="color: #BF6159;">Cetaphil Bright Healthy Night Comfort Cream</h5>
                <p class="card-text" style="color: #5F5A56;">กู้ผิวหมองคล้ำ ปลุกผิวกระจ่างใสอย่างอ่อนโยน เพื่อผิวบอบบาง แพ้ง่าย</p>
                <img src="img/ceta4.jpg" alt="Description" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
    
    <h1 class=" mt-4 text-center">cosmetics</h1>
    
    <div class="row row-cols-3 row-cols-lg-2 row-cols-md-3 gx-1  ">
        <div class="card border-#BF6159  mb-3 mt-5 mx-4"
            style="max-width: 13rem; min-height: 20rem; border: 2px solid #BF6159; ">
            <!-- <div class="card-header"style="color: #BF6159;">Header</div> -->
            <div class="card-body ">
                <h5 class="card-title" style="color: #BF6159;">Maybelline FIT ME! Matte+Poreless Liquid Foundation</h5>
                <p class="card-text" style="color: #5F5A56;"> รองพื้นกันน้ำคุมมันสำหรับคนหน้ามันจาก Maybelline รองพื้นบางเบาเนื้อแมท</p>
                <img src="img/Fitme.jpg" alt="Description" style="max-width: 100%; height: auto;">
            </div>
        </div>
        <div class="card border-#BF6159  mb-3 mt-5 mx-4"
            style="max-width: 13rem; min-height: 20rem; border: 2px solid #BF6159; ">
            <!-- <div class="card-header"style="color: #BF6159;">Header</div> -->
            <div class="card-body ">
                <h5 class="card-title" style="color: #BF6159;">skintific cushion</h5>
                <p class="card-text" style="color: #5F5A56;">คุชชั่นที่ช่วยปรับผิวของคุณให้สวยสมบูรณ์แบบ เนื้อบางเบา แต่มาพร้อมการปกปิดสูง ช่วยปกป้องคุณจากความมันและน้ำ</p>
                <img src="img/skintifcushion.png" alt="Description" style="max-width: 100%; height: auto;">
            </div>
        </div>
        <div class="card border-#BF6159  mb-3 mt-5 mx-4"
            style="max-width: 13rem; min-height: 20rem; border: 2px solid #BF6159; ">
            <!-- <div class="card-header"style="color: #BF6159;">Header</div> -->
            <div class="card-body ">
                <h5 class="card-title" style="color: #BF6159;">LA GLACE</h5>
                <p class="card-text" style="color: #5F5A56;">เนื้อบาล์มเจลลี่ที่ให้ความชุ่มชื้น ไม่เหนอะเกลี่ยง่าย มอบผิวฉ่ำโกลว์หมือนสาวแก้มใสดูเป็นธรรมชาติ และให้ความติดทนนาน สามารถทาได้ทั้งแก้มและริมฝีปาก</p>
                <img src="img/LaGlace.jpg" alt="Description" style="max-width: 100%; height: auto;">
            </div>
        </div>
        <div class="card border-#BF6159  mb-3 mt-5 mx-4"
            style="max-width: 13rem; min-height: 20rem; border: 2px solid #BF6159; ">
            <!-- <div class="card-header"style="color: #BF6159;">Header</div> -->
            <div class="card-body ">
                <h5 class="card-title" style="color: #BF6159;">Primary card title</h5>
                <p class="card-text" style="color: #5F5A56;">แป้งคุมมันฟิตมี พร้อมกันแดด SPF32 PA+++ ผิวแพ้ง่ายก็ใช้ได้โดยไม่ต้องกลัวการอุดตัน</p>
                <img src="img/แป้งฟิตมี.png" alt="Description" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>