<?php
// session_start();

?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/head.php" ?>

<body>
  <div class="container-scroller">
    <!-- partial:partials/navbar -->
    <?php include "includes/layout/navbar.php"; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include "includes/layout/sidebar.php"; ?>
      <!-- partial -->
      <?php include "pages/dashboard.php" ?>
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <?php include "includes/script.php" ?>
</body>
</html>
<?php
session_start();
session_unset();
session_destroy();
header('Location: auth/login.php');
exit;
?>