<?php
session_start();
// ?productid=48&redirect=addtocart.php&originalreferer=product_page.php

//getting some context

// This is a test file. We are assuming all the information is being passed on to it

// Use out test user to login

$_SESSION['userID'] = 8008;
//productid, just incase its from add to cart, or product page
$productNumber = $_GET['productid'];

$redirect = $_GET['redirect']; 

$originalReferer = $_GET['originalreferer']; 

//$productNumber: The game id that is involved in the current login action

//$redirect: The URL to redirect to after a successful login

//$originalReferer: The URL to send in the redirect variable during redirection, this is the page that redirected to the $redirect url

// Great, now we start a session 





// Now we redirect back to add to cart with the previous information

header("Location: $redirect?productid=$productNumber&redirect=$originalReferer");

