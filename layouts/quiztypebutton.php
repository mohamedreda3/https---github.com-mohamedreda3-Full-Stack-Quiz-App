<?php
function quizTap($quizType, $quizTitle,$numberOfStudents, $email){
    return '
    <div class="quiz__tap quiz__name" id="'.$quizType.'" data-email="'.$email.'">
    <p class="quiz__name">'.$quizTitle.'</p>
    <p class="number__students">'.$numberOfStudents.'</p>
    </div>
    ';
}
?>