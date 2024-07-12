<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array();

    if (empty($_POST['user'])) {
        $error['user'] = 'Please enter username';
    } else {
        $pattern = "/^[a-z0-9_\.]{6,32}$/";
        if (!preg_match($pattern, $_POST['user'])) {
            $error['user'] = 'Username must be 6 characters or longer';
        } else {
            $user = $_POST['user'];
        }
    }

    if (empty($_POST['password'])) {
        $error['password'] = 'Please enter password';
    } else {
        $pattern = "/^(?=.*[A-Z])(?=.*[0-9])[\w_\.!@#$%^&*()]{6,}$/";
        if (!preg_match($pattern, $_POST['password'])) {
            $error['password'] = 'Password must be 6 characters, one capital letter, one number';
        } else {
            $password = $_POST['password'];
        }
    }

    if (empty($_POST['name'])) {
        $error['name'] = 'Please enter name';
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST['email'])) {
        $error['email'] = 'Please enter email';
    } else {
        $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if (!preg_match($pattern, $_POST['email'])) {
            $error['email'] = 'Invalid email';
        } else {
            $email = $_POST['email'];
        }
    }

    if (empty($_POST['phone'])) {
        $error['phone'] = 'Please enter phone number';
    } else {
        $pattern = "/^(03|05|07|08|09)\d{8}$/";
        if (!preg_match($pattern, $_POST['phone'])) {
            $error['phone'] = 'Invalid phone number';
        } else {
            $phone = $_POST['phone'];
        }
    }

    if (empty($_POST['roleid'])) {
        $error['roleid'] = 'Please enter role ID';
    } else {
        $roleid = $_POST['roleid'];
    }

    if (empty($error)) {
        header('location: pages/add_account.php?username=' . $user . '&password=' . $password . ' &name=' . $name . ' &email=' . $email . ' &phone=' . $phone . ' &roleid=' . $roleid . '');
    }
}
?>
<h1>Account management</h1>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role id</th>
            <th>Action</th>
        </tr>
        <?php
        include_once("db/db.php");
        $sql = "SELECT * FROM `account`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                  <td>" . $row['username'] . "</td>
                  <td>" . $row['password'] . "</td> 
                  <td>" . $row['name'] . "</td>
                  <td>" . $row['email'] . "</td>
                  <td>" . $row['phone'] . "</td>
                  <td>" . $row['roleid'] . "</td>
                  <td><a style='padding:0 8px' href=\"?page=account_edit&id=" . $row['username'] . "\"><i class=\"fa-solid fa-pen\"></i></a>
                  <a style='color:red' href=\"#\" onclick=\"return confirmDelete('{$row['username']}');\"><i class=\"fa-solid fa-trash\" style='padding:0 8px'></i></a></td>
                </tr>
                ";
            }
        } else {
            echo "0 results";
        }
        ?>
    </table>
</div>
<script>
    function confirmDelete(username) {
        // Show confirmation dialog
        if (confirm("Bạn có chắc chắn muốn xóa tài khoản này không?")) {
            // If user clicks "OK", redirect to the delete URL
            window.location.href = "?page=account_delete&username=" + username;
        } else {
            // If user clicks "Cancel", do nothing
            console.log("Deletion cancelled");
        }
    }
</script>



<h2>Add account</h2>
<form method="post" action="">
    <input type="hidden" name="action" value="add">
    <label style="width:100px" for="user">Username:</label>
    <input type="text" name="user" value="<?php if (isset($user)) echo $user ?>"><br>
    <?php
    if (isset($error['user'])) {
        echo '<span style="color: red;">' . $error['user'] . '</span>';
    }
    ?><br>
    <label style="width:100px" for="password">Password:</label>
    <input type="password" name="password"><br>
    <?php
    if (isset($error['password'])) {
        echo '<span style="color: red;">' . $error['password'] . '</span>';
    }
    ?><br>
    <label style="width:100px" for="name">Name:</label>
    <input type="text" name="name" value="<?php if (isset($name)) echo $name ?>"><br>
    <?php
    if (isset($error['name'])) {
        echo '<span style="color: red;">' . $error['name'] . '</span>';
    }
    ?><br>
    <label style="width:100px" for="email">Email:</label>
    <input type="text" name="email" value="<?php if (isset($email)) echo $email ?>"><br>
    <?php
    if (isset($error['email'])) {
        echo '<span style="color: red;">' . $error['email'] . '</span>';
    }
    ?><br>
    <label style="width:100px" for="phone">Phone:</label>
    <input type="text" name="phone" value="<?php if (isset($phone)) echo $phone ?>"><br>
    <?php
    if (isset($error['phone'])) {
        echo '<span style="color: red;">' . $error['phone'] . '</span>';
    }
    ?><br>
    <label style="width:100px" for="roleid">Role ID:</label>
    <input type="text" name="roleid" value="<?php if (isset($roleid)) echo $roleid ?>"><br>
    <?php
    if (isset($error['roleid'])) {
        echo '<span style="color: red;">' . $error['roleid'] . '</span>';
    }
    ?><br>
    <input type="submit" value="Add">
</form>