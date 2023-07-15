<?php
include_once('../config/config.php');
session_start();
if (!empty($_POST['email'] && !empty($_POST['password']))) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $selectAdminAccount = mysqli_query($conn, "SELECT * FROM teachers WHERE email = '$email' AND password = '$password'");
   
    if (mysqli_num_rows($selectAdminAccount) > 0) {
        echo 'Added';
        $_SESSION['teacher__email'] = $email;
    } else {
        echo 'Email or password is wrong';
    }
}
