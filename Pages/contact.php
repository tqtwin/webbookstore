<?php
require("./Database/connect-mysql.php");
$sql = "SELECT * FROM `contact`";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching category data: " . mysqli_error($conn));
}

$rows = mysqli_num_rows($result);

if ($rows) {
    $row = mysqli_fetch_assoc($result);
?>

    <style>
        .text1 {
            margin-left: 300px;
        }

        .text1 h3 {
            margin-left: 0;
        }

        li {
            margin-left: 20px;
        }
    </style>

    <div class="text1">
        Chào mừng bạn đến trang Liên Hệ của Bookstore. Chúng tôi luôn sẵn sàng lắng nghe và giải đáp mọi câu hỏi của bạn.

        <h3>Thông Tin Liên Hệ</h3>
        <li>Địa chỉ: <?php echo $row['address']; ?></li>
        <li>Email: <?php echo $row['email']; ?></li>
        <li>Số điện thoại: <?php echo $row['phone']; ?></li>

        <h3>Giờ Làm Việc</h3>
        Chúng tôi sẵn sàng phục vụ bạn trong các khung giờ sau:

        Thứ Hai - Thứ Sáu: [Giờ làm việc từ 7h- đến 17h]
        Thứ Bảy: [Giờ làm việc từ 8h- đến 17h]
        Nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ, đừng ngần ngại liên hệ với chúng tôi. Đội ngũ của chúng tôi sẽ phản hồi trong thời gian sớm nhất.

        <h3>Form Liên Hệ</h3>
        Nếu bạn muốn liên hệ trực tiếp thông qua trang web, hãy sử dụng biểu mẫu dưới đây. Hãy gửi cho chúng tôi ý kiến, đề xuất hoặc bất kỳ câu hỏi nào bạn có.

        <h3>Kết Nối Xã Hội</h3>
        Theo dõi chúng tôi trên các mạng xã hội để cập nhật thông tin mới nhất và nhận được hỗ trợ nhanh chóng.

        <li>Facebook: <a href="https://www.facebook.com" target="_blank"><?php echo $row['facebook'];?></a></li>
        <li> Twitter:<a href="https://www.facebook.com" target="_blank"><?php echo $row['twitter'];?></a></li>
        <li>Instagram: <a href="https://t.me/bookstore" target="_blank"><?php echo $row['instagram']; ?></a></li>
        Chúng tôi rất mong được phục vụ bạn và cảm ơn bạn đã lựa chọn Bookstore!
    </div>

<?php
} else {
    echo "Không có dữ liệu.";
}

// Đóng kết nối CSDL
mysqli_close($conn);
?>
