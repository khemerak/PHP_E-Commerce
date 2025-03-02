<?php
require_once __DIR__ . '/../Slideshows.php';
$slideshows = new Slideshows();
$id = $_GET['id'];
$slide = $slideshows->findById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_path = $slide['image_path'];
    if ($_FILES['image']['name']) {
        $image_path = 'uploads/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }
    $slideshows->updateSlideshow($id, $image_path, $_POST['caption'], $_POST['slide_order']);
    header('Location: index.php');
    exit;
}
?>

<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Edit Slideshow
    </h2>
    <form method="POST" enctype="multipart/form-data" class="px-6 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400">Image</label>
            <img src="<?php echo $slide['image_path']; ?>" class="w-20 h-20 object-cover mb-2">
            <input type="file" name="image" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-gray-300">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400">Caption</label>
            <input type="text" name="caption" value="<?php echo htmlspecialchars($slide['caption']); ?>" required class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-gray-300">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400">Slide Order</label>
            <input type="number" name="slide_order" value="<?php echo $slide['slide_order']; ?>" required class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-gray-300">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
                Update Slideshow
            </button>
        </div>
    </form>
</div>