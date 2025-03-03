<?php
require_once __DIR__ . '/../User.php';
$userModel = new User();

$id = $_GET['id'] ?? null;
$user = $id ? $userModel->findByUsername($id) : null;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? $user['username']; // Default to current if not provided
    $email = $_POST['email'] ?? $user['email']; // Default to current if not provided
    $new_password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Verify password match if a new password is provided
    if ($new_password && !$userModel->verifyPasswordMatch($new_password, $confirm_password)) {
        $error_message = "Passwords do not match";
    } else {
        try {
            // Update user details (username, email, and password if provided)
            $userModel->updateUser($id, $username, $email, $new_password);
            echo "<script>window.location.href = '?p=users';</script>";
            exit();
        } catch (Exception $e) {
            $error_message = "Error updating user: " . $e->getMessage();
        }
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
    <style>
        .password-wrapper {
            position: relative;
        }
        .password-message {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            z-index: 10;
        }
    </style>
</head>
<body>
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Edit User
    </h2>

    <?php if ($error_message): ?>
        <div class="mb-4 px-4 py-2 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <div class="px-6 py-8 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Username
                </label>
                <input type="text" name="username" placeholder="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Email
                </label>
                <input type="email" name="email" placeholder="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
            </div>
            <div class="relative password-wrapper">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                    New Password (leave blank to keep current)
                </label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                <span class="absolute inset-y-0 right-0 mr-2 pr-3 flex items-center cursor-pointer mt-6">
                    <i id="togglePasswordIcon" class="fas fa-eye text-gray-500 dark:text-gray-400" onclick="togglePassword('password', 'togglePasswordIcon')"></i>
                </span>
            </div>
            <div class="relative password-wrapper">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Confirm New Password
                </label>
                <input type="password" name="confirm_password" id="confirm_password" class="w-full px-4 py-2 mt-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" onblur="verifyPasswordMatch()">
                <span class="absolute inset-y-0 right-0 mr-2 pr-3 flex items-center cursor-pointer mt-6">
                    <i id="toggleConfirmPasswordIcon" class="fas fa-eye text-gray-500 dark:text-gray-400" onclick="togglePassword('confirm_password', 'toggleConfirmPasswordIcon')"></i>
                </span>
                <p id="passwordMatchMessage" class="mt-1 text-sm text-red-600 dark:text-red-400 hidden password-message">Passwords do not match</p>
            </div>
            <div class="flex gap-4">
                <button type="submit" id="submitButton" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Update User
                </button>
                <a href="?p=users" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }

    function verifyPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const message = document.getElementById('passwordMatchMessage');
        const submitButton = document.getElementById('submitButton');

        if (password === confirmPassword && password !== '') {
            message.classList.add('hidden');
            message.classList.remove('text-red-600', 'dark:text-red-400');
            message.classList.add('text-green-600', 'dark:text-green-400');
            message.textContent = "Passwords match";
            message.classList.remove('hidden');
            submitButton.disabled = false;
        } else if (confirmPassword !== '' || password !== '') {
            message.classList.remove('hidden', 'text-green-600', 'dark:text-green-400');
            message.classList.add('text-red-600', 'dark:text-red-400');
            message.textContent = "Passwords do not match";
            submitButton.disabled = true;
        } else {
            message.classList.add('hidden');
            submitButton.disabled = false; // Allow submission if no password change
        }
    }
</script>
</body>
</html>