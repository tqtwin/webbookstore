<?php
session_start();
if (isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $_SESSION['cart_amount'] = 0;
}
header("Location: ../index.php?Page=cart");
?>
