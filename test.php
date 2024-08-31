<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>ศูนย์กลางเครื่องสำอาง</title>
    <link href="style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header class="w-100 bg-D9D9D9 px-5" style="height: 70px;">
        <nav class="navbar navbar-expand-lg container">
            <div class="d-flex flex-wrap w-100 justify-content-between align-items-center center">
                <a href="#">
                    <img src="img/logo.png" width="130px" alt="">
                </a>
            </div>
        </nav>
    </header>

    <!-- question -->
    <div class="container mt-5 fw-normal text-BF6159">
        <form id="surveyForm" method="post" action="insert_question.php">
            <h1>ทดสอบสภาพผิวหน้า</h1>

            <!-- question 1-->
            <div class="question active">
                <div class="radio-list">
                    <h1 class="text-center">สภาพผิวของคุณเป็นเเบบไหน</h1>

                    <div class="radio-item"><input name="answer1" id="answer1_1" type="radio" value="เป็นผิวเเพ้ง่าย"><label for="answer1_1">เป็นผิวเเพ้ง่าย</label></div>
                    <div class="radio-item"><input name="answer1" id="answer1_2" type="radio" value="เป็นผิวปกติ"><label for="answer1_2">เป็นผิวปกติ</label></div>
                    <button type="button" class="btn btn-primary next mt-5">Next</button>
                </div>
            </div>


                <!-- question 2-->
                <div class="question">
                    <div class="radio-list">
                        <h1 class="text-center">ประเภทผิวของคุณเป็นเเบบไหน</h1>
                        
                        <div class="radio-item"><input name="answer2" id="answer2_1" type="radio" value="ผิวมัน (Oily skin)"><label for="answer2_1">ผิวมัน (Oily skin)</label></div>
                        <div class="radio-item"><input name="answer2" id="answer2_2" type="radio" value="ผิวผสม (Combination skin)"><label for="answer2_2">ผิวผสม (Combination skin)</label></div>
                        <div class="radio-item"><input name="answer2" id="answer2_3" type="radio" value="ผิวแห้ง (Dry skin)"><label for="answer2_3">ผิวแห้ง (Dry skin)</label></div>
                        <button type="button" class="btn btn-primary next mt-5">Next</button>
                    </div>
                </div>


            <!-- question 3-->
            <div class="question">
                <div class="radio-list">
                    <h1 class="text-center" >ปัญหาผิวของคุณมีอะไรบ้าง</h1>
                    
                    <div class="radio-item"><input name="answer3" id="answer3_1" type="radio" value="มีสิว"><label for="answer3_1">มีสิว</label></div>
                    <div class="radio-item"><input name="answer3" id="answer3_2" type="radio" value="มีรอยดำและรอยแดง"><label for="answer3_2">มีรอยดำและรอยแดง</label></div>
                    <div class="radio-item"><input name="answer3" id="answer3_3" type="radio" value="มีริ้วรอยและความเหี่ยวย่น"><label for="answer3_3">มีริ้วรอยและความเหี่ยวย่น</label></div>
                    <div class="radio-item"><input name="answer3" id="answer3_4" type="radio" value="มีรูขุมขนกว้าง"><label for="answer3_4">มีรูขุมขนกว้าง</label></div>
                    <button type="button" class="btn btn-primary next mt-5">Next</button>
                </div>
            </div>

            <!-- question 4-->
            <div class="question">
                <div class="radio-list">
                    <h1 class="text-center" >สีผิวของคุณคืออะไร</h1>
                    
                    <div class="radio-item"><input name="answer4" id="answer4_1" type="radio" value="ผิวสีขาว (Fair Skin)"><label for="answer4_1">ผิวสีขาว(Fair Skin)</label></div>
                    <div class="radio-item"><input name="answer4" id="answer4_2" type="radio" value="ผิวสีเหลือง (Yellowish skin)"><label for="answer4_2">ผิวสีเหลือง (Yellowish skin)</label></div>
                    <div class="radio-item"><input name="answer4" id="answer4_3" type="radio" value="ผิวสีเเทน (Tan Skin)"><label for="answer4_3">ผิวสีเเทน (Tan Skin)</label></div>
                    
                    <button type="submit" class="btn btn-primary next mt-5">ส่งคำตอบ</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('.next').click(function () {
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