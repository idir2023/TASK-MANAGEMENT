<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
            <h1 class="font-semibold text-slate-800 dark:text-slate-100 text-center">{{ __('messages.add_employer') }}</h1>
        </header>

        <div class="p-3">
            <form action="{{ route('employers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-slate-700 dark:text-slate-200 text-sm font-bold mb-2" for="avatar">{{ __('messages.image') }}</label>
                    <input type="file" name="avatar" id="avatar" class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 dark:text-slate-300 leading-tight focus:outline-none focus:shadow-outline @error('avatar') border-red-500 @enderror">
                    @error('avatar')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-slate-700 dark:text-slate-200 text-sm font-bold mb-2" for="name">{{ __('messages.name') }}</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 dark:text-slate-300 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-slate-700 dark:text-slate-200 text-sm font-bold mb-2" for="email">{{ __('messages.email') }}</label>
                    <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 dark:text-slate-300 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-slate-700 dark:text-slate-200 text-sm font-bold mb-2" for="company_name">{{ __('messages.campany_name') }}</label>
                    <input type="text" name="company_name" id="company_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-slate-700 dark:text-slate-300 leading-tight focus:outline-none focus:shadow-outline @error('company_name') border-red-500 @enderror" value="{{ old('company_name') }}" required>
                    @error('company_name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ __('messages.add') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
