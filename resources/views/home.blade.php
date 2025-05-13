@extends('layouts.main')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-white dark:bg-gray-900 py-16">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-extrabold leading-tight tracking-tight text-gray-900 dark:text-white mb-4">
                Find Top Freelance Jobs and Talent
            </h1>
            <p class="text-lg text-gray-500 dark:text-gray-400 mb-6">
                Connect with talented freelancers or discover your next remote opportunity.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('search') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-6 py-3">
                    Browse Jobs
                </a>

                @php
                    $isGuestWeb = Auth::guard('web')->guest();
                    $isGuestAdmin = Auth::guard('admin')->guest();
                    $isGuest = $isGuestWeb || $isGuestAdmin;
                @endphp
                
                @if (!$isGuest)
                    <a href="{{ route('register') }}"
                        class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-900 font-medium rounded-lg px-6 py-3 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                        Join as Freelancer
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- Categories --}}
    <section class="py-12 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Explore Categories</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                @foreach ($categories as $category)
                    <a href="{{ route('search', ['category_id' => $category->id]) }}"
                        class="block bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6 hover:shadow-xl transition-transform transform hover:scale-105">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Discover jobs in {{ $category->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Trusted Companies --}}
    <section class="py-12 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400 mb-6">Trusted by</h3>
            <div class="flex flex-wrap justify-center gap-10 items-center text-gray-400 dark:text-gray-500">
                <i
                    class="bi bi-google text-4xl hover:text-gray-600 dark:hover:text-white transition-colors duration-200"></i>
                <i
                    class="bi bi-microsoft text-4xl hover:text-gray-600 dark:hover:text-white transition-colors duration-200"></i>
                <i
                    class="bi bi-spotify text-4xl hover:text-gray-600 dark:hover:text-white transition-colors duration-200"></i>
                <i
                    class="bi bi-youtube text-4xl hover:text-gray-600 dark:hover:text-white transition-colors duration-200"></i>
            </div>
        </div>
    </section>
@endsection
