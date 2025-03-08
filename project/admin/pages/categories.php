<?php
require_once __DIR__ . '/../../db/Categories.php';  
$categoryModel = new Category();

$itemsPerPage = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $itemsPerPage;

$totalCategories = $categoryModel->getCategoryCount();
$totalPages = ceil($totalCategories / $itemsPerPage);

$categories = $categoryModel->getAllCategories($itemsPerPage, $offset);
?>

<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Manage Categories</h2>
    <div class="mb-4 flex justify-between items-center">
        <div class="flex gap-2">
            <a href="?p=addCategory" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Add New Category</a>
        </div>
        <div class="flex items-center">
            <input type="text" id="searchInput" placeholder="Search by category name..." class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
        </div>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap" id="categoryTable">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Category ID</th>
                        <th class="px-4 py-3">Category Name</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Created At</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <?php if (empty($categories)): ?>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td colspan="5" class="px-4 py-3 text-sm text-center">No categories found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($categories as $category): ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($category['category_id']); ?></td>
                                <td class="px-4 py-3 text-sm category-name"><?php echo htmlspecialchars($category['name']); ?></td>
                                <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($category['description'] ?? 'No description'); ?></td>
                                <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($category['created_at']); ?></td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="?p=editCategory&id=<?php echo urlencode($category['category_id']); ?>" class="text-blue-600 hover:underline">Edit</a>
                                    <a href="?p=deleteCategory&id=<?php echo urlencode($category['category_id']); ?>" class="text-red-600 hover:underline ml-2">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing <?php echo min($offset + 1, $totalCategories); ?>-<?php echo min($offset + count($categories), $totalCategories); ?> of <?php echo $totalCategories; ?>
            </span>
            <span class="col-span-2"></span>
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <?php if ($page > 1): ?>
                            <li>
                                <a href="?p=categories&page=<?php echo $page - 1; ?>" class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                                    <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li>
                                <a href="?p=categories&page=<?php echo $i; ?>" class="px-3 py-1 rounded-md <?php echo $i === $page ? 'text-white bg-purple-600 border border-r-0 border-purple-600' : ''; ?> focus:outline-none focus:shadow-outline-purple"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages): ?>
                            <li>
                                <a href="?p=categories&page=<?php echo $page + 1; ?>" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </span>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchValue = this.value.trim().toLowerCase();
        const rows = document.querySelectorAll('#categoryTable tbody tr');

        rows.forEach(row => {
            const categoryName = row.querySelector('.category-name').textContent.toLowerCase();
            if (searchValue === '' || categoryName.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>