<x-app-layout>
    <x-slot name="head">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Update Subject</h1>
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

        <form action="{{ route('subject.update', $subjectData->id) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Groups -->
                <div>
                    <label for="group_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Select Groups
                    </label>

                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($groupData as $group)
                            <label class="flex items-center space-x-2 p-2 border rounded-lg dark:border-gray-600">
                                <input type="checkbox" name="group_ids[]" value="{{ $group->id }}"
                                    {{ (is_array(old('group_ids', $subjectData->groups->pluck('id')->toArray()))
                                        && in_array($group->id, old('group_ids', $subjectData->groups->pluck('id')->toArray())))
                                        ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                                <span class="text-gray-900 dark:text-gray-200">{{ $group->name }}</span>
                            </label>
                        @endforeach
                    </div>

                    @error('group_ids')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subject Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Subject Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $subjectData->name) }}" required
                        class="w-full px-4 py-3 bg-white dark:bg-gray-800 border
               @error('name') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror
               rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none text-gray-900 dark:text-white" />
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subject Code -->
                <div class="mt-4">
                    <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Subject Code <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="code" id="code" value="{{ old('code', $subjectData->code) }}" required
                        class="w-full px-4 py-3 bg-white dark:bg-gray-800 border
               @error('code') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror
               rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none text-gray-900 dark:text-white" />
                    @error('code')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Optional -->
                <div class="flex items-center space-x-3">
                    <input type="checkbox" id="is_optional" name="is_optional" value="1"
                        class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        {{ old('is_optional', $subjectData->is_optional) ? 'checked' : '' }}>
                    <label for="is_optional" class="text-gray-700 dark:text-gray-300 font-medium">
                        Is Optional?
                    </label>
                </div>

                <!-- Is Active -->
                <div class="flex items-center space-x-3">
                    <input type="checkbox" id="is_active" name="is_active" value="1"
                        class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        {{ old('is_active', $subjectData->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="text-gray-700 dark:text-gray-300 font-medium">
                        Is Active?
                    </label>
                </div>

                <!-- Submit -->
                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2">
                        <span>Update Subject</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
