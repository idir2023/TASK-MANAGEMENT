<!-- resources/views/projects/create.blade.php -->
<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h1 class="font-semibold text-slate-800 dark:text-slate-100 text-center">Update Project</h1>
        </header>

        <div class="p-3">
            <form action="{{ route('projects.update', ['id' => $projects->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" id="title" value="{{ $projects->title }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">{{ $projects->description }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="employer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Employer</label>
                    <select name="employer_id" id="employer_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                        @foreach ($employers as $employer)
                            <option value="{{ $employer->id }}" {{ $employer->id == $projects->employer_id ? 'selected' : '' }}>{{ $employer->name }}</option>
                        @endforeach
                    </select>
                    @error('employer_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Project
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
