<h1>Category management</h1>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Category name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php
        include_once("db/db.php");
        $sql = "SELECT * FROM `category`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                  <td>" . $row['categoryid'] . "</td>
                  <td>" . $row['categoryname'] . "</td> 
                  <td>" . $row['description'] . "</td>
                  <td><a style='padding:0 8px' href=\"?page=category_edit&id=" . $row['categoryid'] . "\"><i class=\"fa-solid fa-pen\"></i></a>
                  <a style='color:red ' href=\"#\" onclick=\"confirmDelete({$row['categoryid']})\"><i style='padding:0 8px'  class=\"fa-solid fa-trash\"></i></a></td>
                </tr>
                ";
            }
        } else {
            echo "0 results";
        }
        ?>
    </table>
</div>
<h2>Add category</h2>
<form method="post" action="?page=category_add">
    <input type="hidden" name="action" value="add">
    <label style="width:150px" for="categoryname">Category name:</label>
    <input type="text" name="categoryname" required><br><br>
    <label style="width:150px" for="description">Description:</label>
    <input type="text" name="description" required><br><br>
    <input type="submit" value="Add">
</form>

<script>
    function confirmDelete(categoryId) {
        // Show confirmation dialog
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
            // If user clicks "OK", redirect to the delete URL
            window.location.href = "?page=category_delete&id=" + categoryId;
        } else {
            // If user clicks "Cancel", do nothing
            console.log("Deletion cancelled");
        }
    }
</script>