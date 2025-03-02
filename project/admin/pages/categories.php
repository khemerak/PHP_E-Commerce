
<div class="container px-6 mx-auto grid">
    <!-- Header -->
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Manage Categories
    </h2>
    <!-- Add New Category Button -->
    <div class="mb-4">
        <a href="add_category.php"
           class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Add New Category
        </a>
    </div>
    <!-- Categories Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Category ID</th>
                        <th class="px-4 py-3">Category Name</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Parent Category</th>
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <!-- Example Row 1: Top-Level Category -->
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">1</td>
                        <td class="px-4 py-3 text-sm">Electronics</td>
                        <td class="px-4 py-3 text-sm">Devices and gadgets</td>
                        <td class="px-4 py-3 text-sm">None</td>
                        <td class="px-4 py-3 text-sm">
                            <img src="path/to/electronics.jpg" alt="Electronics" class="w-10 h-10 object-cover">
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="edit_category.php?id=1" class="text-blue-600 hover:underline">Edit</a>
                            <a href="delete_category.php?id=1" class="text-red-600 hover:underline ml-2">Delete</a>
                        </td>
                    </tr>
                    <!-- Example Row 2: Subcategory -->
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">2</td>
                        <td class="px-4 py-3 text-sm">Smartphones</td>
                        <td class="px-4 py-3 text-sm">Mobile phones with advanced features</td>
                        <td class="px-4 py-3 text-sm">Electronics</td>
                        <td class="px-4 py-3 text-sm">
                            <img src="path/to/smartphones.jpg" alt="Smartphones" class="w-10 h-10 object-cover">
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="edit_category.php?id=2" class="text-blue-600 hover:underline">Edit</a>
                            <a href="delete_category.php?id=2" class="text-red-600 hover:underline ml-2">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing 1-10 of 20
            </span>
            <span class="col-span-2"></span>
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <li>
                            <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                                <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                1
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                2
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </span>
        </div>
    </div>
</div>