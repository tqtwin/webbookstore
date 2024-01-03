<?php
session_start();

// Tạo session tổng số lượng giỏ hàng
if (!isset($_SESSION['cart_amount'])) {
    $_SESSION['cart_amount'] = 0;
}

// Tạo session giỏ hàng
if (isset($_REQUEST['bookid'])) {
    $bookid = $_REQUEST['bookid'];
    $quantity = intval($_REQUEST['quantity']);

    if (isset($_SESSION['cart'][$bookid])) {
        // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
        $_SESSION['cart'][$bookid]['quantity'] += $quantity;
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng
        $_SESSION['cart'][$bookid] = array(
            'title' => $_REQUEST['title'],
            'image' => $_REQUEST['image'],
            'quantity' => $quantity,
            'price' => $_REQUEST['price']
        );
    }

    // Cập nhật tổng số lượng giỏ hàng
    $_SESSION['cart_amount'] += $quantity;
}

header("location:../index.php");
?>
