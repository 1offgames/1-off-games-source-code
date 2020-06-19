<?php
    require_once '../vendor/autoload.php';

    $stripe = [
        "secret_key"    => "sk_test_51GsXAmFUdAtrMllDcLC6s1GpFOx0u7rD7HCWYJx6a53YfrO3mzgSkut8phAE1yTYpBE9jquSO5IumQ7OMH6fOyja00uCoAFBfH",
        "publishable_key"=>"pk_test_51GsXAmFUdAtrMllDd1L0qCJukzXlzDkRvfct45e9GqLV0rk5Wm0rk2Q6xsWpz9FvJwwWpSc9t4jyQqz06yZ0N85y00u7K7s76i"
    ];

    \Stripe\Stripe::setApiKey($stripe['secret_key']);