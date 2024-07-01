<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h1 class="font-semibold text-slate-800 dark:text-slate-100 text-center">{{ __('messages.tasks_completed') }}
            </h1>
        </header>

        <div class="p-3">
            <!-- Active Tasks -->

            <!-- Task Table and Add Task Button -->
            <div class="overflow-x-auto">

                <table class="table-auto w-full dark:text-slate-300" id="taskTable">
                    <thead
                        class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
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
                                <td class="py-2 px-4 text-center">{{ $task->description }}</td>
                                <td class="py-2 px-4 text-center">{{ Auth::user()->name }}</td>
                                <td class="py-2 px-4 text-center">{{ $task->due_date }}</td>
                                <td class="py-2 px-4 text-center">{{ $task->project->title }}</td>
                                <td class="py-2 px-4 text-center">
                                    <span
                                        class="text-white py-1 px-3 rounded-full text-xs {{ $task->status == 'pending' ? 'bg-yellow-500' : ($task->status == 'in_progress' ? 'bg-blue-500' : 'bg-green-500') }}">
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
                                    <form action="{{ url('/tasks/destroy', ['id' => $task->id]) }}" method="POST"
                                        style="display:inline;" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="py-1 px-1 rounded-full text-xs delete-btn">
                                            <i class="fas fa-trash-alt text-red-500"></i>
                                        </button>
                                    </form>

                                    <form action="{{ url('/tasks/archive', ['id' => $task->id]) }}" method="POST"
                                        style="display:inline;" onsubmit="return confirmArchive();">
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
</x-app-layout>
<script>
    function confirmDelete() {
        return confirm('{{ __('messages.delete_confirmation') }}');
    }

    function confirmArchive() {
        return confirm('{{ __('messages.archive_confirmation') }}');
    }
</script>
