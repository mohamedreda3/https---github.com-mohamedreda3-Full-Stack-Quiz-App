<?php
include_once('./config/config.php');
session_start();
if (!empty($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $getUserName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'"))['username'];
} else {
    header('location:adminlogin.php', true);
}
$title = 'Admin --teacher--';
$getTeachers = mysqli_query($conn, "SELECT * FROM teachers");
$getTeacher = mysqli_query($conn, "SELECT * FROM teachers");
?>

<!DOCTYPE html>

<head>
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="./assets/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./admin_assets/style.css">
    <link rel="stylesheet" href="./admin_assets/forms.css">
</head>

<body>
    <?php include('./layouts/adminnavber.php'); ?>
    <?php include('./layouts/errorbar.php'); ?>

    <span class="btn addTeacher third">Add Teacher</span>
    <span class="btn assignSubject third">Assign Subject</span>
    <div class="form__container addteacher">
        <div class="content">
            <h1 class="form-title"><span> Add Teacher </span> <span class="close__form">close</span></h1>
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
            <h1 class="form-title"><span> Assign Subject To Teacher </span> <span class="close__form">close</span></h1>
            <form>
                <select name="teacher" value="">
                    <?php
                    while ($teacherRow = mysqli_fetch_assoc($getTeachers)) {
                        $teacherName = $teacherRow['username'];
                        $teacherEmail = $teacherRow['email'];
                        echo "<option value='$teacherEmail'>$teacherName</option>";
                    }
                    ?>
                </select>
                <div>
                    <select name="subject" value="">
                        <?php
                        $getsubjects = mysqli_query($conn, "SELECT * FROM subjects");
                        while ($subjectRow = mysqli_fetch_assoc($getsubjects)) {
                            $subjectName = $subjectRow['subjectName'];
                            $subjectId = $subjectRow['subjectId'];
                            echo "<option value='$subjectId'>$subjectName</option>";
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
            <h1 class="form-title"><span> Edit Teacher </span> <span class="close__form">close</span></h1>
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
        while ($teacherRow = mysqli_fetch_assoc($getTeacher)) {
            $teacherName = $teacherRow['username'];
            $teacherEmail = $teacherRow['email'];
            $phonenumber = $teacherRow['phonenumber'];
            $gender = $teacherRow['gender'];
            $address = $teacherRow['address'];
            echo "<div class='account__container'>
            <img src='https://www.dlf.pt/dfpng/middlepng/481-4816679_user-login-png-gambar-icon-user-png-transparent.png' alt='$teacherName'/>
            <p>$teacherName</p>
            <p>$teacherEmail</p>
            <p>$address</p>
            <p>$gender</p>
            <p>$phonenumber</p>";
            $getAssignedSubjects = mysqli_query($conn, "SELECT * FROM subject_teacher WHERE email = '$teacherEmail'");
            echo "<div class='subjects'>";
            while ($getTeacherSubjects = mysqli_fetch_assoc($getAssignedSubjects)) {
                $subjectId = $getTeacherSubjects['subjectid'];
                $nameOfSubject = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM subjects WHERE subjectId = '$subjectId'"))['subjectName'];
                echo "<span>- $nameOfSubject <span class='deleteThisSubjects' id='$subjectId' data-email='$teacherEmail' onclick='deleteSubjectfromTeacher(this.id, this.getAttribute(`data-email`), `deleteteachersubject.php`);'><i class='fa-solid fa-times'></i></span></span>";
            }
            echo "</div>";
            echo "<div class='btns'><button class='edit' id='$teacherEmail' style='--i:1' onclick='editAcc(this.id,`getteacher.php`,`editteacher.php`)'>editTeacher</button><button class='delete' id='$teacherEmail' style='--i:2' onclick='deleteAcc(this.id,`deleteteacher.php`)'>deleteTeacher</button></div></div>";
        }

        ?>
    </div>
    <?php include('./layouts/scripts.php'); ?>
    <script>
        document.querySelector('.addTeacher').onclick = () => document.querySelector('.form__container.addteacher').classList.add('active');
        document.querySelector('.addteacher .close__form').onclick = () => document.querySelector('.form__container.addteacher').classList.remove('active');

        document.querySelector('.assignSubject').onclick = () => document.querySelector('.form__container.addsubject').classList.add('active');
        document.querySelector('.addsubject .close__form').onclick = () => document.querySelector('.form__container.addsubject').classList.remove('active');

        document.querySelector('.addteacher form').onsubmit = (e) => {
            e.preventDefault();
            var detailsForm = new FormData(document.querySelector('.addteacher form'));
            fetchData('./functions/addteacher.php', detailsForm).then(res => res.text()).then(data => {
                if (data != 'Added') {
                    errorMassege(data, 'red');
                } else {
                    errorMassege('Added', 'green');
                    location.reload();
                }
            })
        }

        document.querySelector('.addsubject form').onsubmit = (e) => {
            e.preventDefault();
            const detailsForm = new FormData(document.querySelector('.addsubject form'));
            fetchData('./functions/assignsubjecttoteacher.php', detailsForm).then(res => res.text()).then(data => {
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