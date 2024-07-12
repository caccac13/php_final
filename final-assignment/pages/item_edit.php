<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>";
    $itemid = $_POST['itemid'];
    $error = array();

    if (empty($_POST['itemname'])) {
        $error['itemname'] = 'Please enter itemname';
    } else {
        $itemname = $_POST['itemname'];
    }

    if (empty($_POST['description'])) {
        $error['description'] = 'Please enter description';
    } else {
        $description = $_POST['description'];
    }

    if (empty($_POST['unit'])) {
        $error['unit'] = 'Please enter unit';
    } else {
        $unit = $_POST['unit'];
    }

    if (empty($_POST['price'])) {
        $error['price'] = 'Please enter price';
    } else {
        $price = $_POST['price'];
    }

    if (empty($_POST['category'])) {
        $error['category'] = 'Please select category';
    } else {
        $category = $_POST['category'];
    }

    $target_dir = "img/";
    // tao duong dan file sau khi upload
    $target_file = $target_dir . basename($_FILES['fileUpload']['name']);
    // echo $target_file;
    if (empty($_FILES['fileUpload']['full_path'])) {
        $error['fileUpload'] = 'Please select the image';
    }

    if ($_FILES['fileUpload']['size'] > 5242880) {
        $error['fileUpload'] = 'Invalid';
    }

    //ktra loai file(png, jpg, jpeg, gif)
    $file_type = pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION);
    $file_type_allow = array('png', 'jpg', 'jpeg', 'gif');

    if (!in_array(strtolower($file_type), $file_type_allow)) {
        $error['fileUpload'] = 'File is invalid';
    }

    //ktra file da ton tai tren he thong 
    if (file_exists($target_file)) {
        $fileUpload = $_FILES['fileUpload'];
    }

    //ktra va chuyen file tu bo nho tam len server
    if (empty($error['fileUpload'])) {
        if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target_file)) {
            // echo 'Uploaded successfully';
            $fileUpload = basename($_FILES['fileUpload']['name']);
            $flag = true; 
        } else {
            echo 'Upload failed';
        }
    }
    if (empty($error)) {
        echo "<script>
            window.location.href = 'pages/save_item_edit.php?itemid={$itemid}&itemname={$itemname}&description={$description}&unit={$unit}&price={$price}&fileUpload={$fileUpload}&category={$category}';
        </script>";
    }
}


$itemid = $_REQUEST['id'];
include_once 'db/db.php';
$sql = "SELECT * FROM `item` WHERE `itemid` = $itemid";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
?>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="itemid">Item id:</label><br>
            <input type="text" name="itemid" id="itemid" value="<?php echo $row['itemid']; ?>" readonly>
            <br>

            <label for="itemname">Item name:</label><br>
            <textarea name="itemname" id="itemname"><?php echo $row['itemname']; ?></textarea><br>
            <?php
            if (isset($error['itemname'])) {
                echo '<span style="color: red;">' . $error['itemname'] . '</span>';
            }
            ?><br>

            <label for="description">Description:</label><br>
            <textarea name="description" id="description" rows="4"><?php echo $row['description']; ?></textarea><br>
            <br>

            <label for="unit">Unit:</label><br>
            <input type="text" name="unit" id="unit" value="<?php echo $row['unit']; ?>"><br>
            <br>

            <label for="price">Price:</label><br>
            <input type="text" name="price" id="price" value="<?php echo $row['price']; ?>"><br>
            <br>

            <label for="fileUpload">Image:</label><br>
            <input type="file" name="fileUpload" id="fileUpload" value="<?php echo $row['image']; ?>"><br>
            <?php
            if (isset($error['fileUpload'])) {
                echo '<span style="color: red;">' . $error['fileUpload'] . '</span><br>';
            }
            ?><br>

            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="">-- select --</option>
                <?php
                include_once '../db/db.php';
                $sql = 'SELECT * FROM `category`';
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <option value=" . $row['categoryid'] . ">{$row['categoryname']}</option>
                        ";
                    }
                } else {
                    echo "0 results";
                }
                ?>

            </select><br>
            <?php
            if (isset($error['category'])) {
                echo '<span style="color: red;">' . $error['category'] . '</span>';
            }
            ?><br>
            <input style="margin-bottom: 40px;" type="submit" value="Ok">
        </form>

<?php

    }
} else {
    echo "0 results";
}
$conn->close();
?><style>
    textarea {
        width: 500px;
        resize: none;
    }

    input {
        width: 500px;

    }
</style>