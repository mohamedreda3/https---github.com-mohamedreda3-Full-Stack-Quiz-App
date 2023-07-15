<?php
include_once('../config/config.php');
include('../functions/insertFunction.php');
if (!empty($_POST['number']) && !empty($_POST['gender']) && !empty($_POST['id']) && !empty($_POST['address'] && !empty($_POST['name']))) {
    $address = $_POST['address'];
    $number = $_POST['number'];
    $gender = $_POST['gender'];
    $email = $_POST['id'];
    $name = $_POST['name'];
    editFunction($conn, 'studentteacherpanel', "email = '$email'", "email = '$email', username = '$name', phonenumber = '$number', address = '$address', gender = '$gender'");
}
