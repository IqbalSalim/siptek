<div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 dark:bg-slate-800 sm:justify-center sm:pt-0">
    <div>
        {{ $logo }}
    </div>

    <div
        class="w-full px-6 py-4 mt-6 overflow-hidden bg-white border border-gray-200 shadow-md dark:border-gray-700 dark:bg-gray-800 sm:max-w-md sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
