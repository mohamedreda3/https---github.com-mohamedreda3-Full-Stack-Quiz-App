<?php
include_once('../config/config.php');
include('../functions/insertFunction.php');
if (!empty($_POST['subject__title'])) {
    $subjectTitle = $_POST['subject__title'];
    insertToDatabase($conn, 'subjects', 'subjectName' , "'$subjectTitle'", "(subjectName  = '$subjectTitle')", 'The Subjects');
}
?>