<style>
   
</style>

<script>
    // Sử dụng JavaScript để thêm sự kiện click cho các mục danh sách
    const statusItems = document.querySelectorAll('.status-li');
    
    statusItems.forEach(item => {
        item.addEventListener('click', () => {
            // Loại bỏ lớp 'active' khỏi tất cả các mục
            statusItems.forEach(otherItem => {
                otherItem.classList.remove('active');
            });
            
            // Thêm lớp 'active' vào mục đang được click
            item.classList.add('active');
        });
    });
</script>

<?php
require("./Database/connect-mysql.php");

$sql = "SELECT * FROM `orderstatus`";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Lỗi lấy dữ liệu trạng thái đơn hàng: " . mysqli_error($conn));
}

$rows = mysqli_num_rows($result);

if ($rows) {
    echo '<div class="status-list">';
    echo "<ul class='status-ul'>";
    while ($row = mysqli_fetch_array($result)) {
        echo '<li class="status-li"><a href="index.php?Page=order-history&statusid=' . $row["statusid"] . '">' . $row['statusname'] . '</a></li>';
    }
    echo "</ul>";
    echo '</div>';
}

mysqli_close($conn);
?>
