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
                    <li><a href="./studentteacherpanel.php"> Add student </a></li>
                    <li><a href="./functions/logout3.php">
                            <i class="icon fa fa-sign-out-alt"></i>
                            Log out
                        </a></li>
                </ul>
        </nav>
    </header>
    <script src="./admin_assets/main.js"></script>
    <h2 style="width: 250px; text-align:center; padding:5px 0; margin: 10px auto; border-bottom:0.5px solid grey;">- Questions -</h2>
    <?php
    include_once('config/config.php');
    $quizId = $_GET['quiz_id'];
    $getQuestions = [];
    $getQuestion = mysqli_query($conn, "SELECT * FROM questions WHERE quizid = '$quizId'");
    echo "<div class='questions'>";
    $iterator = 0;
    while ($question = mysqli_fetch_assoc($getQuestion)) {
        $answers = unserialize($question['answers']);
        if ($question['question'][strlen($question['question']) - 1] != '?') {
            $questionTitle = $question['question'] . '?';
        } else {
            $questionTitle = $question['question'];
        }
        $questionId = $question['questionid'];
        echo "<div class='question'><h3>$questionTitle</h3>";
        $questionUnique = base64_encode($iterator);
        echo "<div id='secq'>";
        foreach ($answers as $value) {
            echo " <p class='question__option' id='$questionId'>$value</p>";
        }
        echo "<button class='viewquiz' id='$questionId' width: 137px;>Edit Question</button></div></div>";
    }
    ?>
</body>

</html>