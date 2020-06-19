<?php
require_once('createHyphenatedName.php');

function card($productID, $productName, $productPrice, $selectedCategory, $productImage, $catFilter, $platFilter, $pageNumber)
{
    //Default filters to empty strings
    if (is_null($catFilter)) {
        $categoryFilter = "";
    } else {
        $categoryFilter = "&category=$catFilter";
    }
    if (is_null($platFilter)) {
        $platformFilter = "";
    } else {
        $platformFilter = "&platform=$platFilter";
    }
    $pageNumber = "&page=$pageNumber";

    // createHyphenatedName.php
    $placeholder = createHyphenatedName($productName);

    // FIXME: Remove for production
    $regularPrice = '$' . number_format($productPrice * 1.2, 2, '.', '');

    if ($productPrice <= 0) {
        $productPrice = 'FREE';
        $regularPrice = '';
    } else {
        $productPrice = '$' . $productPrice;
    }

    // If category selected, add image overlay w/ category
    $category = '';
    if ($selectedCategory != '') {
        $category = "<div class='card-img-overlay h-25'>
                  <h5 class='card-title btn btn-danger btn-sm '>$selectedCategory</h5>
                </div>";
    }

    $element = "
      <div class='col-lg-4 col-md-6 mb-4'>
        <div class='card h-100'>
          <a href='product_page.php?productid=$productID'>
            <img class='card-img-top img-thumbnail' src='./db/img/$productImage' alt='$placeholder'>
            $category
          </a>
          <div class='card-body d-flex flex-column'>
            <h4 class='card-title'>
              <a href='product_page.php?productid=$productID'>$productName</a>
            </h4>
            <div class='card-footer text-center' style='margin-top: auto;'>
              <h5>
                <small><s>$regularPrice</s></small>
                <span>$productPrice</span>
              </h5>
              <a class='btn btn-danger btn-lg' href='addtocart.php?productid=$productID&redirect=products.php$platformFilter$categoryFilter$pageNumber'>Add to cart</a>
            </div>
          </div>
        </div>
      </div>
    ";
    echo $element;
}
