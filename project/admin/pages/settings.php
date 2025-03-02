<div class="container px-6 mx-auto grid">
    <!-- Header -->
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Admin Settings
    </h2>
    <!-- Profile Information Card -->
    <div class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
            Profile Information
        </h4>
        <form method="post" action="update_settings.php" enctype="multipart/form-data">
            <!-- Name Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="name">
                    Name
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="John Doe" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm" 
                />
            </div>
            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="email">
                    Email
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="john.doe@example.com" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm" 
                />
            </div>
            <!-- Profile Picture Field -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="profile-picture">
                    Profile Picture
                </label>
                <input 
                    type="file" 
                    id="profile-picture" 
                    name="profile-picture" 
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100" 
                />
            </div>
            <!-- Save Button -->
            <div class="mt-6">
                <button 
                    type="submit" 
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                    Save Changes
                </button>
            </div>
        </form>
        <!-- Change Password Link -->
        <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            To change your password, <a href="change_password.php" class="text-purple-600 hover:underline">click here</a>.
        </div>
    </div>
</div>