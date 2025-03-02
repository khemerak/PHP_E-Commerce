<?php
require_once __DIR__ . '/../User.php';
$userModel = new User();

$id = $_GET['id'] ?? null;
$user = $id ? $userModel->findByUsername($id) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['password'] ?? '';
    if ($new_password) {
        $userModel->updatePassword($id, $new_password);
    }
    echo "<script>window.location.href = '?p=users';</script>";
    exit();
}
?>
<div class="container px-6 mx-auto grid">
    <?php echo $user;?>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Edit User
    </h2>
    <div class="px-6 py-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Username
                </label>
                <input type="text" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" disabled class="w-full px-4 py-2 mt-2 text-sm border rounded-lg bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Email
                </label>
                <input type="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" disabled class="w-full px-4 py-2 mt-2 text-sm border rounded-lg bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                    New Password (leave blank to keep current)
                </label>
                <input type="password" name="password" class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div class="flex gap-4">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Update User
                </button>
                <a href="?p=users" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>