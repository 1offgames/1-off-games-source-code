<?PHP 
    session_start();
    include('./mysqli_connect.php');

    printOrderHistory($_GET["orderID"], $link);
    

    function printOrderHistory($orderID, $link) {
        $sql = 'SELECT customer_name, customer_username, customer_id, order_id,order_date, order_total, customer_email FROM orders odrs
                    INNER JOIN customers cstm
                    USING (customer_id)
                    INNER JOIN orders_items itms
                    USING (order_id)
                    WHERE odrs.order_id LIKE ' . $orderID;
        
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) > 0){
            $customerUsername =  $row["customer_username"];
            $customerName = $row["customer_name"];
            $customerEmail = $row["customer_email"];
            $customerID = $row["customer_id"];
            $orderID = $row["order_id"];
            $orderDate = $row["order_date"];
            $orderPrice = $row["order_total"];

            $sql = 'SELECT ords.product_id, prdt.product_name, ords.order_price, ords.order_quantity FROM orders_items ords
                        INNER JOIN products prdt
                        USING (product_id)
                        WHERE ords.order_ID LIKE ' . $orderID;

            $result = mysqli_query($link, $sql);

            if(mysqli_num_rows($result) > -1){
                $itmlist = "\n";
                while ($row = mysqli_fetch_assoc($result)) {
                   $itmlist .= "> " . $row["product_id"] . " - " . $row["product_name"] . " - " . $row["order_price"] . " - Amt: " . $row["order_quantity"] ."\n";
                }
                $ITMLIST .= "\n";
                $recName = sha1($customerUsername . "-" . $customerID . "-" . $orderID);
                $filepath = "../db/receipts/" . $recName . ".txt";
                $file = fopen($filepath, "w") or die();
                $print = "Customer Name: $customerName\n";
                $print .= "Customer E-Mail: $customerEmail\n";
                $print .= "Customer ID: $customerID\n";
                $print .= "Order Number: $orderID\n";
                $print .= "Order Date: $orderDate\n";
                $print .= "Items Ordered: \n $itmlist";
                $print .= "Order Total: $orderPrice\n";
                //$print .= "Stripe Confirmation: " . "NO STRIPE DATA YET" . "\n";
                fwrite($file, $print);
                fclose($file);
                echo $itmlist;
                header("Location: ".$_GET["redirect"]."?orderID=$orderID");
                exit();
            }else {
                echo mysqli_error($link);
                header("Location: ".$_GET["redirect"]);
                exit();
            }
            
        } else {
            echo mysqli_error($link);
            header("Location: ".$_GET["redirect"]);
            exit();
        }
    }
?>