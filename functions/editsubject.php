<?php
include_once('../config/config.php');
include('../functions/insertFunction.php');
if (!empty($_POST['id']) && !empty($_POST['name'])) {
    $subjectId = $_POST['id'];
    $subjectName = $_POST['name'];
    editFunction($conn, 'subjects', "subjectId = '$subjectId'", "subjectName = '$subjectName'");
}
