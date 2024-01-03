<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Your existing styles */
        .category-list {
            margin-top: 100px;
        }

        .category-list ul {
            list-style: none;
            padding: 0;
            margin-left: 500px;
        }

        .category-list li {
            padding: 10px;
            margin: 0 5px;
            border: 0.5px dotted #000;
        }

        .category-list a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .category-list a:hover {
            color: #007bff;
        }

        .auth-links {
            align-items: center;
            margin-left: auto;
            /* Move auth links to the right */
            margin-right: 20px;
            /* Add some right margin */
            display: flex;
        }

        .nav-link {
            margin: 20px;
            width: 150px;
        }

        .acount-bg {
            background-color: #333;
            height: 200px;
            width: 1400px;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['email'])) {
        echo '
        <div class="category-list">
            <ul class="user-menu">
                <li><a href="?Page=change-acount">Chỉnh sửa thông tin </a></li>
                <li><a href="?Page=order-history">Lịch sử mua hàng</a></li>';

        echo '       <li><a href="?Page=customer-delete">Xóa tài khoản</a></li>
                <li><a href="./Control/customer-logout.php">Đăng xuất</a></li>
            </ul>
        </div>';
    } else {

        include_once("Pages/login.php");
    }
    ?>
   

</body>

</html>