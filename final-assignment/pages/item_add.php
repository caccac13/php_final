<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<pre>";
    // print_r($_FILES);
    echo "</pre>";
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
    if (empty($_FILES['fileUpload'])) {
        $error['fileUpload'] = 'Please select the image';
    }

    if ($_FILES['fileUpload']['size'] > 5242880) {
        $error['fileUpload'] = 'Only files under 5mb in size are allowed';
    }

    //ktra loai file(png, jpg, jpeg, gif)
    $file_type = pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION);
    $file_type_allow = array('png', 'jpg', 'jpeg', 'gif');

    if (!in_array(strtolower($file_type), $file_type_allow)) {
        $error['fileUpload'] = 'Only png, jpg, jpeg, gif files are allowed';
    }

    //ktra file da ton tai tren he thong 
    if (file_exists($target_file)) {
        $fileUpload = $_FILES['fileUpload'];
    }

    //ktra va chuyen file tu bo nho tam len server
    if (empty($error['fileUpload'])) {
        if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target_file)) {
            echo 'Uploaded successfully';
            $fileUpload = basename($_FILES['fileUpload']['name']);
            $flag = true;
        } else {
            echo 'Upload failed';
        }
    }

    if (empty($error)) {
        echo "<script>
            window.location.href = 'pages/save_item_add.php?itemname={$itemname}&description={$description}&unit={$unit}&price={$price}&fileUpload={$fileUpload}&category={$category}';
        </script>";
    }
}
?>


<style>
    textarea {
        width: 500px;
        resize: none;
    }

    input {
        width: 500px;

    }
</style>
<form action="" method="post" enctype="multipart/form-data">
    <label for="itemname">Item name:</label><br>
    <textarea name="itemname" id="itemname"></textarea><br>
    <?php
    if (isset($error['itemname'])) {
        echo '<span style="color: red;">' . $error['itemname'] . '</span>';
    }
    ?><br>

    <label for="description">Description:</label><br>
    <textarea name="description" id="description"></textarea><br>
    <?php
    if (isset($error['description'])) {
        echo '<span style="color: red;">' . $error['description'] . '</span>';
    }
    ?><br>

    <label for="unit">Unit:</label><br>
    <input type="text" name="unit" id="unit"><br>
    <?php
    if (isset($error['unit'])) {
        echo '<span style="color: red;">' . $error['unit'] . '</span>';
    }
    ?><br>

    <label for="price">Price:</label><br>
    <input type="text" name="price" id="price"><br>
    <?php
    if (isset($error['price'])) {
        echo '<span style="color: red;">' . $error['price'] . '</span>';
    }
    ?><br>

    <label for="fileUpload">Image:</label><br>
    <input type="file" name="fileUpload" id="fileUpload"><br>
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
    <input style="margin-bottom: 40px;" type="submit" value="Add ">
</form>