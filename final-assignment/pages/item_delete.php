<?php
$itemid = $_REQUEST['id'];
// echo $itemid;

include_once 'db/db.php';

$sql = "DELETE FROM `item` WHERE `itemid` = $itemid";
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    echo '<script>history.go(-2)</script>';
} else {
    echo "Error deleting record: " . $conn->error;
}
