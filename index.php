<?php
include_once('config/config.php');
include('layouts/quiztypebutton.php');
$student__email = '';
$getUserName = '';
session_start();
if (!empty($_SESSION['student__email'])) {
    $student__email = $_SESSION['student__email'];
    $getUserName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM studentteacherpanel WHERE email = '$student__email'"))['username'];
} else {
    header('location:studentlogin.php', true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_assets/style.css">
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
                            <div class="name"><?php echo $getUserName; ?></div>
                        </div>
                        <div class="bars">
                            <div class="bar"></div>
                        </div>
                    </div>
                    <ul class="body">
                        <li>Welcome : <?php echo $getUserName; ?> </li>
                        <li><a href="./functions/logout2.php">
                                <i class="icon fa fa-sign-out-alt"></i>
                                Log out
                            </a></li>
                    </ul>
            </nav>
        </header>
        <div class="slide__conainer">
            <div class="site__container">
                <div class="quiz__information">
                    <div class="quiz__taps">
                        <?php
                        $getSubjects = mysqli_query($conn, "SELECT * FROM subject_student WHERE email = '$student__email'");
                        while ($getstudentteacherpanelubject = mysqli_fetch_assoc($getSubjects)) {
                            $subId = $getstudentteacherpanelubject['subjectid'];
                            $getSubject = mysqli_query($conn, "SELECT * FROM subjects WHERE subjects.subjectId = '$subId'");
                            while ($subjects = mysqli_fetch_assoc($getSubject)) {
                                $subject = $subjects['subjectName'];
                                $subjectId = $subjects['subjectId'];
                                $getQuizzes = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM quizzes WHERE quizzes.subjectId = '$subjectId' "));
                                echo quizTap($subjectId, $subject, $getQuizzes, $student__email);
                            }
                        }
                        ?>
                    </div>
                    <div class="subject__quizzes">
                        <div class="back__page">
                            <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="quizzes">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='assets/js/all.js'></script>
    <script src="admin_assets/main.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>