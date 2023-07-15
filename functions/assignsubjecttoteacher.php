<?php
include_once('../config/config.php');
include('../functions/insertFunction.php');
if (!empty($_POST['teacher']) && !empty($_POST['subject'])) {
    $teacher = $_POST['teacher'];
    $subject = $_POST['subject'];
    insertToDatabase($conn, 'subject_teacher', 'email, subjectid', "'$teacher', '$subject'", "(subjectid  = '$subject' AND email  = '$teacher')", 'The Subjects');
}
