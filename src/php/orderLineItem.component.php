<?php
require_once('createHyphenatedName.php');

function orderLineItem($productName, $productImage, $orderPrice, $productID, $orderID)
{
  // createHREF.php
  $placeholder = createHyphenatedName($productName);
  

  $element = "
    <li class='list-group-item d-flex justify-content-between align-items-center m-0'>
    <div class='row col-md p-0'>
      <div class='col-md-4 my-2 mt-3'>
        <a href='product_page.php?productid=$productID'>
          <img class='li-img img-thumbnail' src='./db/img/$productImage' alt='$placeholder'>
        </a>
      </div>
      <div class='col-md-5 my-4'>
        <a href='product_page.php?productid=$productID'>
          <h4>$productName</h4>
        </a>
        <h5><span>$$orderPrice</span></h5>
      </div>
      <div class='col-md-3 my-4 mx-0 p-0 d-flex justify-content-center align-items-center'>
        <a class='btn btn-danger' href='addreview.php?productid=$productID&redirect=orderhistory.php'>Add Review</a>
      </div>
    </div>
    </li>
    ";

  echo $element;
}
