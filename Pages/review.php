<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .danhgia-all {
      width: 990px;
      display: flex;
      border: 1px solid red;
    }

    .danhgia-left {
      width: 50%;
      background-color: #F5F5F7;
    }

    .danhgia-right {
      width: 50%;
      background-color: #F5F5F7;
    }

    .container2 {
      background-image: url("https://www.toptal.com/designers/subtlepatterns/patterns/concrete-texture.png");
      display: flex;
      flex-wrap: wrap;
    }

    .rating {
      display: inline-block;
      position: relative;
      height: 25px;
      bottom: 15px;
      font-size: 30px;
    }

    .rating label {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      cursor: pointer;
    }

    .rating label:last-child {
      position: static;
    }

    .rating label:nth-child(1) {
      z-index: 5;
    }

    .rating label:nth-child(2) {
      z-index: 4;
    }

    .rating label:nth-child(3) {
      z-index: 3;
    }

    .rating label:nth-child(4) {
      z-index: 2;
    }

    .rating label:nth-child(5) {
      z-index: 1;
    }

    .rating label input {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
    }

    .rating label .icon {
      float: left;
      color: transparent;
    }

    .rating label:last-child .icon {
      color: #000;
    }

    .rating:not(:hover) label input:checked~.icon,
    .rating:hover label:hover input~.icon {
      color:
        #ffd203;
    }

    .rating label input:focus:not(:checked)~.icon:last-child {
      color: #000;
      text-shadow: 0 0 5px #09f;
    }

    .review-stars {
      display: block;
      position: relative;
      width: 180px;
      margin-left: 100px;
      height: 25px;
      user-select: none;
      background: var(--stars);
      --stars: url("http://www.harborsailboats.com/wp-content/uploads/2017/04/5a36f9d97d0d54f0a186b4d7fb742ad3_five-stars-salon-review-google-5-star-review-clipart_3000-700.png") right/auto 100% no-repeat;

      &:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        right: 0;
        width: 0%;
        height: 100%;
        background: var(--stars);
        filter: grayscale(1);
      }

      &[data-stars="4.5"]:after {
        width: 7%;
      }

      &[data-stars="4"]:after {
        width: 13%;
      }

      &[data-stars="3.5"]:after {
        width: 17.9%;
      }

      &[data-stars="3"]:after {
        width: 24.5%;
      }

      &[data-stars="2.5"]:after {
        width: 50%;
      }

      &[data-stars="2"]:after {
        width: 35%;
      }

      &[data-stars="1.5"]:after {
        width: 70%;
      }

      &[data-stars="1"]:after {
        width: 80%;
      }

      &[data-stars="0.5"]:after {
        width: 90%;
      }
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      min-height: 100vh;
      margin: 0;
    }

    .feedback {
      border-radius: 8px;
      display: flex;
      border: 1px solid red;
      box-shadow: 0 4px 30px rgba(0, 0, 0, .05);
    }

    .comment-user {
      display: flex;

    }

    .comment {
      background-color: white;
      margin: 20px;
      margin-top: 40px;
    }
  </style>
</head>

<body>
  <?php

  require("./Database/connect-mysql.php");

  $sql = "SELECT review.*, book.*, customer.*, ratings.avgRating, ratings.reviewCount
        FROM `review` 
        JOIN `book` ON review.bookid = book.bookid
        JOIN `customer` ON review.customerid = customer.customerid
        LEFT JOIN (
            SELECT bookid, AVG(rating) as avgRating, COUNT(*) as reviewCount
            FROM `review`
            GROUP BY bookid
        ) as ratings ON review.bookid = ratings.bookid";

  if (isset($_REQUEST['bookid'])) {
    $sql .= " WHERE review.bookid = '" . $_REQUEST['bookid'] . "'";
  }

  $result = mysqli_query($conn, $sql);

  if (!$result) {
    die("Lỗi lấy dữ liệu đánh giá, lỗi: " . mysqli_error($conn));
  }

  $rows = mysqli_num_rows($result);
  ?>

  <div class="danhgia-all">
    <div class="danhgia-left">
      <?php
      $reviewCountEchoed = false;
      // Iterate through reviews
      $rows = [];
while ($row = mysqli_fetch_array($result)) {
    $rows[] = $row;

        $averageRating = round($row['avgRating'], 1);
        $reviewCount = $row['reviewCount'];
        if (!$reviewCountEchoed) {
          echo '<div style="display:flex"><h3>Đánh giá(' . $reviewCount . ')</h3>';
          echo '<div class="review-stars" data-stars="' . $averageRating . '" title="' . $averageRating . ' stars"></div>(' . $averageRating . '/5)</div>';
          $reviewCountEchoed = true;
        }
        // Your existing code to display reviews
        echo '<div class="comment">';
        echo '  <div class="comment-user">';
        echo '    <img src="./IMG-customer/' . $row['avatar'] . '" height="30px" width="50px" style="border-radius: 20px;" alt="" > ' . $row['username'];
        echo '    <div class="review-stars" data-stars="' . $row['rating'] . '" title="' . $row['rating'] . ' stars"></div>';
        echo '  </div>';
        echo '<p style="margin:20px">' . $row['reviewtext'] . '</p>';
        echo '</div>';
      }
      ?>
    </div>

    <div class="danhgia-right">
      <?php
      // Check if $_SESSION['username'] is set
      if (isset($_SESSION['username'])) {
        $alreadyReviewed = false;
        foreach ($rows as $row) {
            if ($_SESSION['username'] === $row['username']) {
                echo '<p>Bạn đã đánh giá rồi.</p>';
                $alreadyReviewed = true;
                break;
            }
        }

        // If the user hasn't reviewed, display the review form
        if (!$alreadyReviewed) {
          echo '<h4>HÃY NHẬN XÉT</h4>';
          echo '<div class="container2">';
          echo '<form class="rating" method="post">';
          echo '      <label>
            <input type="radio" name="stars" value="1" />
            <span class="icon">★</span>
          </label>
          <label>
            <input type="radio" name="stars" value="2" />
            <span class="icon">★</span>
            <span class="icon">★</span>
          </label>
          <label>
            <input type="radio" name="stars" value="3" />
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>   
          </label>
          <label>
            <input type="radio" name="stars" value="4" />
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
          </label>
          <label>
            <input type="radio" name="stars" value="5" />
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
            <span class="icon">★</span>
          </label>';
          echo '</form>';
          echo '</div>';
          echo '<textarea name="comment" cols="63" rows="5" style="margin-top:8px;"></textarea>';
          echo '<a href="#" id="submit-review-link">Gửi đi</a>';
        }
      } else {
        // If $_SESSION['username'] is not set, display a message or login link
        echo '<p><a href="index.php?Page=login">Đăng nhập để đánh giá</a></p>';
      }
      ?>
    </div>
  </div>
</body>
<!-- Add the following script inside the head tag or at the end of the body tag -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Function to get the selected rating value
    function getSelectedRating() {
      var selectedRating = document.querySelector('input[name="stars"]:checked');
      return selectedRating ? selectedRating.value : null;
    }

    // Function to handle anchor tag click
    function handleReviewSubmit() {
      var selectedRating = getSelectedRating();
      var commentText = document.querySelector('textarea[name="comment"]').value;

      // Check if a rating is selected
      if (selectedRating === null) {
        alert("Please select a rating before submitting.");
        return;
      }

      // Construct the URL with query parameters
      var bookId = "<?php echo $_REQUEST['bookid']; ?>";
      var url = "Pages/customer-review.php?bookid=" + bookId + "&rating=" + selectedRating + "&comment=" + encodeURIComponent(commentText);

      // Redirect to the URL
      window.location.href = url;
    }

    // Add a click event listener to the anchor tag
    var submitLink = document.getElementById("submit-review-link");
    if (submitLink) {
      submitLink.addEventListener("click", function (event) {
        event.preventDefault();
        handleReviewSubmit();
      });
    }
  });
</script>

</html>