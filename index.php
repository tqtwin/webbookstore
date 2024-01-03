<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nhà Sách Online uy tín hàng đầu VN</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./CSS/index.css">
  <style>

  </style>
</head>

<body>
  <?php
  session_start();

  // include_once ("./Pages/header.php");
  ?>
  <header>
    <?php include_once("./Pages/menubar.php"); ?></header>
  <div style=" display:flex;">
    <div class="col-sm-15">
      <div class="container">
        <?php
        if (isset($_REQUEST['Page'])) {
          if ($_REQUEST['Page'] == "signup")
            include_once("Pages/signup.php");
          else if ($_REQUEST['Page'] == "login")
            include_once("Pages/login.php");
          else if ($_REQUEST['Page'] == "cart")
            include_once("Pages/cart.php");
          else if ($_REQUEST['Page'] == "change-acount")
            include_once("Pages/change-acount.php");
          else if ($_REQUEST['Page'] == "order-history")
            include_once("Pages/order-history.php");
          else if ($_REQUEST['Page'] == "acount")
            include_once("Pages/acount.php");
          else if ($_REQUEST['Page'] == "introduce")
            include_once("Pages/introduce.php");
          else if ($_REQUEST['Page'] == "contact")
            include_once("Pages/contact.php");
          else if ($_REQUEST['Page'] == "forgot-password")
            include_once("Pages/forgot-password.php");
          else if ($_REQUEST['Page'] == "reset-password")
            include_once("Pages/reset-password.php");
          else
            include_once("Pages/item.php");
        } else {
          if (isset($_REQUEST['bookid']))
            include_once("./Pages/item-detail.php");
          else if (isset($_REQUEST['keyvalue']))
            include_once("./Pages/item-search.php");
          else
            include_once("./Pages/item.php");
        }
        ?>



      </div>
    </div>
  </div>

  </div>
  </div>
  <footer>
    <?php include_once("./Pages/footer.php")
    ?>
  </footer>
</body>

</html>