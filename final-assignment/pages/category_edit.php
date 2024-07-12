<?php
$catId = $_REQUEST['id'];
include 'db/db.php';
$sql = "SELECT * FROM `category` WHERE `categoryid` = '$catId'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
?>

        <h2>Edit category</h2>
        <form method="post" action="pages/save_category_edit.php">
            <label style="width:150px" for="categoryid">Id:</label>
            <input type="text" name="categoryid" value="<?php echo $catId ?>" required readonly><br><br>
            <label style="width:150px" for="categoryname">Category name:</label>
            <input type="text" name="categoryname" value="<?php echo $row['categoryname'] ?>" required><br><br>
            <label style="width:150px" for="description">Description:</label>
            <input type="text" name="description" value="<?php echo  $row['description'] ?>" required><br><br>
            <input type="submit" value="Ok">
        </form>
<?php

    }
} else {
    echo "0 results";
}
?>