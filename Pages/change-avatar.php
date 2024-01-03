<form action="Pages/customer-change-avatar.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="current-avatar">Avatar hiện tại:</label>
    <img src="./IMG/<?php echo $_SESSION['avatar']; ?>" alt="Current Avatar" width="100" id="avatar" name="avatar">
  </div>
  <div class="form-group">
    <label for="newavatar">Ảnh đại diện mới:</label>
    <input type="file" class="form-control" id="avatarmoi" name="avatarmoi" placeholder="Ảnh đại diện mới">
  </div>
  <button type="submit" class="btn btn-primary">Đồng ý</button>
</form>
