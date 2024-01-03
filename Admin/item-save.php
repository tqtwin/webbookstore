<?php
$itemid = $title = $description = $price = $image = $status = $categoryid = $authorid = $publisher = $release_date = $num_pages = $quantity = $discount_price = "";

$itemid = $_POST['itemid'];
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$categoryid = $_POST['categoryid'];
$authorid = $_POST['authorid'];
$publisher = $_POST['publisher'];
$release_date = $_POST['release_date'];
$num_pages = $_POST['num_pages'];
$quantity = $_POST['quantity'];
$discount_price = $_POST['discount_price'];

$image = $_FILES['image']['name'];

if (isset($_FILES['images'])) {
    $images = tao_mang_image();
}

include_once("../Database/DBHandle.php");
$DB = new Database();
$sql = "INSERT INTO `book`(`bookid`, `title`, `description`, `price`, `image`, `categoryid`, `authorid`, `publisher`, `release_date`, `num_pages`, `quantity`, `discount_price`) VALUES ('" . $itemid . "','" . $title . "','" . $description . "','" . $price . "','" . $image . "','" . $categoryid . "','" . $authorid . "','" . $publisher . "','" . $release_date . "','" . $num_pages . "','" . $quantity . "','" . $discount_price . "')";

$ok = $DB->ExecuteSQL($sql);

if ($ok > 0) {
    if ($image) up_hinhdaidien();
    if ($images) up_hinhchitiet();
    echo '<script>alert("Đã thêm sách");history.go(-2)</script>';
} else {
    echo '<script>alert("Thêm sách bị lỗi, vui lòng xem lại dữ liệu");</script>';
}

function up_hinhdaidien()
{
    $thu_muc_luu_hinh = "../IMG/";
    $ten_file_luu = $thu_muc_luu_hinh . basename($_FILES['image']['name']);
    $OK = 1;

    if (file_exists($ten_file_luu)) {
        $OK = 0;
    }

    if ($_FILES['image']['size'] > (5 * 1024 * 1024)) {
        $OK = 0;
    }

    $duoi_mo_rong = strtolower(pathinfo($ten_file_luu, PATHINFO_EXTENSION));

    if ($duoi_mo_rong != "jpg" && $duoi_mo_rong != "png" && $duoi_mo_rong != "gif") {
        $OK = 0;
    }

    if ($OK) {
        move_uploaded_file($_FILES['image']['tmp_name'], $ten_file_luu);
    }

    return $OK;
}

function up_hinhchitiet()
{
    $files = $_FILES['images'];
    $file_count = count($files['name']);
    $thu_muc_luu_hinh = "../IMG/";

    for ($i = 0; $i < $file_count; $i++) {
        $filename = $files['name'][$i];
        $ten_file_luu = $thu_muc_luu_hinh . basename($files['name'][$i]);
        move_uploaded_file($files['tmp_name'][$i], $ten_file_luu);
    }
}

function tao_mang_image()
{
    $files = $_FILES['images'];
    $file_count = count($files['name']);
    $filename = "";

    for ($i = 0; $i < $file_count; $i++) {
        $filename .= $files['name'][$i] . ";";
    }

    return $filename;
}
?>
