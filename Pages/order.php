<?php
	
	session_start();
	$tongtien=0;
	foreach ($_SESSION['cart'] as $key => $value)
			$tongtien+=$value['quantity']*$value['price'];
	require("../Database/connect-mysql.php");
	//Thêm vào đơn hàng
	$sql = "INSERT INTO `order`(`orderdate`,`total`, `phone`, `recipientname`, `email`, `address`, `note`, `statusid`) 
    VALUES (CURRENT_DATE,'$tongtien',";
	if(isset($_SESSION['phone'])) $sql.="'".$_SESSION['phone']."'";
	else $sql.="null";
	$sql.=",'".$_REQUEST['recipientname']."','".$_REQUEST['email']."','".$_REQUEST['address']."','".$_REQUEST['note']."','1')";
	
	//thêm vào đơn hàng
	$result = mysqli_query($conn,$sql);
	if (!$result) // Thông báo lỗi nếu thực thi thất bại
    	die("Server đang bị lỗi, vui lòng thử lại sau ít phút 1!"); 
	
    //thêm chi tiết đơn hàng
    //lấy số đơn hàng mới nhất
    $sql = "SELECT max(orderid) orderid FROM `order`";
    	
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($result); // Lấy số hàng trả về
    if (!$result) // Thông báo lỗi nếu thực thi thất bại
    	die("Server đang bị lỗi, vui lòng thử lại sau ít phút 2!"); 
    $orderid = "";
    while ($row = mysqli_fetch_array($result))
  		$orderid = $row['orderid'];
  	//thêm vào chi tiết đơn hàng
  	//duyệt giỏ hàng để lưu vào chi tiết
  	$sql="INSERT INTO `bookorderdetail`(`orderid`, `bookid`, `quantity`, `price`) VALUES";
  	foreach ($_SESSION['cart'] as $key => $value)
  		$sql.= "('$orderid','$key','".$value['quantity']."','".$value['price']."'),";	
  	//bỏ dấu , cuối cùng
  	$sql = substr($sql, 0, strlen($sql)-1);
  	//thêm dấu ; vào cuối
  	$sql.=";";
  	echo $sql;
  	$result = mysqli_query($conn,$sql);
  	if (!$result) // Thông báo lỗi nếu thực thi thất bại
    	die("Server đang bị lỗi, vui lòng thử lại sau ít phút! 3"); 
    //xóa các session liên quan giỏ hàng
    unset($_SESSION['cart-amount']);	
    unset($_SESSION['cart']);	
    mysqli_close($conn);
    echo '<script>alert("Đặt hàng thành công! Vui lòng chờ shop xử lý!");document.location= "../index.php";
			</script>';
           
            
?>