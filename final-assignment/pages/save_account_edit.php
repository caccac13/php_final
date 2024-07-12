<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usern = $_POST['usern'];
    $pass = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $roleid = $_POST['roleid'];

    include_once '../db/db.php';
    $sql = "UPDATE `account` SET `password`='" . $pass . "',`name`='" . $name . "',`email`='" . $email . "',`phone`='" . $phone . "',`roleid`='" . $roleid . "' WHERE `username` = '" . $usern . "'";
    // echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully <script>history.go(-2);</script>";

    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
