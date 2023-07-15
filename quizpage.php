<?php
include_once('config/config.php');
$student__email = '';
$getUserName = '';
session_start();
if (!empty($_SESSION['student__email']) && $_GET['quizId']) {
    $student__email = $_SESSION['student__email'];
    $getUserName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM studentteacherpanel WHERE email = '$student__email'"))['username'];
} else {
    header('location:index.php', true);
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

    <title><?php
            $quizId = $_GET['quizId'];
            $subjectId = $_GET['subjectId'];
            $quizName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT quizName FROM quizzes WHERE quizId ='$quizId'"))['quizName'];
            $subjectName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT subjectName FROM subjects WHERE subjectId ='$subjectId'"))['subjectName'];
            echo $quizName . ' - ' . $subjectName;
            ?></title>
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
                        <div class="name"><?php echo $getUserName; ?></div>
                    </div>
                    <div class="bars">
                        <div class="bar"></div>
                    </div>
                </div>
                <ul class="body">
                    <li>Welcome : <?php echo  $getUserName; ?> </li>
                    <li><a href="./functions/logout2.php">
                            <i class="icon fa fa-sign-out-alt"></i>
                            Log out
                        </a></li>
                </ul>
        </nav>
    </header>
    <script src="./admin_assets/main.js"></script>
    <?php include('./layouts/errorbar.php'); ?>
    <?php
    include_once('config/config.php');
    $quizId = $_GET['quizId'];
    $quizTime = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM quizzes WHERE quizid = '$quizId'"))['quiztime'];
    $getQuestions = [];
    $getQuestion = mysqli_query($conn, "SELECT * FROM questions WHERE quizid = '$quizId'");
    echo "<div class='time'>$quizTime</div><form class='form_questions'>";
    $iterator = 0;
    while ($question = mysqli_fetch_assoc($getQuestion)) {
        $answers = unserialize($question['answers']);
        $questionTitle = $question['question'];
        $questionId = $question['questionid'];
        echo "<div class='question'><h3>$questionTitle</h3>";
        $questionUnique = base64_encode($iterator);
        echo "<div id='secq'>";
        foreach ($answers as $value) {
            $questionOption = base64_encode($value);
            $questionUnique = base64_encode($iterator);
            echo "<div class='input_fld'> <input type='radio' class='question__option' id='$questionUnique' name='$questionId' value='$value' required>
            <label for='$questionUnique' class='question__title'>$value</label><br> </div>";
            $iterator++;
        }
        echo "</div></div>";
    }
    echo "<button type='submit' class='custom-btn btn-3'>Send Answers</button></form>";
    ?>
    <script src="./assets/js/fetch.js"></script>
    <script src="./assets/js/main.js"></script>
    <script>
        var quizTime = document.querySelector('.time');
        var timeInSec = parseInt(quizTime.innerText) * 60;
        // timeInSec = 10;
        setInterval(() => {
            if (timeInSec > 0) {
                --timeInSec;
                var sec = parseInt(timeInSec % 60);
                var min = parseInt((timeInSec - sec) / 60);
                var hours = parseInt((timeInSec - (min * 60)) / 60);
                quizTime.innerHTML = hours > 0 ? `${hours} H : ${min} M : ${sec} S` : min > 0 ? `${min} M : ${sec} S` : `${sec} S`;
            } else {
                // document.querySelector('form').submit();
                sendAnswers();
                // location.href = window.close();
            }
        }, 1000);

        document.querySelector('form').onsubmit = (e) => {
            e.preventDefault();
            sendAnswers();
        }

        function sendAnswers() {
            var questionFormData = new FormData(document.querySelector('form'));
            var quizId = "<?php echo $quizId; ?>";
            var studentEmail = "<?php echo $student__email; ?>";
            questionFormData.append('quizId', quizId);
            questionFormData.append('email', studentEmail);
            fetchData('./functions/sendAnswers.php', questionFormData).then(res => res.text()).then(function(data) {
                if (data != 'Added') {
                    errorMassege(data, 'red');
                } else {
                    errorMassege(data, 'green');
                    setTimeout(() => window.location.replace(location.origin), 1200);
                }
            })
        }
    </script>
</body>

</html>
