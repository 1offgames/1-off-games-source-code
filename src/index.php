<?php
include('./php/mysqli_connect.php');
require_once('./php/head.php');
require_once('./php/navbar.php');
require_once('./php/footer.php');
require_once('./php/displayAlerts.php');
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
  // from displayAlerts.php
  privacyPolicyStatus();
  userReg();
  userLog();
  ?>

  <!-- Page Content -->
  <div id="top-image">

  </div>
  <div class="game-row-header container">
    <?php
    if ($_SESSION['userID'] == 0) {
      echo "<h3>Most Popular:</h3>";
    } else {
      echo "<h3>Top Picks For You:</h3>";
    }
    ?>
  </div>
  <div class="game-row">
    <?php
    // Get 15 games
    $sql = "SELECT `product_id`, `product_name`, `product_image` FROM `products` LIMIT 15";
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
      $productName = $row['product_name'];
      $productImage = $row['product_image'];
      $productNumber = $row['product_id'];
      echo "<div id=\"$productNumber\" class=\"game-container\" style=\"background-image: url('./db/img/$productImage');\" onclick=\"redir($productNumber)\">";
      echo "<div class=\"game-text\">$productName</div>";
      echo "<img src=\"img/homepage/Battletoads_cover.jpg\">";
      echo "</div>";
    }
    ?>
    <div style="width:15px; visibility: hidden;">...</div>
  </div>


  <div class="game-row-header container">
    <h3>Best in Nintendo 64:</h3>
  </div>
  <div class="game-row">
    <?php
    // Get 15 games
    $sql = "SELECT `product_id`, `product_name`, `product_image` FROM `products` WHERE `platform_id` = 8";
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result)) {
      $productName = $row['product_name'];
      $productImage = $row['product_image'];
      $productNumber = $row['product_id'];
      echo "<div id=\"$productNumber\" class=\"game-container\" style=\"background-image: url('./db/img/$productImage');\" onclick=\"redir($productNumber)\">";
      echo "<div class=\"game-text\">$productName</div>";
      echo "<img src=\"img/homepage/Battletoads_cover.jpg\">";
      echo "</div>";
    }
    ?>
    <div style="width:15px; visibility: hidden;">...</div>
  </div>

  <!-- Footer -->
  <?php
  footer();
  ?>

  <!-- JavaScript -->
  <script src='js/jquery.min.js'></script>
  <script src='js/bootstrap.bundle.min.js'></script>
  <script>
    function redir(productNumber) {
      window.location.href = "product_page.php?productid=" + productNumber
    }
  </script>
</body>

</html>