
        // Preloader functionality
        const preloaderOverlay = document.getElementById('preloaderOverlay');
        let isLoading = false;
        let loadingTimeout;

        // Show preloader function
        function showPreloader() {
            if (!isLoading) {
                isLoading = true;
                preloaderOverlay.classList.add('active');
                document.body.classList.add('loading');

                // Clear any existing timeout
                clearTimeout(loadingTimeout);

                // Auto-hide after 10 seconds as fallback
                loadingTimeout = setTimeout(() => {
                    hidePreloader();
                }, 10000);
            }
        }

        // Hide preloader function
        function hidePreloader() {
            isLoading = false;
            preloaderOverlay.classList.remove('active');
            document.body.classList.remove('loading');
            clearTimeout(loadingTimeout);
        }

        /*
        // Show preloader on any click (except preloader itself and certain elements)
        document.addEventListener('click', function(e) {
            // Don't trigger preloader for these elements
            const excludeSelectors = [
                '.preloader-overlay',
                '[data-no-preloader]',
                'button[type="button"]:not([data-preloader])',
                '.dropdown-toggle',
                '#theme-toggle',
                '#user-menu-button',
                '#mobile-menu-button'
            ];

            const shouldExclude = excludeSelectors.some(selector =>
                e.target.closest(selector)
            );

            if (!shouldExclude && !isLoading) {
                showPreloader();
            }
        });

        */

        // Show preloader on form submissions
        document.addEventListener('submit', function(e) {
            showPreloader();
        });


        /*
        // Show preloader on link clicks (navigation)
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && link.href && !link.href.startsWith('#') &&
                !link.hasAttribute('download') &&
                !link.hasAttribute('data-no-preloader')) {
                showPreloader();
            }
        });
      */
        // Hide preloader when page is fully loaded
        window.addEventListener('load', function() {
            hidePreloader();
        });

        // Hide preloader on page show (back/forward navigation)
        window.addEventListener('pageshow', function(e) {
            hidePreloader();
        });

        // For AJAX requests (if using jQuery)
        if (typeof $ !== 'undefined') {
            $(document).ajaxStart(function() {
                showPreloader();
            });

            $(document).ajaxStop(function() {
                setTimeout(hidePreloader, 300);
            });
        }

        // For Fetch API requests
        const originalFetch = window.fetch;
        window.fetch = function() {
            showPreloader();
            return originalFetch.apply(this, arguments)
                .finally(() => {
                    setTimeout(hidePreloader, 500);
                });
        };

        // Dark mode toggle
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const html = document.documentElement;

        function setTheme(theme) {
            if (theme === 'dark') {
                html.classList.add('dark');
                themeIcon.className = 'fas fa-sun text-xl';
                localStorage.setItem('theme', 'dark');
            } else {
                html.classList.remove('dark');
                themeIcon.className = 'fas fa-moon text-xl';
                localStorage.setItem('theme', 'light');
            }
        }

        // Initialize theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
            setTheme(currentTheme === 'dark' ? 'light' : 'dark');
        });

        // User dropdown
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');

        userMenuButton.addEventListener('click', () => {
            userDropdown.classList.toggle('hidden');
            if (!userDropdown.classList.contains('hidden')) {
                userDropdown.classList.remove('opacity-0', 'scale-95');
                userDropdown.classList.add('opacity-100', 'scale-100');
            } else {
                userDropdown.classList.add('opacity-0', 'scale-95');
                userDropdown.classList.remove('opacity-100', 'scale-100');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden', 'opacity-0', 'scale-95');
                userDropdown.classList.remove('opacity-100', 'scale-100');
            }
        });

        // Mobile sidebar toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        function toggleMobileSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        }

        mobileMenuButton.addEventListener('click', toggleMobileSidebar);
        sidebarOverlay.addEventListener('click', toggleMobileSidebar);

        // Submenu toggle
        function toggleSubmenu(menuId) {
            const submenu = document.getElementById(menuId + '-submenu');
            const icon = document.getElementById(menuId + '-icon');

            submenu.classList.toggle('hidden');

            if (submenu.classList.contains('hidden')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(90deg)';
            }
        }

        // Make toggleSubmenu available globally
        window.toggleSubmenu = toggleSubmenu;
