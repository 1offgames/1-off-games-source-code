<?php
function admin()
{
    if (!isset($_SESSION["admin"])) {
        header("Location: ./index.php");
        exit();
    }

    if ($_SESSION["admin"] == "no") {
        header("Location: ./index.php");
        exit();
    }
}
