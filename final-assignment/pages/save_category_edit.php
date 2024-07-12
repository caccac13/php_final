<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catId = $_POST['categoryid'];
    $catName =  $_POST['categoryname'];
    $catDes = $_POST['description'];
    echo $catId;
    // echo $catDes;

    include_once '../db/db.php';
    $sql = "UPDATE `category` SET `categoryname`='" . $catName . "',`description`='" . $catDes . "' WHERE `categoryid` = " . $catId . "";
    // echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully <script>history.go(-2);</script>";
        
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
