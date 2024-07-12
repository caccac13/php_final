<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // echo '<pre>';
    // print_r($_GET);
    $itemname = $_GET['itemname'];
    $description = $_GET['description'];
    $unit = $_GET['unit'];
    $price = $_GET['price'];
    $img = $_GET['fileUpload'];
    $status_default = 1;
    $categoryid = $_GET['category'];


    include_once '../db/db.php';
    $sql = "INSERT INTO `item`(`itemname`, `description`, `unit`, `price`, `image`, `status`, `categoryid`) 
    VALUES ('" . $itemname . "','" . $description . "','" . $unit . "','" . $price . "','" . $img . "','" . $status_default . "','" . $categoryid . "')";
    // echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully ";
        header('location: ../?page=item');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
