<?php
include("config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $questions = [
        'question1' => $_POST['question1'],
        'answer1' => $_POST['answer1'],
        'question2' => $_POST['question2'],
        'answer2' => $_POST['answer2'],
        'question3' => $_POST['question3'],
        'answer3' => $_POST['answer3'],
        'question4' => $_POST['question4'],
        'answer4' => $_POST['answer4'],
    ];

    // print_r($questions);

    $stmt = $conn->prepare("INSERT INTO question (question_name, question_answer) VALUES (?, ?)");

    for ($i = 1; $i <= 4; $i++) {
        $question_name = $questions["question{$i}"];
        $question_answer = $questions["answer{$i}"];
        $stmt->bind_param("ss", $question_name, $question_answer);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();
    echo "Survey submitted successfully!";
    // echo print_r($questions);
} else {
    echo "Invalid request.";
}
?>

