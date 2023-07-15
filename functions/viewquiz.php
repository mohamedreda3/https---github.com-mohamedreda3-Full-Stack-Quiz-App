<?php
include_once('../config/config.php');
if (!empty($_POST['id'])) {
    session_start();
    $_SESSION['subjectId'] = $_POST['id'];
    echo true;
}