<?php
include_once('../config/config.php');
include('../functions/insertFunction.php');
if (!empty($_POST['id'])) {
    $email = $_POST['id'];
    deleteFunction($conn, 'studentteacherpanel', "(email = '$email')");
}
