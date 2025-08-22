<x-app-layout>
    <x-slot name="head">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Create Institute</h1>
    </x-slot>

    <div class="glass-effect rounded-2xl p-8 shadow-2xl bg-white dark:bg-gray-900">
        @if ($errors->any())
            <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('userprofile.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf

            <!-- Row: Name + Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        User Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                           class="w-full px-4 py-3 bg-white dark:bg-gray-800 border
                           @error('name') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror
                           rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none text-gray-900 dark:text-white" />
                    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="w-full px-4 py-3 bg-white dark:bg-gray-800 border
                           @error('email') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror
                           rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none text-gray-900 dark:text-white" />
                    @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Row: Phone + Role -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        WhatssApp Mobile Number
                    </label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                           class="w-full px-4 py-3 bg-white dark:bg-gray-800 border
                           @error('phone') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror
                           rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none text-gray-900 dark:text-white" />
                    @error('phone') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Assign Role
                    </label>
                    <select name="role" id="role"
                            class="w-full px-4 py-3 bg-white dark:bg-gray-800 border
                            @error('role') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror
                            rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none text-gray-900 dark:text-white">
                        <option value="">Select a role</option>
                        @foreach ($roles as $id => $name)
                            <option value="{{ $name }}" {{ old('role') == $name ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('role') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Row: Password + Confirm Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Password
                    </label>
                    <input type="password" name="password" id="password"
                           class="w-full px-4 py-3 pr-10 bg-white dark:bg-gray-800 border
                           @error('password') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror
                           rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 text-gray-900 dark:text-white" />
                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-[40px] text-gray-500 dark:text-gray-300">
                        👁
                    </button>
                    @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="relative">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full px-4 py-3 pr-10 bg-white dark:bg-gray-800 border
                           @error('password_confirmation') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror
                           rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 text-gray-900 dark:text-white" />
                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-[40px] text-gray-500 dark:text-gray-300">
                        👁
                    </button>
                    @error('password_confirmation') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Is School Checkbox -->
            <div class="flex items-center space-x-3">
                <input type="checkbox" id="is_school" name="is_school" value="1"
                       class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                       {{ old('is_school') ? 'checked' : '' }}>
                <label for="is_school" class="text-gray-700 dark:text-gray-300 font-medium">
                    Is School?
                </label>
            </div>

            <!-- School Info (hidden by default) -->
            <div id="schoolFields" class="space-y-4 hidden">
                <div>
                    <label for="school_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        School Name
                    </label>
                    <input type="text" name="school_name" id="school_name" value="{{ old('school_name') }}"
                           class="w-full px-4 py-3 bg-white dark:bg-gray-800 border @error('school_name') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-xl text-gray-900 dark:text-white" />
                </div>

                <div>
                    <label for="school_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        School Address
                    </label>
                    <textarea name="school_address" id="school_address" rows="3"
                              class="w-full px-4 py-3 bg-white dark:bg-gray-800 border @error('school_address') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror rounded-xl text-gray-900 dark:text-white">{{ old('school_address') }}</textarea>
                </div>

                {{-- <div>
                    <label for="school_photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        School Photo
                    </label>
                    <input type="file" name="school_photo" id="school_photo"
                           class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100
                                  dark:file:bg-gray-700 dark:file:text-gray-200 dark:hover:file:bg-gray-600" />
                </div> --}}
            </div>

            <!-- Submit -->
            <div class="pt-6">
                <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2">
                    <span>Create Institute</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }

        document.getElementById('is_school').addEventListener('change', function () {
            const schoolFields = document.getElementById('schoolFields');
            schoolFields.classList.toggle('hidden', !this.checked);
        });

        // Keep open after validation error
        window.addEventListener('DOMContentLoaded', () => {
            if (document.getElementById('is_school').checked) {
                document.getElementById('schoolFields').classList.remove('hidden');
            }
        });
    </script>
</x-app-layout>
