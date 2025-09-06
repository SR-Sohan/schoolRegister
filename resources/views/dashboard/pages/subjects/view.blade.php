<x-app-layout>
    <x-slot name="head">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            Subject Details
        </h1>
    </x-slot>

    <div class="glass-effect rounded-2xl p-8 shadow-2xl bg-white dark:bg-gray-900">

        <!-- Subject Info -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                {{ $subject->name }}
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Code: <span class="font-semibold">{{ $subject->code }}</span>
            </p>
            <p class="mt-2">
                <span class="px-3 py-1 rounded-full text-sm
                    {{ $subject->is_optional ? 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-200' : 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200' }}">
                    {{ $subject->is_optional ? 'Optional' : 'Mandatory' }}
                </span>

                <span class="ml-2 px-3 py-1 rounded-full text-sm
                    {{ $subject->is_active ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-200' }}">
                    {{ $subject->is_active ? 'Active' : 'Inactive' }}
                </span>
            </p>
        </div>

        <!-- Groups Assigned -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">
                Groups Assigned
            </h3>
            @if ($subject->groups->count() > 0)
                <div class="flex flex-wrap gap-2">
                    @foreach ($subject->groups as $group)
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 dark:bg-purple-800 dark:text-purple-200 rounded-full text-sm shadow">
                            {{ $group->name }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 dark:text-gray-400">No groups assigned.</p>
            @endif
        </div>

        <!-- Students -->
        {{-- <div>
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">
                Students Enrolled
            </h3>
            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                {{ $subject->students_count ?? 0 }} Students
            </p>
        </div> --}}

        <!-- Action Buttons -->
        <div class="mt-8 flex space-x-4">
            <a href="{{ route('subject.edit', $subject->id) }}"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow transition">
                ✏️ Edit
            </a>
            <form action="{{ route('subject.destroy', $subject->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this subject?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow transition">
                    🗑️ Delete
                </button>
            </form>
            <a href="{{ route('subject.index') }}"
                class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl shadow transition">
                ⬅️ Back
            </a>
        </div>
    </div>
</x-app-layout>
