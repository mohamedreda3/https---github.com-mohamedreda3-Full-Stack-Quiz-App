<?php
include_once('config/config.php');
$teacher__email = '';
$getUserName = '';
session_start();
if (!empty($_SESSION['teacher__email']) && $_GET['quiz_id']) {
    $teacher__email = $_SESSION['teacher__email'];
    $getUserName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM teachers WHERE email = '$teacher__email'"))['username'];
} else {
    header('location:teacherlogin.php', true);
}
$quiz_id = $_GET['quiz_id'];
$quizName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM quizzes WHERE quizid = '$quiz_id'"))['quizName'];
$quizDegree = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM quizzes WHERE quizid = '$quiz_id'"))['degree'];
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
    <link rel="stylesheet" type="text/css" media="print" href="assets/css/style.css">
    <style>
        .questions,
        .question,
        .question>* {
            width: 100%;
        }

        .questions,
        .question {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .question h3,
        .question div p {
            padding: 5px;
            min-width: 50px;
            border-bottom: 0.5px solid rgb(179 179 179);
            max-width: 300px;
        }

        .question>* {
            margin: 5px 0;
        }

        .question {
            padding: 10px;
            align-items: flex-start;
        }

        .question div#secq button {
            margin: 6px 0;
        }

        .question div#secq {
            align-items: flex-start;
        }
    </style>
    <title>-- Quiz Quiestions --</title>
</head>

<body>

    <header>
        <nav>
            <div class="title">
                <h1>Quizat</h1>
            </div>
            <div class="navbar">
                <div class="head">
                    <div class="info">
                        <img src="https://www.dlf.pt/dfpng/middlepng/481-4816679_user-login-png-gambar-icon-user-png-transparent.png" alt="Admin">
                        <div class="name"><?php echo  $getUserName; ?></div>
                    </div>
                    <div class="bars">
                        <div class="bar"></div>
                    </div>
                </div>
                <ul class="body">
                    <li>Welcome : <?php echo $getUserName; ?> </li>
                    <li><a href="./yoursubjects.php"> Your Subjects </a></li>
                    <li><a href="./adminpanal.php"> Add quiz </a></li>
                    <li><a href="./functions/logout3.php">
                            <i class="icon fa fa-sign-out-alt"></i>
                            Log out
                        </a></li>
                </ul>
        </nav>
    </header>
    <script src="./admin_assets/main.js"></script>
    <h2 style="width: 250px; text-align:center; padding:5px 0; margin: 10px auto; border-bottom:0.5px solid grey;">-
        <?php
        echo $quizName;
        ?>
        degrees -</h2>
    <div class="print">-Print Degrees-</div>
    <?php
    $getStudentCompleted = mysqli_query($conn, "SELECT * FROM completed_quiz WHERE quizid = '$quiz_id'");
    echo "<div class='deg_con'>
    <p>- $quizName degrees -</p>
    <table class='degree_container'>
    <tr>
    <td>Student Name</td>
    <td>Student Email</td>
    <td>Student Address</td>
    <td>Student PhoneNumber</td>
    <td>Student Gender</td>
    <td> Quiz</td>
    <td>Student Degree</td>
    <td>Quiz Degree</td>
    </tr>
    ";
    while ($getStudent = mysqli_fetch_assoc($getStudentCompleted)) {
        $email = $getStudent['email'];
        $degree = $getStudent['quizdegree'];
        $getStudentData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM studentteacherpanel WHERE email = '$email'"));
        $studentName = $getStudentData['username'];
        $studentAddress = $getStudentData['address'];
        $studentPhoneNumber = $getStudentData['phonenumber'];
        $studentGender = $getStudentData['gender'];
        echo "
        <tr>
        <td>$studentName</td>
        <td>$email</td>
        <td>$studentAddress</td>
        <td>$studentPhoneNumber</td>
        <td>$studentGender</td>
        <td>$quizName</td>
        <td>$degree</td>
        <td>$quizDegree</td>
        </tr>";
    }
    echo "</table></div>";
    ?>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
    <script>
        document.querySelector('.print').onclick = function() {
            window.frames['print_frame'].document.body.innerHTML = '<link rel="stylesheet" href="assets/css/style.css">' + document.querySelector('.deg_con').innerHTML;
            window.frames["print_frame"].window.focus();
            setTimeout(() => window.frames["print_frame"].window.print(), 200);
        }
    </script>
</body>

</html>