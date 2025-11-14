<footer class=" bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
    <div class="container mx-auto px-4 py-8 flex flex-col md:flex-row items-center justify-between">

        {{-- Copyright --}}
        <div class="text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} {{ config('app.name', 'E-Store') }}. All rights reserved.
        </div>

        {{-- Footer links --}}
        <div class="flex gap-4 mt-3 md:mt-0">
            <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 text-sm">Privacy</a>
            <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 text-sm">Terms</a>
            <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 text-sm">Help</a>
        </div>
    </div>
</footer>
