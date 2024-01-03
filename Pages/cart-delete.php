<?php
session_start();
$OLD_QUANTITY = $_SESSION['cart'][$_REQUEST['bookid']]['quantity'];
$_SESSION['cart_amount'] = $_SESSION['cart_amount']-$OLD_QUANTITY;
unset($_SESSION['cart'][$_REQUEST['bookid']]);
header("location:../index.php?Page=cart");
?>