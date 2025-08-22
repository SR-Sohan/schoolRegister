<div id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-xl transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300 ease-in-out">
    <div class="flex items-center justify-center h-16 px-4 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="flex items-center">
            <span class="ml-2 text-lg font-bold text-white">{{ auth()->user()->name }}</span>
        </div>
    </div>

    <nav class="mt-8 px-4 space-y-2 overflow-y-auto scrollbar-hide h-full pb-20">
        <div class="space-y-2">
            <!-- Dashboard (visible to all authenticated users, adjust if needed) -->
            <a href="{{ route('oxadmin') }}"
                class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-200 group">
                <i class="fas fa-home w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                <span class="ml-3 font-medium">Dashboard</span>
            </a>


            <div class="space-y-1">
                <button onclick="toggleSubmenu('institute')"
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <div class="flex items-center">
                        <i class="fas fa-folder w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                        <span class="ml-3 font-medium">Institute</span>
                    </div>
                    <i id="institute-icon" class="fas fa-chevron-right transition-transform duration-200"></i>
                </button>
                <div id="institute-submenu" class="hidden pl-8 space-y-1">

                    <a href=""
                        class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-150">Institute
                        Lists</a>


                    <a href=""
                        class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-150">Create
                        Institute</a>


                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-150">Set
                        Fees Institute</a>

                </div>
            </div>




            <div class="space-y-1">
                <button onclick="toggleSubmenu('exams')"
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <div class="flex items-center">
                        <i class="fas fa-chart-bar w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                        <span class="ml-3 font-medium">Manage Session</span>
                    </div>
                    <i id="exams-icon" class="fas fa-chevron-right transition-transform duration-200"></i>
                </button>
                <div id="exams-submenu" class="hidden pl-8 space-y-1">


                    <a href=""
                        class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        Class</a>



                    <a href=""
                        class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-150">Group</a>



                    <a href=""
                        class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-150">Subjects</a>


                    <a href=""
                        class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-150">Sessions</a>

            </div>
        </div>


        <div class="space-y-1">
            <button onclick="toggleSubmenu('school-register')"
                class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-200 group">
                <div class="flex items-center">
                    <i class="fas fa-chart-bar w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
                    <span class="ml-3 font-medium">School Registration</span>
                </div>
                <i id="exams-icon" class="fas fa-chevron-right transition-transform duration-200"></i>
            </button>
            <div id="school-register-submenu" class="hidden pl-8 space-y-1">


                <a href=""
                    class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-150">Register</a>


                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-150">Students
                    List</a>


            </div>
        </div>






        <a href=""
            class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-200 group">
            <i class="fas fa-user-shield w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
            <span class="ml-3 font-medium">Roles & Permission</span>
        </a>


        <!-- Settings (visible to all authenticated users, adjust if needed) -->
        <a href="{{ route('profile.edit') }}"
            class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-200 group">
            <i class="fas fa-cog w-5 h-5 text-gray-500 group-hover:text-blue-600"></i>
            <span class="ml-3 font-medium">Settings</span>
        </a>
    </div>
</nav>
</div>

<!-- JavaScript for submenu toggle -->
<script>
    function toggleSubmenu(id) {
        const submenu = document.getElementById(`${id}-submenu`);
        const icon = document.getElementById(`${id}-icon`);
        submenu.classList.toggle('hidden');
        icon.classList.toggle('rotate-90');
    }
</script>
