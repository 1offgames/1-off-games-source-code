<?php
require_once('orderLineItem.component.php');

function order($orderID, $orderDate, $orderStatus, $orderTotal, $link)
{
  $userID = $_SESSION['userID'];
  $userName = $_SESSION['userName'];

  $recName = sha1($userName . "-" . $userID . "-" . $orderID);

  $lineItemQuery =
    "SELECT product_name, product_image, order_price, o.product_id, o.order_id FROM orders_items o INNER JOIN products p ON o.product_id = p.product_id WHERE o.order_id = $orderID";
  $lineItemResult = mysqli_query($link, $lineItemQuery);

  // Selects approporiate image and status message based on order status #.
  if ($orderStatus == 1) {
    $statusImage = "<img class='mx-auto img-fluid mt-5' src='img/orderhistory/processing.png'>";
    $statusMessage = "<div class='font-weight-bold text-left my-3 mb-5 px-1 w-100'>Processing</div>";
  } elseif ($orderStatus == 2) {
    $statusImage = "<img class='mx-auto img-fluid mt-5' src='img/orderhistory/shipped.png'>";
    $statusMessage = "<div class='font-weight-bold text-center my-3 mb-5 px-1 w-100'>Shipped</div>";
  } else {
    $statusImage = "<img class='mx-auto img-fluid mt-5' src='img/orderhistory/delivered.png'>";
    $statusMessage = "<div class='font-weight-bold text-right my-3 mb-5 px-1 w-100'>Delivered</div>";
  }

  // Order Information Column
  echo "<div class='col-md-7 my-4 px-0'>";
  echo "<ul class='list-group'>";
  echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
  echo "<h5 class='m-0'>Order #$orderID</h5><h5 class='m-0'>Order Date: $orderDate</h5><h5 class='m-0'>Order Total: $$orderTotal</h5><a class='btn btn-danger' href='./db/receipts/$recName.txt' download>Download</a>";
  // orderLineItem.component.php - Pulls the line items from each order
  while ($row = mysqli_fetch_assoc($lineItemResult)) {
    orderLineItem($row['product_name'], $row['product_image'], $row['order_price'], $row['product_id'], $row['order_id']);
  }
  echo "</ul>";
  echo "</div>";
  // Order Status Column
  echo "<div class='col-md-5 my-4'>";
  echo "<ul class='list-group'>";
  echo "<li class='list-group-item'><h5 class='text-center m-0 py-2'>Order Status</h5></li>";
  echo "<li class='list-group-item d-flex flex-column align-items-center mx-auto'>$statusImage $statusMessage</li>";
  echo "</ul>";
  echo "</div>";
}
