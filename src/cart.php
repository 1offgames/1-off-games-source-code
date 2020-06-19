<?PHP
include('./php/mysqli_connect.php');
require_once('./php/head.php');
require_once('./php/navbar.php');
require_once('./php/cart_item.php');
require_once('./php/footer.php');
require_once('./php/head.php');
require_once './vendor/autoload.php';

$stripe = [
    "secret_key"    => "sk_test_51GsXAmFUdAtrMllDcLC6s1GpFOx0u7rD7HCWYJx6a53YfrO3mzgSkut8phAE1yTYpBE9jquSO5IumQ7OMH6fOyja00uCoAFBfH",
    "publishable_key"=>"pk_test_51GsXAmFUdAtrMllDd1L0qCJukzXlzDkRvfct45e9GqLV0rk5Wm0rk2Q6xsWpz9FvJwwWpSc9t4jyQqz06yZ0N85y00u7K7s76i"
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
$cartTotal = 0.0;
?>

<!DOCTYPE html>
<html lang="en">

<?PHP
head();
?>
    <?PHP
    navbar();
    ?>

    <div class="container full-height">
        <div class="row">
            <div class="pt-4 pl-2 w-100">
                <h3>Shopping Cart</h3>
            </div>
            <!-- Display Shopping Cart product cards -->
            <div class="col-sm-9 pl-2">
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
                    $sql = 'SELECT crt.customer_id, crt.product_id, crt.quantity, pdct.product_id, pdct.product_name, pdct.product_description, pdct.product_image, pdct.product_price, pdct.product_id
                        FROM cart crt
                        INNER JOIN products pdct
                        ON crt.product_id = pdct.product_id
                        WHERE crt.customer_id LIKE ' . $customer_id;
                    $result = mysqli_query($link, $sql);

                    //Don't do things while empty, fewer errors.
                    if (mysqli_num_rows($result) != 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            cart_item($row['product_name'], $row['product_image'], $row['product_price'], $row['quantity'], $row['product_description'], $row['product_id']);
                            $cartTotal = $cartTotal + ($row['product_price'] * $row['quantity']);
                        }
                    } else {
                        echo "
                            <div class='my-4 pl-0'>
                                <h4>Your cart is empty.</h4>
                                <h5>Add items on the <a href='products.php'>products</a> page</h5>
                            </div>";
                    }

                    ?>
                </ul>
                <div class="d-flex flex-row-reverse bd-highlight">
                    <div class="p-2">
                        <?php
                        if (mysqli_num_rows($result) != 0) {
                            echo "<a class='btn btn-danger' href='changecart.php?productid=-1&removeAmt=99'' name='negBut'>Remove All</a>";
                        }
                        ?>

                    </div>
                </div>

            </div>

            <!-- Total and Checkout Button Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        Subtotal: $
                        <?PHP
                        echo $cartTotal
                        ?>
                        <p>
                            <hr />
                            <p>Shipping: $
                                <?PHP
                                if ($cartTotal > 0) {
                                    echo 15;
                                } else {
                                    echo 0;
                                }
                                ?><p>
                                    <hr />
                                    <p>
                                        <h4>Total: $
                                            <?PHP
                                            if ($cartTotal > 0) {
                                                echo ($cartTotal + 15);
                                            } else {
                                                echo $cartTotal;
                                            }
                                            $cartTotal = ($cartTotal + 15) * 100;
                                            ?></h4>
                                        <?php
                                        if (mysqli_num_rows($result) != 0) {
//                                            echo "<p><br><button type='button' class='btn btn-info btn-lg btn-block' name='checkout'>Check Out</button>";
                                            $pubKey = $stripe['publishable_key'];
                                            $el = "<form action=\"./php/stripe-charge.php\" method=\"post\">
                                            <script src=\"https://checkout.stripe.com/checkout.js\" class=\"stripe-button\"
                                                data-key=\"$pubKey\"
                                                data-description=\"Checkout\"
                                                data-amount=\"$cartTotal\"
                                                data-locale=\"auto\"
                                                data-label=\"Checkout\">
                                            </script>
                                            <input type=\"hidden\" name=\"totalamt\" value=\"$cartTotal\"/>
                                        </form>";

                                            echo $el;



                                        } else {
                                            echo "<p><br><button type='button' class='btn btn-secondary btn-lg btn-block disabled' name='checkout'>Check Out</button>";
                                        }
                                        ?>
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