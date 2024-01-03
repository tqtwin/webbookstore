<style>.product-card {
        position: relative;
        margin: 20px;
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

    ul.df-menu {
        list-style: none;
        padding: 0;
        display: flex;
    }

    ul.df-menu li {
        margin: 0 10px;
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
        margin-left: 15%; 
      
        
       
}</style>
<?php
    require("./Database/connect-mysql.php");

    $keyvalue = mysqli_real_escape_string($conn, $_REQUEST['keyvalue']);
    $sql = "SELECT b.*, a.authorname
            FROM book b
            JOIN author a ON b.authorid = a.authorid
            WHERE b.title LIKE '%$keyvalue%' 
            OR a.authorname LIKE '%$keyvalue%'";
    

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Lỗi lấy dữ liệu sản phẩm, lỗi: " . mysqli_error($conn));
    }
    $rows = mysqli_num_rows($result);

    if ($rows) {
        echo '<div class="itemlist1">';
        echo'<input type="text" value="' .$keyvalue.'" readonly style="width:100%; margin-left: 15%; ">';
        echo '<div class="itemlist">';
       
        while ($row = mysqli_fetch_array($result)) {
            echo '<div class="card product-card" style="width:250px">';
            echo '<a href="?bookid=' . $row['bookid'] . '"> <img class="card-img-top hinh" src="./IMG/' . $row['image'] . '" alt="Hình sản phẩm" style="">';
            echo '<hr>';
            echo '<div class="card-body" style=" text-align: center;">';
            echo '<h5 class="card-title" style="text-align:center;color: green;" >' . $row['title'] . '</h5>';
            echo '<h5 class="card-title" style="text-align:center;color: red;">' . number_format($row['price']) . 'VNĐ</h5>';
            echo '<a href="Pages/add-cart.php?bookid=' . $row['bookid'] . '&title=' . $row['title'] . '&image=' . $row['image'] . '&price=' . $row['price'] . '&quantity=1" class="btn btn-success" style="margin-left:60px; font-size: 10px;">Thêm giỏ hàng</a>';
            echo "</div>";
            echo "</div>";
            
        }
        echo '</div>';  
    } else {
        echo 'Không tìm thấy sản phẩm cần tìm!';
    }

    mysqli_close($conn);
?>

