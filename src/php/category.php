<?php
    function getCategories(){
        require'mysqli_connect.php';

        $sql = "SELECT category_id, category_name from categories";
        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $categoryID = $row["category_id"];
            $categoryName = $row["category_name"];
            echo "<option value='$categoryID'>" . $categoryName . "</option>";
        }
    }