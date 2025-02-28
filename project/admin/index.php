<?php
session_start();
$route = [

];

$pages = "pages/dashboard.php";
if (isset($_GET['p'])) {
  $p = $_GET['p'];
  switch ($p) {
    case "slideshows":
      $pages = "pages/slideshows.php";
      break;
    case "users":
      $pages = "pages/users.php";
      break;
    case "products":
      $pages = "pages/products.php";
      break;
    case "settings":
      $pages = "pages/settings.php";
      break;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/head.php" ?>
<body>
  <div class="container-scroller">
    <?php include "includes/layout/navbar.php"; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include "includes/layout/sidebar.php"; ?>
      <?php include "$pages" ?>
    </div>
  </div>
  <?php include "includes/script.php" ?>
</body>

</html>
<?php
session_unset();
session_destroy();
exit;
?>