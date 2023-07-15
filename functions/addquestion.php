<?php
include_once('../config/config.php');

if ((isset($_POST['answers']) && !empty($_POST['answers'])) && (isset($_POST['subject']) && !empty($_POST['subject']))  && (isset($_POST['quiz']) && !empty($_POST['quiz']))  && (isset($_POST['question']) && !empty($_POST['question']))  && (isset($_POST['correct__answer']) && !empty($_POST['correct__answer']))) {
    $answers = serialize(json_decode($_POST['answers']));
    // echo $answers;
    $question = $_POST['question'];
    $quiz = $_POST['quiz'];
    $correctAnswer = $_POST['correct__answer'];
    if (mysqli_query($conn, "INSERT INTO questions(question, correctanswer, questionid, quizid, answers) VALUES('$question', '$correctAnswer', '$question', '$quiz', '$answers')")) {
        echo 'Added';
    } else {
        echo mysqli_error($conn);
    }
} else {
    echo 'Enter Answer';
}


/*
question	correctanswer	questionid	quizid	answers	
*/