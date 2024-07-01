@props([
    'align' => 'right'
])

<div class="relative inline-flex" x-data="{ open: false }">
    <button
        class="w-8 h-8 flex items-center justify-center bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600/80 rounded-full"
        :class="{ 'bg-slate-200': open }"
        aria-haspopup="true"
        @click.prevent="open = !open"
        :aria-expanded="open"
    >
        <span class="sr-only">Info</span>
        <svg class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-current text-slate-500 dark:text-slate-400" d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm.3 18.3c-1.8-.3-3.3-1.3-4.4-2.6.3-.8.6-1.5.9-2.2.4-.8.9-1.4 1.5-2 .8.4 1.6.7 2.5.8 0 .3 0 .7.1 1 .1.7.3 1.4.4 2.1-.6.5-1.3 1-2 1.3zm4.2-1.5c-.2-.6-.4-1.3-.5-1.9-.1-.5-.2-1-.3-1.4 1.1-.1 2.1-.5 3-1.1.3 1.2.2 2.4-.3 3.6-1.3.6-2.4 1-3.9.8zm4.1-3.4c-.7-.3-1.3-.8-1.8-1.3.3-.8.5-1.6.6-2.5.6.2 1.2.2 1.8.1-.1 1.5-.3 2.5-.6 3.7zM17.1 8c-.5.4-1.1.7-1.7.9-.2-.6-.5-1.2-.8-1.7-.3-.6-.6-1.2-.9-1.7.9.2 1.7.5 2.5 1.1.3.5.6 1.1.9 1.4zm-3.7 1.3c-.4.4-.7.9-.9 1.5-.6-.1-1.1-.3-1.6-.5-.6-.3-1.1-.7-1.6-1.1.1-.2.3-.5.5-.7.5-.7 1.1-1.2 1.8-1.6.6.6 1.3 1.7 1.8 2.4zm-2.7-4.3c.5.7.9 1.4 1.3 2.2-.8.4-1.7.5-2.5.3-.2-.7-.4-1.4-.5-2.1 0-.1.1-.1.1-.2.5-.1.9-.1 1.6-.2zm-2.3.3c.2.7.5 1.3.8 1.9-.5.5-1.2.9-1.9 1.2-.2-.5-.4-.9-.5-1.4.4-.5 1-1 1.6-1.7zm-3.5 6.4c.3.2.6.3 1 .4.4.1.9.2 1.4.3-.2.6-.5 1.3-.8 1.9-.7.5-1.6.8-2.4.8-.3-.5-.4-1.1-.5-1.7.5-.4 1-.9 1.3-1.7zm-1.1 4.2c-.3-1-.4-2.2-.3-3.4.8.4 1.7.5 2.5.5.2.8.5 1.5.9 2.2-.5.6-1.1 1.2-1.8 1.6-.5-.2-.9-.5-1.3-.9zm5.3-10.8c-.1 1-.2 2-.5 2.9-.6-.2-1.2-.4-1.7-.8-.3-.3-.7-.6-1-.9.7-1.1 1.6-2 2.7-2.6.2.5.4.9.5 1.4zm.6 9.9c.4-.5.6-1.1.8-1.7.3.1.6.1.9.1.8.1 1.5-.2 2.2-.6.1.5.2 1 .2 1.6-.8.6-1.6 1.2-2.5 1.6-.5-.2-.9-.5-1.3-.9zM8.4 17c-.5-.6-.9-1.2-1.2-1.8-.3-.6-.5-1.3-.7-1.9.6-.1 1.2-.3 1.8-.5.7-.1 1.3-.3 1.9-.5.4.7.8 1.3 1.3 1.9-.8.4-1.6.8-2.4 1.1-.5.2-1.1.4-1.7.6zm7.7-8.8c-.2.7-.5 1.3-.9 1.9-.7-.3-1.4-.5-2.1-.8-.1-.7-.1-1.3 0-2 .3-.1.7-.1 1.1-.2.6 0 1.2.1 1.8.2.2.2.2.6.1.9zm-5.4-.2c-.2-.7-.5-1.3-.8-1.9.6-.1 1.3-.1 1.9.2.5.2.9.5 1.2.9-.2.6-.3 1.3-.4 1.9-.5-.1-.9-.1-1.3-.1-.2 0-.5 0-.7 0zm4.4-3.1c-.2-.4-.4-.7-.6-1.1.6-.5 1.3-.8 2-.9.1.4.2.8.2 1.2-.5.3-1.2.5-1.8.8-.1 0-.1.1-.1.1z"/>
        </svg>
    </button>
    <div
        class="origin-top-right z-10 absolute top-full min-w-44 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1 {{$align === 'right' ? 'right-0' : 'left-0'}}"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-show="open"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak
    >
        <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase pt-1.5 pb-2 px-3">Changer Langue</div>
        <ul>
            <li>
                <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 flex items-center py-1 px-3" href="{{ route('setLocale', ['locale' => 'ar']) }}" @click="open = false" @focus="open = true" @focusout="open = false">
                    <svg class="w-3 h-3 fill-current text-indigo-300 dark:text-indigo-500 shrink-0 mr-2" viewBox="0 0 12 12">
                        <rect y="3" width="12" height="9" rx="1" />
                        <path d="M2 0h8v2H2z" />
                    </svg>
                    <span class="text-blue-500 hover:text-blue-700 px-4">العربية</span>
                </a>
            </li>
            <li>
                <a class="font-medium text-sm text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 flex items-center py-1 px-3" href="{{ route('setLocale', ['locale' => 'en']) }}" @click="open = false" @focus="open = true" @focusout="open = false">
                    <svg class="w-3 h-3 fill-current text-indigo-300 dark:text-indigo-500 shrink-0 mr-2" viewBox="0 0 12 12">
                        <path d="M10.5 0h-9A1.5 1.5 0 000 1.5v9A1.5 1.5 0 001.5 12h9a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0010.5 0zM10 7L8.207 5.207l-3 3-1.414-1.414 3-3L5 2h5v5z" />
                    </svg>
                    <span class="text-blue-500 hover:text-blue-700 px-4">English</span>
                </a>
            </li>
        </ul>
    </div>
</div>
