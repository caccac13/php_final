<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = $_REQUEST['username'];
    $pass = $_REQUEST['password'];
    echo $user;
    echo $pass;

    include '../db/db.php';

    $sql = "SELECT * FROM `account` WHERE `username` = '$user' and `password` = '$pass'";
    // echo $sql;  
    $result = $conn->query($sql);
    // echo $result;
    if (!$result) {
        die("Server đang lỗi, vui lòng thử lại sau ít phút!" . $conn->error); 
    }
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            session_start();
            $_SESSION['username'] = $row['username'];

            // echo $row['username'].'<br>';
            // echo $row['password'].'<br>';
        }
        header('location: ../index.php');
    } else {
        echo '<script>alert("Username hoặc mật khẩu không đúng");history.go(-1);</script>';
    }
    $conn->close();

}