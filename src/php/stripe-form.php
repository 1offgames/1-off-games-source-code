<?php require_once 'config.php';
//here for testing remove when adding to page
$cartTotal = 8000;
?>

<form action="stripe-charge.php" method="post">
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="<?php echo $stripe['publishable_key'];?>"
        data-description="Checkout"
        data-amount="<?php echo $cartTotal;?>"
        data-locale="auto"
        data-label="checkout">
    </script>
    <input type="hidden" name="totalamt" value="<?php echo $cartTotal;?>"/>
</form>
