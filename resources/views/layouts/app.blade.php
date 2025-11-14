<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Scipy') }}</title>

    <!-- Prevent flash-of-incorrect-theme: read saved preference and apply .dark to <html> immediately -->
    <script>
        (function() {
            try {
                const theme = localStorage.getItem('theme');
                if (theme === 'dark' || (!theme && window.matchMedia && window.matchMedia(
                        '(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {
                /* ignore */ }
        })();
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ✅ Alpine.js (for dropdowns, carousels, etc.) -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="font-sans antialiased bg-white text-gray-900 dark:bg-gray-900 shadow dark:shadow-md">
    <div class="min-h-screen flex flex-col">
        {{-- Header / Navigation --}}
        @include('layouts.navigation')

        {{-- Optional header slot --}}
        @isset($header)
            <header class="bg-white dark:bg-gray-900 shadow dark:shadow-md">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="text-gray-800 dark:text-gray-100">
                        {{ $header }}
                    </div>
                </div>
            </header>
        @endisset

        {{-- Main Page Content --}}
        <main class="flex-1">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        @include('layouts.footer')
    </div>

    {{-- Stack for scripts pushed from child views --}}
    @stack('scripts')
</body>

</html>
