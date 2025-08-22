<x-app-layout>
    <x-slot name="head">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Edit User</h1>
    </x-slot>

    <div class="glass-effect rounded-2xl p-8 shadow-2xl bg-white dark:bg-gray-900 max-w-4xl mx-auto">
        @if (session('error'))
            <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('userprofile.update', $data->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name + Email Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $data->name) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                    @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $data->email) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                    @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Phone + Role Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $data->mobile) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                    @error('phone')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                    <select name="role"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @foreach ($roles as $id => $name)
                            <option value="{{ $name }}" {{ $data->roles->pluck('name')->contains($name) ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Active Status -->
            <div class="mt-4">
                <span class="text-gray-700 dark:text-gray-300 font-medium mb-2 block">Active Status</span>
                <div class="flex items-center space-x-6">
                    <label class="inline-flex items-center">
                        <input type="radio" name="is_active" value="1"
                            {{ old('is_active', $data->is_active) == 1 ? 'checked' : '' }} class="form-radio text-green-500">
                        <span class="ml-2 text-gray-700 dark:text-gray-300">Active</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" name="is_active" value="0"
                            {{ old('is_active', $data->is_active) == 0 ? 'checked' : '' }} class="form-radio text-red-500">
                        <span class="ml-2 text-gray-700 dark:text-gray-300">Inactive</span>
                    </label>
                </div>
                @error('is_active')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password (leave blank to keep current)</label>
                <input type="password" name="password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- School Info Toggle -->
            <div class="flex items-center">
                <input type="checkbox" name="is_school" value="1" id="is_school" class="mr-2"
                    {{ $data->profile?->school_name ? 'checked' : '' }}>
                <label for="is_school" class="text-gray-700 dark:text-gray-300 font-medium">School</label>
            </div>

            <!-- School Fields -->
            <div id="school-fields" class="grid grid-cols-1 md:grid-cols-2 gap-6"
                style="{{ $data->profile?->school_name ? '' : 'display:none' }}">
                <div>
                    <label for="school_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">School Name</label>
                    <input type="text" name="school_name"
                        value="{{ old('school_name', $data->profile?->school_name) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                    @error('school_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="school_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label>
                    <input type="text" name="school_address"
                        value="{{ old('school_address', $data->profile?->address) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                    @error('school_address')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full md:w-1/3 bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-xl shadow-lg transition-all duration-300">
                    Update User
                </button>
            </div>
        </form>
    </div>

    <script>
        const checkbox = document.getElementById('is_school');
        const schoolFields = document.getElementById('school-fields');

        checkbox.addEventListener('change', function() {
            schoolFields.style.display = this.checked ? 'grid' : 'none';
        });
    </script>
</x-app-layout>
