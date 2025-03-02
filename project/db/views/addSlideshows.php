<?php
require_once __DIR__ . '/../Slideshows.php';
$slideshows = new Slideshows();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_path = $_FILES['image']['name'];
    $caption = $_POST['caption'];
    $slide_order = $_POST['slide_order'];
    
    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image_path);
    $slideshows->createSlideshow('uploads/' . $image_path, $caption, $slide_order);
    header('Location: index.php');
    exit;
}
?>

<div class="container px-6 mx-auto grid">
    <div class="flex flex-row justify-between">

        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Add New Slideshow
        </h2>
        <a class="my-6 text-md rounded-lg bg-gray-500 font-semibold text-gray-700 dark:text-gray-200" href="?p=slideshows">
            
            Back to Slideshow
        </a>
    </div>
    <form method="POST" enctype="multipart/form-data" class="px-6 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400">Image</label>
            <input type="file" name="image" required class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-gray-300">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400">Caption</label>
            <input type="text" name="caption" required class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-gray-300">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400">Slide Order</label>
            <input type="number" name="slide_order" required class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-gray-300">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
                Save Slideshow
            </button>
        </div>
    </form>
</div>