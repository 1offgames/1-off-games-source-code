<?php
    session_start();
    require 'php/mysqli_connect.php';

    $productNumber = $_GET['productid'];
    $userid = $_SESSION['userID'];
    if (empty($productNumber) or is_nan($productNumber) or is_nan($userid) or empty($userid)){
        header("Location: cart.php");
        exit();
    }


    $operation = $_GET['removeAmt'];

    if($operation == 99) {
        $sql = "DELETE FROM `cart` WHERE `customer_id` = '$userid'";
        $result = mysqli_query($link, $sql);

        if($result){
            header("Location: ./cart.php");
            exit();
        }
    }

    if($operation == 1) {
        $sql = "UPDATE `cart` SET `quantity`= `quantity` + 1 WHERE `product_id` = '$productNumber' AND `customer_id` = '$userid'";
        $result = $link->query($sql);

        if($result){
            header("Location: ./cart.php");
            exit();
        }
    }

    if($operation == -1) {
        $sql = "SELECT * FROM `cart` WHERE `product_id` LIKE '$productNumber' AND `customer_id` LIKE '$userid'";
        $result = $link->query($sql);
        $row = mysqli_fetch_assoc($result);
        if((int)$row['quantity'] > 1){
            $sql = "UPDATE `cart` SET `quantity`= `quantity` - 1 WHERE `product_id` = '$productNumber' AND `customer_id` = '$userid'";
            $result = $link->query($sql);
            if($result) {
                header("Location: ./cart.php");
                exit();
            }  
        } else {
            $sql = "DELETE FROM `cart` WHERE `product_id` = '$productNumber' AND `customer_id` = '$userid'";
            $result = $link->query($sql);
            if($result) {
                header("Location: ./cart.php");
                exit();
            }  
        }
    }

    if($operation == 0) {
        $sql = "DELETE FROM `cart` WHERE `product_id` = '$productNumber' AND `customer_id` = '$userid'";
        $result = mysqli_query($link, $sql);

        if($result){
            header("Location: ./cart.php");
            exit();
        }
    }
?>