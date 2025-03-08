<?php
require_once __DIR__ . '/../Categories.php';
$categoryModel = new Category();

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';

    try {
        if ($categoryModel->checkCategoryExists($name)) {
            $error_message = "Category with this name already exists";
        } else {
            $categoryModel->createCategory($name, $description);
            echo "<script>window.location.href = '?p=categories';</script>";
            exit();
        }
    } catch (Exception $e) {
        $error_message = "Error creating category: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .form-container {
            max-width: 80%; 
            margin: 40px 40px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add New Category
    </h2>
    
    <?php if ($error_message): ?>
        <div class="mb-4 px-4 py-2 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>
    
    <div class="px-6 py-8 bg-white rounded-lg shadow-xs dark:bg-gray-800 form-container">
        <form method="POST" class="space-y-6 p-4">
            <div>
                <label class="mt-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Category Name
                </label>
                <input type="text" name="name" required class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div>
                <label class="mt-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Description (Optional)
                </label>
                <textarea name="description" class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" rows="4"></textarea>
            </div>
            <div class="flex gap-4 mt-8">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Create Category
                </button>
                <a href="?p=categories" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>