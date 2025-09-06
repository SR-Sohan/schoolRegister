<x-app-layout>
    <x-slot name="head">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100"> Subjects</h1>
    </x-slot>

    <div class=" gap-2 mb-6 relative z-30">
        {{-- <h1>{{ $title }}</h1> --}}
        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-end">

            <a href="{{ route('subject.create') }}"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">Create</a>


            <button
                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow transition">PDF</button>
            <button
                class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow transition">Print</button>
            <button
                class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg shadow transition">CSV</button>


            <button id="dropdownToggle" type="button"
                class="inline-flex justify-center items-center px-4 py-2.5 text-sm font-medium bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2z" />
                </svg>
                Columns
                <svg class="ml-2 h-4 w-4 transition-transform duration-200" id="columnChevron" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

        </div>

        <!-- Columns Dropdown -->
        <div class="relative">


            <!-- Dropdown -->
            <div id="columnDropdown"
                class="absolute right-0 mt-2 w-56 rounded-lg shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 dark:ring-gray-600 hidden z-50 border border-gray-100 dark:border-gray-700">
                <div class="p-3 max-h-64 overflow-y-auto">
                    <div class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">
                        Show/Hide Columns
                    </div>
                    @foreach ($allColumns as $index => $col)
                        <label
                            class="flex items-center space-x-3 py-2 px-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition-colors duration-150 cursor-pointer">
                            <input type="checkbox"
                                class="form-checkbox column-toggle h-4 w-4 text-blue-600 rounded border-gray-300 dark:border-gray-600 focus:ring-blue-500 dark:focus:ring-blue-400"
                                data-index="{{ $index + 1 }}" {{ in_array($col, $visibleColumns) ? 'checked' : '' }}>
                            <span class="select-none">{{ ucfirst($col) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl border border-gray-100 dark:border-gray-700 relative">
        <div class="overflow-x-auto">
            <table id="schoolTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800">
                    <tr>
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold text-gray-900 dark:text-gray-100 uppercase tracking-wider">
                            #</th>
                        @foreach ($allColumns as $col)
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-900 dark:text-gray-100 uppercase tracking-wider">
                                {{ ucfirst($col) }}
                            </th>
                        @endforeach
                        <th
                            class="px-6 py-4 text-left text-xs font-semibold text-gray-900 dark:text-gray-100 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($data as $key => $row)
                        <tr
                            class="group hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 dark:hover:from-gray-700 dark:hover:to-gray-600 transition-all duration-200">
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white font-medium">{{ $key + 1 }}
                            </td>
                            @foreach ($allColumns as $col)
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                    @if ($col === 'is_active')
                                        @if (isset($row->is_active))
                                            @php $row->is_active = $row->is_active; @endphp
                                        @elseif(!isset($rowis_active))
                                            @php $row->is_active = 0; @endphp
                                        @endif


                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $row->is_active ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                            <span
                                                class="w-1.5 h-1.5 rounded-full {{ $row->is_active ? 'bg-green-400' : 'bg-red-400' }} mr-1.5"></span>
                                            {{ $row->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    @elseif ($col === 'created_by')
                                        {{ $row->user->name ?? '-' }}
                                    @elseif ($col === 'is_optional')
                                        @if (isset($row->is_optional))
                                            @if ($row->is_optional)
                                                <span
                                                    class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full dark:bg-green-800 dark:text-green-100">
                                                    Optional
                                                </span>
                                            @else
                                                <span
                                                    class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full dark:bg-blue-800 dark:text-blue-100">
                                                    Compulsory
                                                </span>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    @elseif ($col === 'groups')
                                        @if ($row->groups && $row->groups->count() > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($row->groups as $group)
                                                    <span
                                                        class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full dark:bg-blue-800 dark:text-blue-100">
                                                        {{ $group->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            -
                                        @endif
                                    @else
                                        {{ $row->$col ?? '-' }}
                                    @endif
                                </td>
                            @endforeach

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="relative">
                                    <!-- Toggle Button -->
                                    <button type="button"
                                        class="action-dropdown-toggle inline-flex justify-center items-center px-3 py-2 text-sm font-medium bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                                        data-row-id="{{ $row->id }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zM12 13a1 1 0 110-2 1 1 0 010 2zM12 20a1 1 0 110-2 1 1 0 010 2z" />

                                        </svg>
                                        Action
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div
                                        class="action-dropdown hidden fixed bg-white dark:bg-gray-800 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 dark:ring-gray-600 border border-gray-100 dark:border-gray-700 min-w-[14rem] dropdown-menu">
                                        <div class="py-2" role="menu">

                                            <a href="{{ route('subject.edit', $row->id) }}"
                                                class="dropdown-link group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-800 dark:hover:text-blue-200 transition-colors duration-150"
                                                role="menuitem">
                                                <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-blue-500"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>

                                            <form action="{{ route('subject.destroy', $row->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="dropdown-link group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-red-50 dark:hover:bg-gray-700 hover:text-red-800 dark:hover:text-red-200 transition-colors duration-150">
                                                    <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-red-500"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>


                                            <a href="{{ route('subject.show', $row->id) }}"
                                                class="dropdown-link group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-gray-700 hover:text-green-800 dark:hover:text-green-200 transition-colors duration-150"
                                                role="menuitem">
                                                <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-green-500"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </a>

                                            <hr class="my-2 border-gray-200 dark:border-gray-600">

                                            <a href="#"
                                                class="dropdown-link group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-50 dark:hover:bg-gray-700 hover:text-purple-800 dark:hover:text-purple-200 transition-colors duration-150"
                                                role="menuitem">
                                                <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-purple-500"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                Payments
                                            </a>



                                            <hr class="my-2 border-gray-200 dark:border-gray-600">

                                            <a href=""
                                                class="dropdown-link group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-gray-700 hover:text-green-800 dark:hover:text-green-200 transition-colors duration-150"
                                                role="menuitem">
                                                <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-green-500"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Activate
                                            </a>

                                            <a href=""
                                                class="dropdown-link group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-gray-700 hover:text-green-800 dark:hover:text-green-200 transition-colors duration-150"
                                                role="menuitem">
                                                <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-green-500"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Deactivate
                                            </a>

                                        </div>
                                    </div>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @once

        <!-- DataTable Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

        <script>
            let dataTable;

            function refreshHiddenColumnsDropdown() {
                const $select = $('#showColumnSelect');
                if ($select.length) {
                    $select.find('option:not(:first)').remove();

                    $('.column-toggle').each(function() {
                        const index = $(this).data('index');
                        const columnName = $(this).next('span').text();
                        if (!this.checked) {
                            $select.append(`<option value="${index}">${columnName}</option>`);
                        }
                    });
                }
            }

            function positionDropdown($dropdown, $button) {
                const buttonRect = $button[0].getBoundingClientRect();
                const viewportHeight = window.innerHeight;
                const viewportWidth = window.innerWidth;
                const dropdownWidth = 224; // 14rem = 224px
                const dropdownHeight = 400; // Approximate max height

                let top = buttonRect.bottom + window.scrollY + 8;
                let left = buttonRect.left + window.scrollX;

                // Adjust horizontal position if dropdown would go off screen
                if (left + dropdownWidth > viewportWidth) {
                    left = buttonRect.right + window.scrollX - dropdownWidth;
                }

                // Adjust vertical position if dropdown would go off screen
                if (buttonRect.bottom + dropdownHeight > viewportHeight) {
                    top = buttonRect.top + window.scrollY - dropdownHeight - 8;
                }

                $dropdown.css({
                    'top': top + 'px',
                    'left': left + 'px'
                });
            }

            $(document).ready(function() {
                // Initialize DataTable
                dataTable = $('#schoolTable').DataTable({
                    responsive: true,
                    paging: true,
                    pageLength: 10,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records...",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "Next",
                            previous: "Previous"
                        }
                    },
                    dom: '<"flex flex-col sm:flex-row justify-between items-center mb-4"lf>rtip'
                });

                // Set initial column visibility
                $('.column-toggle').each(function() {
                    const index = $(this).data('index');
                    const isChecked = $(this).is(':checked');
                    const column = dataTable.column(index);
                    column.visible(isChecked);
                });

                refreshHiddenColumnsDropdown();

                // Column visibility toggle
                $('.column-toggle').on('change', function() {
                    const index = $(this).data('index');
                    const column = dataTable.column(index);
                    column.visible(this.checked);
                    refreshHiddenColumnsDropdown();
                });

                // Column dropdown toggle
                $('#dropdownToggle').on('click', function(e) {
                    e.stopPropagation();
                    const $dropdown = $('#columnDropdown');
                    const $chevron = $('#columnChevron');

                    $dropdown.toggleClass('hidden');
                    $chevron.toggleClass('rotate-180');

                    // Close action dropdowns when opening column dropdown
                    $('.action-dropdown').addClass('hidden');
                });

                // Action dropdown toggle with improved positioning
                $(document).on('click', '.action-dropdown-toggle', function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    const $button = $(this);
                    const $dropdown = $button.siblings('.action-dropdown');
                    const $allDropdowns = $('.action-dropdown');

                    // Close all other dropdowns
                    $allDropdowns.not($dropdown).addClass('hidden');

                    // Close column dropdown
                    $('#columnDropdown').addClass('hidden');
                    $('#columnChevron').removeClass('rotate-180');

                    // Toggle current dropdown
                    if ($dropdown.hasClass('hidden')) {
                        $dropdown.removeClass('hidden');
                        positionDropdown($dropdown, $button);
                        $button.addClass('bg-gray-100 dark:bg-gray-600');
                    } else {
                        $dropdown.addClass('hidden');
                        $button.removeClass('bg-gray-100 dark:bg-gray-600');
                    }
                });

                // Reposition dropdowns on window resize
                $(window).on('resize', function() {
                    $('.action-dropdown:not(.hidden)').each(function() {
                        const $dropdown = $(this);
                        const $button = $dropdown.siblings('.action-dropdown-toggle');
                        positionDropdown($dropdown, $button);
                    });
                });

                // Reposition dropdowns on scroll
                $(window).on('scroll', function() {
                    $('.action-dropdown:not(.hidden)').each(function() {
                        const $dropdown = $(this);
                        const $button = $dropdown.siblings('.action-dropdown-toggle');
                        positionDropdown($dropdown, $button);
                    });
                });

                // Click outside to close dropdowns
                $(document).on('click', function(e) {
                    const $target = $(e.target);

                    // Check if click is outside any dropdown area
                    if (!$target.closest(
                            '#dropdownToggle, #columnDropdown, .action-dropdown-toggle, .action-dropdown')
                        .length) {
                        $('#columnDropdown').addClass('hidden');
                        $('#columnChevron').removeClass('rotate-180');
                        $('.action-dropdown').addClass('hidden');
                        $('.action-dropdown-toggle').removeClass('bg-gray-100 dark:bg-gray-600');
                    }
                });

                // Prevent dropdown from closing when clicking inside
                $('.action-dropdown, #columnDropdown').on('click', function(e) {
                    e.stopPropagation();
                });

                // Show hidden column from select (if exists)
                $('#showColumnSelect').on('change', function() {
                    const index = $(this).val();
                    if (index) {
                        const column = dataTable.column(index);
                        column.visible(true);
                        $(`.column-toggle[data-index="${index}"]`).prop('checked', true);
                        refreshHiddenColumnsDropdown();
                        $(this).val('');
                    }
                });

                // Add keyboard accessibility
                $(document).on('keydown', '.action-dropdown-toggle', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        $(this).click();
                    }
                });

                // Add keyboard navigation for dropdown items
                $(document).on('keydown', '.action-dropdown a', function(e) {
                    const $dropdown = $(this).closest('.action-dropdown');
                    const $items = $dropdown.find('a:visible');
                    const currentIndex = $items.index(this);

                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        const nextIndex = (currentIndex + 1) % $items.length;
                        $items.eq(nextIndex).focus();
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        const prevIndex = currentIndex === 0 ? $items.length - 1 : currentIndex - 1;
                        $items.eq(prevIndex).focus();
                    } else if (e.key === 'Escape') {
                        $dropdown.addClass('hidden');
                        $dropdown.siblings('.action-dropdown-toggle').focus();
                    }
                });
            });
        </script>

        <style>
            /* Custom DataTable styling */
            .dataTables_wrapper {
                font-family: inherit;
            }

            .dataTables_filter input {
                @apply border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
            }

            .dataTables_length select {
                @apply border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
            }

            .dataTables_paginate .paginate_button {
                @apply px-3 py-2 mx-1 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150;
            }

            .dataTables_paginate .paginate_button.current {
                @apply bg-blue-600 text-white border-blue-600 hover:bg-blue-700;
            }

            .dataTables_paginate .paginate_button.disabled {
                @apply opacity-50 cursor-not-allowed;
            }

            .dataTables_info {
                @apply text-sm text-gray-700 dark:text-gray-300;
            }

            /* Custom scrollbar for dropdowns */
            .action-dropdown::-webkit-scrollbar,
            #columnDropdown::-webkit-scrollbar {
                width: 6px;
            }

            .action-dropdown::-webkit-scrollbar-track,
            #columnDropdown::-webkit-scrollbar-track {
                @apply bg-gray-100 dark:bg-gray-700;
            }

            .action-dropdown::-webkit-scrollbar-thumb,
            #columnDropdown::-webkit-scrollbar-thumb {
                @apply bg-gray-300 dark:bg-gray-600 rounded-full;
            }

            .action-dropdown::-webkit-scrollbar-thumb:hover,
            #columnDropdown::-webkit-scrollbar-thumb:hover {
                @apply bg-gray-400 dark:bg-gray-500;
            }

            /* Animation classes */
            .rotate-180 {
                transform: rotate(180deg);
            }

            /* Focus styles */
            .action-dropdown a:focus {
                @apply outline-none ring-2 ring-blue-500 ring-inset;
            }

            /* Fixed positioning for action dropdowns */
            .action-dropdown {
                position: fixed !important;
                z-index: 9999 !important;
                max-height: 400px;
                overflow-y: auto;
            }

            /* Ensure dropdown menu stays above everything */
            .dropdown-menu {
                z-index: 10000 !important;
            }

            /* Remove relative positioning from table cell */
            .action-dropdown-toggle {
                position: relative;
            }
        </style>
    @endonce

</x-app-layout>
