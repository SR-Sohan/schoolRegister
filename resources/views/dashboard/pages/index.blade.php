<x-app-layout>


    <x-slot name="head">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Welcome back! Here's what's happening with your projects today.</p>
    </x-slot>

       <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700 transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                        <i class="fas fa-users text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</h3>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">2,847</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700 transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 dark:bg-green-900/20 rounded-lg">
                        <i class="fas fa-chart-line text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Revenue</h3>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">$24,589</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700 transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/20 rounded-lg">
                        <i class="fas fa-folder text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Projects</h3>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">142</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700 transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-2 bg-orange-100 dark:bg-orange-900/20 rounded-lg">
                        <i class="fas fa-clock text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending Tasks</h3>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">28</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">New user registered</p>
                        <span class="text-xs text-gray-500">2 min ago</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Project completed</p>
                        <span class="text-xs text-gray-500">5 min ago</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Server maintenance scheduled</p>
                        <span class="text-xs text-gray-500">10 min ago</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-4">
                    <button class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors duration-200">
                        <i class="fas fa-plus text-blue-600 dark:text-blue-400 mb-2"></i>
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">New Project</p>
                    </button>
                    <button class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors duration-200">
                        <i class="fas fa-user-plus text-green-600 dark:text-green-400 mb-2"></i>
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Add User</p>
                    </button>
                    <button class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors duration-200">
                        <i class="fas fa-chart-bar text-purple-600 dark:text-purple-400 mb-2"></i>
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Analytics</p>
                    </button>
                    <button class="p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg hover:bg-orange-100 dark:hover:bg-orange-900/30 transition-colors duration-200">
                        <i class="fas fa-cog text-orange-600 dark:text-orange-400 mb-2"></i>
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Settings</p>
                    </button>
                </div>
            </div>
        </div>

</x-app-layout>
