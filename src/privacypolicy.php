<?php
require_once('php/displayAlerts.php');
require_once('php/head.php');
require_once('php/navbar.php');
require_once('php/policy.component.php');
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

  <div class='disable-navigation'></div>

  <div class="container full-height">
    <div class='row full-height'>
      <div class='col-md-3'></div>
      <div class='col-md-6 flex-column d-flex justify-content-center align-content-center'>
        <!-- Privacy Policy Form -->
        <form action="php/updateprivacypolicy.php" method="POST" enctype="multipart/form-data">
          <div class="modal-dialog bring-to-front" role="document">
            <div class="modal-content p-3">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Privacy Policy</h5>
              </div>

              <!-- from policy.component.php -->
              <?php
              displayPrivacyPolicy();
              ?>

              <div class="modal-footer justify-content-center align-content-center pt-4">
                <button class="btn btn-secondary" type="submit" value="declined" name="privacyPolicyResult">Decline & Return to Login</button>
                <button class="btn btn-danger" type="submit" value="accepted" name="privacyPolicyResult">Accept Terms & Continue</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class='col-md-3'></div>
    </div>
  </div>


  <?php
  footer();
  ?>

  <!-- JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>