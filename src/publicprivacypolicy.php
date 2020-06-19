<?php
require_once('php/displayAlerts.php');
require_once('php/head.php');
require_once('php/navbar.php');
require_once('php/policy.component.php');
require_once('php/footer.php');
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

  <div class="container full-height">
    <div class='row full-height'>
      <div class='col-md-3'></div>
      <div class='col-md-6 flex-column d-flex justify-content-center align-content-center'>
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
              <br />
              <br />
            </div>
          </div>
        </div>
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