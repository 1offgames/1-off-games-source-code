<?php
session_start();
require_once("mysqli_connect.php");

if (isset($_SESSION["userID"])) {
  $customerID = $_SESSION["userID"];
}

// Update db with accepted/declined result
if (isset($_POST["privacyPolicyResult"]) && $_POST["privacyPolicyResult"] == "accepted") {
  $privacyPolicyResult = 1;
  $dateAccepted = 'NOW()';
} else {
  $privacyPolicyResult = 0;
  $dateAccepted = 'NULL';
}

$sql = "SELECT * FROM customers WHERE customer_id = $customerID";

$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) != 0) {
  $sql = "UPDATE customers SET privacy_accepted = $privacyPolicyResult, date_privacy_accepted = $dateAccepted WHERE customer_id = $customerID";

  // Final redirect based on accepted/declined result
  if ($link->query($sql) === TRUE && $privacyPolicyResult == 1) {
    $_SESSION["privacyPolicyStatus"] = "accepted";

    if ($_SESSION["privacyPolicyRedirect"] == "usersettings") {
      header("Location: ../usersettings.php?");
      exit();
    } else {
      header("Location: ../index.php?");
      exit();
    }
  } else {
    header("Location: logout.php");
    exit();
  }
}
