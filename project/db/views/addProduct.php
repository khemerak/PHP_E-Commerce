<?php
require_once __DIR__ . '/../Product.php';
$productModel = new Product();

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? '';
    $stock_quantity = $_POST['stock_quantity'] ?? '';
    $image = $_FILES['image']['name'] ?? null;

    if ($productModel->checkProductExists($name)) {
        $error_message = "Product with this name already exists";
    } else {
        try {
            if ($image) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($image);
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            }
            $productModel->createProduct($name, $description, $price, $stock_quantity, $image);
            echo "<script>window.location.href = '?p=products';</script>";
            exit();
        } catch (Exception $e) {
            $error_message = "Error creating product: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Add New Product</h2>
    <?php if ($error_message): ?>
        <div class="mb-4 px-4 py-2 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>
    <div class="px-6 py-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <form method="POST" enctype="multipart/form-data" class="space-y-6">
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Product Name</label>
                <input type="text" name="name" required class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                <textarea name="description" class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" rows="4"></textarea>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Price</label>
                <input type="number" step="0.01" name="price" required class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Stock_quantity</label>
                <input type="number" name="stock_quantity" required class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div><label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Image (Optional)</label>
                <input type="file" name="image" class="w-full px-4 py-2 mt-2 text-sm border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div class="flex gap-4">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">Create Product</button>
                <a href="?p=products" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>