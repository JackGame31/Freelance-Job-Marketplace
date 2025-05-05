<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? env('APP_NAME') . ' | ' . $title : env('APP_NAME') }}</title>

    {{-- CSS --}}
    @vite('resources/css/app.css')
    @yield('css')
</head>
<body>
    {{-- Navigation Bar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <div class="container mx-auto">
        @yield('content')
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @yield('js')
</body>
</html>