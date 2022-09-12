<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    @vite('resources/js/app.js')
</head>

<body>
    <div class="font-sans antialiased text-gray-900 dark:bg-slate-800">
        {{ $slot }}
    </div>
    {{-- <script>
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
    </script> --}}
</body>


</html>