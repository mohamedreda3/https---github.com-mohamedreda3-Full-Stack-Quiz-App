<?php
include_once('./config/config.php');
$teacher__email = '';
$getUserName = '';
session_start();
if (!empty($_SESSION['teacher__email'])) {
    $teacher__email = $_SESSION['teacher__email'];
    $getUserName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM teachers WHERE email = '$teacher__email'"))['username'];
} else {
    header('location:teacherlogin.php', true);
}
$title = 'Admin --student--';
$getstudents = mysqli_query($conn, "SELECT * FROM studentteacherpanel WHERE teacheremail = '$teacher__email'");
$getstudent = mysqli_query($conn, "SELECT * FROM studentteacherpanel WHERE teacheremail = '$teacher__email'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <link rel="stylesheet" href="./admin_assets/style.css">
    <link rel="stylesheet" href="./admin_assets/forms.css">
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
        <?php include('./layouts/errorbar.php'); ?>

        <span class="btn addstudent third">Add Student</span>
        <span class="btn assignSubject third">Assign Subject</span>
        <div class="form__container">
            <div class="content">
                <h1 class="form-title"><span> Add Student </span> <span class="close__form">close</span></h1>

                <form>
                    <input type="text" placeholder="NAME" name="name" required>
                    <div class="beside">
                        <input type="number" name="number" placeholder="PHONE NUMBER" required>
                        <select name="gender" value="">
                            <option value="Male">MALE</option>
                            <option value="Female">FEMALE</option>
                        </select><br />
                    </div>
                    <input type="text" name="address" placeholder="ADDRESS" required>
                    <input type="email" name="email" placeholder="EMAIL ADDRESS" required>
                    <input type="password" name="password" placeholder="PASSWORD" required>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
        <div class="form__container addsubject">
            <div class="content">
                <h1 class="form-title"><span> Assign Subject To student </span> <span class="close__form">close</span></h1>
                <form>
                    <select name="student" value="">
                        <?php
                        while ($studentRow = mysqli_fetch_assoc($getstudents)) {
                            $studentName = $studentRow['username'];
                            $studentEmail = $studentRow['email'];
                            echo "<option value='$studentEmail'>$studentName</option>";
                        }
                        ?>
                    </select>
                    <div>

                        <select name="subject" value="">
                            <?php
                            $getId = mysqli_query($conn, "SELECT * FROM subject_teacher WHERE email = '$teacher__email'");
                            while ($getsubjectd = mysqli_fetch_assoc($getId)) {
                                $getsubjectid = $getsubjectd['subjectid'];
                                $getsubjects = mysqli_query($conn, "SELECT * FROM subjects WHERE subjectId = '$getsubjectid'");
                                while ($subjectRow = mysqli_fetch_assoc($getsubjects)) {
                                    $subjectName = $subjectRow['subjectName'];
                                    $subjectId = $subjectRow['subjectId'];
                                    echo "<option value='$subjectId'>$subjectName</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
        <div class="form__container edit">
            <div class="content">
                <h1 class="form-title"><span> Edit student </span> <span class="close__form">close</span></h1>
                <form>
                    <input type="text" name="address" placeholder="ADDRESS" required>
                    <input type="text" name="name" placeholder="NAME" required>
                    <div class="beside">
                        <input type="number" name="number" placeholder="PHONE NUMBER" required>
                        <select name="gender" value="">
                            <option value="Male">MALE</option>
                            <option value="Female">FEMALE</option>
                        </select><br />
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
        <div class="div__container">
            <?php
            while ($studentRow = mysqli_fetch_assoc($getstudent)) {
                $studentName = $studentRow['username'];
                $studentEmail = $studentRow['email'];
                $phonenumber = $studentRow['phonenumber'];
                $gender = $studentRow['gender'];
                $address = $studentRow['address'];
                echo "<div class='account__container'>
            <img src='https://www.dlf.pt/dfpng/middlepng/481-4816679_user-login-png-gambar-icon-user-png-transparent.png' alt='$studentName'/>
            <p>$studentName</p>
            <p>$studentEmail</p>
            <p>$address</p>
            <p>$gender</p>
            <p>$phonenumber</p>";
                $getAssignedSubjects = mysqli_query($conn, "SELECT * FROM subject_student WHERE email = '$studentEmail'");
                echo "<div class='subjects'>";
                while ($getstudentSubjects = mysqli_fetch_assoc($getAssignedSubjects)) {
                    $subjectId = $getstudentSubjects['subjectid'];
                    $nameOfSubject = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM subjects WHERE subjectId = '$subjectId'"))['subjectName'];
                    echo "<span>- $nameOfSubject <span class='deleteThisSubjects' id='$subjectId' data-email='$studentEmail' onclick='deleteSubjectfromTeacher(this.id, this.getAttribute(`data-email`), `deletestudentsubject.php`)'><i class='fa-solid fa-times'></i></span></span>";
                }
                echo "</div>";
                echo "<div class='btns'><button class='edit' id='$studentEmail' style='--i:1' onclick='editAcc(this.id,`getstudent.php`,`editstudent.php`)'>editstudent</button><button class='delete' id='$studentEmail' style='--i:2' onclick='deleteAcc(this.id,`deletestudent.php`)'>deletestudent</button></div></div>";
            }

            ?>
        </div>
        <?php include('./layouts/scripts.php'); ?>
        <script>
            document.querySelector('.addstudent').onclick = () => document.querySelector('.form__container').classList.add(
                'active');
            document.querySelector('.close__form').onclick = () => document.querySelector('.form__container').classList.remove(
                'active');
            document.querySelector('form').onsubmit = (e) => {
                e.preventDefault();
                var detailsForm = new FormData(document.querySelector('form'));
                detailsForm.append('techemail', "<?php echo $teacher__email; ?>")
                fetchData('./functions/addstudent.php', detailsForm).then(res => res.text()).then(data => {
                    if (data != 'Added') {
                        errorMassege(data, 'red');
                    } else {
                        errorMassege('Added', 'green');
                        location.reload();
                    }
                })
            }

            document.querySelector('.assignSubject').onclick = () => document.querySelector('.form__container.addsubject')
                .classList.add('active');
            document.querySelector('.addsubject .close__form').onclick = () => document.querySelector(
                '.form__container.addsubject').classList.remove('active');

            document.querySelector('.addsubject form').onsubmit = (e) => {
                e.preventDefault();
                const detailsForm = new FormData(document.querySelector('.addsubject form'));
                fetchData('./functions/assignsubjecttostudent.php', detailsForm).then(res => res.text()).then(data => {
                    if (data != 'Added') {
                        errorMassege(data, 'red');
                    } else {
                        errorMassege('Added', 'green');
                        location.reload();
                    }
                })
            }
        </script>
</body>

</html>