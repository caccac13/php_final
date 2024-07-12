<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="main">
        <div class="side-bar">
            <?php
            session_start();
            if (isset($_SESSION['username'])) {
                include 'pages/sidebar.php';
            }
            ?>
        </div>
        <div class="content">
            <div class="top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <?php
                            if (isset($_SESSION['username'])) {
                                include 'pages/total_item.php';
                            }
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                            if (isset($_SESSION['username'])) {
                                include 'pages/total_account.php';
                            }
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                            if (isset($_SESSION['username'])) {
                                include 'pages/total_income.php';
                            }
                            ?>
                        </div>
                        <div class="col-sm-3 d-flex justify-content-center align-items-center">
                            <?php
                            if (isset($_SESSION['username'])) {
                                echo '<div><a href="pages/logout.php"><i style="font-size:60px;padding:12px;     color:red" title="Logout" class="fa-solid fa-right-from-bracket"></i></a></div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid ">
                <?php
                if (isset($_SESSION['username'])) {
                    if (isset($_REQUEST['page'])) {
                        if ($_REQUEST['page'] == "item") {
                            include 'pages/item.php';
                        }
                        if ($_REQUEST['page'] == "item_add") {
                            include 'pages/item_add.php';
                        }
                        if ($_REQUEST['page'] == "item_delete") {
                            include 'pages/item_delete.php';
                        }
                        if ($_REQUEST['page'] == "item_edit") {
                            include 'pages/item_edit.php';
                        }
                        if ($_REQUEST['page'] == "account") {
                            include 'pages/account.php';
                        }
                        if ($_REQUEST['page'] == "account_delete") {
                            include 'pages/account_delete.php';
                        }
                        if ($_REQUEST['page'] == "account_edit") {
                            include 'pages/account_edit.php';
                        }
                        if ($_REQUEST['page'] == "category") {
                            include 'pages/category.php';
                        }
                        if ($_REQUEST['page'] == "category_edit") {
                            require 'pages/category_edit.php';
                        }
                        if ($_REQUEST['page'] == "category_add") {
                            require 'pages/category_add.php';
                        }
                        if ($_REQUEST['page'] == "category_delete") {
                            require 'pages/category_delete.php';
                        }
                    } else {
                        include 'pages/item.php';
                    }
                } else {
                    echo '<div style="margin-top: 80px">Vui lòng đăng nhập</div>';
                    include 'pages/loginform.php';
                }
                ?>
            </div>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>