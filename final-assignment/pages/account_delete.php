<?php
$user = $_REQUEST['username'];

include_once 'db/db.php';

$sql = "DELETE FROM `account` WHERE `username` = '$user'";
if ($conn->query($sql) === TRUE) {
    echo "Add successfully <script>history.go(-1);</script>";
} else {
    echo "Error record: " . $conn->error;
}
$conn->close();
