<?php
include_once('../config/config.php');
include('../functions/insertFunction.php');
if (!empty($_POST)) {
    $quizId = $_POST['quizId'];
    $email = $_POST['email'];
    $getQuestions = mysqli_query($conn, "SELECT * FROM questions WHERE quizid = '$quizId'");
    $quizDegree = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM quizzes WHERE quizid = '$quizId'"))['degree'];
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM questions WHERE quizid = '$quizId'")) > 0){
    $eachQuestionDegree = $quizDegree / mysqli_num_rows(mysqli_query($conn, "SELECT * FROM questions WHERE quizid = '$quizId'"));
    $degree = 0;
    while ($questions = mysqli_fetch_assoc($getQuestions)) {
        $questionId = $questions['questionid'];
        $correctAnswer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM questions WHERE questionid = '$questionId'"))['correctanswer'];
        if (array_key_exists($questionId, $_POST)) {
            if ($_POST[$questionId] == $correctAnswer) {
                $degree += $eachQuestionDegree;
            }
        }
    }
    insertToDatabase($conn, 'completed_quiz', 'email, quizid, quizdegree', "'$email', '$quizId', '$degree'", "(email = '$email' AND quizid  = '$quizId')", 'You completed this exam. ');
}else{
    echo 'Added';
}
    
}
