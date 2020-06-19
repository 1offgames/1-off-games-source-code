<?php
include('./php/mysqli_connect.php');
require_once('./php/head.php');
require_once('./php/order.component.php');
require_once('./php/navbar.php');
require_once('./php/footer.php');
?>

<!-- Taken from cart.php, checks for user ID -->
<?php
$customer_id = 0;
if (isset($_SESSION["userID"])) {
    $customer_id = $_SESSION["userID"];
}

if ($customer_id <= 0) {
    //Redirect user to Login page
    $_SESSION["productID"] = 0;
    $_SESSION["redirect"] = "orderhistory.php";
    $_SESSION["originalreferer"] = "orderhistory.php";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
head();
?>

<body>
    <?php
    navbar();
    ?>

    <div class="container full-height">
        <div class="row">
            <div class="pt-4 pl-2 w-100">
                <h3>Order History</h3>
            </div>
            <!-- Display Orders -->
            <?php
            $orderQuery = "SELECT * FROM orders o WHERE o.customer_id = $customer_id ORDER BY o.order_date DESC";
            $orderResult = mysqli_query($link, $orderQuery);

            if (mysqli_num_rows($orderResult) != 0) {
                // order.component.php
                while ($row = mysqli_fetch_assoc($orderResult)) {
                    order($row['order_id'], $row['order_date'], $row['order_status'], $row['order_total'], $link);
                }
            } else {
                echo "
                <div class='col-md my-4 pl-2'>
                    <h4>You have not made any orders.</h4>
                    <h5>Please click <a href='products.php'>here</a> to see our available products.</h5>
                </div>";
            }
            ?>
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