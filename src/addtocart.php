<?php
session_start();
require 'php/mysqli_connect.php';

// If No Product is passed to the page, redirect to index.php
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

// Products.php exclusive variables
$platformFilter = $_GET['platform'];
if (empty($platformFilter)) {
    $platformFilter = null;
}

$categoryFilter = $_GET['category'];
if (empty($categoryFilter)) {
    $categoryFilter = null;
}

$pageNumber = $_GET['page'];
if (empty($pageNumber)) {
    $pageNumber = null;
}

//data sanitization
$productNumber = mysqli_real_escape_string($link, $productNumber);

// If not logged in, redirect to login
if ($_SESSION["userID"] == 0) {
    $_SESSION["productID"] = $productNumber;
    $_SESSION["redirect"] = "addtocart.php";
    $_SESSION["originalreferer"] = $redirect;
    if (!is_null($platformFilter)) {
        $_SESSION["platformFilter"] = $platformFilter;
    }
    if (!is_null($categoryFilter)) {
        $_SESSION["categoryFilter"] = $categoryFilter;
    }
    if (!is_null($pageNumber)) {
        $_SESSION["pagenumber"] = $pageNumber;
    }
    header("Location: ./login.php?productid=$productNumber&redirect=addtocart.php&originalreferer=$redirect");
    exit();
}

$userid = $_SESSION['userID'];
// We Logged in bois

$sql = "INSERT INTO `cart`(`product_id`, `customer_id`, `quantity`) VALUES ('$productNumber', '$userid',1)";
if (is_null($categoryFilter)) {
    $categoryFilter = "";
} else {
    $categoryFilter = "&category=$categoryFilter";
}
if (is_null($platformFilter)) {
    $platformFilter = "";
} else {
    $platformFilter = "&platform=$platformFilter";
}
$pageNumber = "&page=$pageNumber";
if ($link->query($sql) === TRUE) {
    header("Location: ./$redirect?productid=$productNumber&addedtocart=true$platformFilter$categoryFilter$pageNumber");
    exit();
} else {
    //updates the quantity by +1
    $sql = "UPDATE `cart` SET `quantity`= `quantity` + 1 WHERE `product_id` = '$productNumber' AND `customer_id` = '$userid'";
    if ($link->query($sql) === TRUE) {
        header("Location: ./$redirect?productid=$productNumber&addedtocart=true$platformFilter$categoryFilter$pageNumber");
        exit();
    } else {
        header("Location: ./$redirect?productid=$productNumber&addedtocart=false$platformFilter$categoryFilter$pageNumber");
        exit();
    }
}

