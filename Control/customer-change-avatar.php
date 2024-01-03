<?php
session_start(); // Khởi đầu phiên làm việc
// Kiểm tra xem người dùng đã đăng nhập hay chưa (bạn nên có một hệ thống xác thực người dùng ở đây).
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php'); // Nếu chưa đăng nhập, chuyển hướng người dùng đến trang đăng nhập.
    exit();
}
$avatarcu = $_SESSION['avatar'];
$avatarmoi = ''; // Khởi tạo biến $avatarmoi
// Kiểm tra xem người dùng đã gửi một tệp hình ảnh mới hay chưa
if (isset($_FILES['avatarmoi']) && $_FILES['avatarmoi']['error'] === UPLOAD_ERR_OK) {
    // Lấy thông tin của tệp hình ảnh mới
    $avatarmoi = $_FILES['avatarmoi']['name'];

    include_once("../Database/connect-mysql.php");
    $newAvatarPath =   $avatarmoi; // Specify the directory for storing the new avatar
    
    $sql = "UPDATE `customer` SET `avatar` = '$newAvatarPath' WHERE `username` = '{$_SESSION['username']}'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Lỗi cơ sở dữ liệu: " . mysqli_error($conn));
    }

    // Call the up_hinhdaidien function to upload and validate the avatar
    if (up_hinhdaidien($avatarmoi)) {
        $_SESSION['avatar'] = $newAvatarPath;
        mysqli_close($conn);
        echo '<script>alert("Đổi avatar thành công!"); document.location="../index.php";</script>';
    }
} else {
    echo '<script>alert("Vui lòng chọn tệp hình ảnh mới.");</script>';
}
//header('Location: ../index.php');
echo $avatarmoi;
exit();

function up_hinhdaidien($avatarmoi)
{
    $thu_muc_luu_hinh = "../IMG-customer/";
    $ten_file_luu = $thu_muc_luu_hinh . basename($avatarmoi);
    $ok = 1;

    if (file_exists($ten_file_luu)) {
        echo "File này đã tồn tại trên server!";
        $ok = 0;
    }

    if ($_FILES['avatarmoi']['size'] > (5 * 1024 * 1024)) {
        echo "Chỉ cho phép tải lên file <= 5MB";
        $ok = 0;
    }

    $duoi_mo_rong = strtolower(pathinfo($ten_file_luu, PATHINFO_EXTENSION));

    if ($duoi_mo_rong != "jpg" && $duoi_mo_rong != "png" && $duoi_mo_rong != "jpeg" && $duoi_mo_rong != "gif") {
        echo "Chỉ cho phép tải lên file jpg, png, jpeg, gif";
        $ok = 0;
    }

    if ($ok) {
        move_uploaded_file($_FILES['avatarmoi']['tmp_name'], $ten_file_luu);
    }

    return $ok;
}
?>
