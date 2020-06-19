<?php
session_start();
include('./php/mysqli_connect.php');
require_once 'php/navbar.php';
require_once 'php/head.php';

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$productNumber = $_GET['productid'];
if (empty($productNumber) or is_nan($productNumber)) {
    header("Location: index.php");
    exit();
}

$redirect = $_GET['redirect'];
if (empty($redirect)) {
    $redirect = 'product_page.php';
}

// If not logged in, redirect to login
if ($_SESSION["userID"] == 0) {
    $_SESSION["productID"] = $productNumber;
    $_SESSION["redirect"] = "addreview.php";
    $_SESSION["originalreferer"] = $redirect;
    header("Location: ./login.php?productid=$productNumber&redirect=addreview.php&originalreferer=$redirect");
    exit();
}

$userid = $_SESSION['userID'];
// We Logged in bois

// Time to check if they even bought the game!
$sql = "SELECT `orders`.`order_id`, `orders_items`.`product_id`, `orders`.`customer_id` FROM `orders` INNER JOIN `orders_items` ON  `orders`.`order_id` = `orders_items`.`order_id` WHERE  `orders`.`customer_id` = $userid and `orders_items`.`product_id` = $productNumber";
$result = mysqli_query($link, $sql);
// Product is not in order history!! Ridirect to redirect!
if (mysqli_num_rows($result) == 0) { 
    header("Location: ./$redirect?productid=$productNumber");
    exit();
}

$isNotReviewing = TRUE;
$gamereviewText = $_POST['gamereviewText'];
if (empty($gamereviewText)) {
    $isNotReviewing = FALSE;
}
$recommend = $_POST['recommend'];
$gamereviewText = mysqli_real_escape_string($link, trim(strip_tags($gamereviewText)));
$recommend = mysqli_real_escape_string($link, trim(strip_tags($recommend)));


if ($gamereviewText == '') {
    $nogametext = TRUE;
} else {
    $nogametext = FALSE;
}

if ($recommend == 'y') {
    $recommend = 9;
} else {
    $recommend = 0;
}

if (!$nogametext) {
    $sql = "INSERT INTO `reviews` (`customer_id`, `product_id`, `review_text`, `review_score`) VALUES ('$userid', '$productNumber', '$gamereviewText', '$recommend')";
    if ($link->query($sql) === TRUE) {
        header("Location: ./$redirect?productid=$productNumber&addedreview=true");
        exit();
    } else {
        // Asume Dup Entry. Update Original Review
        $sql = "UPDATE `reviews` SET `review_text` = '$gamereviewText', `review_score` = '$recommend' WHERE `reviews`.`customer_id` = $userid AND `reviews`.`product_id` = $productNumber";

        if ($link->query($sql) === TRUE) {
            header("Location: ./$redirect?productid=$productNumber&addedreview=true");
            exit();
        } else {
            echo "Something Went Wrong! Please pass this along to customer support : " . $link->error;
        }
    }
}

//data sanitization
$productNumber = mysqli_real_escape_string($link, $productNumber);
// Get Game Info
$sql = "SELECT * FROM `products` where product_id = $productNumber";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
if ($row == NULL) {
    // If No Result, Redirect to 404
    header("Location: 404.html");
    exit();
}
$productName = $row['product_name'];
$productPrice = $row['product_price'];

if ($productPrice <= 0) {
    $productPrice = "FREE";
} else {
    $productPrice = "$" . $productPrice;
}
$productImage = $row['product_image'];
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
    <div class="container">
        <div class="jumbotron" style="margin-top: 20px; padding-top: 20px; padding-bottom: 20px;">
            <h3>You are adding a review for:</h3>
            <?php
            echo "<h4>$productName - $productPrice</h4>";

            echo "<form action=\"addreview.php?productid=$productNumber&redirect=$redirect\" method=\"POST\">";
            ?>
            <div class="form-group">
                <?php
                if ($nogametext and $isNotReviewing) {
                    echo "<textarea class=\"form-control is-invalid\" id=\"gamereviewText\" name=\"gamereviewText\" rows=\"8\" maxlength=\"250\" required></textarea>";
                } else {
                    echo "<textarea class=\"form-control\" id=\"gamereviewText\" name=\"gamereviewText\" rows=\"8\" maxlength=\"250\" required></textarea>";
                }
                ?>
            </div>
            <h5>Would you recommend this game?</h5>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="recommend" id="inlineRadio1" value="y" required>
                <label class="form-check-label" for="inlineRadio1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="recommend" id="inlineRadio2" value="n" required>
                <label class="form-check-label" for="inlineRadio2">No</label>
            </div>
            <div class="form-check-inline">
                <button type="submit" class="btn btn-danger mb-2">Post Review</button>
            </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script src='js/jquery.min.js'></script>
    <script src='js/bootstrap.bundle.min.js'></script>
</body>

</html>