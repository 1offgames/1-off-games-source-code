<?php
require_once 'php/navbar.php';
require_once 'php/footer.php';
require_once 'php/head.php';
require_once 'php/displayAlerts.php';
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
    privacyPolicyStatus();
    userLog();
    ?>

    <!--login form-->
    <div class="container full-height">
        <div class='row full-height'>
            <div class='col-md-4'></div>
            <div class='col-md-4 flex-column d-flex justify-content-center align-content-center'>
                <!-- Logo -->
                <div class='row align-self-center my-3'>
                    <img src='./img/1offgames_logo_white_trimmed_navbar.png' />
                </div>
                <!-- Login Form -->
                <div id="login" class="row">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <form action="php/user.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Username:</label>
                                    <input class="form-control" id="userName" name="userName" type="text" required>
                                </div>

                                <div class="form-group">
                                    <label for="title">Password:</label>
                                    <input class="form-control" id="password" name="userPass" type="password" required>
                                </div>

                                <div class="text-center mt-4">
                                    <button class="btn btn-danger" type="submit" value="Submit" name="submit" style="width: 10rem;">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Already Registered -->
                <div class='row my-3 align-items-center justify-content-center'>
                    <span class='line-through text-secondary'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    &nbsp;New to 1-OFF Games?&nbsp;
                    <span class='line-through text-secondary'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </div>
                <div class='row align-items-center justify-content-center'>
                    <a class='btn btn-danger' href='register.php'>Create an account here</a>
                </div>
            </div>
            <div class='col-md-4'></div>
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