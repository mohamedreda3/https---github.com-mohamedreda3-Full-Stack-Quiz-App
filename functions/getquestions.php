<?php
include_once('../config/config.php');
$quizId = '';
if(!empty($_POST['quizId'])){
$quizId = $_POST['quizId'];
$getQuestionsQuery = mysqli_query($conn,"SELECT * FROM questions WHERE quizid = '$quizId'");
// $getQuestionsQuery = mysqli_query($conn,"SELECT * FROM questions JOIN answers WHERE quizid = '$quizId' AND questions.questionid = answers.questionId");
$getQuestions = [];
$getAnswers = [];
while($getQuestion = mysqli_fetch_assoc($getQuestionsQuery)){
array_push($getQuestions, $getQuestion); 
$qId= $getQuestion['questionid'];
$getAnswersQuery = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM answers WHERE answers.questionId = '$qId'"));
array_push($getAnswersQuery, ['question'=>$getQuestion['question'],'questionid'=>$getQuestion['questionid']]); 
array_push($getAnswers, $getAnswersQuery); 
}

echo json_encode($getAnswers);
    
}else{
    echo 'Please Choose Quiz';
}
?>

