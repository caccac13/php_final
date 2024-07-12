<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['categoryname'];
    $catDes = $_POST['description'];

    include_once 'db/db.php';

    $sql = "INSERT INTO `category`(`categoryname`, `description`) VALUES ('" . $catName . "','" . $catDes . "')";
    // echo $sql;

    if ($conn->query($sql) === TRUE) {
        echo "Add successfully <script>history.go(-1);</script>";
    } else {
        echo "Error record: " . $conn->error;
    }

    $conn->close();
}
