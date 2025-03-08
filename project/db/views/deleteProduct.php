<?php
require_once __DIR__ . '/../Product.php';
$productModel = new Product();

$id = $_GET['id'] ?? null;
$product = $id ? $productModel->findById($id) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($id) {
        $productModel->deleteProduct($id);
    }
    echo "<script>window.location.href = '?p=products';</script>";
    exit();
}
?>

<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Delete Product</h2>
    <div class="px-6 py-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="mb-6">
            <p class="text-gray-700 dark:text-gray-200">
                Are you sure you want to delete product "<?php echo htmlspecialchars($product['name'] ?? ''); ?>"?
                This action cannot be undone.
            </p>
        </div>
        <form method="POST" class="flex gap-4">
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">Yes, Delete</button>
            <a href="?p=products" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</a>
        </form>
    </div>
</div>