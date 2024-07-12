<?php
$usern = $_REQUEST['id'];
include 'db/db.php';
$sql = "SELECT * FROM `account` WHERE `username` = '$usern'";
// echo $sql;
$result = $conn->query($sql);   
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
?>

        <h2>Edit account</h2>
        <form method="post" action="pages/save_account_edit.php">
            <label style="width:150px" for="usern">Username:</label>
            <input type="text" name="usern" value="<?php echo $usern ?>" required readonly><br><br>
            <label style="width:150px" for="password">Password:</label>
            <input type="text" name="password" value="<?php echo $row['password'] ?>" required><br><br>
            <label style="width:150px" for="name">Name:</label>
            <input type="text" name="name" value="<?php echo  $row['name'] ?>" required><br><br>
            <label style="width:150px" for="email">Email:</label>
            <input type="email" name="email" value="<?php echo  $row['email'] ?>" required><br><br>
            <label style="width:150px" for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo  $row['phone'] ?>" required><br><br>
            <label style="width:150px" for="roleid">Mô tả:</label>
            <input type="text" name="roleid" value="<?php echo  $row['roleid'] ?>" required><br><br>
            <input type="submit" value="Ok">
        </form><?php

            }
        } else {
            echo "0 results";
        }
