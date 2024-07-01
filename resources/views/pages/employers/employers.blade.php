<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h1 class="font-semibold text-slate-800 dark:text-slate-100 text-center">{{ __('messages.employer_list') }}</h1>
        </header>

        <div class="p-3">

            <!-- Task Table and Add Task Button -->
            <div class="overflow-x-auto">

                <div class="flex justify-between items-center mt-2 mb-2">
                    <div class="flex items-center mt-2 mb-2">
                        <button onclick="window.location='{{ route('employers.create') }}'"
                            class="bg-orange-500 hover:bg-orange-700 text-white p-1 mr-2 rounded-lg text-xs font-bold text-center">
                            <i class="fas fa-plus"></i> {{ __('messages.add_employer') }}
                        </button>
                        {{-- <button onclick="window.location='{{ route('employers.export') }}'"
                            class="bg-green-500 hover:bg-green-700 text-white p-1 mr-2 rounded-lg text-xs font-bold text-center">
                            <i class="fas fa-file-excel"></i> {{ __('messages.export_excel') }}
                        </button> --}}
                    </div>
                </div>

                <table class="table-auto w-full dark:text-slate-300" id="employerTable">
                    <thead
                        class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50">
                        <tr class="rounded-lg text-black dark:text-white">
                            <th class="p-2">
                                <div class="font-semibold text-left">{{ __('messages.employer_id') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.image') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.name') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.email') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.company_name') }}</div>
                            </th>
                            <th class="p-2">
                                <div class="font-semibold text-center">{{ __('messages.actions') }}</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">
                        @foreach ($employers as $key => $employer)
                            <tr class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                <td class="py-2 px-4 text-center">{{ $key + 1 }}</td>

                                <td class="p-2">
                                    <div class="flex items-center justify-center">
                                        @if ($employer->avatar)
                                            <img class="shrink-0 mr-2 sm:mr-3 rounded-full" width="36" height="36" src="{{ asset('storage/' . $employer->avatar) }}" alt="{{ __('messages.image') }}">
                                        @else
                                            <img class="shrink-0 mr-2 sm:mr-3 rounded-full" width="36" height="36" src="{{ asset('default-avatar.png') }}" alt="{{ __('messages.image') }}">
                                        @endif
                                    </div>
                                </td>

                                <td class="py-2 px-4 text-center">{{ $employer->name }}</td>
                                <td class="py-2 px-4 text-center">{{ $employer->email }}</td>
                                <td class="py-2 px-4 text-center">{{ $employer->company_name }}</td>
                                <td class="py-2 px-4 text-center">
                                    <a href="{{ url('/employers/edit', ['id' => $employer->id]) }}"
                                        class="py-1 px-1 rounded-full text-xs">
                                        <i class="fas fa-edit text-blue-500"></i>
                                    </a>
                                    <a href="{{ url('/employers/show', ['id' => $employer->id]) }}"
                                        class="py-1 px-1 rounded-full text-xs">
                                        <i class="fas fa-eye text-gray-500"></i>
                                    </a>
                                    <form action="{{ url('/employers/destroy', ['id' => $employer->id]) }}"
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
            return confirm('{{ __('messages.confirm_delete') }}');
        }
    </script>
</x-app-layout>
