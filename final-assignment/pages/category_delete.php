<?php
$catId = $_REQUEST['id'];
echo $catId;

include_once 'db/db.php';

$sql = "DELETE FROM `category` WHERE `categoryid` = $catId";
if ($conn->query($sql) === TRUE) {
    echo "Add successfully <script>history.go(-2);</script>";
} else {
    echo "Error record: " . $conn->error;
}
$conn->close();
