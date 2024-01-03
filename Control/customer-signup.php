<?php
$usernamesu = $email = $passwordsu = $gender = $name = $birthday = $phone = $address = $avatar = "";
$errusername = $erremail = $errpasswordsu = $errgender = $errname = $errbirthday = $errphone = $erraddress = $erravatar = "";
$usernamesu = $_POST['txt_username'];
$email = $_POST['txt_email'];
$passwordsu = $_POST['txt_password'];
$gender = isset($_POST['txt_gender']) ? $_POST['txt_gender'] : "";
$name = $_POST['txt_name'];
$birthday = $_POST['txt_birthday'];
$phone = $_POST['txt_phone'];
$address = $_POST['txt_address'];
$avatar = $_FILES['picture']['name'];
if (empty($usernamesu) || empty($email) || empty($passwordsu) || empty($gender) || empty($name) || empty($phone) || empty($address)) {
    echo '<script>alert("Vui lòng nhập đầy đủ");</script>';
} else {
    include_once("../Database/connect-mysql.php");

    // Kiểm tra email hoặc số điện thoại có khách hàng đăng ký chưa
    $sql = "SELECT * FROM `customer` WHERE `email` = '$email' OR `phone` = '$phone'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Server đang lỗi, vui lòng thử lại sau ít phút!"); // Thông báo lỗi nếu thực thi thất bại
    }

    $rows = mysqli_num_rows($result); // Lấy số hàng trả về

    if ($rows) {
        echo '<script>alert("Email hoặc Số điện thoại đã có tài khoản khác");document.location="../index.php?Page=signup";</script>';
        mysqli_close($conn);
        exit();
    }

    $hinh = "";

    if (isset($_FILES['picture'])) {
        $avatar = basename($_FILES['picture']['name']);
    }

    $thu_muc_luu_hinh = "../IMG-customer/";

    $sql = "INSERT INTO `customer`(`username`,`email`, `password`,`gender`,`name`,`birthday`, `phone`, `address`,`avatar`) VALUES ('$usernamesu','$email',md5('$passwordsu'),'$gender','$name','$birthday','$phone','$address','$avatar')";

    if (isset($_REQUEST['categoryid'])) {
        $sql .= " WHERE `categoryid`= '" . $_REQUEST['categoryid'] . "'";
    }

    // Thực hiện truy vấn SQL
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Lỗi đăng ký thất bại, vui lòng thử lại sau ít phút!");
    }

    // Kiểm tra nếu người dùng có tải lên hình ảnh thì copy vào thư mục hình
    if ($avatar && isset($_FILES['picture'])) {
        if (up_hinhdaidien($avatar)) {
            mysqli_close($conn);
            echo '<script>alert("Đăng ký thành công!");document.location="../index.php";
            </script>';
        }
    }
}

function up_hinhdaidien($avatar)
{
    $thu_muc_luu_hinh = "../IMG-customer/";
    $ten_file_luu = $thu_muc_luu_hinh . basename($avatar);

    $ok = 1;

    if (file_exists($ten_file_luu)) {
        echo "File này đã tồn tại trên server!";
        $ok = 0;
    }

    if ($_FILES['picture']['size'] > (5 * 1024 * 1024)) {
        echo "Chỉ cho phép tải lên file <= 5MB";
        $ok = 0;
    }

    $duoi_mo_rong = strtolower(pathinfo($ten_file_luu, PATHINFO_EXTENSION));

    if ($duoi_mo_rong != "jpg" && $duoi_mo_rong != "png" && $duoi_mo_rong != "jpeg" && $duoi_mo_rong != "gif") {
        echo "Chỉ cho phép tải lên file jpg, png, jpeg, gif";
        $ok = 0;
    }

    if ($ok) {
        move_uploaded_file($_FILES['picture']['tmp_name'], $ten_file_luu);
    } else {
        echo "File upload failed.";
    }
    
    return $ok;
}
?>