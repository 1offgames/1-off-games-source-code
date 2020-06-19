<?php

function pagination($pageToUse, $currentPage, $totalPages, $catFilter, $platFilter)
{
    //Default filters to empty strings
    if(is_null($catFilter)){
        $categoryFilter = "";
    }
    else{
        $categoryFilter = "&category=$catFilter";
    }
    if(is_null($platFilter)){
        $platformFilter = "";
    }else{
        $platformFilter = "&platform=$platFilter";
    }


    if($currentPage == 1){
        $element = "
      <ul class='pagination mb-4'>
            <li class='page-item disabled'>
              <a class='page-link' href='$pageToUse?page=1$categoryFilter$platformFilter'>&laquo;</a>
            </li>
  ";
        echo $element;
    }else{
        $element = "
            <ul class='pagination mb-4'>
                <li class='page-item'>
              <a class='page-link' href='$pageToUse?page=1$categoryFilter$platformFilter'>&laquo;</a>
                </li>
        ";
        echo $element;
    }


    for ($x = 1; $x <= $totalPages; $x++) {
        if($x == $currentPage){
            $element = "
            <li class='page-item active'>
              <a class='page-link' href='$pageToUse?page=$x$categoryFilter$platformFilter'>$x</a>
            </li>
            ";
            echo $element;
        }else{
            $element = "
            <li class='page-item'>
              <a class='page-link' href='$pageToUse?page=$x$categoryFilter$platformFilter'>$x</a>
            </li>
            ";
            echo $element;
        }
    }
    if($currentPage == $totalPages){
        $element = "
            <li class='page-item disabled'>
              <a class='page-link' href='#'>&raquo;</a>
            </li>
          </ul>
        ";

        echo $element;
    }else{
    $element = "
        <li class='page-item'>
          <a class='page-link' href='$pageToUse?page=$totalPages$categoryFilter$platformFilter'>&raquo;</a>
        </li>
      </ul>
    ";
    echo $element;
    }


}
