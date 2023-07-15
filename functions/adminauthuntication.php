<?php
include_once('../config/config.php');
if (!empty($_POST['email'] && !empty($_POST['password']))) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $selectAdminAccount = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email' AND password = '$password'");
    if (mysqli_num_rows($selectAdminAccount) > 0) {
        echo 'Added';
        session_start();
        session_encode();
        $_SESSION['email'] = $email;
    } else {
        echo 'Email or password is wrong';
    }
}
