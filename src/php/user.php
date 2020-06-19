<?php
session_start();
require "mysqli_connect.php";

$userName = mysqli_real_escape_string($link, trim(strip_tags($_POST["userName"])));
$userPass = mysqli_real_escape_string($link, trim(strip_tags($_POST["userPass"])));
$productid = isset($_SESSION["productID"]) ? $_SESSION["productID"] : '';
$redirect = isset($_SESSION["redirect"]) ? $_SESSION["redirect"] : '';
$originalReferer = isset($_SESSION["originalreferer"]) ? $_SESSION["originalreferer"] : '';
$categoryFilter = isset($_SESSION["categoryFilter"]) ? $_SESSION["categoryFilter"] : null;
$platformFilter = isset($_SESSION["platformFilter"]) ? $_SESSION["platformFilter"] : null;
$pageNumber = isset($_SESSION["pagenumber"]) ? $_SESSION["pagenumber"] : '';


//hashes the password
$userPass = sha1($userPass);

$sql = "SELECT * FROM customers WHERE customer_username = '$userName' AND customer_password = '$userPass'";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) == 1) {
    $_SESSION["userID"] = $row["customer_id"];
    $_SESSION["userName"] = $row["customer_username"];

    //checks if admin
    if ($row["customer_admin"] == 1) {
        $_SESSION["admin"] = "yes";
    } else {
        $_SESSION["admin"] = "no";
    }

    // check if privacy policy has been accepted
    if ($row["privacy_accepted"] != 1) {
        header("Location: ../privacypolicy.php");
        exit();
    }

    //Set Last Login

    $sql = "UPDATE customers
    SET last_login = NOW()
    WHERE customer_id LIKE " . $_SESSION["userID"];

    $result = mysqli_query($link, $sql);
    //

    if ($productid == '' and $redirect == '' and $originalReferer == '') {
        $_SESSION["userLogged"] = "true";
        header("Location: ../index.php");
        exit();
    } else if ($originalReferer == 'products.php') {
        unset($_SESSION['productID']);
        unset($_SESSION['redirect']);
        unset($_SESSION['originalreferer']);
        unset($_SESSION['categoryFilter']);
        unset($_SESSION['platformFilter']);
        unset($_SESSION['pagenumber']);

        $pageNumber = "&page=$pageNumber";

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

        $_SESSION["userLogged"] = "true";
        header("Location: ../$redirect?productid=$productid&redirect=$originalReferer$platformFilter$categoryFilter$pageNumber");
        exit();
    }
    else{
        unset($_SESSION['productID']);
        unset($_SESSION['redirect']);
        unset($_SESSION['originalreferer']);
        $_SESSION["userLogged"] = "true";
        header("Location: ../$redirect?productid=$productid&redirect=$originalReferer");
        exit();
    }

} else {
    $_SESSION["userLogged"] = "false";
    header("Location: ../login.php");
    exit();
}
