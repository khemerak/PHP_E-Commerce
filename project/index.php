<?php 
    session_start();
    // $page = "userPages/home.php";
    // $p = "home";
    // if (isset($_GET['p'])) {
    //     $p = $_GET['p'];
    //     switch ($p) {
    //         case 'shop':
    //             $pages = "userPages/shop.php";
    //             break;
    //         case "contact":
    //             $pages = "userPages/contact.php";
    //             break;
    //         default:
    //             $pages =  "index.php";
    //             break;
    //     }
    // }
?> 
<!DOCTYPE html>
<html lang="en">
    <?php include "includes/head.php"; ?>
<body>
    <?php //include "includes/preloader.php"; ?>
    <?php include "includes/offcanvas.php"; ?>
    <?php include "includes/header.php"; ?>
    <?php include "includes/banner.php"; ?>
    <?php include "includes/categories.php"; ?>
    <?php include "includes/product.php"; ?>
    <?php include "includes/discount.php"; ?>
    <?php include "includes/trend.php"; ?>
    <?php include "includes/services.php"; ?>
    <?php include "includes/instagram.php"; ?>
    <?php //include "$page"; ?>
    <?php include "includes/footer.php"; ?>
    <?php include "includes/search.php"; ?>
</body>
</html>