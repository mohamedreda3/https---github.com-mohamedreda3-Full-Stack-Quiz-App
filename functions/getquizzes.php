<?php
include_once('../config/config.php');
if (isset($_POST['subject']) && !empty($_POST['subject'])) {
    $subject = $_POST['subject'];
    $quizzes = mysqli_query($conn, "SELECT * FROM quizzes WHERE subjectId = '$subject'");
    $getQuizzes = [];
    while ($getQuiz = mysqli_fetch_assoc($quizzes)) {
        array_push($getQuizzes, $getQuiz);
    }
    echo json_encode($getQuizzes);
} else {
    echo json_encode(array('select sub'));
}
