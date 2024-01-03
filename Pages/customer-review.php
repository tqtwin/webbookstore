<?php
// customer-review.php
session_start();
// Kiểm tra nếu có dữ liệu POST từ trang review

    // Lấy các giá trị từ dữ liệu POST
    $bookId = $_REQUEST['bookid'];
    $rating = $_REQUEST['rating'];
    $comment = $_REQUEST['comment'];
    $usernamerv = $_SESSION['username']; 

    // Thực hiện thêm đánh giá vào cơ sở dữ liệu
    include_once("../Database/connect-mysql.php");
    $sqlInsertReview = "INSERT INTO `review` (`bookid`, `customerid`, `rating`, `reviewtext`) 
    VALUES ('$bookId', (SELECT customerid FROM `customer` WHERE username = '$usernamerv'), '$rating', '$comment')";
    // Thực hiện truy vấn và kiểm tra kết quả
    if (mysqli_query($conn, $sqlInsertReview)) {
        echo "Đánh giá đã được thêm thành công.";
        header('../index.php');
    } else {
        echo "Lỗi: " . mysqli_error($conn);
       echo  $sqlInsertReview;
    }


?>
