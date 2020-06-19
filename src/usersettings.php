<?php
require('php/mysqli_connect.php');
require_once('php/displayAlerts.php');
require_once('php/head.php');
require_once('php/navbar.php');
require_once('php/settings.component.php');
require_once('php/footer.php');
?>

<!-- Taken from cart.php, checks for user ID -->
<?php
$customer_id = 0;
if (isset($_SESSION["userID"])) {
  $customer_id = $_SESSION["userID"];
}

if ($customer_id <= 0) {
  //Redirect user to Login page
  header("Location: login.php");
  exit();
}

// If privacy policy is accepted again, redirect back to settings
$redirect = "usersettings";
$_SESSION["privacyPolicyRedirect"] = $redirect;
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

  <!-- from displayAlerts.php -->
  <?php
  updatedSettings();
  privacyPolicyStatus();
  ?>

  <!--User Settings form-->
  <div class="container full-height">
    <div class='row full-height'>
      <div class='col-md-2'></div>
      <div class='col-md-8 flex-column d-flex justify-content-center align-content-center'>
        <!-- User Settings Form -->
        <form action="php/updateusersettings.php" method="POST" enctype="multipart/form-data" onsubmit="return validationUpdateUser()">
          <div class="modal-dialog" role="document">
            <div class="modal-content p-3">
              <div class='container-fluid'>
                <div class="modal-header">
                  <h5 class="modal-title" id="userSettingsModal">User Settings</h5>
                </div>
                <div class='modal-body'>
                  <?php
                  $sql = "SELECT customer_username, customer_email, customer_name, customer_address, customer_province, customer_postal, privacy_accepted, date_privacy_accepted FROM customers WHERE customer_id = $customer_id";

                  $result = mysqli_query($link, $sql);
                  $row = mysqli_fetch_assoc($result);

                  // settings.component.php - target row, date(if needed), name, id
                  displayAvailableSetting($row["customer_username"], '', 'Username', 'userName');
                  displayAvailableSetting($row["customer_email"], '', 'Email', 'userEmail');
                  displayAvailableSetting($row["customer_name"], '', 'Name', 'Name');
                  displayAvailableSetting($row["customer_address"], '', 'Address', 'userAddress');
                  displayAvailableSetting($row["customer_province"], '', 'Province/Territory', 'userProvince');
                  displayAvailableSetting($row["customer_postal"], '', 'Postal Code', 'userPostal');
                  displayAvailableSetting($row["privacy_accepted"], $row["date_privacy_accepted"], 'Privacy Policy Status', 'policy');
                  ?>
                </div>
                <div class="modal-footer justify-content-center align-content-center pt-4">
                  <button class="btn btn-danger" type="submit" value="Submit" name="submit">Save Changes</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class='col-md-2'></div>
    </div>
  </div>


  <?php
  footer();
  ?>

  <!-- JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/validation.js"></script>
</body>

</html>