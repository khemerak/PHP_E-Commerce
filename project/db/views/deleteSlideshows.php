<?php
require_once __DIR__ . '/../Slideshows.php';
$slideshows = new Slideshows();
$id = $_GET['id'];
$slideshows->deleteSlideshow($id);
echo "<script>window.location.href = '?p=slideshows';</script>";

exit;