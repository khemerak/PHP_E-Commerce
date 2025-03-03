<?php
    require_once __DIR__ . "/../../db/User.php";
    $user = new User();
    $users = $user->getAllUsers();
    
?>
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Manage Users
    </h2>
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"><?= $user->getUserCount() ?></p>
            </div>
        </div>
    </div>
    <div class="mb-4 flex justify-between items-center">
        <div class="flex gap-2">
            <a href="?p=addUser"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Add New User
            </a>
        </div>
        <div class="flex items-center">
            <input type="text" id="searchInput" placeholder="Search by username..."
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
        </div>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap" id="userTable">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">User ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user_data): ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm"><?= htmlspecialchars($user_data['user_id']) ?></td>
                                <td class="px-4 py-3 text-sm username"><?= htmlspecialchars($user_data['username']) ?></td>
                                <td class="px-4 py-3 text-sm"><?= htmlspecialchars($user_data['email']) ?></td>
                                <td class="px-4 py-3 text-sm"><?= htmlspecialchars($user_data['role'] ?? 'user') ?></td>
                                <td class="px-4 py-3 text-xs">
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        Active
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="?p=editUser&id=<?= $user_data['user_id'] ?>"
                                        class="text-blue-600 hover:underline">Edit</a>
                                    <a href="?p=deleteUser&id=<?= $user_data['user_id'] ?>"
                                        class="text-red-600 hover:underline ml-2"
                                        onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td colspan="6" class="px-4 py-3 text-sm text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div
            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">Showing 1-<?= count($users) ?> of
                <?= $user->getUserCount() ?></span>
            <span class="col-span-2"></span>
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <li><button
                                class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                aria-label="Previous">
                                <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button></li>
                        <li><button
                                class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">1</button>
                        </li>
                        <li><button
                                class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">2</button>
                        </li>
                        <li><button
                                class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">3</button>
                        </li>
                        <li><button
                                class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                aria-label="Next">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button></li>
                    </ul>
                </nav>
            </span>
        </div>
    </div>
</div>
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchValue = this.value.trim().toLowerCase();
        const rows = document.querySelectorAll('#userTable tbody tr');

        rows.forEach(row => {
            const username = row.querySelector('.username').textContent.toLowerCase();
            if (searchValue === '' || username.includes(searchValue)) {
                row.style.display = ''; 
            } else {
                row.style.display = 'none'; 
            }
        });
    });
    let timeout;
    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            const searchValue = this.value.trim().toLowerCase();
            const rows = document.querySelectorAll('#userTable tbody tr');
            rows.forEach(row => {
                const username = row.querySelector('.username').textContent.toLowerCase();
                row.style.display = searchValue === '' || username.includes(searchValue) ? '' : 'none';
            });
        }, 300); // 300ms delay
    });
    rows.forEach(row => {
        const usernameCell = row.querySelector('.username');
        const username = usernameCell.textContent.toLowerCase();
        if (searchValue === '' || username.includes(searchValue)) {
            row.style.display = '';
            if (searchValue !== '') {
                const regex = new RegExp(`(${searchValue})`, 'gi');
                usernameCell.innerHTML = usernameCell.textContent.replace(regex, '<span style="background-color: yellow">$1</span>');
            }
        } else {
            row.style.display = 'none';
        }
    });
</script>