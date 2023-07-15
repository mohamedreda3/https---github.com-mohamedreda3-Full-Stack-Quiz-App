<?php
session_start();
unset($_SESSION['student_email']);
header('location:../studentlogin.php',true);
?>