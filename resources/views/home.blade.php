@extends('layouts.main')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-white dark:bg-gray-900 py-20">
        <div class="container mx-auto px-6 grid md:grid-cols-2 items-center gap-10 text-center md:text-left">
            {{-- Left Column --}}
            <div>
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-gray-900 dark:text-white mb-6">
                    Find Top Freelance Jobs and Talent
                </h1>
                <p class="text-lg text-gray-500 dark:text-gray-400 mb-8">
                    Whether you're hiring or looking for work, we connect the best people for the best projects.
                </p>
                <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
                    <a href="{{ route('search') }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-6 py-3 transition">
                        Browse Jobs
                    </a>
                    @php
                        $isGuestWeb = Auth::guard('web')->guest();
                        $isGuestAdmin = Auth::guard('admin')->guest();
                        $isGuest = $isGuestWeb && $isGuestAdmin;
                    @endphp
                    @if ($isGuest)
                        <a href="{{ route('register') }}"
                            class="inline-block bg-gray-100 hover:bg-gray-200 text-gray-900 font-medium rounded-lg px-6 py-3 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 transition">
                            Join as Freelancer
                        </a>
                    @endif
                </div>
            </div>

            {{-- Right Image (optional visual touch) --}}
            <div class="hidden md:block">
                <img src="{{ asset('img/hero.png') }}" alt="Job search illustration"
                    class="w-full mx-auto rounded-lg"
                    style="height: 320px; object-fit: cover;">
            </div>
        </div>
    </section>

    {{-- Categories --}}
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-10">Explore Categories</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('search', ['category_id' => $category->id]) }}"
                        class="group bg-white dark:bg-gray-700 rounded-xl shadow-md p-6 text-center hover:shadow-xl hover:-translate-y-1 transition-all">
                        <div class="mb-3">
                            <i class="bi bi-briefcase-fill text-3xl text-blue-500 group-hover:text-blue-700 transition"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Jobs in {{ $category->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Trusted Companies --}}
    <section class="py-12 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-lg font-semibold text-gray-500 dark:text-gray-400 mb-6">Trusted by global teams</h3>
            <div class="flex flex-wrap justify-center items-center gap-10 text-gray-400 dark:text-gray-500">
                <div class="tooltip" title="Google">
                    <i class="bi bi-google text-4xl hover:text-gray-600 dark:hover:text-white transition"></i>
                </div>
                <div class="tooltip" title="Microsoft">
                    <i class="bi bi-microsoft text-4xl hover:text-gray-600 dark:hover:text-white transition"></i>
                </div>
                <div class="tooltip" title="Spotify">
                    <i class="bi bi-spotify text-4xl hover:text-gray-600 dark:hover:text-white transition"></i>
                </div>
                <div class="tooltip" title="YouTube">
                    <i class="bi bi-youtube text-4xl hover:text-gray-600 dark:hover:text-white transition"></i>
                </div>
            </div>
        </div>
    </section>
@endsection
