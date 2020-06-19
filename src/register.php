<?php
require_once('php/head.php');
require_once('php/navbar.php');
require_once('php/displayAlerts.php');
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

    <?php
    userReg();
    ?>

    <div class="container full-height">
        <div class="row full-height">
            <div class='col-md-2'></div>
            <div class='col-md-8 flex-column d-flex justify-content-center align-content-center'>
                <!-- Logo -->
                <div class='row align-self-center my-3'>
                    <img src='./img/1offgames_logo_white_trimmed_navbar.png' />
                </div>
                <!--login form-->
                <div id="login" class="row">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <form class='row' action="php/addUser.php" method="POST" enctype="multipart/form-data" onsubmit="return validationAddUser()">
                                <!-- First half of fields -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="title">Username:</label>
                                        <input class="form-control" id="userName" name="userName" type="text" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Password:</label>
                                        <input class="form-control" id="password" name="userPass" type="password" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Retype Password:</label>
                                        <input class="form-control" id="passwordRe" name="userPassRE" type="password" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Email:</label>
                                        <input class="form-control" id="userEmail" name="userEmail" type="email" required>
                                    </div>
                                </div>
                                <!-- Second half of fields -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="title">Name:</label>
                                        <input class="form-control" id="Name" name="Name" type="text" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Address:</label>
                                        <input class="form-control" id="userAddress" name="userAddress" type="text" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Province/Territory:</label>
                                        <select class="form-control" id="userProvince" name="userProvince" type="text" required>
                                            <option value="AB">AB</option>
                                            <option value="BC">BC</option>
                                            <option value="MB">MB</option>
                                            <option value="NB">NB</option>
                                            <option value="NL">NL</option>
                                            <option value="NT">NT</option>
                                            <option value="NS">NS</option>
                                            <option value="NU">NU</option>
                                            <option value="ON">ON</option>
                                            <option value="PE">PE</option>
                                            <option value="QC">QC</option>
                                            <option value="SK">SK</option>
                                            <option value="YT">YT</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Postal code:</label>
                                        <input class="form-control" id="userPostal" name="userPostal" type="text" required>
                                    </div>
                                </div>

                                <div class="col w-100 text-center my-2 align-items-center justify-content-center">
                                    <button type="button" id="continueBtn" class="btn btn-danger" data-toggle="modal" data-target="" style="width: 10rem;" onclick="validateBeforePrivacyPolicy()">Continue</button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="privacyModal" aria-hidden="true">
                                    <div class="modal-dialog centered-content" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="privacyPolicyModal">Privacy Policy</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <!-- from policy.component.php -->
                                            <?php
                                            displayPrivacyPolicy();
                                            ?>

                                            <div class="form-check text-center">
                                                <input type="checkbox" class="form-check-input" id="policyAccepted" name="policyAccepted" value="yes" required>
                                                <label class="form-check-label" for="policyAccepted">I accept the terms and conditions</label>
                                            </div>
                                            <div class="modal-footer mt-4">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                                <button class="btn btn-danger" type="submit" value="Submit" name="submit" style="width: 10rem;">Register</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Already Registered -->
                <div class='row my-3 align-items-center justify-content-center'>
                    <span class='line-through text-secondary'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    &nbsp;Already have an account?&nbsp;
                    <span class='line-through text-secondary'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </div>
                <div class='row align-items-center justify-content-center'>
                    <a class='btn btn-danger' href='login.php' style="width: 10rem;">Login Here</a>
                </div>
            </div>
            <div class='col-md-2'></div>
        </div>
    </div>

    <?php
    footer();
    ?>

    <!-- JavaScript -->
    <script src='js/jquery.min.js'></script>
    <script src='js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="js/validation.js"></script>
</body>

</html>