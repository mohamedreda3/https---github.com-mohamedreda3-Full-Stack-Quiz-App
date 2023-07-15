<?php
include_once('../config/config.php');
include('../functions/insertFunction.php');
if (!empty($_POST['student']) && !empty($_POST['subject'])) {
    $student = $_POST['student'];
    $subject = $_POST['subject'];
    insertToDatabase($conn, 'subject_student', 'email, subjectid', "'$student', '$subject'", "(subjectid  = '$subject' AND email  = '$student')", 'The Subjects');
}
