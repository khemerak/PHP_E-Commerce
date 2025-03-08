<?php
session_start();
require_once __DIR__ . '/../db/User.php';

$userModel = new User();

$pages = "pages/dashboard.php";
$p = "dashboard";
if (isset($_GET['p'])) {
    $p = $_GET['p'];
    switch ($p) {
        case 'products':
            $pages = "pages/products.php";
            break;
        case "slideshows":
            $pages = "pages/slideshows.php";
            break;
        case "addSlideshows":
            $pages = "../db/views/addSlideshows.php";
            break;
        case "editSlideshows":
            $pages = "../db/views/editSlideshows.php";
            break;
        case "deleteSlideshows":
            $pages = "../db/views/deleteSlideshows.php";
            break;
        case "categories":
            $pages = "pages/categories.php";
            break;
        case "addCategory":
            $pages = "../db/views/addCategory.php";
            break;
        case "editCategory":
            $pages = "../db/views/editCategory.php";
            break;
        case "deleteCategory":
            $pages = "../db/views/deleteCategory.php";
            break;        
        case "users":
            $pages = "pages/users.php";
            break;
        case "addUser":
            $pages = "../db/views/addUser.php";
            break;
        case "editUser":
            $pages = "../db/views/editUser.php";
            break;
        case "deleteUser":
            $pages = "../db/views/deleteUser.php";
            break;
        case "settings":
            $pages = "pages/settings.php";
            break;
        default:
            $pages =  "index.php";
            break;
    }
}

if (!isset($_SESSION['username']) || !$userModel->checkAdmin($_SESSION['username'])) {
    header("Location: auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<?php include_once 'includes/head.php'; ?>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <?php include 'includes/desktop-sidebar.php'; ?>
        <!-- Backdrop -->
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        </div>
        <?php //include "includes/sidebar.php"; ?>
        <div class="flex flex-col flex-1 w-full">
            <?php include "includes/header.php"; ?>
            <main class="h-full overflow-y-auto">
                <?php include "$pages"; ?>
            </main>
        </div>
    </div>
</body>

</html>