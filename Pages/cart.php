<style>
  .cart {
    margin-left: 200px;
    width: 1200px;
    margin-top: 110px;
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
</style>

<div class="cart">
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th>Sản Phẩm</th>
        <th>Hình ảnh</th>
        <th>Số lượng</th>
        <th>Giá tiền</th>
        <th>Thành tiền</th>
        <th>Xử lý</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($_SESSION['cart'])) {
        $tongtien = 0;
        foreach ($_SESSION['cart'] as $key => $value) {
          echo "<tr>";
          echo '<td>' . $value['title'] . '</td>';
          echo '<td><img src="./IMG/' . $value['image'] . '" height="50px" width="50px"></td>';
          echo '<td><input type="number" name="quantity" min="0" value="' . $value['quantity'] . '"onclick="edit_quantity(' . $key . ',this.value);"></td>';
          echo '<td>' . number_format($value['price']) . '</td>';
          $thanhtien = $value['quantity'] * $value['price'];
          $tongtien += $thanhtien;
          echo '<td>' . number_format($thanhtien) . '</td>';
          echo '<td><a href="Pages/cart-delete.php?bookid=' . $key . '">Xóa</a></td>';
          echo "</tr>";
        }
        echo '<tr><td colspan="4" align="left">Mã giảm giá <input type="text"><button type="submit" class="custom-btn btn-14">Áp dụng mã giảm giá</button></td>';

        echo ' <tr><td colspan="4" align="right">Tổng tiền giỏ hàng:</td>
            <td align="right">' . number_format($tongtien) . '</td><td></td></tr>';
        echo ' <tr><td colspan="6" align="right"><button type="button" class="btn btn-success" onclick="show_div(' . $_SESSION['cart_amount'] . ')">Đặt hàng</button>
            <a href="./index.php"><button type="button" class="btn btn-primary">Tiếp tục mua hàng</button></a>
            <a href="Pages/cart-clear.php"><button type="button" class="btn btn-danger">Xóa Tất Cả</button></a></td></tr>';
      }
      ?>
    </tbody>
  </table>
  <div class="thongtinnhanhang">
    <div id="div_thongtinnhanhang" style="display: none;">
      <h4>Thông tin nhận hàng</h4>
      <form action="./Pages/order.php" class="was-validated">
        <div class="form-group">
          <label for="recipientname">Tên người nhận:</label>
          <input type="text" class="form-control" id="recipientname" name="recipientname" placeholder="Nhập tên người nhận hàng" value="<?php if (isset($_SESSION['name'])) echo $_SESSION['name']; ?>" required>
          <div class="valid-feedback">Ok</div>
          <div class="invalid-feedback">Vui lòng điền tên người nhận.</div>
        </div>
        <div class="form-group">
          <label for="phone">Số điện thoại:</label>
          <input type="tel" class="form-control" id="phone" name="phone" placeholder="0123456789" pattern="[0-9]{10}" maxlength=10 value="<?php if (isset($_SESSION['phone'])) echo $_SESSION['phone']; ?>" required>
          <div class="valid-feedback">Ok</div>
          <div class="invalid-feedback">Vui lòng nhập điện thoại.</div>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="email@gmail.com" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email']; ?>" required>
          <div class="valid-feedback">Ok</div>
          <div class="invalid-feedback">Vui lòng nhập email.</div>
        </div>
        <div class="form-group">
          <label for="address">Địa chỉ giao hàng:</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ giao hàng" value="<?php if (isset($_SESSION['address'])) echo $_SESSION['address']; ?>" required>
          <div class="valid-feedback">Ok</div>
          <div class="invalid-feedback">Vui lòng nhập địa chỉ giao hàng.</div>
        </div>
        <div class="form-group">
          <label for="note">Ghi chú (nếu có):</label>
          <input type="text" class="form-control" id="note" name="note">
        </div>

        <button type="submit" class="btn btn-success" style="float: right;">Đồng ý đặt hàng</button>
      </form><a href="./index.php"><button type="reset" class="btn btn-primary" style="float: right;">Bỏ qua</button></a>
    </div>
  </div>

</div>
<script>
  function edit_quantity(bookid, new_quantity) {
    window.location = "Pages/cart-edit.php?bookid=" + bookid + "&quantity=" + new_quantity;
  }

  function show_div(cart_amount) {
    let div = document.getElementById('div_thongtinnhanhang');
    if (cart_amount != 0 && div.style.display == "none")
      div.style.display = "block";
    else
      div.style.display = "none";
  }
</script>