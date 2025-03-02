<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="index.php">Valera - Admin</a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <?php echo $p == "dashboard" ? "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>" : ""; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold <?= $p == "dashboard" ? 'text-purple-600 hover:text-purple-600 dark:text-gray-200' : '' ?> transition-colors duration-150 dark:hover:text-gray-200 "
                    href="index.php">
                    <span class="material-symbols-outlined">home</span>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul>
            <li class="relative px-6 py-3">
                <?php echo $p == "slideshows" ? "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>" : ""; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold <?= $p == "slideshows" ? 'text-purple-600 hover:text-purple-600 dark:text-gray-200' : '' ?> transition-colors duration-150 dark:hover:text-gray-200"
                    href="index.php?p=slideshows">
                    <span class="material-symbols-outlined">transition_slide</span>
                    <span class="ml-4">Slideshows</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <?php echo $p == "products" ? "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>" : ""; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold <?= $p == "products" ? 'text-purple-600 hover:text-purple-600 dark:text-gray-200' : '' ?> transition-colors duration-150 dark:hover:text-gray-200"
                    href="index.php?p=products">
                    <span class="material-symbols-outlined">package_2</span>
                    <span class="ml-4">Products</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <?php echo $p == "categories" ? "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>" : ""; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold <?= $p == "categories" ? 'text-purple-600 hover:text-purple-600 dark:text-gray-200' : '' ?> transition-colors duration-150 dark:hover:text-gray-200"
                    href="index.php?p=categories">
                    <span class="material-symbols-outlined">sell</span>
                    <span class="ml-4">Categories</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <?php echo $p == "users" ? "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>" : ""; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold <?= $p == "users" ? 'text-purple-600 hover:text-purple-600 dark:text-gray-200' : '' ?> transition-colors duration-150 dark:hover:text-gray-200"
                    href="index.php?p=users">
                    <span class="material-symbols-outlined">person</span>
                    <span class="ml-4">Users</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <?php echo $p == "settings" ? "<span class='absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg' aria-hidden='true'></span>" : ""; ?>
                <a class="inline-flex items-center w-full text-sm font-semibold <?= $p == "settings" ? 'text-purple-600 hover:text-purple-600 dark:text-gray-200' : '' ?> transition-colors duration-150 dark:hover:text-gray-200"
                    href="index.php?p=settings">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="ml-4">Settings</span>
                </a>
            </li>
        </ul>
        <div class="px-6 my-6">
            <a href="auth/logout.php"
                class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Logout
            </a>
        </div>
    </div>
</aside>