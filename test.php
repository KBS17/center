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
                    <h1 class="text-center">ระหว่างวันคุณรู้สึกว่าผิวหน้าเป็นอย่างไรมากที่สุด</h1>
                    <input name="question1" id="question1" type="text" value="ระหว่างวันคุณรู้สึกว่าผิวหน้าเป็นอย่างไรมากที่สุด">
                    <div class="radio-item"><input name="answer1" id="answer1_1" type="radio" value="รู้สึกว่าหน้าแห้ง ระคายเคือง มีผื่นคันง่าย"><label for="answer1_1">รู้สึกว่าหน้าแห้ง ระคายเคือง มีผื่นคันง่าย</label></div>
                    <div class="radio-item"><input name="answer1" id="answer1_2" type="radio" value="รู้สึกว่าผิวบริเวณแก้มตึงง่าย ต่างกับบริเวณอื่นๆ"><label for="answer1_2">รู้สึกว่าผิวบริเวณแก้มตึงง่าย ต่างกับบริเวณอื่นๆ</label></div>
                    <div class="radio-item"><input name="answer1" id="answer1_3" type="radio" value="รู้สึกว่าผิวหน้าดี ไม่มีปัญหา"><label for="answer1_3">รู้สึกว่าผิวหน้าดี ไม่มีปัญหา</label></div>
                    <div class="radio-item"><input name="answer1" id="answer1_4" type="radio" value="รู้สึกว่าหน้ามันเยิ้มง่ายและบ่อย"><label for="answer1_4">รู้สึกว่าหน้ามันเยิ้มง่ายและบ่อย</label></div>
                    <button type="button" class="btn btn-primary next mt-5">Next</button>
                </div>
            </div>

            <!-- question 2-->
            <div class="question">
                <div class="radio-list">
                    <h1>รูขุมขนบริเวณแก้มของคุณเป็นอย่างไร</h1>
                    <input name="question2" id="question2" type="text" value="รูขุมขนบริเวณแก้มของคุณเป็นอย่างไร">
                    <div class="radio-item"><input name="answer2" id="answer2_1" type="radio" value="ค่อนข้างเล็ก ถ้าไม่สังเกตุไม่เห็น"><label for="answer2_1">ค่อนข้างเล็ก ถ้าไม่สังเกตุไม่เห็น</label></div>
                    <div class="radio-item"><input name="answer2" id="answer2_3" type="radio" value="ค่อนข้างกว้าง ถ้าสังเกตุก็เห็น"><label for="answer2_3">ค่อนข้างกว้าง ถ้าสังเกตุก็เห็น</label></div>
                    <button type="button" class="btn btn-primary next mt-5">Next</button>
                </div>
            </div>

            <!-- question 3-->
            <div class="question">
                <div class="radio-list">
                    <h1>รูขุมขนบริเวณจมูกหรือรอบๆจมูกของคุณเป็นแบบไหน</h1>
                    <input name="question3" id="question3" type="text" value="รูขุมขนบริเวณจมูกหรือรอบๆจมูกของคุณเป็นแบบไหน">
                    <div class="radio-item"><input name="answer3" id="answer3_1" type="radio" value="ค่อนข้างเล็ก ถ้าไม่สังเกตุไม่เห็น"><label for="answer3_1">ค่อนข้างเล็ก ถ้าไม่สังเกตุไม่เห็น</label></div>
                    <div class="radio-item"><input name="answer3" id="answer3_3" type="radio" value="ค่อนข้างกว้าง ถ้าสังเกตุก็เห็น"><label for="answer3_3">ค่อนข้างกว้าง ถ้าสังเกตุก็เห็น</label></div>
                    <button type="button" class="btn btn-primary next mt-5">Next</button>
                </div>
            </div>

            <!-- question 4-->
            <div class="question">
                <div class="radio-list">
                    <h1>ผิวบริเวณรอบๆปาก ตา หรือแก้ม มักแห้งลอกเป็นขุยเมื่ออยู่ในที่อากาศเย็นๆ</h1>
                    <input name="question4" id="question4" type="text" value="ผิวบริเวณรอบๆปาก ตา หรือแก้ม มักแห้งลอกเป็นขุยเมื่ออยู่ในที่อากาศเย็นๆ">
                    <div class="radio-item"><input name="answer4" id="answer4_1" type="radio" value="รู้สึกบ่อยครั้ง"><label for="answer4_1">รู้สึกบ่อยครั้ง</label></div>
                    <div class="radio-item"><input name="answer4" id="answer4_2" type="radio" value="เป็นบางครั้ง"><label for="answer4_2">เป็นบางครั้ง</label></div>
                    <div class="radio-item"><input name="answer4" id="answer4_3" type="radio" value="ไม่รู้สึกเลย"><label for="answer4_3">ไม่รู้สึกเลย</label></div>
                    <div class="radio-item"><input name="answer4" id="answer4_4" type="radio" value="นานๆครั้งจะรู้สึก"><label for="answer4_4">นานๆครั้งจะรู้สึก</label></div>
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
                if (current.find('input:radio:checked').length > 0) {
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
