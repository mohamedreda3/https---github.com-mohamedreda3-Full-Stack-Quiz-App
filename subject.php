<?php
include_once('./config/config.php');
session_start();
if (!empty($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $getUserName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'"))['username'];
} else {
    header('location:adminlogin.php', true);
}
$title = 'Admin --subject--';
$getsubject = mysqli_query($conn, "SELECT * FROM subjects");
?>

<!DOCTYPE html>

<head>
    <title> <?php echo $title; ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./admin_assets/style.css">
    <link rel="stylesheet" href="./admin_assets/forms.css">
</head>

<body>
    <?php include('./layouts/adminnavber.php'); ?>
    <?php include('./layouts/errorbar.php'); ?>
    <span class="btn addTeacher third">Add subject</span>
    <div class="form__container">
        <div class="content" style="width: 300px; min-height:150px">
            <h1 class="form-title"><span> Add subject </span> <span class="close__form">close</span></h1>
            <form style="padding: 0 10px; text-align:center;">
                <input type="text" name="subject__title" placeholder="Subject title" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <div class="form__container edit__subject">
        <div class="content" style="width: 300px; min-height:150px">
            <h1 class="form-title"><span> Edit Subject </span> <span class="close__form">close</span></h1>
            <form style="padding: 0 10px; text-align:center;">
                <input type="text" name="name" placeholder="NAME" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <div class="div__container">
        <!-- https://www.linktolibraries.org/application/files/4315/5257/2195/books-icon.png -->
        <?php
        while ($subjectRow = mysqli_fetch_assoc($getsubject)) {
            $subjectName = $subjectRow['subjectName'];
            $subjectId = $subjectRow['subjectId'];

            echo "<div class='account__container'> <img src='https://www.linktolibraries.org/application/files/4315/5257/2195/books-icon.png' alt='$subjectName'/>
            <p>$subjectName</p>";

            echo "<div class='btns'><button class='edit' id='$subjectId' style='--i:1' onclick='editSubject(this.id,`getsubject.php`,`editsubject.php`)'>editsubject</button><button class='delete' id='$subjectId' style='--i:2' onclick='deleteAcc(this.id,`deletesubject.php`)'>deletesubject</button></div></div>";
        }

        ?>
    </div>
    <?php include('./layouts/scripts.php'); ?>
    <script>
        document.querySelector('.addTeacher').onclick = () => document.querySelector('.form__container').classList.add('active');
        document.querySelector('.close__form').onclick = () => document.querySelector('.form__container').classList.remove('active');
        document.querySelector('form').onsubmit = (e) => {
            e.preventDefault();
            var detailsForm = new FormData(document.querySelector('form'));
            fetchData('./functions/addsubject.php', detailsForm).then(res => res.text()).then(data => {
                if (data != 'Added') {
                    errorMassege(data, 'red');
                } else {
                    errorMassege('Added', 'green');
                    location.reload();
                }
            })
        }

        function editSubject(accId, file, file2) {
            document.querySelector('.form__container.edit__subject').classList.add('active');
            document.querySelector('.form__container.edit__subject .close__form').onclick = () => document.querySelector('.form__container.edit__subject').classList.remove('active');
            var idForm = new FormData();
            idForm.append('id', accId);
            fetchData(`./functions/${file}`, idForm).then(res => res.json()).then(data => {
                document.querySelector('.form__container.edit__subject form input[name=name]').value = data.subjectName;
            })
            document.querySelector('.form__container.edit__subject form').onsubmit = (e) => {
                e.preventDefault();
                var detailsForm = new FormData(document.querySelector('.form__container.edit__subject form'));
                detailsForm.append('id', accId);
                fetchData(`./functions/${file2}`, detailsForm).then(res => res.text()).then(data => {
                    if (data != 'Added') {
                        errorMassege(data, 'red');
                    } else {
                        errorMassege('Added', 'green');
                        location.reload();
                    }
                })
            }
        }
    </script>
</body>

</html>