
<?php
  session_start();
  if (!isset($_SESSION['usernamead']) || $_SESSION['roleid'] != '1') {
    echo '<script>alert("Vui lòng đăng nhập để vào trang này!");
        window.location="login.php";
    </script>';
    exit();
  }
?>

<?php
  // Thiết lập các giá trị ban đầu của phân trang gồm: số trang, số sp/1 trang, tổng số sp
  if (!isset($_SESSION['category'])) $_SESSION['category'] = 'Chọn loại sách';
  if (!isset($_SESSION['pagesize'])) $_SESSION['pagesize'] = 10;
  if (!isset($_SESSION['totalbook'])) {
    include_once("../Database/DBHandle.php");
    $DB = new Database();
    $result = $DB->GetData("SELECT `bookid` FROM `book`;");
    if ($result != NULL) {
      $_SESSION['totalbook'] = mysqli_num_rows($result);
    } else $_SESSION['totalbook'] = 0;
  }
  if (isset($_REQUEST['pagesize'])) $_SESSION['pagesize'] = $_REQUEST['pagesize'];
  if (isset($_REQUEST['category'])) $_SESSION['category'] = $_REQUEST['category'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Trang quản trị - shop cây cảnh online</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style type="text/css">
    body {
      background-color: #f5f5f5;
      font-family: Arial, sans-serif;
    }
    .header-ad {
        height: 60px;
        display: flex;
        justify-content: space-between;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: #fff;
        
        }
       .header-ad-icon{margin-top: 10px;
        margin-left: 20px;
        width: 210px;
   }
  
   
        .header-ad i {
            color: white;
            font-size: 20px;
            margin-right: 10px; /* Khoảng cách giữa các biểu tượng */
        }
        .header-id-account{ 
        margin-top: 10px;
        margin-right: 20px;
        width: 350px;
    }
    .header-ad-account a{margin-left: 20px;}
      .sidebar {
      height: 39vh; /* Chiều cao của thanh bên trái là 100% của chiều cao màn hình */
      width: 200px; /* Độ rộng của thanh bên trái */
      background-color: #fff;
      position: fixed; 
      top: 60px;
      left: 0;
      bottom: 20px;
     
  }
    .header-ad a {
      text-decoration: none;
      font-size: 8px;
      margin-top: 5px;
    }

/* CSS chung áp dụng cho tất cả ul */
.ul1 {
  list-style: none;
  margin: 0;
  padding: 0;
  
  align-items: center;
}

/* CSS cho ul với lớp .menubar */
ul.menubar-ad {
  /* Thêm hoặc sửa đổi các thuộc tính CSS dành riêng cho .menubar */
  
  border-radius: 10px;
}
/* CSS cho các mục trong .menubar */
ul.menubar-ad li {
  margin-left: 20px;
}
/* CSS cho các liên kết trong .menubar */
ul.menubar-ad li a {
  color: #fff;
  text-decoration: none;
  position: relative;
  font-size: 18px; 
  display: block;
}

/* CSS cho hiệu ứng hover của liên kết trong .menubar */
ul.menubar-ad li a:hover::after {
  transform-origin: bottom left;
  transform: scaleX(1);
}

/* CSS cho dạng đường gạch dưới của liên kết trong .menubar */
ul.menubar-ad li a::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 4px;
  background-color: #FEFEFE;
  transform-origin: bottom right;
  transition: transform 0.5s ease;
  transform: scaleX(0);
}


/* Nếu muốn chỉ áp dụng cho .menubar trong .header */
.header-ad ul.menubar {
  /* Thêm hoặc sửa đổi các thuộc tính CSS dành riêng cho .menubar trong .header */
  border-bottom: 1px solid #ddd;
  padding: 18px;
}
  </style>
</head>
<body>
<div class="header-ad">
        <div class="header-ad-icon">
        <i class="fa fa-bars" aria-hidden="true" style="color: black; font-size:30px;"></i>
        <a href="index.php"><img src="./IMG/bookstore.jpg" alt="" width="55%"></a>
        </div>
</div>
      <div class="header-ad-account"> 
        <?php   if(isset($_SESSION['usernamead']))
        {
        echo '
       <a href="?Page=acount">
       <img src="" height="40px" width="40px" style="border-radius: 50%;" alt="" > '.$_SESSION['usernamead'].'</a></li>';
        }
        else if(isset($_SESSION['emailad']))
        echo '
        <a href="?Page=acount">
        <img src="'.$_SESSION['google_picture_link'].'" height="40px" width="40px" style="border-radius: 50%;" alt="">'.$_SESSION['emailad'],$_SESSION['google_name'].'</a></li>';
      
        else{
            echo'<a href="?Page=signup"><span style="color: black; font-size:15px;">Đăng ký</a> <a href="?Page=login"><span style="color: black; font-size:15px;">Đăng nhập</a>';
        }
        ?>
        </span> 
      </div>
</div>
<div class="sidebar-ad">
  <li class="menubar-ad ul1">
  <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Tài khoản</button>
          <div class="dropdown-menu">
          <a class="" href="?Page=user" class="menu-button <?php if($current_page == "user") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Quản lý tài khoản</button>
          </a>
          <a class="" href="../Admin/customer-logout.php" class="menu-button">
            <button type="button" class="btn btn-primary" style="width: 200px;">Đăng xuất</button>
          </a>
          <a class="" href="?Page=change-password" class="menu-button <?php if($current_page == "change-password") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Đổi mật khẩu</button>
          </a>
          <a class=" dropdown-item" href="?Page=update-info" class="menu-button <?php if($current_page == "update-info") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Cập nhật thông tin</button>
          </a>
        </div>
  </li>
  <li class="">
        <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Danh mục</button> 
          <div class="dropdown-menu">
         
          <a class="nav-link dropdown-item" href="?Page=category" class="menu-button <?php if($current_page == "category") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Danh mục sách</button>
          </a>
          <a class="nav-link dropdown-item" href="?Page=item" class="menu-button <?php if($current_page == "item") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Sách</button>
          </a>
        </div>
  </li>
  <li class="">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Bán hàng</button>
          <a class="nav-link dropdown-item" href="?Page=status" class="menu-button <?php if($current_page == "status") echo 'selected'; ?>">
          <div class="dropdown-menu">

            <button type="button" class="btn btn-primary" style="width: 200px;">Danh mục trạng thái</button>
          </a>
          <a class="nav-link dropdown-item" href="?Page=order" class="menu-button <?php if($current_page == "order") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Xử lý đơn hàng</button>
          </a>
        </div>
    </div>
  </li>
  <li class="">
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Thống kê</button>
            <div class="dropdown-menu">
          <a class="nav-link dropdown-item" href="?Page=doanh-thu" class="menu-button <?php if($current_page == "doanh-thu") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Doanh thu</button>
          </a>
          <a class="nav-link dropdown-item" href="?Page=san-pham-ban-chay" class="menu-button <?php if($current_page == "san-pham-ban-chay") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Sản phẩm bán chạy</button>
          </a>
        </div>
      </div>
  </li>
  </ul>

</div>
      <div class="col-sm-10">
        <?php
           if(isset($_REQUEST['Page'])){
            if($_REQUEST['Page']=="item")
              include("item.php");
            else if($_REQUEST['Page']=="order")
              include("order.php");
            else if($_REQUEST['Page']=="item-add")
              include("item-add.php");
            else if($_REQUEST['Page']=="order-detail")
              include("order-detail.php");
            else if($_REQUEST['Page']=="category")
              include("category.php");
            else if($_REQUEST['Page']=="user")
              include("user.php");
            else if($_REQUEST['Page']=="change-password")
              include("change-password.php");
            else if($_REQUEST['Page']=="item-edit")
              include("item-edit.php");
            else if($_REQUEST['Page']=="add-user")
              include("add-user.php");
              else if($_REQUEST['Page']=="category-update")
              include("category-update.php");
            else if($_REQUEST['Page']=="doanh-thu")
              include("doanh-thu.php");
            else if($_REQUEST['Page']=="san-pham-ban-chay")
              include("san-pham-ban-chay.php");
              else if($_REQUEST['Page']=="status")
              include("status.php");
              else if($_REQUEST['Page']=="update-info")
              include("update-info.php");
          }
        ?>
      </div>
    </div>
    
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Bắt sự kiện khi một phần được chọn
    $(".menu-button").click(function() {
        // Loại bỏ lớp "selected" từ tất cả các phần khác
        $(".menu-button").removeClass("selected");
        // Thêm lớp "selected" vào phần đang được chọn
        $(this).addClass("selected");
    });
});
</script>
</html>
