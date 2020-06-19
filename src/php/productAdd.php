<?php
session_start();
require 'image.php';
require 'mysqli_connect.php';
require_once 'console.php';

$title = isset($_POST["title"]) ? $_POST["title"] : "";
$quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : "";
$price = isset($_POST["price"]) ? $_POST["price"] : "";
$desc = isset($_POST["desc"]) ? $_POST["desc"] : "";
$system = isset($_POST["system"]) ? $_POST["system"] : "";
$category = isset($_POST["category"]) ? $_POST["category"] : "";

//data sanitization
$title = mysqli_real_escape_string($link, trim(strip_tags($title)));
$desc = mysqli_real_escape_string($link, trim(strip_tags($desc)));

$sql = "SELECT `product_name` FROM `products` WHERE  product_name = '$title' AND platform_id = '$system'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 0) {
    //saves the image
    $image = saveImage($title, getPlaformName($system));

    $sql = "INSERT INTO products (product_id, product_name, product_quantity, 
        product_price, product_description, product_image, platform_id, category_id)
        VALUES (NULL, '$title', '$quantity', $price, '$desc', '$image', '$system', '$category')";

    if ($link->query($sql) === TRUE) {
        $_SESSION["addedProduct"] = "true";
        header("Location: ../addProduct.php");
        exit();
    } else {
        $_SESSION["addedProduct"] = "false";
        header("Location: ../addProduct.php");
        exit();
    }
} else {
    $_SESSION["addedProduct"] = "false";
    header("Location: ../addProduct.php");
    exit();
}
