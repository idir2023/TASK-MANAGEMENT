<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h2 class="text-center text-xl font-bold text-gray-800 mt-4 mb-4">
                Modifier une tâche
            </h2>
        </header>
        <div class="p-3">

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/tasks/update', ['id' => $task->id]) }}" id="taskForm">
                @csrf
                @method('PUT')
                <div class="mb-6 flex">
                    <div class="w-1/2 mr-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            Titre
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="title" type="text" placeholder="Titre" name="title"
                            value="{{ old('title', $task->title) }}">
                    </div>
                    <div class="w-1/2 ml-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="due_date">
                            Date d'échéance
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="due_date" type="date" name="due_date"
                            value="{{ old('due_date', $task->due_date) }}">
                    </div>
                </div>

                <div class="mb-6 flex">
                    <div class="w-1/2 mr-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="priority">
                            Priorité
                        </label>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="priority" name="priority">
                            <option value="{{ $task->priority }}">{{ ucfirst($task->priority) }}</option>
                            <option value="low">Low</option>
                            <option value="normal">Normal</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="w-1/2 ml-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                            Statut
                        </label>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="status" name="status">
                            <option value="{{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </option>
                            <option value="pending">Pending</option>
                            <option value="in_progress">In progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="project_id"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project</label>
                    <select name="project_id" id="project_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">

                        <option value="{{ $task->project->id  }}">{{ $task->project->title }}</option>

                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    </select>

                    @error('employer_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="description" placeholder="Description" name="description">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="mb-8 flex justify-center">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 m-2 rounded-full"
                        type="submit">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <button id="Annuler"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 m-2 rounded-full"
                        type="button" onclick="window.location='{{ url('/tasks') }}'">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
