<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h1 class="font-semibold text-slate-800 dark:text-slate-100 text-center">{{ __('messages.tasks_list') }}</h1>
        </header>

        <div class="p-3">
            <!-- Active Tasks -->
            <div class="flex flex-row row-span-full sm:row-span-6 xl:row-span-4 bg-white dark:bg-slate-800 shadow-lg rounded p-6">
                <div class="w-1/3 ml-2">
                    <label class="font-semibold text-slate-800 dark:text-slate-100">{{ __('messages.status') }}</label>
                    <select class="rounded-lg p-2 text-sm w-full" id="status" name="status">
                        <option value="">{{ __('messages.all') }}</option>
                        <option value="pending">{{ __('messages.pending') }}</option>
                        <option value="in_progress">{{ __('messages.in_progress') }}</option>
                        <option value="completed">{{ __('messages.completed') }}</option>
                    </select>
                </div>
                <div class="w-1/3 ml-2">
                    <label class="font-semibold text-slate-800 dark:text-slate-100">{{ __('messages.priority') }}</label>
                    <select class="shadow appearance-none rounded-lg w-full p-2 text-sm" id="priority" name="priority">
                        <option value="">{{ __('messages.all') }}</option>
                        <option value="low">{{ __('messages.low') }}</option>
                        <option value="normal">{{ __('messages.normal') }}</option>
                        <option value="high">{{ __('messages.high') }}</option>
                    </select>
                </div>
            </div>
            <br>
            <!-- Cards -->
            <div class="grid grid-cols-12 gap-6">
                <!-- In Progress Tasks -->
                <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                    <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center">
                        <i class="fas fa-tasks text-blue-500 mr-3"></i>
                        <h2 class="font-semibold text-slate-800 dark:text-slate-100">{{ __('messages.in_progress_tasks') }}</h2>
                    </header>
                    <div class="px-5 py-3">
                        <div class="flex items-start">
                            <div class="text-3xl font-bold text-slate-800 dark:text-slate-100 mr-2 tabular-nums">
                                {{ $tasks->where('status', 'in_progress')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Completed Tasks -->
                <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                    <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-slate-200">{{ __('messages.completed_tasks') }}</h2>
                    </header>
                    <div class="px-5 py-3">
                        <div class="flex items-start">
                            <div class="text-3xl font-bold text-slate-800 dark:text-slate-100 mr-2 tabular-nums">
                                {{ $tasks->where('status', 'completed')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pending Tasks -->
                <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                    <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center">
                        <i class="fas fa-info-circle text-yellow-500 mr-3"></i>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-slate-200">{{ __('messages.pending_tasks') }}</h2>
                    </header>
                    <div class="px-5 py-3">
                        <div class="flex items-start">
                            <div class="text-3xl font-bold text-slate-800 dark:text-slate-100 mr-2 tabular-nums">
                                {{ $tasks->where('status', 'pending')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Task Table and Add Task Button -->
            <div class="overflow-x-auto">
                <table class="table-auto w-full dark:text-slate-300" id="taskTable">
                    <div class="flex justify-between items-center mt-2 mb-2">
                        <input type="text" placeholder="{{ __('messages.search') }}" id="search" name="search" class="rounded-lg p-1 m-1 text-sm w-1/4">
                        <div class="flex items-center mt-2 mb-2">
                            <button onclick="window.location='{{ route('tasks.create') }}'" class="bg-orange-500 hover:bg-orange-700 text-white p-1 mr-2 rounded-lg text-xs font-bold text-center">
                                <i class="fas fa-plus"></i> {{ __('messages.add_task') }}
                            </button>
                            <button onclick="window.location='{{ route('tasks.export') }}'" class="bg-green-500 hover:bg-green-700 text-white p-1 mr-2 rounded-lg text-xs font-bold text-center">
                                <i class="fas fa-file-excel"></i> {{ __('messages.export_excel') }}
                            </button>
                        </div>
                    </div>
                    <thead class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                        <tr class="rounded-lg text-black dark:text-white">
                            <th class="p-2">
                                <div class="font-semibold text-left">{{ __('messages.task_id') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.title') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.description') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.created_by') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.due_date') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.project') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.priority') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.status') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.actions') }}</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                        @foreach ($tasks as $key => $task)
                            <tr class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                <td class="py-2 px-4 text-center">{{ $key + 1 }}</td>
                                <td class="py-2 px-4 text-center">{{ $task->title }}</td>
                                <td class="py-2 px-4 text-center">{{ $task->description ? $task->description : '---' }}</td>
                                <td class="py-2 px-4 text-center">{{ Auth::user()->name }}</td>
                                <td class="py-2 px-4 text-center">{{ $task->due_date }}</td>
                                <td class="py-2 px-4 text-center">{{ $task->project->title }}</td>
                                <td class="py-2 px-4 text-center">
                                    <span class="text-white py-1 px-3 rounded-full text-xs {{ $task->priority == 'low' ? 'bg-green-500' : ($task->priority == 'normal' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                        @if ($task->priority == 'low')
                                            {{ __('messages.low') }}
                                        @elseif ($task->priority == 'normal')
                                            {{ __('messages.normal') }}
                                        @elseif ($task->priority == 'high')
                                            {{ __('messages.high') }}
                                        @endif
                                    </span>
                                </td>
                                <td class="py-2 px-4 text-center">
                                    <span class="text-white py-1 px-3 rounded-full text-xs {{ $task->status == 'pending' ? 'bg-yellow-500' : ($task->status == 'in_progress' ? 'bg-blue-500' : 'bg-green-500') }}">
                                        @if ($task->status == 'pending')
                                            {{ __('messages.pending') }}
                                        @elseif ($task->status == 'in_progress')
                                            {{ __('messages.in_progress') }}
                                        @elseif ($task->status == 'completed')
                                            {{ __('messages.completed') }}
                                        @endif
                                    </span>
                                </td>
                                <td class="py-2 px-4 text-center">
                                    <a href="{{ url('/tasks/edit', ['id' => $task->id]) }}" class="py-1 px-1 rounded-full text-xs">
                                        <i class="fas fa-edit text-blue-300"></i>
                                    </a>
                                    <a href="{{ url('/tasks/show', ['id' => $task->id]) }}" class="py-1 px-1 rounded-full text-xs">
                                        <i class="fas fa-eye text-gray-500"></i>
                                    </a>
                                    <form action="{{ url('/tasks/destroy', ['id' => $task->id]) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="py-1 px-1 rounded-full text-xs delete-btn">
                                            <i class="fas fa-trash-alt text-red-500"></i>
                                        </button>
                                    </form>
                                    <form action="{{ url('/tasks/archive', ['id' => $task->id]) }}" method="POST" style="display:inline;" onsubmit="return confirmArchive();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="py-1 px-1 rounded-full text-xs delete-btn">
                                            <i class="fas fa-archive text-blue-500"></i>
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
            return confirm('{{ __("messages.delete_confirmation") }}');
        }

        function confirmArchive() {
            return confirm('{{ __("messages.archive_confirmation") }}');
        }

        $(document).ready(function() {
            function fetchTasks(search, status, priority) {
                $.ajax({
                    url: "{{ route('tasks.search') }}",
                    type: 'GET',
                    data: {
                        search: search,
                        status: status,
                        priority: priority
                    },
                    success: function(response) {
                        console.log("Response:", response); // Debugging statement
                        $('#taskTable tbody').html(response);
                    }
                });
            }

            // Event listener for search input
            $('#search').on('keyup', function() {
                var search = $(this).val();
                var status = $('#status').val();
                var priority = $('#priority').val();
                fetchTasks(search, status, priority);
            });

            $('#status').on('change', function() {
                var status = $(this).val();
                var search = $('#search').val();
                var priority = $('#priority').val();
                fetchTasks(search, status, priority);
            });

            $('#priority').on('change', function() {
                var priority = $(this).val();
                var status = $('#status').val();
                var search = $('#search').val();
                fetchTasks(search, status, priority);
            });
        });
    </script>
</x-app-layout>
