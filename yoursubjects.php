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
$getsubject = mysqli_query($conn, "SELECT * FROM subject_teacher WHERE email = '$teacher__email'");
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
                        <li><a href="./functions/logout3.php">
                                <i class="icon fa fa-sign-out-alt"></i>
                                Log out
                            </a></li>
                    </ul>
            </nav>
        </header>
        <div class="div__container">
            <?php
            while ($subjectRow = mysqli_fetch_assoc($getsubject)) {
                $subjectid = $subjectRow['subjectid'];
                $subjectRow2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM subjects WHERE subjectId = '$subjectid'"));
                $subjectName = $subjectRow2['subjectName'];
                $subjectId = $subjectRow2['subjectId'];

                echo "<div class='account__container'> <img src='https://www.linktolibraries.org/application/files/4315/5257/2195/books-icon.png' alt='$subjectName'/>
            <p>$subjectName</p>";

                echo "<div class='btns'><button class='edit' id='$subjectId' style='--i:1; width: 137px;' onclick='viewQuiz(this.id)'>View Your Quizzes</button></div></div>";
            }

            ?>
        </div>
        <script src='assets/js/all.js'></script>
        <script src="admin_assets/main.js"></script>
        <script src="assets/js/fetch.js"></script>
        <script src="assets/js/main.js"></script>
        <script>
            function viewQuiz(subjectId) {
                location.href = `viewquiz.php?sub_id=${subjectId}`;
            }
        </script>

</body>

</html>