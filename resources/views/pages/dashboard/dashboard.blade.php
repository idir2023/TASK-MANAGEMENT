<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Welcome banner -->
        <x-dashboard.welcome-banner />

        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6">
            <!-- Tasks Card -->
            <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="px-5 pt-5">
                    <div class="flex items-center mb-2">
                        <svg class="w-6 h-6 text-blue-500 dark:text-blue-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">{{ __('pagination.tasks') }}</h2>
                    </div>
                    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase mb-1">{{ __('pagination.tasks') }}</div>
                    <div class="flex items-start">
                        <div class="text-3xl font-bold text-center text-slate-800 dark:text-slate-100 mr-2">
                            {{ $Tasks->count() }}
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('tasks') }}" class="text-blue-500 hover:text-blue-700">{{ __('pagination.view_more') }}</a>
                    </div>
                </div>
            </div>

            <!-- Projects Card -->
            <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="px-5 pt-5">
                    <div class="flex items-center mb-2">
                        <svg class="w-6 h-6 text-green-500 dark:text-green-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 2h6a2 2 0 012 2v4h2a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h2V4a2 2 0 012-2z"></path>
                        </svg>
                        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">{{ __('pagination.projects') }}</h2>
                    </div>
                    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase mb-1">{{ __('pagination.projects') }}</div>
                    <div class="flex items-start">
                        <div class="text-3xl font-bold text-center text-slate-800 dark:text-slate-100 mr-2">
                            {{ $Projects->count() }}
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('projects') }}" class="text-blue-500 hover:text-blue-700">{{ __('pagination.view_more') }}</a>
                    </div>
                </div>
            </div>

            <!-- Employers Card -->
            <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <div class="px-5 pt-5">
                    <div class="flex items-center mb-2">
                        <svg class="w-6 h-6 text-red-500 dark:text-red-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 11-8 0 4 4 0 018 0zm2 1a6 6 0 11-12 0 6 6 0 0112 0zm-6 3a7 7 0 017 7H5a7 7 0 0114 0h-2"></path>
                        </svg>
                        <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">{{ __('pagination.employers') }}</h2>
                    </div>
                    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase mb-1">{{ __('pagination.employers') }}</div>
                    <div class="flex items-start">
                        <div class="text-3xl font-bold text-center text-slate-800 dark:text-slate-100 mr-2">
                            {{ $Employers->count() }}
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('employers') }}" class="text-blue-500 hover:text-blue-700">{{ __('pagination.view_more') }}</a>
                    </div>
                </div>
            </div>

            <!-- Tasks Table Card -->
            <div class="col-span-full xl:col-span-12 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
                <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
                    <h2 class="font-semibold text-slate-800 dark:text-slate-100">{{ __('pagination.tasks') }}</h2>
                </header>
                <div class="p-3">
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table id="tasksTable" class="table-auto w-full dark:text-slate-300">
                            <!-- Table header -->
                            <thead class="text-xs uppercase text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-700 dark:bg-opacity-50 rounded-sm">
                                <tr>
                                    <th class="p-2">
                                        <div class="font-semibold text-left">{{ __('pagination.employer') }}</div>
                                    </th>
                                    <th class="p-2">
                                        <div class="font-semibold text-center">{{ __('pagination.task') }}</div>
                                    </th>
                                    <th class="p-2">
                                        <div class="font-semibold text-center">{{ __('pagination.status') }}</div>
                                    </th>
                                    <th class="p-2">
                                        <div class="font-semibold text-center">{{ __('pagination.project') }}</div>
                                    </th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody class="text-sm font-medium divide-y divide-slate-100 dark:divide-slate-700">

                            </tbody>
                        </table>
                    </div>
                    <!-- Buttons container -->
                    <div class="bottom-buttons mt-4"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#tasksTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dashboard') }}',
                columns: [
                    { data: 'employer', name: 'employer' },
                    { data: 'task_title', name: 'task_title' },
                    { data: 'status', name: 'status' },
                    { data: 'project_title', name: 'project_title' }
                ],
                dom: '<"flex justify-between items-center mb-4"Bf>rt<"pagination-container"p>',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel" style="color: green;"></i> {{ __("pagination.export_to_excel") }}',
                        className: 'export-excel-btn',
                        titleAttr: '{{ __("pagination.export_to_excel") }}'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf" style="color: red;"></i> {{ __("pagination.export_to_pdf") }}',
                        className: 'export-pdf-btn',
                        titleAttr: '{{ __("pagination.export_to_pdf") }}'
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-columns" style="color: blue;"></i> {{ __("pagination.column_visibility") }}',
                        className: 'colvis-btn',
                        titleAttr: '{{ __("pagination.column_visibility") }}'
                    }
                ],
                language: {
                    search: "",
                    searchPlaceholder: "{{ __('search') }}"
                },
                drawCallback: function() {
                    stylePagination();
                }
            });

            $('.search-box input[type="search"]').addClass(
                'pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500'
            ).attr('placeholder', '{{ __("search") }}');
            $('.search-box').append(
                '<svg class="w-4 h-4 absolute left-3 top-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 10-4 13 7 7 0 014-13z" /></svg>'
            );

            function stylePagination() {
                $('.dataTables_paginate').addClass('flex space-x-2');
                $('.dataTables_paginate a').addClass(
                    'px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-800');
                $('.dataTables_paginate .current').addClass('bg-blue-500 text-white');
            }

            stylePagination();
        });
    </script>
</x-app-layout>
