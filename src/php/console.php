<?php
    
    function getPlatforms(){
        require 'mysqli_connect.php';
        
        $sql = "SELECT platform_id, platform_name from platforms";
        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $platformID = $row["platform_id"];
            $platformName = $row["platform_name"];
            echo "<option value='$platformID'>$platformName</option>";
        }
    }

    function getPlaformName($platformNum){
        require 'mysqli_connect.php';

        $sql = $sql = "SELECT platform_name FROM `platforms` WHERE platform_id = $platformNum";
        $result = mysqli_query($link, $sql);

        $row = mysqli_fetch_assoc($result);

        return $row["platform_name"];
    }