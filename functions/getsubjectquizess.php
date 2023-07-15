<?php
include_once('../config/config.php');
if (isset($_POST['id']) && !empty($_POST['id']) && !empty($_POST['email'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    if ($id != '') {
        $getSubjectId = mysqli_fetch_assoc(mysqli_query($conn, "SELECT subjectId FROM subjects WHERE subjectId='$id'"))['subjectId'];
        $quizzes = mysqli_query($conn, "SELECT * FROM quizzes WHERE quizzes.subjectId='$getSubjectId'");
        if (mysqli_num_rows($quizzes) > 0) {
            while ($quiz = mysqli_fetch_assoc($quizzes)) {
                $quizId = $quiz['quizId'];
                $getCompletedQuizzes = mysqli_query($conn, "SELECT * FROM completed_quiz WHERE quizid ='$quizId'");
                if(mysqli_num_rows($getCompletedQuizzes)){
                    while($getCompleteQuizzes = mysqli_fetch_assoc($getCompletedQuizzes)){
                    echo '
                    <div class="quiz__tap">
                    <p class="quiz__name">' . $quiz['quizName'] . '</p>
                    <p class="quiz__time"> Completed </p>
                    <p class="quiz__degree">Your Degree: ' . $getCompleteQuizzes['quizdegree'] . '/ ' . $quiz['degree'] . '</p>
                    </div>
                    ';
                }
                }else{
                    echo '
                    <div class="quiz__tap quiz__info" id=' . $quiz['quizId'] . ' data-subject=' . $quiz['subjectId'] . '>
                        <p class="quiz__name">' . $quiz['quizName'] . '</p>
                        <p class="quiz__time">Time: ' . $quiz['quiztime'] . ' Min</p>
                        <p class="quiz__degree">Degree: ' . $quiz['degree'] . '</p>
                        </div>
                    ';
                }
            }
        } else {
            echo '<p> There are not any quizzes </p>' . $_POST['email'];
        }
    } else {
        echo '<p> There are not any quizzes </p>' . $_POST['email'];
    }
}
