<?php
$user= $_REQUEST['username'];
$pass = $_REQUEST['password'];
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$roleid = $_REQUEST['roleid'];

include '../db/db.php';

$sql = "INSERT INTO `account`(`username`, `password`, `name`, `email`, `phone`, `roleid`) 
VALUES ('".$user."','".$pass."','".$name."','".$email."','".$phone."','".$roleid."')";

if ($conn->query($sql) === TRUE) {
    echo "Add successfully <script>history.go(-2);</script>";
} else {
    echo "Error record: " . $conn->error;
}

$conn->close();