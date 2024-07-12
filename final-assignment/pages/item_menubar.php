<div class="wrapper">
    <div class="filter">
        <label>Sort by category:</label>
        <select id="category" onchange="gofilter();">
            <option value="">--</option>
            <?php
            include_once("../db/db.php");
            $sql = "SELECT * FROM `category`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['categoryid'] . '">' . $row['categoryname'] . '</option>';
                }
            } else {
                echo "0 results";
            }
            ?>
        </select>
        <label>Price:</label>
        <select id="sort" onchange="gofilter();">
            <option value="">--</option>
            <option value="price_asc">Ascending</option>
            <option value="price_desc">Descending</option>
        </select>
        <input type="text" id="keysearch" name="txtkey" placeholder="Search..." onchange="gofilter();">
    </div>
    <button style="margin:8px 0;"> <a style="padding: 8px;text-decoration: none;" href="?page=item_add">Add product</a></button>
</div>

<script>
    function gofilter() {
        var category = document.getElementById('category').value;
        var sort = document.getElementById('sort').value;
        var keysearch = document.getElementById('keysearch').value;
        var url = "index.php?page=item";

        if (category) {
            url += "&category=" + category;
        }

        if (sort) {
            url += "&sort=" + sort;
        }

        if (keysearch) {
            url += "&keysearch=" + keysearch;
        }

        document.location = url;
    }
</script>
<style>
    .wrapper {
        display: flex;
        justify-content: space-between;
    }
</style>