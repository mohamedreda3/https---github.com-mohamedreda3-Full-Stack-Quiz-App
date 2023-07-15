<?php
include_once('../config/config.php');
if(!empty($_POST['id'])){
$email = $_POST['id'];
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM teachers WHERE email = '$email'")) > 0) {
    echo json_encode(mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM teachers WHERE email = '$email'")));
} else {
    echo 'Email or password is ' . 'wrong';
}
}