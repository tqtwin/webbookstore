<?php
session_start(); // Khởi đầu phiên làm việc
$matkhaumoi = $matkhaumoi2= "";
$matkhaumoi = $_POST['txt_password'];
$matkhaumoi2 = $_POST['txt_repassword'];
$email = $_GET['email'];  // Change $_email1 to $_GET['email']
if(!$matkhaumoi ||!$matkhaumoi2)
{
    echo '<script>alert("Vui lòng nhập đầy đủ các mật khẩu"); document.location="../index.php?Page=change-password";</script>';
}
else if($matkhaumoi != $matkhaumoi2)
{ 
    echo '<script>alert("xác nhận mật khẩu không chính xác"); document.location="../index.php?Page=change-password";</script>';
}
else
{ include_once("../Database/connect-mysql.php");
    // Kiểm tra email hoặc số điện thoại có khách hàng đăng ký chưa
    $sql = "UPDATE `customer` SET `password` = md5('$matkhaumoi') WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result) 
    die("Lỗi cơ sở dữ liệu: " . mysqli_error($conn));
    // Thông báo lỗi nếu thực thi thất bại
        $_SESSION['password'] = $matkhaumoi;
        echo '<script>alert("Đã đổi mật khẩu thành công vui lòng đăng nhập bằng mật khẩu mới"); document.location="../index.php?Page=login";</script>';
        mysqli_close($conn); 
}

?>