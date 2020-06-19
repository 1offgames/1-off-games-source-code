<?PHP
include('./php/mysqli_connect.php');
require_once('./php/head.php');
require_once('./php/navbar.php');
require_once('./php/cart_item.php');
require_once('./php/footer.php');
require_once('./php/orderLineItem.component.php');
$cartTotal = 0.0;
$orderID = $_GET["orderID"];
//$orderID = 1;

$userName = $_SESSION["userName"];
$userID = $_SESSION["userID"];

$recName = sha1($userName . "-" . $userID . "-" . $orderID);
?>

<!DOCTYPE html>
<html lang="en">
<?PHP
head();
?>

<body>
    <?PHP
    navbar();
    ?>

    <div class="container full-height">
        <div class="row">
            <div class="pt-4 pl-2 w-100">
                
            </div>
            <!-- Display Shopping Cart product cards -->
            <div class='col-sm-1'></div>
            <div class="col-sm-8 pl-2 bg-secondary rounded p-4">
                <ul class="list-group">
                    <?PHP
                    //This is the default account loaded. Set to an account ID for testing. Ideally set to 0 when not testing.
                    $customer_id = 0;
                    if (isset($_SESSION["userID"])) {
                        $customer_id = $_SESSION["userID"];
                    }
                    //$customer_id = 3;
                    if ($customer_id <= 0) {
                        //Redirect user to Login page
                        header("Location: logIn.php");
                        exit();
                    }
                    $sql = 'SELECT o.order_id, o.order_date, o.order_total, SUM(oi.order_quantity)
                            FROM orders o
                            INNER JOIN orders_items oi
                            ON o.order_id = oi.order_id
                            WHERE o.order_id LIKE ' . $orderID;
                    $result = mysqli_query($link, $sql);
                    $row = mysqli_fetch_row($result);

                    if (mysqli_num_rows($result) > 0) {
                        $orderDate = $row[1];
                        $orderTotal = $row[2];
                        $totalItems = $row[3];
                        echo "<h2>Thank you!</h2> <p> Your order has been received and your item will ship shortly! A confirmation file has been created, and may be downloaded below. Thank you for shopping with 1-Off Games.";
                    } else {
                        echo mysqli_error($link);
                    }

                    ?>
                    
                </ul>
                <br>
                <div class="row bd-highlight">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <a class='btn btn-danger' href='index.php'' name='homebut'>Return Home</a>
                    </div>
                    <div class="col-sm-3">
                        <?PHP 
                         echo "<a class='btn btn-danger btn-block' href='./db/receipts/$recName.txt' download name='dlbut'>Download Receipt</a>";
                        ?>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                    <?php
                        // DISGUSTING THEIFT OF JORDAN'S CODE STARTS HERE

                        $sql = "SELECT product_name, product_image, order_price, product_id, order_id 
                                FROM orders o
                                INNER JOIN orders_items oi
                                USING (order_id)
                                INNER JOIN products pdct
                                USING (product_id)
                                WHERE o.order_id = $orderID 
                                ORDER BY o.order_date DESC";
                        $result = mysqli_query($link, $sql);

                        if (mysqli_num_rows($result) != 0) {
                            while ($row = mysqli_fetch_assoc($result) ) {
                                orderLineItem($row['product_name'], $row['product_image'], $row['order_price'], $row['product_id'], $row['order_id']);
                            }
                        }

                        //Im so sorry
                    ?>
                    </div>
                </div>

            </div>

            <!-- Total and Checkout Button Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                            <h4>Order Date: <p>
                                <?PHP
                                echo $orderDate;
                                ?></h4>
                            <h4>Order Total: <p>$
                                <?PHP
                                echo $orderTotal . " <br>($totalItems Items Total)";
                                ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    footer();
    ?>

    <!-- JavaScript -->
    <script src='js/jquery.min.js'></script>
    <script src='js/bootstrap.bundle.min.js'></script>
</body>

</html>