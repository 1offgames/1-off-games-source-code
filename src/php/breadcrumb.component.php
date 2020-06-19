<?php

function breadcrumb($categorySelected)
{
  $breadcrumbItem = '';
  $activePage = 'active';

  if ($categorySelected != null) {
    $breadcrumbItem = "<li class='breadcrumb-item'>$categorySelected</li>";
    $activePage = '';
  }

  $element = "
        <div class='my-4'>
          <ol class='breadcrumb'>
            <li class='breadcrumb-item'><a href='index.php'>Home</a></li>
            <li class='breadcrumb-item $activePage'><a href='products.php'>Products</a></li>
            $breadcrumbItem
          </ol>
        </div>
    ";

  echo $element;
}
