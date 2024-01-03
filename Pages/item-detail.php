<header>
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</header>
<style>
  .book-detail {
    width: 990px;
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    margin-top: 140px;
    border: 1px solid red;
  }

  .docthem {
    width: 990px;
    max-width: 1200px;
    
  }

  .book-left {
    width: 40%;
  }

  .book-right {
    width: 60%
  }

  .image-container {
    position: relative;
    display: inline-block;
    overflow: hidden;
    border-radius: 8px 0 0 8px;
    /* Góc bo tròn chỉ ở góc trái */
    max-width: 100%;
    /* Đảm bảo .image-container không rộng hơn cha nó */
    width: 500px;
  }

  .discount-badge {
    position: absolute;
    top: 0;
    right: 0;
    width: 50px;
    height: 50px;
    background-color: red;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 14px;
  }

  .image-container img {
    width: 70%;
    height: 500px;
    border-radius: 8px 0 0 8px;
  }

  .button {
    margin-top: 10px;
    
  }

  .custom-btn {
    width: 130px;
    height: 40px;
    color: #fff;
    border-radius: 5px;
    padding: 10px 25px;
    font-family: 'Lato', sans-serif;
    font-weight: 500;
    background: transparent;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
    box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5),
      7px 7px 20px 0px rgba(0, 0, 0, .1),
      4px 4px 5px 0px rgba(0, 0, 0, .1);
    outline: none;
  }

  /* 8 */
  .btn-8 {
    background-color: #f0ecfc;
    background-image: linear-gradient(315deg, #f0ecfc 0%, #c797eb 74%);
    line-height: 42px;
    padding: 0;
    border: none;
  }

  .btn-8 span {
    position: relative;
    display: block;
    width: 100%;
    height: 100%;
  }

  .btn-8:before,
  .btn-8:after {
    position: absolute;
    content: "";
    right: 0;
    bottom: 0;
    background: #c797eb;
    /* box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.5),
    inset 4px 4px 6px 0 rgba(116, 125, 136, .3); */
    transition: all 0.3s ease;
  }

  .btn-8:before {
    height: 0%;
    width: 2px;
  }

  .btn-8:after {
    width: 0%;
    height: 2px;
  }

  .btn-8:hover:before {
    height: 100%;
  }

  .btn-8:hover:after {
    width: 100%;
  }

  .btn-8:hover {
    background: transparent;
  }

  .btn-8 span:hover {
    color: #c797eb;
  }

  .btn-8 span:before,
  .btn-8 span:after {
    position: absolute;
    content: "";
    left: 0;
    top: 0;
    background: #c797eb;
    /*box-shadow:  4px 4px 6px 0 rgba(255,255,255,.5),
              -4px -4px 6px 0 rgba(116, 125, 136, .2), 
    inset -4px -4px 6px 0 rgba(255,255,255,.5),
    inset 4px 4px 6px 0 rgba(116, 125, 136, .3);*/
    transition: all 0.3s ease;
  }

  .btn-8 span:before {
    width: 2px;
    height: 0%;
  }

  .btn-8 span:after {
    height: 2px;
    width: 0%;
  }

  .btn-8 span:hover:before {
    height: 100%;
  }

  .btn-8 span:hover:after {
    width: 100%;
  }

  .btn-14 {
    background: rgb(255, 151, 0);
    border: none;
    width: auto;
    z-index: 1;
  }

  .btn-14:after {
    position: absolute;
    content: "";
    width: 100%;
    height: 0;
    top: 0;
    left: 0;
    z-index: -1;
    border-radius: 5px;
    background-color: #eaf818;
    background-image: linear-gradient(315deg, #eaf818 0%, #f6fc9c 74%);
    box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5),
      7px 7px 20px 0px rgba(0, 0, 0, .1),
      4px 4px 5px 0px rgba(0, 0, 0, .1);
    transition: all 0.3s ease;
  }

  .btn-14:hover {
    color: #000;
  }

  .btn-14:hover:after {
    top: auto;
    bottom: 0;
    height: 100%;
  }

  .btn-14:active {
    top: 2px;
  }

  /* 13 */
  .btn-13 {
    background-color: #89d8d3;
    background-image: linear-gradient(315deg, #89d8d3 0%, #03c8a8 74%);
    border: none;
    z-index: 1;
  }

  .btn-13:after {
    position: absolute;
    content: "";
    width: 100%;
    height: 0;
    bottom: 0;
    left: 0;
    z-index: -1;
    border-radius: 5px;
    background-color: #4dccc6;
    background-image: linear-gradient(315deg, #4dccc6 0%, #96e4df 74%);
    box-shadow:
      -7px -7px 20px 0px #fff9,
      -4px -4px 5px 0px #fff9,
      7px 7px 20px 0px #0002,
      4px 4px 5px 0px #0001;
    transition: all 0.3s ease;
  }

  .btn-13:hover {
    color: #fff;
  }

  .btn-13:hover:after {
    top: 0;
    height: 100%;
  }

  .btn-13:active {
    top: 2px;
  }
</style>

<?php
require("./Database/connect-mysql.php");


if (isset($_REQUEST['bookid'])) {
  $bookid = mysqli_real_escape_string($conn, $_REQUEST['bookid']);

  $sql = "SELECT b.*, a.authorname FROM `book` b
            JOIN `author` a ON b.authorid = a.authorid
            WHERE b.`bookid` = '$bookid'";

  // Execute the query
  $result = mysqli_query($conn, $sql);

  if (!$result) {
    die("Lỗi lấy dữ liệu sách, lỗi: " . mysqli_error($conn));
  }

  echo '</div>';
  while ($row = mysqli_fetch_array($result)) {

    echo '</div>';
    echo ' <div class="book-detail" >';
    echo '<div class="book-left">';

    // Kiểm tra xem có giảm giá hay không
    if ($row['sale'] > 0) {
      echo '<div class="image-container">';
      echo '<div class="discount-badge">';
      echo '<span>-' . round($row['sale'] * 100) . '%</span>';
      echo '</div>';
      echo '<img   src="./IMG/' . htmlspecialchars($row['image']) . '" alt="Hình sách" style="width:100%">';
      echo '</div>';
      echo '</div>';
    } else {
      echo '<div class="image-container">';

      echo '<img   src="./IMG/' . htmlspecialchars($row['image']) . '" alt="Hình sách" style="width:100%">';
      echo '</div>';
      echo '</div>';
    }


    echo '<div class"book-right" style="flex: 1; padding: 15px;">';
    echo '<h5  style=" font-size: 30px;">' . htmlspecialchars($row['title']) . '</h5>';
    if ($row['sale'] > 0) {
      $discountedPrice = $row['price'] * (1 - $row['sale']);
      echo '<h5  style="color: red;"> Giá bán:<del>' . number_format($row['price']) . 'VNĐ</del> ' . number_format($discountedPrice) . 'VNĐ</h5>';
    } else {
      echo '<h5> Giá bán:<span style="color: red;">' . number_format($row['price']) . 'VNĐ</h5>';
    }
    if ($row['quantity'] > 5) {
      echo '<h5  style="color: green;"><i class="fa fa-check-square-o" aria-hidden="true"></i>Còn hàng</h5> ';
    } else {
      echo '<h5  style="color: red;">Số lượng ít</h5>';
    }
    echo '<p  style="text-align:left;"><b>Tác giả:</b> ' . htmlspecialchars($row['authorname']) . '</p>';
    echo '<p style="text-align:left;"><b>Nhà xuất bản:</b> ' . htmlspecialchars($row['publisher']) . '</p>';
    echo '<p style="text-align:left;"><b>Ngày phát hành:</b> ' . htmlspecialchars($row['release_date']) . '</p>';
    echo '<p style="text-align:left;"><b>Số trang:</b> ' . htmlspecialchars($row['num_pages']) . '</p>';
    echo '<form method="post" action="Pages/add-cart.php">';
    echo '<div class="form-group">';
    echo '<label for="quantity"><b>Số lượng</b>:</label>';
    echo '<input type="number" name="quantity" id="quantity" min="0" value="1">';
    echo '</div>';
    echo '<input type="hidden" name="bookid" value="' . $row['bookid'] . '">';
    echo '<input type="hidden" name="title" value="' . $row['title'] . '">';
    echo '<input type="hidden" name="image" value="' . $row['image'] . '">';
    echo '<input type="hidden" name="price" value="' . $row['price'] . '">';
    if ($row['quantity'] <= 0) {
      echo '<p  style="text-align:left;">Sản phẩm đang hết hàng vui lòng chờ cửa hàng nhập ';
    } else {
      echo '<button type="submit" class="custom-btn btn-14" style="margin-top: 15px;">Thêm vào giỏ hàng</button><button class="custom-btn btn-13" 
        onclick="goToCart()" style="margin-top: 15px;margin-left: 15px">Mua ngay</button>';
    }
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="button">
        <button class="custom-btn btn-8" onclick="toggleSection(\'descriptionSection\')"><span>Giới thiệu</span></button>
        <button class="custom-btn btn-8" onclick="toggleSection(\'reviewsSection\')"><span>Đánh giá</span></button>
    </div>
    <hr>';
    echo '<div class="docthem" id="descriptionSection">
        <h3> Giới Thiệu </h3>
        <p style="text-align:left;">' . nl2br($row['description']) . '</p>
    </div>';
    echo '<div class="docthem" id="reviewsSection" style="display: none;">';
    include_once("Pages/review.php");
    echo ' </div>';
  }
  mysqli_close($conn);
} else {
  echo "Không có 'bookid' nào được hiện lên.";
}

?>
<script>
  function toggleSection(sectionId) {
    var sections = ['descriptionSection', 'reviewsSection'];

    sections.forEach(function(section) {
      var element = document.getElementById(section);
      if (section === sectionId) {
        element.style.display = 'block';
      } else {
        element.style.display = 'none';
      }
    });
  }

  function goToCart() {
    window.location = 'Pages/cart.php';
  }
</script>