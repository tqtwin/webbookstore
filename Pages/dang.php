<?php if (isset($_GET['plus'])) {
    $proid = $_GET['plus'];
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['proid'] == $proid && $product['proAmount'] <= 5) {
            // Kiểm tra nếu số lượng chưa đạt tối đa (5) thì mới thực hiện cộng
            $_SESSION['cart'][$key]['proAmount']++;
            $_SESSION['cart-count']++;
            break;
        } elseif ($product['proid'] == $proid && $product['proAmount'] >= 5) {
            // Nếu số lượng đã đạt tối đa, có thể thông báo lỗi hoặc không làm gì cả
            // Ở đây chỉ in ra thông báo lỗi để bạn có thể thay đổi theo ý muốn
            echo "<script>
            alert('Bạn đặt quá số lượng');
            </script>";
        }
    }
    header('Location:../../index.php?pages=cart');
}