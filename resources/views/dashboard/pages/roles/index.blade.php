<x-app-layout>
    <div class="min-h-screen bg-[#f9fafb] dark:bg-gray-900 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">🎛 Role & Permission Management</h1>
                <a href="{{ route('roles.create') }}"
                   class="inline-flex items-center px-5 py-2.5 bg-green-600 text-white dark:text-white text-sm font-semibold rounded-lg shadow hover:bg-green-700 transition duration-300">
                    ➕ Create New Role
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow dark:bg-green-800 dark:text-green-200 dark:border-green-600">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase">Role Name</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase">Permissions</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($roles as $role)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-base text-gray-800 dark:text-gray-100 font-medium">
                                    {{ $role->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-black">
                                    @forelse ($role->permissions as $permission)
                                        <span class="inline-block text-black text-xs font-semibold mr-1 mb-1 px-2 py-1 rounded">
                                            {{ $permission->name }}
                                        </span>
                                    @empty
                                        <span class="text-gray-400 dark:text-gray-500">No Permissions</span>
                                    @endforelse
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('roles.edit', $role) }}"
                                           class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium">
                                            ✏️ Edit
                                        </a>
                                        <form method="POST" class="delete-role-form" data-role="{{ $role->name }}" action="{{ route('roles.destroy', $role) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline font-medium">
                                                🗑️ Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No roles found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll('.delete-role-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // stop the form from submitting

            const roleName = this.getAttribute('data-role');

            Swal.fire({
                title: `Delete "${roleName}"?`,
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // submit the form
                }
            });
        });
    });
</script>

</x-app-layout>
