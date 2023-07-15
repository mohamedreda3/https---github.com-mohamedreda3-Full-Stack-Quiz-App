<?php
include_once('./config/config.php');
session_start();
$email = '';
$getUserName = '';
if (!empty($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $getUserName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'"))['username'];
} else {
    header('location:adminlogin.php', true);
}
$title = 'Admin';
?>

<!DOCTYPE html>

<head>
    <title> <?php echo $title; ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./admin_assets/style.css">
</head>

<body>
    <?php include('./layouts/adminnavber.php'); ?>
    <?php include('./layouts/scripts.php'); ?>
</body>

</html>