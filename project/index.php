<?php 
    session_start();
    $pagesAllow = [
        '' => ['file' => 'pages/home.php', 'access' => 'public'],
        'home' => ['file' => 'pages/home.php', 'access' => 'public'],
        'shop' => ['file' => 'pages/shop.php', 'access' => 'public'],
        'contact' => ['file' => 'pages/contact.php', 'access' => 'public'],
        'login' => ['file' => 'auth/login.php', 'access' => 'public'],
        'register' => ['file' => 'auth/register.php', 'access' => 'public'],
        'account' => ['file' => 'user/account.php', 'access' => 'required_login'],
        'cart' => ['file' => 'cart/cart.php', 'access' => 'required_login'],
        'orders' => ['file' => 'cart/orders.php', 'access' => 'required_login'],
    ];
    $uriReq = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $req = trim($uriReq, '/');
    if(array_key_exists($req, $pagesAllow)) {
        $route = $pagesAllow[$req];
        $access = $route['access'];
        if($access === 'public') {
            include $route['file'];
        } 
        elseif ($access === 'required_login') {
            if (isset($_SESSION['required_login']) && $_SESSION['required_login']) {
                include $route['file'];
            } else {
                header('Location: login');
                exit;
            }
        }
    } 
    else {
        include 'pages/error.php';
    }
?> 
<!DOCTYPE html>
<html lang="en">
    <?php include "includes/head.php"; ?>
<body>
    <?php include "includes/preloader.php"; ?>
    <?php include "includes/offcanvas.php"; ?>
    <?php include "includes/header.php"; ?>
    <?php include "includes/categories.php"; ?>
    <?php include "includes/banner.php"; ?>
    <?php include "includes/product.php"; ?>
    <?php include "includes/discount.php"; ?>
    <?php include "includes/trend.php"; ?>
    <?php include "includes/services.php"; ?>
    <?php include "includes/instagram.php"; ?>
    <?php include "includes/footer.php"; ?>
    <?php include "includes/search.php"; ?>
</body>
</html>