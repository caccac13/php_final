<?php
include 'item_menubar.php';
include 'db/db.php';

$sql = "SELECT * FROM `item`";
$where = "";
$order = "";

if (isset($_REQUEST['category']) && $_REQUEST['category'] != "") {
    $where = " WHERE `categoryid` = {$_REQUEST['category']}";
}

if (isset($_REQUEST['keysearch']) && $_REQUEST['keysearch'] != "") {
    if ($where != "") {
        $where .= " AND `itemname` like '%" . $_REQUEST['keysearch'] . "%'";
    } else {
        $where = " WHERE `itemname` like '%" . $_REQUEST['keysearch'] . "%'";
    }
}

if (isset($_REQUEST['sort'])) {
    $sort = $_REQUEST['sort'];
    if ($sort == 'price_asc') {
        $order = " ORDER BY `price` ASC";
    } elseif ($sort == 'price_desc') {
        $order = " ORDER BY `price` DESC";
    }
}

$sql .= $where . $order;
$result = $conn->query($sql);

$total = $result->num_rows;
$limit = 10;
$page = ceil($total / $limit);
$cur_page = (isset($_GET['pageindex']) ? $_GET['pageindex'] : 1);
$start = ($cur_page - 1) * $limit;

if (!isset($_REQUEST['category']) && !isset($_REQUEST['keysearch'])) {
    $sql .= " LIMIT $start, $limit";
}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Unit</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    ';

    while ($row = $result->fetch_assoc()) {
        echo "
        <tr>
        <td>" . $row['itemid'] . "</td>
        <td>" . $row['itemname'] . "</td> 
        <td>" . $row['description'] . "</td>
        <td>" . $row['unit'] . "</td>
        <td>" . number_format($row['price']) . "đ</td>
        <td><img style=\"width: 80px; margin:10px\" src=\"img/" . $row['image'] . "\"></td>
        <td style='text-align:center'><a style='padding:12px;display:block' href=\"?page=item_edit&id=" . $row['itemid'] . "\"><i class=\"fa-solid fa-pen\"></i></a>
        <a href=\"#\" onclick=\"confirmDelete({$row['itemid']})\"><i style='padding:12px;display:block; color:red;'  class=\"fa-solid fa-trash\"></i></a></td>
        </td>
        </tr>
        ";
    }
    echo '</tbody></table>';

    if (!isset($_REQUEST['category']) && !isset($_REQUEST['keysearch'])) {
    ?>
        <nav aria-label="Page navigation example" style="padding-bottom:40px">
        <ul class="pagination justify-content-center">
            <?php if ($cur_page - 1 > 0) { ?>
            <li class="page-item" title="previous">
                <a class="page-link" href="index.php?page=item&pageindex=<?php echo $cur_page - 1; ?>"><<</a>
            </li>
            <?php } ?>
            <?php
            for ($i = 1; $i <= $page; $i++) { ?>
            <li class="page-item <?php echo (($cur_page == $i) ? 'active' : ''); ?>">
                <a class="page-link" href="index.php?page=item&pageindex=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
            <?php
            }
            ?>

            <?php if ($cur_page + 1 <= $page) { ?>
            <li class="page-item" title="next">
                <a class="page-link" href="index.php?page=item&pageindex=<?php echo $cur_page + 1; ?>">>></a>
            </li>
            <?php } ?>
        </ul>
        </nav>
    <?php }
} else {
    echo "0 results";
}
$conn->close();
?>

<script>
    function confirmDelete(itemId) {
        if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
            window.location.href = "?page=item_delete&id=" + itemId;
        } else {
            console.log("Deletion cancelled");
        }
    }
</script>
