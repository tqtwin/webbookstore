<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        ul.category-list {
            list-style: none;
            padding: 0;
           
        }

        ul.category-list li {
            padding: 25px 25px 25px 0;
            border: 1px solid red;
            display: flex;
            font-weight: bold;
            
        }

        ul.category-list a {
            text-decoration: none;
            color: #333; /* Màu chữ mặc định của danh mục */
        }

        ul.category-list a:hover {
            color: #007bff; /* Màu chữ khi rê chuột vào */
        }

        .product-image {
            width: 50%;
            margin: 0;
        }

        .product-details {
            font-size: 13px;
            color: green;
            margin-left: 15px;
        }
    </style>
</head>
<body>

<?php
$firstDayOfMonth = date("Y-m-01");
$currentDate = date("Y-m-d");

if (!isset($_REQUEST['fromdate']) || !isset($_REQUEST['todate'])) {
    $_REQUEST['fromdate'] = $firstDayOfMonth;
    $_REQUEST['todate'] = $currentDate;
}
?>
<?php
if (isset($_REQUEST['fromdate']) && isset($_REQUEST['todate'])) {
    include_once("./Database/connect-mysql.php");
    $sql = "SELECT od.orderid,b.bookid, b.title, od.price, image
            FROM `order` o, `bookorderdetail` od, `book` b
            WHERE o.orderid=od.orderid AND od.bookid=b.bookid 
            AND o.orderdate >= '" . $_REQUEST['fromdate'] . " 00:00:00' 
            AND o.orderdate <= '" . $_REQUEST['todate'] . " 23:59:59' 
            GROUP BY od.orderid, b.title, od.price, b.image 
            ORDER BY SUM(od.quantity) DESC"; // Fix typo in quantity
    $result = mysqli_query($conn, $sql);

    if ($result != NULL) {
        echo '<ul class="category-list">';
        while ($row = mysqli_fetch_array($result)) {
            echo '<a href="?bookid=' . $row['bookid'] . '">';
            echo '<li>';
            echo '<div class="product-image"><img height="60" width="80" src="IMG/' . $row['image'] . '" style="width: 100%;"></div>';
            echo '<div class="product-details">' . $row['title'] . '<br> <span style="color: red;">' . number_format($row['price']) . '</span></div>';
            echo '</li>';
            echo'</a>';
        }
        echo '</ul>';
    }
}
?>

</body>
</html>
