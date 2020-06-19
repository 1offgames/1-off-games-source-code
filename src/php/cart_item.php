<?php

function cart_item($productName, $productImg, $productPrice, $cartQuantity, $productDesc, $productID)
{
  $fakeprice = ($productPrice*1.2);
  $remOne = -1;
  $addOne = 1;
  $setZero = 0;
  $element = "
      <li class='list-group-item d-flex justify-content-between align-items-center'>
          <div class='container'>
            <div class='row'>
              <div class='col-2'>
                <img class='img-fluid' src='db\\img\\$productImg' alt=''>
              </div>
              <div class='col-3'>
                <a href='product_page.php?productid=$productID'><h4>$productName</h4></a><p>
                <p class='mb-0'><s>$$fakeprice</s> $$productPrice</p>
                <div class='row mt-2'>
                
                  <div class='col flex-column d-flex px-0'>
                    <a class='btn btn-danger square align-self-end' href='changecart.php?productid=$productID&removeAmt=$remOne' name='negBut'>-</a>
                  </div>

                  <div class='col flex-column d-flex px-0 align-items-center'>
                    <h5><a class='btn btn-outline-light square align-self-start'>$cartQuantity</a></h5>
                  </div>

                  <div class='col flex-column d-flex px-0'>
                    <a class='btn btn-danger square align-self-start' href='changecart.php?productid=$productID&removeAmt=$addOne' name='plusBut'>+</a>
                  </div>
                  
                </div>
              </div>
              <div class='col-6'>
                <p><br>
                $productDesc
              </div>
              <div class='col-1'>
                <p><br>
                <a class='btn btn-outline-danger' href='changecart.php?productid=$productID&removeAmt=$setZero' name='zeroBut'>X</a>
              </div>
            </div>
          </div>
      </li>";
  echo $element;
}
