<?php
include_once('../config/config.php');
include('../functions/insertFunction.php');
if (!empty($_POST['id'])) {
    $subjectId = $_POST['id'];
    deleteFunction($conn, 'subjects', "(subjectId = '$subjectId')");
}
