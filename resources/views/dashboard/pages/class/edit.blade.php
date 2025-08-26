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

        <form action="{{ route('classmodule.update', $classModule->id) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
             @csrf
            @method('PUT')

            <!-- Row: Name + Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Class Name
                    </label>
                    <input type="text" name="name" id="name" value="{{ $classModule->name}}"
                           class="w-full px-4 py-3 bg-white dark:bg-gray-800 border
                           @error('name') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror
                           rounded-xl focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none text-gray-900 dark:text-white" />
                    @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>



            <!-- Is School Checkbox -->
            <div class="flex items-center space-x-3">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                       class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                       {{ $classModule->is_active ? 'checked' : '' }}>
                <label for="is_active" class="text-gray-700 dark:text-gray-300 font-medium">
                    Is Active?
                </label>
            </div>




            <!-- Submit -->
            <div class="pt-6">
                <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2">
                    <span>Update Class</span>
                </button>
            </div>
        </form>
    </div>

</x-app-layout>
