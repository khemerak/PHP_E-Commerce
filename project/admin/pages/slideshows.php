<?php
require_once __DIR__ . "/../../db/Slideshows.php";
$slideshows = new Slideshows();
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$slides = $slideshows->getAll($limit, $offset);
$totalSlides = $slideshows->getSlideshowCount();
$totalPages = ceil($totalSlides / $limit);
?>

<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Manage Slideshows
    </h2>
    <div class="mb-4 flex justify-between items-center">
        <a href="?p=addSlideshows" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Add New Slideshow
        </a>
        <form method="GET" class="flex items-center">
            <input type="text" name="q" class="px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-gray-300" placeholder="Search by caption...">
            <button type="submit" class="ml-2 px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
                Search
            </button>
        </form>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Details</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <?php foreach ($slides as $slide): ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <span class="text-sm">
                                    ID: <?php echo $slide['id']; ?> | 
                                    Caption: <?php echo htmlspecialchars($slide['caption']); ?> | 
                                    Order: <?php echo $slide['slide_order']; ?>
                                </span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="?p=edit&id=<?php htmlspecialchars($slide['id'])?>" class="text-blue-600 hover:underline">Edit</a>
                            <a href="?p=delete&id=<?php  htmlspecialchars($slide['id']) ?>" class="text-red-600 hover:underline ml-2" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3" colspan="2">
                            <div class="preview-container">
                                <img src="<?php echo $slide['image_path']; ?>" 
                                     alt="<?php echo htmlspecialchars($slide['caption']); ?>" 
                                     class="max-w-full h-auto rounded-md shadow-sm max-h-64 object-contain">
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing <?php echo $offset + 1; ?>-<?php echo min($offset + $limit, $totalSlides); ?> of <?php echo $totalSlides; ?>
            </span>
            <span class="col-span-2"></span>
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav>
                    <ul class="inline-flex items-center">
                        <?php if ($page > 1): ?>
                        <li><a href="?page=<?php echo $page-1; ?>" class="px-3 py-1 rounded-md">Previous</a></li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li><a href="?page=<?php echo $i; ?>" 
                              class="px-3 py-1 rounded-md <?php echo $page == $i ? 'bg-purple-600 text-white' : ''; ?>">
                            <?php echo $i; ?>
                        </a></li>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages): ?>
                        <li><a href="?page=<?php echo $page+1; ?>" class="px-3 py-1 rounded-md">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </span>
        </div>
    </div>
</div>

<style>
.preview-container {
    padding: 1rem;
    background-color: #f9fafb;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
}

.dark .preview-container {
    background-color: #1f2937;
}
</style>