<?php
include_once('config/config.php');
include('layouts/quiztypebutton.php');
$teacher__email = '';
$getUserName = '';
session_start();
if (!empty($_SESSION['teacher__email'])) {
    $teacher__email = $_SESSION['teacher__email'];
    $getUserName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM teachers WHERE email = '$teacher__email'"))['username'];
} else {
    header('location:teacherlogin.php', true);
}
$sub_id = $_GET['sub_id'];
$getQuizzes = mysqli_query($conn, "SELECT * FROM quizzes WHERE subjectId = '$sub_id'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_assets/style.css">
    <link rel="stylesheet" href="admin_assets/forms.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Quiz-App</title>
</head>

<body>
    <div class="container">
        <header>
            <nav>
                <div class="title">
                    <h1>Quizat</h1>
                </div>
                <div class="navbar">
                    <div class="head">
                        <div class="info">
                            <img src="https://www.dlf.pt/dfpng/middlepng/481-4816679_user-login-png-gambar-icon-user-png-transparent.png" alt="Admin">
                            <div class="name">L.messi</div>
                        </div>
                        <div class="bars">
                            <div class="bar"></div>
                        </div>
                    </div>
                    <ul class="body">
                        <li>Welcome : <?php echo $getUserName; ?> </li>
                        <li><a href="./yoursubjects.php"> Your Subjects </a></li>
                        <li><a href="./adminpanal.php"> Add quiz </a></li>
                        <li><a href="./studentteacherpanel.php"> Add student </a></li>
                        <li><a href="./functions/logout2.php">
                                <i class="icon fa fa-sign-out-alt"></i>
                                Log out
                            </a></li>
                    </ul>
            </nav>
        </header>
        <div class="div__container">
            <?php
            if (mysqli_num_rows($getQuizzes) > 0) {
                while ($quizRow = mysqli_fetch_assoc($getQuizzes)) {
                    $quizId = $quizRow['quizId'];
                    $quizTitle = $quizRow['quizName'];
                    $quizTime = $quizRow['quiztime'];
                    $quizDegree = $quizRow['degree'];
                    $subjectId = $quizRow['subjectId'];
                    $subject = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM subjects WHERE subjectId = '$subjectId'"))['subjectName'];
                    $NumberOfStudentComplete = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM completed_quiz WHERE quizid = '$quizId'"));
                    $getDegrees = mysqli_query($conn, "SELECT * FROM completed_quiz WHERE quizid = '$quizId'");
                    $degreeSum = 0;
                    while ($studentDegree = mysqli_fetch_assoc($getDegrees)) {
                        $degreeSum += $studentDegree['quizdegree'];
                    }
                    $degreesAverage = 0;
                    if ($NumberOfStudentComplete  != 0) {
                        $degreesAverage = $degreeSum / ($NumberOfStudentComplete * $quizDegree);
                    }
                    echo "<div class='account__container'> <img src='https://cdn4.vectorstock.com/i/1000x1000/68/03/quiz-sign-icon-questions-and-answers-game-vector-3756803.jpg' alt='$quizTitle'/> 
                <p>$quizTitle</p>
                <p>$quizTime ( Min )</p>
                <p>Degree : $quizDegree</p>
                <p>$subject</p>
                <p>NumberOfStudentComplete : $NumberOfStudentComplete</p>
                <p>degreesAverage : $degreesAverage</p>";
                    echo "<div class='btns'>
                <button class='viewquiz' id='$quizId' style='--i:1; width: 137px;' onclick='quizPage(this.id)'>View Quizz</button>
                <button class='viewdegrees' id='$quizId' style='--i:2; width: 137px;' onclick='degreePage(this.id)'>View Degrees</button>
                </div></div>";
                }
            } else {
                echo '<div class="div__container">There is Not Any quizzes</div>';
            }
            ?>
            <!--      -->
        </div>
        <script src='assets/js/all.js'></script>
        <script src="admin_assets/main.js"></script>
        <script src="assets/js/main.js"></script>
        <script>
            function quizPage(quizId) {
                location.href = `quizquestions.php?quiz_id=${quizId}`;
            }

            function degreePage(quizId) {
                location.href = `studentdegrees.php?quiz_id=${quizId}`;
            }
        </script>
</body>

</html>