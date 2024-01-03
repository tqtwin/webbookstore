<style>.button {
  margin-left: 40%;
}
.custom-btn {
  width: 130px;
  height: 40px;
  color: #fff;
  border-radius: 5px;
  padding: 10px 25px;
  font-family: 'Lato', sans-serif;
  font-weight: 500;
  background: transparent;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  display: inline-block;
   box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
   7px 7px 20px 0px rgba(0,0,0,.1),
   4px 4px 5px 0px rgba(0,0,0,.1);
  outline: none;
}
/* 8 */
.btn-8 {
  background-color: #f0ecfc;
background-image: linear-gradient(315deg, #f0ecfc 0%, #c797eb 74%);
  line-height: 42px;
  padding: 0;
  border: none;
}
.btn-8 span {
  position: relative;
  display: block;
  width: 100%;
  height: 100%;
}
.btn-8:before,
.btn-8:after {
  position: absolute;
  content: "";
  right: 0;
  bottom: 0;
  background: #c797eb;
  /* box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.5),
    inset 4px 4px 6px 0 rgba(116, 125, 136, .3); */
  transition: all 0.3s ease;
}
.btn-8:before{
   height: 0%;
   width: 2px;
}
.btn-8:after {
  width: 0%;
  height: 2px;
}
.btn-8:hover:before {
  height: 100%;
}
.btn-8:hover:after {
  width: 100%;
}
.btn-8:hover{
  background: transparent;
}
.btn-8 span:hover{
  color: #c797eb;
}
.btn-8 span:before,
.btn-8 span:after {
  position: absolute;
  content: "";
  left: 0;
  top: 0;
  background: #c797eb;
  /*box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.5),
    inset 4px 4px 6px 0 rgba(116, 125, 136, .3);*/
  transition: all 0.3s ease;
}
.btn-8 span:before {
  width: 2px;
  height: 0%;
}
.btn-8 span:after {
  height: 2px;
  width: 0%;
}
.btn-8 span:hover:before {
  height: 100%;
}
.btn-8 span:hover:after {
  width: 100%;
}
</style>
<?php
include_once("order-status.php");

if (isset($_REQUEST['statusid'])) {
    require("./Database/connect-mysql.php");    
    $statusId = $_REQUEST['statusid'];
    $orderId = isset($_REQUEST['orderid']) ? $_REQUEST['orderid'] : null;
  
    // Lấy danh sách đơn hàng dựa trên trạng thái đã chọn
    $sql = "SELECT * FROM `order` WHERE `statusid` = '$statusId'";
    $result = mysqli_query($conn, $sql);
 
    if (!$result) {
        die("Lỗi lấy dữ liệu đơn hàng: " . mysqli_error($conn));
    }
    $rows = mysqli_num_rows($result);
    
    if ($rows) {
        echo '<div>';
        ?>
        <style>
           
        </style>
        <table >
            <thead >
                <tr>
                    <th>Số đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tổng tiền</th>
                    <th>Xử lý</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo '<td>' . $row['orderid'] . '</td>';
                echo '<td>' . $row['orderdate'] . '</td>';
                echo '<td>' . number_format($row['total']) . '</td>';
                echo '<td><button type="button" class="custom-btn btn-8"><a style=" text-decoration: none;" href="?page=order-history&statusid=' . $statusId . '&orderid=' . $row['orderid'] . '">Xem chi tiết</a></button></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <?php
        echo '</div>';
        // Hiển thị chi tiết đơn hàng
        if (!empty($orderId)) {
            $sql = "SELECT b.title, b.image, od.quantity, od.price, od.quantity * od.price amount FROM `orderdetail` od, `book` b WHERE od.bookid=b.bookid AND od.orderid='$orderId'";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Lỗi lấy dữ liệu chi tiết đơn hàng: " . mysqli_error($conn));
            }
            $rows = mysqli_num_rows($result);

            if ($rows) {
                ?>
                <div class="order-details">
                    <h5>Chi tiết đơn hàng <?php echo $orderId; ?></h5>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Ảnh đại diện</th>
                                <th>Số lượng</th>
                                <th>Giá bán</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            
                            echo '<td>' . $row['itemname'] . '</td>';
                            echo '<td><img height="70px" width="70px" src="./IMG/' . $row['image'] . '"></td>';
                            echo '<td>' . $row['quatity'] . '</td>';
                            echo '<td>' . number_format($row['price']) . '</td>';
                            echo '<td>' . number_format($row['amount']) . '</td>';
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }
        }
    }

    mysqli_close($conn);
}
?>
