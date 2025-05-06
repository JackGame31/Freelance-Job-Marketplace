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

<body class="bg-gray-50 dark:bg-gray-900">
    {{-- Side Bar --}}
    @include('admin.components.sidebar')

    {{-- Main Content --}}
    <div class="p-4 sm:ml-64">
        <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
            {{-- Alert Component --}}
            <x-alert type="success" :message="session('success')" />
            <x-alert type="error" :message="session('error')" />
            <x-alert type="info" :message="session('info')" />
            <x-alert type="warning" :message="session('warning')" />

            @yield('content')
        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @yield('js')
</body>

</html>
