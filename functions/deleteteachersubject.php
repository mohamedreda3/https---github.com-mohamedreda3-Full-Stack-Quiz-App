<?php
include_once('../config/config.php');
include('../functions/insertFunction.php');
if (!empty($_POST['id']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $id = $_POST['id'];
    deleteFunction($conn, 'subject_teacher', "(email = '$email' AND subjectid = '$id')");
}
