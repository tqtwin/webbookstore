<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>My Header</title>
  <style>
  
    .container {
        width: 100%;
        max-width: 1517px;
        height: 190px;
        margin: 0 auto;
        display: flex;
    }
    .right-col{display: flex;
        justify-content: space-between;
        padding: 10px;
        width: 70%;
        margin-top: 100px;
       
    }
    .left-col {
        width: 30%;
        float: left;
        margin-top: 100px;
      }
      .bg2 {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
.bg2 h1,
.bg2 a {
  display: inline-block;
  margin: 0;
}
.bg2 a {
  color: #007bff; /* Màu của liên kết, có thể thay đổi theo ý muốn */
}
.bg3{ display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

      
      }
    @media (max-width: 768px) {
      .container {
        width: 100%;
      }
      
      .left-col {
        width: 30%;
        float: left;
      }
      .right-col {
        width: 70%;
        float: right;
      }
      .phude{text-align: center;
      margin-top: 20px;
   }
    .img-header{max-width: auto;}
    }
  </style>
</head>

<body>
  <header>
 
  <?php  
    if(isset($_REQUEST['Page'])){
        if ($_REQUEST['Page'] == "introduce"){
        echo '
      <div class="bg2">
        <h1>GIỚI THIỆU</h1><br>
       <div> <a href="./Index.php">TRANG CHỦ </a> <i class="fa fa-chevron-right" aria-hidden="true"></i> GIỚI THIỆU</div>
    </div>';}
      else if ($_REQUEST['Page'] == "contact"){
        echo '
      <div class="bg2">
        <h1>LIÊN HỆ</h1><br>
      <div> <a href="./Index.php">TRANG CHỦ </a> <i class="fa fa-chevron-right" aria-hidden="true"></i> LIÊN HỆ</div>
    </div>';}
  //   else if ($_REQUEST['Page'] == "acount"){
  //     echo '
  //   <div class="bg2">
  //     <h1>TÀI KHOẢN</h1><br>
  //   <div> <a href="./Index.php">TRANG CHỦ </a> <i class="fa fa-chevron-right" aria-hidden="true"></i> TÀI KHOẢN</div>
  // </div>';}
          else if ($_REQUEST['Page'] == "cart"){
            echo '
          <div class="bg2">
            <h1>GIỎ HÀNG</h1><br>
          <div> <a href="./Index.php">TRANG CHỦ </a> <i class="fa fa-chevron-right" aria-hidden="true"></i> GIỎ HÀNG</div>
        </div>';
        } else if ($_REQUEST['Page'] == "signup"){
          echo '
        <div class="bg2">
          <h1>ĐĂNG KÝ</h1><br>
        <div> <a href="./Index.php">TRANG CHỦ </a> <i class="fa fa-chevron-right" aria-hidden="true"></i> ĐĂNG KÝ</div>
        <h3>Đăng ký ngay 1 tài khoản để nhận được những ưu đãi</h3>
        </div>';
        }
        // else if ($_REQUEST['Page'] == "login"){
        //   echo '
        // <div class="bg2">
        //   <h1>ĐĂNG NHẬP</h1><br>
        // <div> <a href="./Index.php">TRANG CHỦ </a> <i class="fa fa-chevron-right" aria-hidden="true"></i> ĐĂNG KÝ</div>
        // </div>';
        // }
          
         }
    else if (isset($_REQUEST['bookid'])) {
          // Xử lý khi có bookid
          $bookid = $_REQUEST['bookid'];
          echo '
          <div class="bg3">
        </div>';
         
        }
      else {echo '<div id="background" class="">
         <img src="./IMG/Lop1.png" alt="Hình nền" >
         <h1>Sách là tri thức, sách là cuộc sống</h1>
         <p>Hãy đến và khám phá trí não của bạn. Chưa bao giờ dễ dàng hơn để loại bỏ căng thẳng và các yếu tố có hại xung quanh bạn mỗi ngày!</p>
     </div>';}
    ?>
  
</body>
</html>
