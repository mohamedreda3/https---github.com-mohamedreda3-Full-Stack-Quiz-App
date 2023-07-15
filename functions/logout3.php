<?php
session_start();
unset($_SESSION['teacher_email']);
header('location:../teacherlogin.php',true);
?>