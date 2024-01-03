<?php
session_start(); // Khởi đầu phiên làm việc

// Kiểm tra địa chỉ cũ
if (empty($_POST['address'])) {
    echo '<script>alert("Vui lòng nhập địa chỉ cũ"); document.location="../index.php?Page=change-address";</script>';
}
// Xuất ra địa chỉ cũ
// Kiểm tra địa chỉ mới
$diachimoi = $_POST['newaddress'];
if (!$diachimoi) {
    echo '<script>alert("Vui lòng nhập địa chỉ mới"); document.location="../index.php?Page=change-address";</script>';
}

// Cập nhật địa chỉ mới vào database
include_once("../Database/connect-mysql.php");
$sql = "UPDATE `customer` SET `address` = '$diachimoi' WHERE `email` = '{$_SESSION['email']}'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Server đang lỗi, vui lòng thử lại sau ít phút!");
}

// Thông báo thành công
echo '<script>alert("Đổi địa chỉ thành công"); document.location="../index.php";</script>';

mysqli_close($conn);


