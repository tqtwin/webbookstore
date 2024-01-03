<?php
session_start();//print_r($_SESSION['cart']); 
$OLD_QUANTITY = $_SESSION['cart'][$_REQUEST['bookid']]['quantity'];
if($_REQUEST['quantity']!= 0){
    $_SESSION['cart_amount'] =$_SESSION['cart_amount']- $OLD_QUANTITY + $_REQUEST['quantity'];
    $_SESSION['cart'][$_REQUEST['bookid']]['quantity'] = $_REQUEST['quantity'];
}
else
{//tổng số = tổng số -số lượng sản phẩm mà người dùng cập nhật thành công
    $_SESSION['cart_amount'] = $_SESSION['cart_amount']-$OLD_QUANTITY;
    unset($_SESSION['cart'][$_REQUEST['bookid']]);
}
header("location:../index.php?Page=cart");
?>