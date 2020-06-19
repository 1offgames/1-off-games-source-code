<!-- @format -->
<?php
include('./php/mysqli_connect.php');
require_once('./php/head.php');
require_once('./php/navbar.php');
require_once('./php/breadcrumb.component.php');
require_once('./php/alert.component.php');
require_once('./php/displayProductsByCategory.php');
require_once('./php/displayProductsByPlatform.php');
require_once('./php/card.component.php');
require_once('./php/pagination.component.php');
require_once('./php/footer.php');
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
// If redirect contains addedtocart then return alert
if (isset($_GET['addedtocart'])) {
    $addedtocart = $_GET['addedtocart'];

    if ($addedtocart == 'true') {
        // alert.component.php
        alert('Product successfully added to cart.', 'alert-success');
    } else {
        alert('Something went wrong. Please try again.', 'alert-danger');
    }
}

// If we happen to have a page number supplied to us
if (isset($_GET['page'])) {
    $pageNumber = $_GET['page'];
} else {
    $pageNumber = 1;
}

// Check to see if there are any filter variables present
$hasFilter = false;

if (isset($_GET['category'])) {
    $categoryFilter = $_GET['category'];
    $hasFilter = true;
} else {
    $categoryFilter = null;
}

if (isset($_GET['platform'])) {
    $platformFilter = $_GET['platform'];
    $hasFilter = true;
} else {
    $platformFilter = null;
}

// Get total number of games in system

if ($hasFilter) {
    if (is_null($categoryFilter)) {
        $sql = "SELECT COUNT(product_name) FROM `products` WHERE platform_id = $platformFilter";
    } else if (is_null($platformFilter)) {
        $sql = "SELECT COUNT(product_name) FROM `products` WHERE category_id = $categoryFilter";
    } else {
        $sql = "SELECT COUNT(product_name) FROM `products` WHERE category_id = $categoryFilter AND platform_id = $platformFilter";
    }
} else {
    $sql = "SELECT COUNT(product_name) FROM products";
}
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);

$total = $row[0];

// Get Total Page Count Roundup(Total Count / Amount Per Page)

$pageCount = ceil(($total / 9));

// Now we need to generate the SQL statement for get games for that page number
$offset = 9 * $pageNumber - 9;
if ($hasFilter) {
    if (is_null($categoryFilter)) {
        $pageContentSQL = "SELECT * FROM `products` WHERE platform_id = $platformFilter LIMIT $offset, 9";
    } else if (is_null($platformFilter)) {
        $pageContentSQL = "SELECT * FROM `products` WHERE category_id = $categoryFilter LIMIT $offset, 9";
    } else {
        $pageContentSQL = "SELECT * FROM `products` WHERE category_id = $categoryFilter AND platform_id = $platformFilter LIMIT $offset, 9";
    }
} else {
    $pageContentSQL = "SELECT * FROM `products` LIMIT $offset, 9";
}


?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-3 my-4">

            <!-- Categories -->
            <h4>Genres</h4>
            <ul class="list-group mb-3">
                <?php
                $query = 'SELECT category_name, COUNT(p.category_id) as count, c.category_id FROM categories c INNER JOIN products p ON c.category_id = p.category_id GROUP BY p.category_id ORDER BY category_name ASC';

                $result = mysqli_query($link, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    displayProductsByCategory($row['category_name'], $row['count'], $row['category_id']);
                    $categoryArray[$row['category_id']] = $row['category_name'];
                }
                ?>
            </ul>

            <!-- Platforms -->
            <h4>Platforms</h4>
            <ul class="list-group">
                <?php
                $query = 'SELECT platform_name, COUNT(prod.platform_id) as count, p.platform_id FROM platforms p INNER JOIN products prod ON p.platform_id = prod.platform_id GROUP BY prod.platform_id ORDER BY p.platform_name ASC';

                $result = mysqli_query($link, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    displayProductsByPlatform($row['platform_name'], $row['count'], $row['platform_id']);
                    $platformArray[$row['platform_id']] = $row['platform_name'];

                }
                ?>
            </ul>
            <!-- /Left Column -->
        </div>

        <!-- Right Column -->
        <div class="col-lg-9">
            <!-- Breadcrumb -->
            <?php
            if ($hasFilter) {
                if (is_null($categoryFilter)) {
                    breadcrumb($platformArray[$platformFilter]. " Games");
                } else if (is_null($platformFilter)) {
                    breadcrumb($categoryArray[$categoryFilter]. " Games");
                } else {
                    breadcrumb("$platformArray[$platformFilter] $categoryArray[$categoryFilter] Games");
                }
            } else {
                breadcrumb('');
            }

            ?>

            <!-- Cards -->
            <div id="displayCards">
                <div class="row">
                    <?php
                    //$query = "SELECT * FROM products";

                    $result = mysqli_query($link, $pageContentSQL);

                    while ($row = mysqli_fetch_array($result)) {
                        card($row['product_id'], $row['product_name'], $row['product_price'], '', $row['product_image'], $categoryFilter, $platformFilter, $pageNumber);
                    }
                    ?>
                </div>
            </div>

            <!-- Pages -->
            <div id="displayPagination">
                <?php
                pagination("products.php", $pageNumber, $pageCount, $categoryFilter, $platformFilter);
                ?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.col-lg-9 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

<!-- Footer -->
<?php
footer();
?>

<!-- JavaScript -->
<script src='js/jquery.min.js'></script>
<script src='js/bootstrap.bundle.min.js'></script>
</body>

</html>