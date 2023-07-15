<?php
include_once('../config/config.php');
include('../functions/insertFunction.php');
if (!empty($_POST['number']) && !empty($_POST['password']) && !empty($_POST['gender']) && !empty($_POST['email']) && !empty($_POST['address'] && !empty($_POST['name']))) {
    $address = $_POST['address'];
    $number = $_POST['number'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    insertToDatabase($conn, 'teachers', 'email, password, username, phonenumber, address, gender', "'$email', '$password', '$name', '$number', '$address', '$gender'", "(email = '$email' AND password = '$email')", 'The teacher');
}
