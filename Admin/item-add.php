<h4>Thêm cây cảnh</h4>
<form action="item-save.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
  <label for="itemid">Mã sách:</label>
<input type="text" class="form-control" id="itemid" name="itemid" required>

<label for="itemname">Tên sách:</label>
<input type="text" class="form-control" id="itemname" name="title" required>

<label for="description">Mô tả chi tiết:</label>
<textarea class="form-control" id="description" name="description" rows="6"></textarea>

<label for="unit">Đơn vị tính:</label>
<input type="text" class="form-control" id="unit" name="unit">

<label for="price">Giá bán:</label>
<input type="number" class="form-control" id="price" name="price">

<label for="categoryid">Phân loại:</label>
<select class="form-control" id="categoryid" name="categoryid">
  <option value="-1">Chọn phân loại</option>
  <?php
  include_once("../Database/DBHandle.php");
  $DB = new Database();
  $sql = "SELECT * FROM `category`";
  $result = $DB->GetData($sql);
  if ($result != NULL) {
    $rows = mysqli_num_rows($result);
    if ($rows) {
      while ($row = mysqli_fetch_array($result)) {
        echo '<option value="' . $row['categoryid'] . '">' . $row['categoryname'] . '</option>';
      }
    }
  }
  ?>
</select>

<label for="image">Ảnh đại diện:</label>
<input type="file" class="form-control" id="image" name="image" title="Chọn ảnh đại diện">

<label for="images">Các ảnh chi tiết:</label>
<input type="file" class="form-control" id="images" name="images[]" title="Chọn các ảnh chi tiết" multiple>

<button type="submit" class="btn btn-success" name="save">Lưu lại</button>
<button type="reset" class="btn btn-secondary" name="cancel" onclick="document.location='index.php?Page=item';">Bỏ qua</button>
</form>

