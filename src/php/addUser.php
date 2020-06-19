<?php
session_start();
require 'mysqli_connect.php';

$name = isset($_POST["Name"]) ? $_POST["Name"] : '';
$userName = isset($_POST["userName"]) ? $_POST["userName"] : '';
$userPass = isset($_POST["userPass"]) ? $_POST["userPass"] : '';
$userEmail = isset($_POST["userEmail"]) ? $_POST["userEmail"] : '';
$userAddress = isset($_POST["userAddress"]) ? $_POST["userAddress"] : '';
$userProvince = isset($_POST["userProvince"]) ? $_POST["userProvince"] : '';
$userCountry = 'Canada';
$userPostal = isset($_POST["userPostal"]) ? $_POST["userPostal"] : '';

if (isset($_POST["policyAccepted"]) && $_POST["policyAccepted"] == "yes") {
    $policyAccepted = 1;
}

//data sanitization
$name = mysqli_real_escape_string($link, trim(strip_tags($name)));
$userName = mysqli_real_escape_string($link, trim(strip_tags($userName)));
$userPass = mysqli_real_escape_string($link, trim(strip_tags($userPass)));
$userEmail = mysqli_real_escape_string($link, trim(strip_tags($userEmail)));
$userAddress = mysqli_real_escape_string($link, trim(strip_tags($userAddress)));
$userProvince = mysqli_real_escape_string($link, trim(strip_tags($userProvince)));
$userCountry = mysqli_real_escape_string($link, trim(strip_tags($userCountry)));
$userPostal = mysqli_real_escape_string($link, trim(strip_tags($userPostal)));

//hashes the user pass
$userPass = sha1($userPass);


$sql = "SELECT `customer_id`, `customer_name`, `customer_username`, `customer_password`, `customer_email`, `customer_address`, `customer_province`, `customer_country`, `customer_postal`, `customer_admin`, `privacy_accepted`, `date_privacy_accepted`, `last_login`
            FROM `customers` WHERE `customer_username` = '$userName'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 0) {
    $sql = "INSERT INTO `customers`(`customer_id`, `customer_name`, `customer_username`, `customer_password`, `customer_email`, `customer_address`, `customer_province`, `customer_country`, `customer_postal`, `customer_admin`, `privacy_accepted`, `date_privacy_accepted`) VALUES 
                (NULL, '$name', '$userName', '$userPass', '$userEmail', '$userAddress', '$userProvince', '$userCountry', '$userPostal', 0, $policyAccepted, NOW())";

    if ($link->query($sql) === TRUE) {
        $_SESSION["addedUser"] = "true";
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION["addedUser"] = "false";
        header("Location: ../register.php");
        exit();
    }
} else {
    $_SESSION["addedUser"] = "false";
    header("Location: ../register.php");
    exit();
}
