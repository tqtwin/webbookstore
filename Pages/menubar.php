<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
       .header {
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
       .header-icon{margin-top: 10px;
        margin-left: 20px;
        width: 210px;
   }
  
   .search {
        position: relative;
        margin-top: 10px;
        margin-left: 20px;
        width: 550px;
    }
      .search input[type="text"] {
          padding-right: 40px; /* Adjust the padding to leave space for the button */
      }

      .search button {
          position: absolute;
          right: 0;
          top: 0;
          bottom: 0;
          background-color: transparent;
          border: none;
          cursor: pointer;
          outline: none;
      }
        .header i {
            color: white;
            font-size: 20px;
            margin-right: 10px; /* Khoảng cách giữa các biểu tượng */
        }
        .header-account{ 
        margin-top: 10px;
        margin-right: 20px;
        width: 350px;
    }
    .header-account a{margin-left: 20px;}
      .sidebar {
      height: 39vh; /* Chiều cao của thanh bên trái là 100% của chiều cao màn hình */
      width: 200px; /* Độ rộng của thanh bên trái */
      background-color: #fff;
      position: fixed; 
      top: 60px;
      left: 0;
      bottom: 20px;
     
  }
    .header a {
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
ul.menubar {
  /* Thêm hoặc sửa đổi các thuộc tính CSS dành riêng cho .menubar */
  
  border-radius: 10px;
}
/* CSS cho các mục trong .menubar */
ul.menubar li {
  margin-left: 20px;
}
/* CSS cho các liên kết trong .menubar */
ul.menubar li a {
  color: #fff;
  text-decoration: none;
  position: relative;
  font-size: 18px;
  display: block;
}

/* CSS cho hiệu ứng hover của liên kết trong .menubar */
ul.menubar li a:hover::after {
  transform-origin: bottom left;
  transform: scaleX(1);
}

/* CSS cho dạng đường gạch dưới của liên kết trong .menubar */
ul.menubar li a::after {
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
.header ul.menubar {
  /* Thêm hoặc sửa đổi các thuộc tính CSS dành riêng cho .menubar trong .header */
  border-bottom: 1px solid #ddd;
  padding: 18px;
}
  </style>
</head>
<body>
<div class="header">
        <div class="header-icon">
          <i class="fa fa-bars" aria-hidden="true" style="color: black; font-size:30px;"></i>
          <a href="index.php"><img src="./IMG/bookstore.jpg" alt="" width="55%"></a>
        </div>
        <div class="search">
    <form action="Pages/key-search.php" method="post" class="input-group">  
        <input type="text" name="txtkey" class="form-control" placeholder="Tìm kiếm" size="50" style="border-radius: 20px;">
        <button type="submit" name="btTim" value="Tìm">
            <i class="fa fa-search" aria-hidden="true" style="color: black; font-size: 20px;"></i>
        </button>
    </form>
</div>
      <div class="header-account"> 
        <a href="?Page=cart">
          <i class="fa fa-shopping-cart" aria-hidden="true" style="color: black; font-size:30px;"></i>
          <span style="color: red;font-size:15px;">
            <?php
            if (isset($_SESSION['cart_amount'])) echo $_SESSION['cart_amount'];
            else echo 0;
            ?>
          </span><span style="color: black; font-size:15px;"> Sản phẩm</a>
        <span>
        <?php   if(isset($_SESSION['username']))
        {
        echo '
       <a href="?Page=acount" style="font-size:15px; color:black;">
       <img src="./IMG-customer/'.$_SESSION['avatar'].'" height="40px" width="40px" style="border-radius: 50%;" margin-right:5px" alt="" > '.$_SESSION['username'].'</a></li>';
        }
        else if(isset($_SESSION['email']))
        echo '
        <a href="?Page=acount" style="font-size:15px; color:black;">
        <img src="'.$_SESSION['google_picture_link'].'" height="40px" width="40px" style="border-radius: 50%; margin-right:5px" alt="" >'.$_SESSION['google_name'].'</a></li>';
      
        else{
            echo'<a href="?Page=signup"><span style="color: black; font-size:15px;">Đăng ký</a> <a href="?Page=login"><span style="color: black; font-size:15px;">Đăng nhập</a>';
        }
        ?>
        </span> 
      </div>
</div>
  <div class="sidebar">
    <ul class="menubar ul1">

      <li><a href="index.php"><i class="fa fa-home" aria-hidden="true" style="color: black; font-size:30px;"></i><span style="margin-left: 20px; color:black">Trang chủ</span></a></li>  
      <li><a href="?Page=introduce"><i class="fa fa-info-circle" aria-hidden="true" style="color: black; font-size:30px;"></i><span style="margin-left: 20px;color:black"> Giới thiệu</a></li>
   <hr>
    <li>
    <h5>Sản phẩm bán chạy</h5> 
    <?php include_once("menu-san-pham.php"); ?> </li>
    </ul>
  </div>
</body>
</html>
