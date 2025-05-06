<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} @isset($title)
            | {{ $title }}
        @endisset
    </title>

    {{-- CSS --}}
    @vite('resources/css/app.css')
    @yield('css')
</head>

<body class="dark:bg-gray-900 min-h-screen flex flex-col">
    {{-- Navigation Bar --}}
    @include('components.navbar')

    <div class="container mx-auto flex-grow">
        {{-- Flash Alert Component --}}
        <div @class(['mt-6' => session('success') || session('error') || session('info') || session('warning')])>
            <x-alert type="success" :message="session('success')" />
            <x-alert type="error" :message="session('error')" />
            <x-alert type="info" :message="session('info')" />
            <x-alert type="warning" :message="session('warning')" />
        </div>

        {{-- Main Content --}}
        @yield('content')
    </div>

    {{-- Footer --}}
    @include('components.footer')

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @yield('js')
</body>

</html>
