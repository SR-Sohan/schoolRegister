<x-app-layout>
    <div class="min-h-screen bg-[#f9fafb] dark:bg-gray-900 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">
                ✏️ Edit Role: <span class="text-blue-600 dark:text-blue-400">{{ $role->name }}</span>
            </h1>

            <form action="{{ route('roles.update', $role) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                {{-- Role Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                        Role Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ $role->name }}"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter role name" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Permissions --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-4">
                        Assign Permissions
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach ($permissions as $module => $modulePermissions)
                            <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4 shadow-sm">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white capitalize mb-3">
                                    {{ $module }}
                                </h3>

                                <div class="space-y-2">
                                    @foreach ($modulePermissions as $permission)
                                        <label for="permission-{{ $permission->id }}" class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-200">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                id="permission-{{ $permission->id }}"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 dark:bg-gray-800 dark:border-gray-600 rounded focus:ring-blue-500">
                                            <span>{{ $permission->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Submit --}}
                <div class="pt-4 text-right">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300">
                        💾 Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
