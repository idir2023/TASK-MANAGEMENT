<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h1 class="font-semibold text-slate-800 dark:text-slate-100 text-center">Project LIST</h1>
        </header>

        <div class="p-3">

            <!-- Task Table and Add Task Button -->
            <div class="overflow-x-auto">

                <div class="flex justify-between items-center mt-2 mb-2">
                    <div class="flex items-center mt-2 mb-2">
                        <button onclick="window.location='{{ route('projects.create') }}'"
                            class="bg-orange-500 hover:bg-orange-700 text-white p-1 mr-2 rounded-lg text-xs font-bold text-center">
                            <i class="fas fa-plus"></i> ADD Project
                        </button>
                        {{-- <button onclick="window.location='{{ route('employers.export') }}'"
                            class="bg-green-500 hover:bg-green-700 text-white p-1 mr-2 rounded-lg text-xs font-bold text-center">
                            <i class="fas fa-file-excel"></i> EXPORT EXCEL
                        </button> --}}
                    </div>
                </div>

                <table class="table-auto w-full dark:text-slate-300" id="ProjectTable">
                    <thead
                        class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                        <tr class="rounded-lg text-black dark:text-white">
                            <th class="p-2">
                                <div class="font-semibold text-left">Project ID</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Title</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Description</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">Employer</div>
                            </th>

                            <th class="p-2">
                                <div class="font-semibold text-center">Actions</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                        @foreach ($projects as $key => $project)
                            <tr class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                <td class="py-2 px-4 text-center">{{ $key + 1 }}</td>
                                <td class="py-2 px-4 text-center">{{ $project->title }}</td>
                                <td class="py-2 px-4 text-center">{{ $project->description }}</td>
                                <td class="py-2 px-4 text-center">{{ $project->employer->name }}</td>
                                <td class="py-2 px-4 text-center">
                                    <a href="{{ url('/projects/edit', ['id' => $project->id]) }}"
                                        class="py-1 px-1 rounded-full text-xs">
                                        <i class="fas fa-edit text-blue-500"></i>
                                    </a>
                                    <a href="{{ url('/projects/show', ['id' => $project->id]) }}"
                                        class="py-1 px-1 rounded-full text-xs">
                                        <i class="fas fa-eye text-gray-500"></i>
                                    </a>
                                    <form action="{{ url('/projects/destroy', ['id' => $project->id]) }}"
                                        method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="py-1 px-1 rounded-full text-xs delete-btn">
                                            <i class="fas fa-trash-alt text-red-500"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this project? If yes, click OK. If no, click Cancel.');
        }
    </script>
</x-app-layout>
