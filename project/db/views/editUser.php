<?php
require_once __DIR__ . '/../User.php';
$userModel = new User();

$id = $_GET['id'] ?? null;
$user = $id ? $userModel->findByUsername($userModel->findById($id)['username']) : null; // Adjust if findById exists
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? $user['username'];
    $email = $_POST['email'] ?? $user['email'];
    $role = $_POST['role'] ?? $user['role'];

    try {
        $existingUser = $userModel->findByUsername($username);
        if ($existingUser && $existingUser['user_id'] != $id) {
            $error_message = "Another user with this username already exists";
        } else {
            $userModel->updateUser($id, $username, $email, $role);
            echo "<script>window.location.href = '?p=users';</script>";
            exit();
        }
    } catch (Exception $e) {
        $error_message = "Error updating user: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Edit User</h2>

    <?php if ($error_message): ?>
        <div class="mb-4 px-4 py-2 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <div class="px-6 py-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" placeholder="<?php echo htmlspecialchars($user['username'] ?? 'Enter username'); ?>" required class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" placeholder="<?php echo htmlspecialchars($user['email'] ?? 'Enter email'); ?>" required class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Role</label>
                <select name="role" class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    <option value="customer" <?php echo ($user['role'] ?? 'customer') === 'customer' ? 'selected' : ''; ?>>Customer</option>
                    <option value="admin" <?php echo ($user['role'] ?? 'customer') === 'admin' ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>
            <div class="flex gap-4">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Update User</button>
                <a href="?p=users" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>