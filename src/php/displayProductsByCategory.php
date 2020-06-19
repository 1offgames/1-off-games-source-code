<?php
require_once('./php/createHyphenatedName.php');

function displayProductsByCategory($categoryName, $count, $ID)
{
  $href = createHyphenatedName($categoryName);

  $element = "
      <li class='list-group-item d-flex justify-content-between align-items-center'>
      <a href='products.php?category=$ID'>
          $categoryName
          <span class='badge badge-primary badge-pill'>$count</span>
      </li>
      </a>
    ";
  echo $element;
}
