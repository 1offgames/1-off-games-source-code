<?php
session_start();
require 'mysqli_connect.php';

if (isset($_SESSION["userID"])) {
  $customerID = $_SESSION["userID"];
}

// Select
$sql = "SELECT * FROM customers WHERE customer_id = $customerID";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);


// Check to see if user inputted new information or left defaults
if ($_POST["Name"] == '') {
  $name = $row["customer_name"];
} else {
  $name = mysqli_real_escape_string($link, trim(strip_tags($_POST["Name"])));
}

if ($_POST["userEmail"] == '') {
  $userEmail = $row["customer_email"];
} else {
  $userEmail = mysqli_real_escape_string($link, trim(strip_tags($_POST["userEmail"])));
}

if ($_POST["userAddress"] == '') {
  $userAddress = $row["customer_address"];
} else {
  $userAddress = mysqli_real_escape_string($link, trim(strip_tags($_POST["userAddress"])));
}

if ($_POST["userProvince"] == '') {
  $userProvince = $row["customer_province"];
} else {
  $userProvince = mysqli_real_escape_string($link, trim(strip_tags($_POST["userProvince"])));
}

if ($_POST["userPostal"] == '') {
  $userPostal = $row["customer_postal"];
} else {
  $userPostal = mysqli_real_escape_string($link, trim(strip_tags(strtoupper($_POST["userPostal"]))));
}


// Update information
if (mysqli_num_rows($result) == 1) {
  $sql = "UPDATE customers SET customer_email = '$userEmail', customer_name = '$name', customer_address = '$userAddress', customer_province = '$userProvince', customer_postal = '$userPostal' WHERE customer_id = $customerID";

  if ($link->query($sql)) {
    $_SESSION["userSettings"] = "true";
    header("Location: ../usersettings.php");
    exit();
  } else {
    $_SESSION["userSettings"] = "false";
    header("Location: ../usersettings.php");
    exit();
  }
} else {
  $_SESSION["userSettings"] = "false";
  header("Location: ../usersettings.php");
  exit();
}
