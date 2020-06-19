<?php
    session_start();
    require_once 'config.php';
    require_once 'mysqli_connect.php';

    if (isset($_SESSION['userID'])){
        $user = $_SESSION['userID'];
    }
    else{
        header("Location: ./index.php");
        exit();
    }

    $token = $_POST['stripeToken'];
    $email = $_POST['stripeEmail'];

    $total = $_POST['totalamt'];
    $date = date("Y-m-d");

    $customer = \Stripe\Customer::create([
        'email' => $email,
        'source' => $token,
    ]);

    $charge = \Stripe\Charge::create([
        'customer' => $customer->id,
        'amount' => $total,
        'currency' => 'cad'
    ]);

    $amount = number_format(($total / 100), 2);

    $sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES\n"

    . "WHERE TABLE_SCHEMA = \"test_oneoff\"\n"

    . "AND TABLE_NAME = \"orders\"";

    $orderID = mysqli_fetch_assoc(mysqli_query($link, $sql));
    $orderID = $orderID['AUTO_INCREMENT'];

    $sql = "INSERT INTO `orders`(`order_id`, `customer_id`, `order_date`, `order_status`, `order_total`) VALUES (NULL, '$user', '$date', 1, '$amount')";

    if ($link -> query($sql) === TRUE){
        $sql = "SELECT * FROM `cart` WHERE customer_id = '$user'";
        $result = $link->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            $product = $row['product_id'];
            $quantity = $row['quantity'];

            $sql = "SELECT `product_price` FROM `products` WHERE `product_id` = '$product'";
            $price = mysqli_fetch_assoc(mysqli_query($link, $sql));
            $price = $price['product_price'];

            $sql = "INSERT INTO `orders_items`(`order_id`, `product_id`, `order_quantity`, `order_price`) VALUES ('$orderID','$product','$quantity','$price')";
            if ($link->query($sql) === TRUE){
                $sql = "DELETE FROM `cart` WHERE `product_id` = '$product' AND `customer_id` = '$user'";
                $delQuery = $link->query($sql);
                if($delQuery) {
                    echo "yeet";
                }
            }
        }
        header("Location: ./writetofile.php?orderID='$orderID'&redirect=../order_confirmation.php");
        exit();
    }