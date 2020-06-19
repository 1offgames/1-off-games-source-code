<?php
require_once 'php/category.php';
require_once 'php/console.php';
require_once 'php/navbar.php';
require_once 'php/footer.php';
require_once 'php/head.php';
require_once 'php/displayAlerts.php';
require_once 'php/userCheck.php'
?>

<!DOCTYPE html>
<html lang="en">

<!--Header-->
<?php
head();
?>

<body>
    <?php
    navbar();
    ?>

    <?php
    confirmation()
    ?>

    <?php
    admin();
    ?>

    <div class="container full-height">
        <!--Product form-->
        <div id="addProduct" class="d-flex justify-content-center mt-3">
            <div class="card h-100 flex-fill" style="max-width: 40rem;">
                <div class="card-body">
                    <form action="php/productAdd.php" method="POST" enctype="multipart/form-data" onsubmit="return validationAddProduct();">
                        <div class="form-group">
                            <label for="title">Product Title:</label>
                            <input class="form-control" id="title" name="title" type="text" required>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input class="form-control" id="quantity" name="quantity" type="number" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input class="form-control" id="price" name="price" type="number" step="0.01" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="category">Catagory:</label>
                            <select class="form-control" id="category" name="category" type="text" required>
                                <?php getCategories(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="system">Console:</label>
                            <select class="form-control" id="system" name="system" type="text" required>
                                <?php getPlatforms(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input class="form-control-file" id="image" name="image" type="file" accept=".png, .jpg, .jpeg" required>
                        </div>

                        <div class="form-group">
                            <label for="desc">Description:</label>
                            <textarea class="form-control" id="desc" name="desc" rows="5" cols="30" required></textarea>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-danger" type="submit" value="Submit" name="submit" style="width: 10rem;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Footer-->
    <?php
    footer();
    ?>

    <!-- JavaScript -->
    <script type="text/javascript" src="js/validation.js"></script>
    <script src='js/jquery.min.js'></script>
    <script src='js/bootstrap.bundle.min.js'></script>
</body>

</html>