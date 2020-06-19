<?php
include('./php/mysqli_connect.php');
require_once 'php/navbar.php';
require_once 'php/head.php';
require_once 'php/displayAlerts.php';

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

// If No Product is passed to the page, redirect to index.php
$productNumber = $_GET['productid'];
if (empty($productNumber) or is_nan($productNumber)) {
  header("Location: index.php");
}

$addedtocart = $_GET['addedtocart'];
if (empty($addedtocart)) {
  $addedtocart = NULL;
}

// Get Game Info
$sql = "SELECT * FROM `products` where product_id = $productNumber";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
if ($row == NULL) {
  // If No Result, Redirect to 404
  header("Location: 404.html");
}
$imagePrefix = 'db/img/';
$productName = $row['product_name'];
$productPrice = $row['product_price'];
if ($productPrice <= 0) {
  $productPrice = "FREE";
} else {
  $productPrice = "$" . $productPrice;
}
$productImage = $row['product_image'];
$productDescription = $row['product_description'];
$productQuantity = $row['product_quantity'];
$stockText = "<span class=\"text-success\">In Stock";
if ($productQuantity <= 0) {
  $stockText = "<span class=\"text-danger\">Out of Stock";
}

// Get Reviews!
$sql = "select reviews.review_text, reviews.review_score, customers.customer_username from reviews join customers on reviews.customer_id = customers.customer_id where reviews.product_id = $productNumber";
$reviews_result = mysqli_query($link, $sql);


// Check to see if we should show the ADD REVIEW Btn
$ShowAddReview = TRUE;

// If not logged in, We Don't Show Add Revuew
if ($_SESSION["userID"] == 0) {
  $ShowAddReview = FALSE;
} else {
  $userid = $_SESSION['userID'];
  // We Logged in bois

  // Time to check if they even bought the game!
  $sql = "SELECT `orders`.`order_id`, `orders_items`.`product_id`, `orders`.`customer_id` FROM `orders` INNER JOIN `orders_items` ON  `orders`.`order_id` = `orders_items`.`order_id` WHERE  `orders`.`customer_id` = $userid and `orders_items`.`product_id` = $productNumber";
  $result = mysqli_query($link, $sql);
  // Product is not in order history!! Do Not Show Add Review Button!!!!1!
  if (mysqli_num_rows($result) == 0) {
    $ShowAddReview = FALSE;
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<?php
head();
?>

<body>
  <?php
  navbar();
  ?>
  <?php
  userLog();
  ?>
  <!-- Main container -->
  <div class="container full-height">
    <div class='row m-3'></div>
    <!-- Game Info Main  -->
    <div class="jumbotron mt-5" style="margin-top: 20px; padding-top: 20px; padding-bottom: 20px;">
      <?php
      $el = "<!-- Game Image -->
        <img
          style=\"float: left; padding-right: 10px;\"
          src=\"$imagePrefix$productImage\"
          width=\"300px\"
          alt=''
        />
        <div style=\"clear: right;\">
          <!-- Game Title H3 -->
          <h3>$productName</h3>
          <!-- Game Price H4 -->
          <h4>$productPrice - $stockText</span></h4>
        </div>

        <!-- Game Description p -->
        <p>$productDescription</p>";
      echo $el;
      ?>
      <!-- Button 'Add To Cart' -->
      <?php

      if ($addedtocart == 'false') :
        echo "<a id=\"addtocartBTN\" class=\"btn btn-danger btn-lg\" href=\"addtocart.php?productid=$productNumber&redirect=product_page.php\">Something went wrong!</a>";
      elseif ($addedtocart == 'true') :
        echo "<a id=\"addtocartBTN\" class=\"btn btn-success btn-lg\" href=\"addtocart.php?productid=$productNumber&redirect=product_page.php\">✔Added!</a>";
      else :
        echo "<a id=\"addtocartBTN\" class=\"btn btn-danger btn-lg\" href=\"addtocart.php?productid=$productNumber&redirect=product_page.php\">Add To Cart</a>";
      endif;


      echo "<!-- Button 'Add Review' -->";
      if ($ShowAddReview) {
        echo "<a class=\"btn btn-danger\" href=\"addreview.php?productid=$productNumber&redirect=product_page.php\">Add Review</a>";
      }

      ?>
      <div style="clear: left; margin: 0; padding: 0; height: 0; visibility: hidden;">.</div>
    </div>

    <h3>Reviews</h3>
    <div id="reviews_container">
      <?php
      // If No reviews, add the no reviews text, otherwise, add allllll the reviews
      if (mysqli_num_rows($reviews_result) == 0) {
        $el = "<div class=\"noreviews\">
          <h1>No Reviews Yet!</h1>
          <h4>Be the first to review $productName</h4>
        </div>";
        echo $el;
      } else {
        while ($row = mysqli_fetch_assoc($reviews_result)) {
          // categories($row['catagory_name'], $row['count']);
          $username = $row['customer_username'];
          $review = $row['review_text'];
          $score = $row['review_score'];
          echo "<div class=\"review\">";
          echo "<!-- UserName -->";
          echo "<H4 class=\"text-danger\">$username</H4>";
          echo "<!-- Review Contents -->";
          echo "<div>$review</div>";
          echo "<hr>";
          if ($score > 5) {
            echo "<span class=\"text-sm\">Would Recommend Game: <span class=\"text-success\">Yes</span></span>";
          } else {
            echo "<span class=\"text-sm\">Would Recommend Game: <span class=\"text-danger\">No</span></span>";
          }
          echo "</div>";
        }
      }
      ?>
    </div>

    <!-- JavaScript -->
    <script src='js/jquery.min.js'></script>
    <script src='js/bootstrap.bundle.min.js'></script>
    <script src='js/functions.js'></script>
    <script>
      <?php
      echo "document.getElementById(\"page_title\").innerHTML = \"$productName - 1-OFF Games\";";

      $el = "
      var justAdded = false;
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      if (urlParams.get('addedtocart') == 'true'){
          justAdded = true;
      }
      
      if(justAdded){
          //Just Logged In?
          var alertbox = document.getElementById(\"alertBoxText\");
          if(elementExits(alertbox)){
              // Just Logged In -> Need to go back 3 entries in history
              if (alertbox.innerHTML == 'Logged in successfully.'){
                  history.pushState(null, null, document.URL);
                  window.addEventListener('popstate', function () {
                      window.history.go(-3)
                  });
              } 
          } else {
              // Just added to cart. already logged in -> need to go back 2 in history
              history.pushState(null, null, document.URL);
              window.addEventListener('popstate', function () {
                  window.history.go(-2)
              });
          }    
      }
      ";

      echo $el;
      ?>
    </script>
</body>

</html>