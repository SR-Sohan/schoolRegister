 <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Mobile menu button -->
                        <div class="flex items-center">
                            <button id="mobile-menu-button" class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition-colors duration-200">
                                <i class="fas fa-bars text-xl"></i>
                            </button>

                            <!-- Search Bar -->
                            <div class="ml-4 flex-1 max-w-md">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" placeholder="Search..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                            </div>
                        </div>

                        <!-- Right side -->
                        <div class="flex items-center space-x-4">
                            <!-- Dark mode toggle -->
                            <button id="theme-toggle" class="p-2 rounded-lg text-gray-500 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition-all duration-200 transform hover:scale-105">
                                <i id="theme-icon" class="fas fa-moon text-xl"></i>
                            </button>

                            <!-- User dropdown -->
                            <div class="relative">
                                <button id="user-menu-button" class="flex items-center space-x-3 text-sm rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 p-2 transition-colors duration-200">
                                    <img class="w-8 h-8 rounded-full ring-2 ring-blue-500" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="User avatar">
                                    <div class="hidden md:block text-left">
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ auth()->user()->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Admin</div>
                                    </div>
                                    <i class="fas fa-chevron-down text-gray-400 ml-2"></i>
                                </button>

                                <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-50 border border-gray-200 dark:border-gray-700 transform opacity-0 scale-95 transition-all duration-200">

                                    <a href="{{route("profile.edit")}}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150">
                                        <i class="fas fa-cog mr-2"></i>Settings
                                    </a>
                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <p  class="block cursor-pointer px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150" :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">

                                        <i class="fas fa-sign-out-alt mr-2"></i>Sign out
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
