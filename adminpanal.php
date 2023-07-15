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
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_assets/style.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .ansers span {
            background: grey;
            padding: 2px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            border-radius: 4px;
        }

        .form span {
            margin: 0 5px 0 15px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .deleteThisSubjects {
            cursor: pointer;
        }
    </style>
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
        <div class="slide__conainer">
            <?php
            include('layouts/slidenav.php');
            ?>
            <div class="site__container">
                <?php include('./layouts/errorbar.php'); ?>
                <section class="form__add__quiz animated flipInX">
                    <section class="form__header">
                        <h2>Add quiz</h2>
                        <span class="close__form">close</span>
                    </section>
                    <form class="newquizbox" autocomplete="off">
                        <p class="Name">
                            <select name="subjectId" placeholder="Choose the Subject:">
                                <option id='' value=''>--Choose the Subject--</option>
                                <?php
                                $getSubjects = mysqli_query($conn, "SELECT * FROM subject_teacher WHERE email = '$teacher__email'");
                                while ($getteacherSubject = mysqli_fetch_assoc($getSubjects)) {
                                    $subId = $getteacherSubject['subjectid'];
                                    $getSubject = mysqli_query($conn, "SELECT * FROM subjects WHERE subjects.subjectId = '$subId'");
                                    while ($subjects = mysqli_fetch_assoc($getSubject)) {
                                        $id = $subjects['subjectId'];
                                        $subject = $subjects['subjectName'];
                                        echo "<option id='$id' value='$id'>$subject</option>";
                                    }
                                }
                                ?>
                            </select>
                        </p>
                        <input placeholder="Quiz title" type="text" id="quiz" name="quiztitle"></input>
                        <input placeholder="Quiz Time (in min)" type="text" id="quiz" name="quiztime"></input>
                        <input placeholder="Quiz degree" type="text" id="quiz" name="quizdegree"></input>
                        <button type="submit">Add quiz</button>
                    </form>
                </section>
                <form class="form add_question" id="question">
                    <section class="form__header">
                        <h2>Add question</h2>
                        <span class="btn addQuiz third">Add quiz</span>
                    </section>
                    <p class="Name">
                        <select name="subject" placeholder="Choose the Subject:">
                            <option id='' value=''>--Choose the Subject--</option>
                            <?php
                            $getSubjects = mysqli_query($conn, "SELECT * FROM subject_teacher WHERE email = '$teacher__email'");
                            while ($getteacherSubject = mysqli_fetch_assoc($getSubjects)) {
                                $subId = $getteacherSubject['subjectid'];
                                $getSubject = mysqli_query($conn, "SELECT * FROM subjects WHERE subjects.subjectId = '$subId'");
                                while ($subjects = mysqli_fetch_assoc($getSubject)) {
                                    $id = $subjects['subjectId'];
                                    $subject = $subjects['subjectName'];
                                    echo "<option id='$id' value='$id'>$subject</option>";
                                }
                            }
                            ?>
                        </select>
                    </p>
                    <p class="Name">
                        <select name="quiz" placeholder="Choose Quiz:">
                            <option id='' value=''>--Choose Quiz--</option>
                        </select>
                    </p>
                    <p class="question"><input name="question" placeholder="Question..."></input>
                    </p>
                    <p class="answer"><input name="answer" placeholder="Add answer then click save to add another answer...."></input> <button type="button" class="save__answer" name="save__answer">Save answer</button></p>

                    <span class="ansers">
                    </span>
                    <p class="correct__answer"><input name="correct__answer" placeholder="Correct Answer..."></input>
                    </p>
                    <button type="submit" class="save__question">Save question</button>
                </form>
            </div>
        </div>
    </div>
    <script src='assets/js/all.js'></script>
    <script src="assets/js/main.js"></script>
    <script src="admin_assets/main.js"></script>
    <script src="assets/js/fetch.js"></script>
    <script>
        var form = document.querySelector('.question');
        var saveAnswer = document.querySelector('.save__answer'),
            answer = document.querySelector('input[name="answer"]'),
            subject = document.querySelector('.form select[name="subject"]'),
            quizSelect = document.querySelector('.form select[name="quiz"]'),
            addQuestion = document.querySelector('.save__question');

        subject.onchange = () => {
            getQuizzes();
        }

        function getQuizzes() {
            var answerForm = new FormData();
            answerForm.append('subject', subject.value);
            fetchData('functions/getquizzes.php', answerForm).then(response => response.json()).then(function(data) {
                quizSelect.innerHTML = "<option id='' value=''>--Choose Quiz--</option>";
                for (let quiz = 0; quiz < data.length; quiz++) {
                    var option = document.createElement('option');
                    option.value = data[quiz].quizId;
                    option.textContent = data[quiz].quizName;
                    quizSelect.insertAdjacentElement('beforeend', option)
                }
            })
        }

        document.querySelector('.addQuiz').onclick = () => document.querySelector('.form__add__quiz').classList.add('active');
        document.querySelector('.close__form').onclick = () => document.querySelector('.form__add__quiz').classList.remove('active');

        document.querySelector('.form__add__quiz button[type="submit"]').onclick = function(e) {
            e.preventDefault();
            let quizInformationForm = new FormData(document.querySelector('.newquizbox'));
            fetchData('./functions/addquiz.php', quizInformationForm).then(res => res.text()).then((data) => {
                if (data == 'Added') {
                    errorMassege('Added', "green");
                } else {
                    errorMassege(data, "red");
                }
            });
        }

        let answersArray = [];

        function saved() {
            answersArray.push(answer.value.trim());
            errorMassege('Saved', "green");
            getAnswers(answersArray);
        }

        function getAnswers(arr) {
            var element = document.querySelector('.ansers');
            if (arr.length == 0) {
                element.innerHTML = '';
            } else {
                let elements = '';
                for (let index = 0; index < arr.length; index++) {
                    elements += `<span>- ${arr[index]} <span class='deleteThisSubjects' id='${index}' onclick='deleteThisAnswer(this.id)'><i class='fa-solid fa-times'></i></span></span>`;
                }
                element.innerHTML = elements;
            }
        }

        saveAnswer.onclick = () => {
            answer.value != '' ? saved() : errorMassege('Please insert an answer', "red");
        }

        function deleteThisAnswer(id) {
            answersArray.splice(id, 1);
            getAnswers(answersArray);
        }

        document.querySelector('.add_question button[type="submit"]').onclick = function(e) {
            e.preventDefault();
            if (answersArray.length != 0) {
                if (document.querySelector('input[name="correct__answer"]').value != '') {
                    var questions = new FormData(document.querySelector('.add_question'));
                    questions.append("answers", JSON.stringify(answersArray));
                    fetchData('./functions/addquestion.php', questions).then(res => res.text()).then((data) => {
                        if (data == 'Added') {
                            answersArray = [];
                            getAnswers(answersArray);
                        }
                    });
                } else {
                    errorMassege("please enter correct answer", "red");
                }
            } else {
                errorMassege('Please insert answers', "red")
            }

        }
    </script>
</body>

</html>