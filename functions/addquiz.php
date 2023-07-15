<?php
include_once('../config/config.php');
if ((isset($_POST['subjectId']) && !empty($_POST['subjectId'])) && (isset($_POST['quiztitle']) && !empty($_POST['quiztitle'])) && (isset($_POST['quiztime']) && !empty($_POST['quiztime'])) && (isset($_POST['quizdegree']) && !empty($_POST['quizdegree']))) {
    $subjectId = $_POST['subjectId'];
    $quiztitle = $_POST['quiztitle'];
    $quiztime = $_POST['quiztime'];
    $quizdegree = $_POST['quizdegree'];
    print_r($_POST);
    if (mysqli_query($conn, "INSERT INTO quizzes(quizName, subjectId, quiztime, degree) VALUES('$quiztitle', '$subjectId', '$quiztime', '$quizdegree')")) {
        echo 'Added';
    }else{
        echo mysqli_error($conn);
    }
} else if (!isset($_POST['subjectId']) || empty($_POST['subjectId'])) {
    echo 'Please Select Subject';
} else if (!isset($_POST['quiztitle']) || empty($_POST['quiztitle'])) {
    echo 'Please Enter Quiz Title';
} else if (!isset($_POST['quiztime']) || empty($_POST['quiztime'])) {
    echo 'Please Enter Quiz Time';
} else if (!isset($_POST['quizdegree']) || empty($_POST['quizdegree'])) {
    echo 'Please Enter Quiz Degree';
}
