<?php
include("config/config.php");

session_start();

$logStatus = isset($_SESSION['logStatus']) ? $_SESSION['logStatus'] : 0;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$userud = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$profile = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : null;

if ($logStatus == 0) {
    header("Location: form_login.php");
}

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

    <div class="container mt-5 fw-normal text-BF6159">
        <form id="surveyForm" method="post" action="insert_question.php">

            <div class="question active">
                <div class="radio-list">
                    <h3 class="text-center">สภาพผิวของคุณเป็นเเบบไหน</h3>
                    <br>
                    <h5 class="radio-item"><input name="answer1" id="answer1_1" type="radio" value="ผิวเเพ้ง่าย"><label for="answer1_1">ผิวเเพ้ง่าย ลักษณะของคนที่เป็นผิวเเพ้ง่าย ผิวหนังมีอาการแดง อาการระคายเคือง เป็นผื่น คัน</label></h5>
                    <div class="radio-item"><input name="answer1" id="answer1_2" type="radio" value="ผิวปกติ"><label for="answer1_2">ผิวปกติ</label></div>
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary next mt-5">Next</button>
                    </div>
                </div>
            </div>


            <!-- question 2-->
            <div class="question">
                <div class="radio-list">
                    <h3 class="text-center">ลักษณะผิวของคุณเป็นเเบบไหน</h3>
                    <br>
                    <div class="radio-item"><input name="answer2" id="answer2_1" type="radio" value="ผิวธรรมดา (Normal Skin)"><label for="answer2_1">ผิวธรรมดา (Normal Skin) ลักษณะของผิวธรรมดา มีรูขุมขนขนาดเล็ก ผิวนุ่มและเรียบเนียน ผิวมีความสดชื่นไม่หมองคล้ำ ปราศจากสิว </label></div>
                    <div class="radio-item"><input name="answer2" id="answer2_2" type="radio" value="ผิวมัน (Oily skin)"><label for="answer2_2">ผิวมัน (Oily skin) ลักษณะของผิวมัน รูขุมขนกว้างมองเห็นได้อย่างชัดเจน ผิวเงา มันวาว ผิวดูหนา อาจมองเห็นเส้นเลือดไม่ชัดเจน</label></div>
                    <div class="radio-item"><input name="answer2" id="answer2_3" type="radio" value="ผิวผสม (Combination skin)"><label for="answer2_3">ผิวผสม (Combination skin) ลักษณะของผิวผสม มันบริเวณทีโซนหน้าผากคางและจมูก รูขุมขนขยายใหญ่ขึ้นในบริเวณนี้ ปกติบริเวณแก้มจะแห้ง</label></div>
                    <div class="radio-item"><input name="answer2" id="answer2_4" type="radio" value="ผิวแห้ง (Dry skin)"><label for="answer2_4">ผิวแห้ง (Dry skin) ลักษณะของผิวเเห้ง เกิดความหยาบกร้าน ผิวลอกเป็นขุย มีอาการคันบ่อย</label></div>
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary next mt-5">Next</button>
                    </div>
                </div>
            </div>


            <!-- question 3-->
            <div class="question">
                <div class="radio-list">
                    <h3 class="text-center">ปัญหาผิวของคุณมีอะไรบ้าง</h3>
                    <br>
                    <div class="radio-item"><input name="answer3" id="answer3_1" type="radio" value="สิวอุดตัน"><label for="answer3_1">สิวอุดตัน ลักษณะของสิวอุดตันมี2ประเภท สิวหัวดำ ลักษณะ เป็นจุดสีดำเล็ก ๆ บนผิวหนังเเละ สิวหัวขาว มีลักษณะเป็นปุ่มสีขาวหรือเนื้อที่ไม่เปิดออก</label></div>
                    <div class="radio-item"><input name="answer3" id="answer3_2" type="radio" value="สิวอักเสบ"><label for="answer3_2">สิวอักเสบ ลักษณะจะเป็นตุ่มนูนแดง หรือเกิดตุ่มหนองบริเวณหัวสิว ซึ่งมีอาการบวมแดงและเจ็บปวดมากกว่าสิวตุ่มนูนแดงกับสิวหัวหนอง</label></div>
                    <div class="radio-item"><input name="answer3" id="answer3_3" type="radio" value="สิวผด"><label for="answer3_3">สิวผด ลักษณะเป็นผื่นตุ่มนูนเล็กๆ มีขนาดประมาณ 1-2 มิลลิเมตร กระจายบนผิวหนัง โดยเฉพาะบริเวณหน้าผาก ขมับ ผิวไม่เรียบเนียนสม่ำเสมอ</label></div>
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary next mt-5">Next</button>
                    </div>
                </div>
            </div>

            <!-- question 4-->
            <div class="question">
                <div class="radio-list">
                    <h3 class="text-center">ปัญหาผิวของคุณมีอะไรบ้าง</h3>
                    <br>
                    <div class="radio-item"><input name="answer4" id="answer4_1" type="radio" value="มีรูขุมขน"><label for="answer4_1">มีรูขุมขน ลักษณะของผิวที่มีรูขุมขน รูขุมขนที่เห็นได้ชัด รูขุมขนมักจะมีขนาดใหญ่และเห็นได้ชัดเจนบนผิวหนัง </label></div>
                    <div class="radio-item"><input name="answer4" id="answer4_2" type="radio" value="ไม่มีมีรูขุมขน"><label for="answer4_2">ไม่มีมีรูขุมขน</label></div>
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary next mt-5">Next</button>
                    </div>
                </div>
            </div>


            <!-- question 5-->
            <div class="question">
                <div class="radio-list">
                    <h3 class="text-center">ปัญหาผิวของคุณมีอะไรบ้าง</h3>
                    <br>
                    <div class="radio-item"><input name="answer5" id="answer5_1" type="radio" value="มีรอยดำเเละรอยแดง"><label for="answer5_1">มีรอยดำเเละรอยแดง ลักษณะของ รอยแดงเกิดจากการอักเสบในรูขุมขนระหว่างเป็นสิว ส่วนรอยดำมักเกิดตามมาหลังจากการอักเสบ</label></div>
                    <div class="radio-item"><input name="answer5" id="answer5_2" type="radio" value="ไม่มีมีรอยดำเเละรอยแดง"><label for="answer5_1">ไม่มีรอยดำเเละรอยแดง</label></div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-danger next mt-5">ส่งคำตอบ</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.next').click(function() {
                var current = $(this).closest('.question');
                var next = current.next('.question');
                var isChecked = current.find('input:radio:checked').length > 0 || current.find('input:checkbox:checked').length > 0;

                if (isChecked) {
                    if (next.length) {
                        current.removeClass('active');
                        next.addClass('active');
                    }
                } else {
                    alert('Please select an option before proceeding.');
                }
            });

        });
    </script>
</body>

</html>