<head>
    <style>
        .product-card {
            position: relative;
            margin: 20px;
            padding: 10px;
            border-radius: 20px;
        }

        .hinh {
            transform: scale(1);
            transition-duration: .4s;
            object-fit: scale-down;
        }

        .hinh {
            width: 100%;
            height: auto;
            object-fit: contain;
            max-height: 200px;
        }

        .hinh:hover {
            transform: scale(1.15);
        }

        

        ul.df-menu li {
            margin-left: 10px;
        }

        ul.df-menu li a {
            text-decoration: none;
            color: black;
        }

        .itemlist {
            flex-wrap: wrap;
            justify-content: space-around;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 5px;
            width: 100%;
            margin: 0 auto;

        }

        .card-body {
            height: 75px;
            padding: 5px;
        }

        .card-body .btn {
            margin-bottom: 5px;
        }

        .all {
            display: flex;
            width: 100%;
            
        }

        .right {
            margin-left: 210px;
            max-width: 1200px;
            margin-top: 150px;
            border: 1px solid red;

        }

        .df-menu {
            display: flex;
            list-style: none;
            margin: 25px;
            background-color: #ededed;
            height: 60px;
        }

        .df-menu li a {
            padding: 10px;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;

        }

        .df-menu li a.active {
            background-color: #007bff;
        }

        @media screen and (max-width: 920px) {
    .itemlist {
        flex-wrap: wrap;
            justify-content: space-around;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 5px;
        margin: 0 auto;
    }
    .df-menu {
            display: flex;
            flex-direction: column;
            background-color: #ededed;
            height: 270px;
            padding: 10px;
        }
        .df-menu li a {
            padding: 10px;
            background-color: #fff;
            display: flex;
            justify-content: left;
            border-radius: 5px;

        }
        .df-menu input[type='number'] {
        width: 170px;
}
}
    </style>
</head>'

<body>


    <div class="all">
        <?php include_once("left-menu.php"); ?>
        <!-- <h6 class="caycanh">Sản phẩm bán chạy</h6>
    <?php include_once("menu-san-pham.php"); ?>  -->
        <div class="right">
        <ul class="df-menu">
    <p style="margin-top: 15px; margin-left:10px">Sắp xếp theo:</p>
    <li style="margin-top: 7px;"><a class="button1 <?php echo isset($_GET['sort']) && $_GET['sort'] == 'default' ? 'active' : ''; ?>" href="<?php echo isset($_GET['categoryid']) ? '?sort=default&categoryid=' . $_GET['categoryid'] : '?sort=default'; ?>">Mặc định</a></li>
    <li style="margin-top: 7px;"><a class="button1 <?php echo isset($_GET['sort']) && $_GET['sort'] == 'price-low-to-high' ? 'active' : ''; ?>" href="<?php echo isset($_GET['categoryid']) ? '?sort=price-low-to-high&categoryid=' . $_GET['categoryid'] : '?sort=price-low-to-high'; ?>">Giá: thấp đến cao</a></li>
    <li style="margin-top: 7px;"><a class="button1 <?php echo isset($_GET['sort']) && $_GET['sort'] == 'price-high-to-low' ? 'active' : ''; ?>" href="<?php echo isset($_GET['categoryid']) ? '?sort=price-high-to-low&categoryid=' . $_GET['categoryid'] : '?sort=price-high-to-low'; ?>">Giá: cao đến thấp</a></li>
    <li style="margin-top: 15px;">
        <!-- tìm kiếm theo giá thấp nhất đến cao nhất -->
        <form action="" method="get">
            <label for="minPrice">Giá từ:</label>
            <input type="number" id="minPrice" name="minPrice">
            <label for="maxPrice">đến:</label>
            <input type="number" id="maxPrice" name="maxPrice">
            <?php 
        if(isset($_GET['categoryid'])) {
            echo '<input type="hidden" name="categoryid" value="' . $_GET["categoryid"] . '">';
        }
    ?>
    <input type="submit" value="Tìm kiếm">
        </form>
    </li>
</ul>

            </ul>

            <?php
            require("./Database/connect-mysql.php");
            $sortField = isset($_GET['sort']) ? $_GET['sort'] : 'default';
            $minPrice = isset($_GET['minPrice']) ? intval($_GET['minPrice']) : null;
            $maxPrice = isset($_GET['maxPrice']) ? intval($_GET['maxPrice']) : null;
            $sql = "SELECT * FROM `book`";
            if (isset($_REQUEST['categoryid'])) {
                $sql .= " WHERE `categoryid`= '" . $_REQUEST['categoryid'] . "'";
            }
            // Thêm điều kiện sắp xếp dựa trên tham số 'sort'
            if ($sortField === 'price-low-to-high') {
                $sql .= " ORDER BY price ASC";
            } elseif ($sortField === 'price-high-to-low') {
                $sql .= " ORDER BY price DESC";
            }

            if ($minPrice !== null && $maxPrice !== null) {
                // Check if there's already a WHERE clause in the query
                if (strpos($sql, 'WHERE') === false) {
                    $sql .= " WHERE price BETWEEN $minPrice AND $maxPrice";
                } else {
                    $sql .= " AND price BETWEEN $minPrice AND $maxPrice";
                }
            }

            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Lỗi lấy dữ liệu sách, lỗi: " . mysqli_error($conn));
            }

            $rows = mysqli_num_rows($result);

            if ($rows) {

                echo '<div class="itemlist">';
                while ($row = mysqli_fetch_array($result)) {
                    echo '<div class="card product-card" style="width:250px">';
                    echo '<a href="?bookid=' . $row['bookid'] . '"> <img class="card-img-top hinh" src="./IMG/' . $row['image'] . '" alt="Hình sản phẩm" style="text-decoration: none;">';
                    echo '<hr>';
                    echo '<div class="card-body" style=" text-align: center;">';
                    echo '<p class="card-title" style="text-align:center;" >' . $row['title'] . '</p>';
                    echo "</div>";
                    echo '<p class="card-title" style="text-align:center;color: red; ">' . number_format($row['price']) . 'VNĐ</p></a>';
                    echo '<a style="text-align:center; text-decoration: none;" 
                    href="Pages/add-cart.php?bookid=' . $row['bookid'] . '&title=' . $row['title'] . '&image=' . $row['image'] . '&price=' . $row['price'] . '&quantity=1" class="btn btn-success" style="margin-left:60px; font-size: 10px;">Thêm giỏ hàng</a>';
                    echo "</div>";
                }
                echo '</div>';

                echo '</div>';
                echo '</div>';
            }
            mysqli_close($conn);
            ?>
</body>

<script>
    $(".button1").on("click", function (e) {
    e.preventDefault();

    // Kiểm tra xem nút đã được nhấp có class 'active' hay không
    if (!$(this).hasClass("active")) {
        // Loại bỏ class 'active' từ tất cả các nút
        $(".button1").removeClass("active");
        // Thêm class 'active' cho nút được nhấp
        $(this).addClass("active");

        // Kiểm tra xem href có giá trị không
        var href = $(this).attr("href");
        if (href) {
            // Thực hiện chuyển hướng (nếu có giá trị)
            window.location.href = href;
        }
    }
});

</script>