<x-app-layout>
    <x-slot name="head">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">User Details</h1>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8 bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-8">
        <!-- User Info -->
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Basic Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <span class="text-gray-600 dark:text-gray-300 font-medium">Name:</span>
                <p class="text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
            </div>
            <div>
                <span class="text-gray-600 dark:text-gray-300 font-medium">Email:</span>
                <p class="text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
            </div>
            <div>
                <span class="text-gray-600 dark:text-gray-300 font-medium">Phone:</span>
                <p class="text-gray-900 dark:text-gray-100">{{ $user->mobile }}</p>
            </div>
            <div>
                <span class="text-gray-600 dark:text-gray-300 font-medium">Roles:</span>
                <p class="text-gray-900 dark:text-gray-100">{{ $user->roles->pluck('name')->join(', ') }}</p>
            </div>
            <div>
                <span class="text-gray-600 dark:text-gray-300 font-medium">Status:</span>
                <p class="text-gray-900 dark:text-gray-100">
                    @if($user->is_active)
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full">Active</span>
                    @else
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full">Inactive</span>
                    @endif
                </p>
            </div>
        </div>

        @if($user->profile)
            <!-- UserProfile Info -->
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Profile Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <span class="text-gray-600 dark:text-gray-300 font-medium">School Name:</span>
                    <p class="text-gray-900 dark:text-gray-100">{{ $user->profile->school_name }}</p>
                </div>
                <div>
                    <span class="text-gray-600 dark:text-gray-300 font-medium">Address:</span>
                    <p class="text-gray-900 dark:text-gray-100">{{ $user->profile->address }}</p>
                </div>
                @if($user->profile->photo)
                    <div class="col-span-1 md:col-span-2 mt-4">
                        <span class="text-gray-600 dark:text-gray-300 font-medium">Photo:</span>
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $user->profile->photo) }}" alt="Profile Photo"
                                 class="rounded-xl shadow-lg w-48 h-48 object-cover">
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('userprofile.index') }}"
               class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-xl shadow-lg transition-all duration-300">
                Back to Users
            </a>
        </div>
    </div>
</x-app-layout>
