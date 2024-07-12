<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // echo '<pre>';
    // print_r($_GET);
    $itemid = $_GET['itemid'];
    $itemname = $_GET['itemname'];
    $description = $_GET['description'];
    $unit = $_GET['unit'];
    $price = $_GET['price'];
    $img = $_GET['fileUpload'];
    $status_default = 1;
    $categoryid = $_GET['category'];


    include_once '../db/db.php';
    $sql = "UPDATE `item` SET `itemname`='{$itemname}',`description`='{$description}',`unit`='{$unit}',`price`='{$price}',`image`='{$img}',`status`='{$status_default}',`categoryid`='$categoryid' WHERE `itemid` = {$itemid}";
    
    //  echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "New record update successfully ";
        header('location: ../?page=item');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}