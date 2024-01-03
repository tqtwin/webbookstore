<?php
session_start(); // Khởi đầu phiên làm việc
$tendn = $matkhau ="";
$tendn = $_POST['txt_username'];
$matkhau = $_POST['txt_password'];
if (!$username && !$matkhau) {
    echo '<script>alert("Vui lòng nhập tên đăng nhập và mật khẩu"); document.location="../index.php?Page=login";</script>';
} elseif (!$tendn) {
    echo '<script>alert("Vui lòng nhập tên đăng nhập"); document.location="../index.php?Page=login";</script>';
} elseif (!$matkhau) {
    echo '<script>alert("Vui lòng nhập mật khẩu"); document.location="../index.php?Page=login";</script>';
}
else
{
    include_once("../Database/connect-mysql.php");
    $sql = "SELECT * FROM `customer` WHERE `username` = '$tendn' and `password` = md5('$matkhau')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Server đang lỗi, vui lòng thử lại sau ít phút!"); 
    }
    $rows = mysqli_num_rows($result); 

    if ($rows) {
        while ($row = mysqli_fetch_array($result))
        {
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['birthday'] = $row['birthday'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['avatar'] = $row['avatar'];
        }
       header("location:../index.php");
    }
    else{

        echo '<script>alert("Tên đăng nhập hoặc mật khẩu không đúng");
        document.location="../index.php?Page=login" ;
        </script>';
     
     
    }
    mysqli_close($conn);
}
?>
