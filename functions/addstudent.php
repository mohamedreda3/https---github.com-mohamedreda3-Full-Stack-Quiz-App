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
    $techEmail = $_POST['techemail'];
    if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM studentteacherpanel WHERE email = '$email'"))){
        echo 'This email exist';
    }else{
        insertToDatabase($conn, 'studentteacherpanel', 'email, password, username, phonenumber, address, gender, teacheremail' , "'$email', '$password', '$name', '$number', '$address', '$gender', '$techEmail'", "(email = '$email' AND password = '$password')", 'The student');
    }
}
?>