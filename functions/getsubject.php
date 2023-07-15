<?php
include_once('../config/config.php');
if(!empty($_POST['id'])){
$id = $_POST['id'];
if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM subjects WHERE subjectId = '$id'")) > 0) {
    echo json_encode(mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM subjects WHERE subjectId = '$id'")));
} 
}