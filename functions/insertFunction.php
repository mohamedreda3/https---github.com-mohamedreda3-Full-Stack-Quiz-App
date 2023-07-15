<?php
include_once('../config/config.php');
function insertToDatabase($conn, $tableName, $tableNameAttributes, $values, $checkValue, $errorExist)
{
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $tableName WHERE $checkValue")) > 0) {
        echo $errorExist . ' exisits';
    } else {
        if (mysqli_query($conn, "INSERT INTO $tableName($tableNameAttributes) VALUES($values)")) {
            echo 'Added';
        } else {
            echo mysqli_error($conn);
        }
    }
}


function loginToAccount($conn, $tableName, $checkValue, $errorExist)
{
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $tableName WHERE $checkValue")) > 0) {
        echo 'Added';
    } else {
        echo 'Email or password is ' . 'wrong';
    }
}

function editFunction($conn, $tableName, $checkValue, $updates)
{
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $tableName WHERE $checkValue")) > 0) {
        if (mysqli_query($conn, "UPDATE $tableName SET $updates WHERE $checkValue")) {
            echo 'Added';
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo mysqli_error($conn);
    }
}


function deleteFunction($conn, $tableName, $checkValue)
{
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $tableName WHERE $checkValue")) > 0) {
        if (mysqli_query($conn, "DELETE FROM $tableName WHERE $checkValue")) {
            echo 'Added';
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo mysqli_error($conn);
    }
}