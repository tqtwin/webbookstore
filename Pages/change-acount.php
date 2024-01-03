<style>.change-acount{
 margin-left: 200px;
 margin-top: 100px;
 width: 1200px;
 height: 550px;

background-color: #f5f5f5;
 display: flex;
}
.left-change{width: 50%;}
.right-change{width: 50%;  }
</style>
<div class="change-acount">
  <div class="left-change">
<form action="Control/customer-change-address.php" method="post" class="was-validated" enctype="multipart/form-data">
<h1>Thông tin mặc định</h1>
        <div class="form-group">
          <label for="recipientname">Họ và tên:</label>
          <input type="text" class="form-control" id="recipientname" name="recipientname" placeholder="Nhập tên người nhận hàng" 
          value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name']; else if(isset($_SESSION['google_name']))echo $_SESSION['google_name']; ?>" required>
          <div class="valid-feedback">Ok</div>
          <div class="invalid-feedback">Vui lòng điền tên người dùng.</div>
        </div>
        <div class="form-group">
          <label for="phone">Số điện thoại:</label>
          <input type="tel" class="form-control" id="phone" name="phone" placeholder="" pattern="[0-9]{10}" maxlength=10 value="<?php if(isset($_SESSION['phone'])) echo $_SESSION['phone']; ?>" >
          <div class="valid-feedback">Ok</div>
          <div class="invalid-feedback">Vui lòng nhập điện thoại.</div>
        </div>
        <div class="form-group">
          <label for="phone">Email:</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="email@gmail.com"  value="<?php if(isset($_SESSION['email'])) echo Anthongtin($_SESSION['email']); ?>" readonly>
          <div class="valid-feedback">Ok</div>
          <div class="invalid-feedback">Vui lòng nhập email.</div>
        </div>
        <div class="form-group">
          <label for="address">Địa chỉ giao hàng:</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ giao hàng" 
          value="<?php if(isset($_SESSION['address'])) echo $_SESSION['address']; ?>" required>
          <div class="valid-feedback">Ok</div>
          <div class="invalid-feedback">Vui lòng nhập địa chỉ giao hàng.</div>
        </div>
        <div>
          <button type="submit" class="btn btn-success" style="float: right;">Lưu thay đổi</button>
      <a href="./index.php"><button type="reset" class="btn btn-primary" style="float: right;">reset</button></a></div>
        </div>
       <div class="right-change">
          <div style="margin-top: 200px; margin-left:150px">
            <label for="avatar">Ảnh đại diện:</label> 
            <?php if(isset($_SESSION['avatar']))
           echo' <img src="./IMG-customer/'.$_SESSION['avatar'].'" width="100px" height="150px" alt="'.$_SESSION['username'].'">';
          else if(isset($_SESSION['google_piture_link']))
          echo $_SESSION['google_piture_link'];
          ?>
            <input type="file" class="form-control" id="avatarmoi" name="avatarmoi" placeholder="Ảnh đại diện mới">
            </form>
            </div>  
        </div>  
  </div>
<script><?php
function Anthongtin($soDienThoai) {
    $doDai = strlen($soDienThoai);

    if ($doDai < 4) {
        return $soDienThoai;
    }
    $soKyTuCanCheGiau = $doDai - 4;
    $soDau = substr($soDienThoai, 0, 2);
    $soCuoi = substr($soDienThoai, -2);

    $chuoiMoi = $soDau . str_repeat('*', $soKyTuCanCheGiau) . $soCuoi;

    return $chuoiMoi;
}
?>
</script>


