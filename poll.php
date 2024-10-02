<?php
include("config/config.php");

session_start();

$logStatus = isset($_SESSION['logStatus']) ? $_SESSION['logStatus'] : 0;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$profile = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : null;

if ($logStatus == 0) {
    header("Location: form_login.php");
}

$sql1 = "SELECT * FROM categories ";
$result1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM brands ";
$result2 = mysqli_query($conn, $sql2);





// Query to fetch the answers






$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poll</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>




<body>
<?php
 include("nav.php");

 ?>


    <div class="container mt-5 fw-normal text-BF6159">
        <form id="surveyForm" method="post" action="insert_question.php">

            <div class="question active">
                <div class="radio-list">


                <?php
                $question_sql = "SELECT question FROM question WHERE id = 1"; // Assuming you're fetching the first question
                $question_result = $conn->query($question_sql);
                $answer_sql = "SELECT answer FROM answer WHERE question_id = 1"; // Assuming you're fetching answers for question ID 1
$answer_result = $conn->query($answer_sql);


                    if ($question_result->num_rows > 0) {
                        // Output the question
                        while ($row = $question_result->fetch_assoc()) {
                            echo '<h3 class="text-center">' . $row["question"] . '</h3>';
                        }
                    } else {
                        echo '<h3 class="text-center">No questions found</h3>';
                    }
                    ?>

                    <br>
                    <?php
                    if ($answer_result->num_rows > 0) {
                        // Output the answers
                        $i = 1;
                        while ($row = $answer_result->fetch_assoc()) {
                            echo '<h5 class="radio-item">
                                  <input name="answer1" id="answer1_' . $i . '" type="radio" value="' . $row["answer"] . '">
                                  <label for="answer1_' . $i . '">' . $row["answer"] . '</label>
                                  </h5>';
                            $i++;
                        }
                    } else {
                        echo '<h5 class="text-center">No answers found</h5>';
                    }
                    ?>
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary next mt-5">Next</button>
                    </div>




                </div>
            </div>


            <!-- question 2-->
            <div class="question">
                <div class="radio-list">



                <?php
                $question_sql = "SELECT question FROM question WHERE id = 2"; // Assuming you're fetching the first question
                $question_result = $conn->query($question_sql);
                $answer_sql = "SELECT answer FROM answer WHERE question_id = 2"; // Assuming you're fetching answers for question ID 1
$answer_result = $conn->query($answer_sql);


                    if ($question_result->num_rows > 0) {
                        // Output the question
                        while ($row = $question_result->fetch_assoc()) {
                            echo '<h3 class="text-center">' . $row["question"] . '</h3>';
                        }
                    } else {
                        echo '<h3 class="text-center">No questions found</h3>';
                    }
                    ?>

                    <br>
                    <?php
                    if ($answer_result->num_rows > 0) {
                        // Output the answers
                        $i = 1;
                        while ($row = $answer_result->fetch_assoc()) {
                            echo '<h5 class="radio-item">
                                  <input name="answer2" id="answer2_' . $i . '" type="radio" value="' . $row["answer"] . '">
                                  <label for="answer2_' . $i . '">' . $row["answer"] . '</label>
                                  </h5>';
                            $i++;
                        }
                    } else {
                        echo '<h5 class="text-center">No answers found</h5>';
                    }
                    ?>

                    
                    
                    
                    
                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary next mt-5">Next</button>
                    </div>
                </div>
            </div>


            <!-- question 3-->
            <div class="question">
                <div class="radio-list">
                    


                <?php
                $question_sql = "SELECT question FROM question WHERE id = 3"; // Assuming you're fetching the first question
                $question_result = $conn->query($question_sql);
                $answer_sql = "SELECT answer FROM answer WHERE question_id = 3"; // Assuming you're fetching answers for question ID 1
$answer_result = $conn->query($answer_sql);


                    if ($question_result->num_rows > 0) {
                        // Output the question
                        while ($row = $question_result->fetch_assoc()) {
                            echo '<h3 class="text-center">' . $row["question"] . '</h3>';
                        }
                    } else {
                        echo '<h3 class="text-center">No questions found</h3>';
                    }
                    ?>

                    <br>
                    <?php
                    if ($answer_result->num_rows > 0) {
                        // Output the answers
                        $i = 1;
                        while ($row = $answer_result->fetch_assoc()) {
                            echo '<h5 class="radio-item">
                                  <input name="answer3" id="answer3_' . $i . '" type="radio" value="' . $row["answer"] . '">
                                  <label for="answer3_' . $i . '">' . $row["answer"] . '</label>
                                  </h5>';
                            $i++;
                        }
                    } else {
                        echo '<h5 class="text-center">No answers found</h5>';
                    }
                    ?>




                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary next mt-5">Next</button>
                    </div>
                </div>
            </div>

            <!-- question 4-->
            <div class="question">
                <div class="radio-list">
                   


                <?php
                $question_sql = "SELECT question FROM question WHERE id = 4"; // Assuming you're fetching the first question
                $question_result = $conn->query($question_sql);
                $answer_sql = "SELECT answer FROM answer WHERE question_id = 4"; // Assuming you're fetching answers for question ID 1
$answer_result = $conn->query($answer_sql);


                    if ($question_result->num_rows > 0) {
                        // Output the question
                        while ($row = $question_result->fetch_assoc()) {
                            echo '<h3 class="text-center">' . $row["question"] . '</h3>';
                        }
                    } else {
                        echo '<h3 class="text-center">No questions found</h3>';
                    }
                    ?>

                    <br>
                    <?php
                    if ($answer_result->num_rows > 0) {
                        // Output the answers
                        $i = 1;
                        while ($row = $answer_result->fetch_assoc()) {
                            echo '<h5 class="radio-item">
                                  <input name="answer4" id="answer4_' . $i . '" type="radio" value="' . $row["answer"] . '">
                                  <label for="answer4_' . $i . '">' . $row["answer"] . '</label>
                                  </h5>';
                            $i++;
                        }
                    } else {
                        echo '<h5 class="text-center">No answers found</h5>';
                    }
                    ?>




                    <div class="text-center">
                        <button type="button" class="btn btn-outline-primary next mt-5">Next</button>
                    </div>
                </div>
            </div>


            <!-- question 5-->
            <div class="question">
                <div class="radio-list">
                <?php
                $question_sql = "SELECT question FROM question WHERE id = 5"; // Assuming you're fetching the first question
                $question_result = $conn->query($question_sql);
                $answer_sql = "SELECT answer FROM answer WHERE question_id = 5"; // Assuming you're fetching answers for question ID 1
$answer_result = $conn->query($answer_sql);


                    if ($question_result->num_rows > 0) {
                        // Output the question
                        while ($row = $question_result->fetch_assoc()) {
                            echo '<h3 class="text-center">' . $row["question"] . '</h3>';
                        }
                    } else {
                        echo '<h3 class="text-center">No questions found</h3>';
                    }
                    ?>

                    <br>
                    <?php
                    if ($answer_result->num_rows > 0) {
                        // Output the answers
                        $i = 1;
                        while ($row = $answer_result->fetch_assoc()) {
                            echo '<h5 class="radio-item">
                                  <input name="answer5" id="answer5_' . $i . '" type="radio" value="' . $row["answer"] . '">
                                  <label for="answer5_' . $i . '">' . $row["answer"] . '</label>
                                  </h5>';
                            $i++;
                        }
                    } else {
                        echo '<h5 class="text-center">No answers found</h5>';
                    }
                    ?>
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
                // ตรวจสอบว่ามีการเลือกคำตอบหรือไม่ (Radio หรือ Checkbox)
                var isChecked = current.find('input:radio:checked').length > 0 || current.find('input:checkbox:checked').length > 0;

                // หากมีการเลือกคำตอบแล้วจะเลื่อนไปยังคำถามถัดไป
                if (isChecked) {
                    if (next.length) {
                        current.removeClass('active');
                        next.addClass('active');
                    }
                } else {
                    alert('Please select an option before proceeding.'); // หากไม่มีการเลือกคำตอบ จะแสดงข้อความเตือน
                }
            });

        });
    </script>
</body>

</html>

