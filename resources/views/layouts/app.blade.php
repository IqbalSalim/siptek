<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireStyles
    <style>
        [x-cloak] {
            display: none
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-slate-800">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow dark:bg-gray-800">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>
    @livewireScripts

    <script>
        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", function(e) {
                const colorScheme = e.matches ? "dark" : "light";
                console.log(colorScheme);
                if (colorScheme === 'dark') {
                    document.getElementById("logo").src = "{{ asset('images/logo-putih.png') }}";
                } else {
                    document.getElementById("logo").src = "{{ asset('images/logo.png') }}";
                }
            });

        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.getElementById("logo").src = "{{ asset('images/logo-putih.png') }}";
        } else {
            document.getElementById("logo").src = "{{ asset('images/logo.png') }}";
        }
    </script>
</body>

</html>
