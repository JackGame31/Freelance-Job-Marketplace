@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto mt-12 bg-white rounded-lg shadow-md dark:bg-gray-800 p-6">
        @php
            $job = [
                'id' => 1,
                'title' => 'Full Stack Laravel Developer',
                'description' =>
                    'We are hiring a Laravel developer to build a scalable application with APIs, dashboards, and admin control.',
                'category' => 'Web Development',
                'status' => 'published',
                'created_at' => '2025-04-28',
                'employer' => 'Tech Solutions Inc.',
            ];
        @endphp

        {{-- Job Title --}}
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">
            {{ $job['title'] }}
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
            Posted on {{ \Carbon\Carbon::parse($job['created_at'])->format('M d, Y') }} by
            <span class="font-medium text-gray-900 dark:text-white">{{ $job['employer'] }}</span>
        </p>

        {{-- Category Badge --}}
        <span
            class="inline-block px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded dark:bg-blue-900 dark:text-blue-300 mb-4">
            {{ $job['category'] }}
        </span>

        {{-- Job Description --}}
        <div class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
            {{ $job['description'] }}
        </div>

        {{-- Apply Button --}}
        @auth
            <form action="
            {{-- {{ route('freelance.apply', $job['id']) }} --}}
             " method="POST">
                @csrf
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Apply for this Job
                </button>
            </form>
        @else
            <div class="bg-yellow-50 text-yellow-800 p-4 rounded mb-4 dark:bg-yellow-800 dark:text-yellow-200">
                Please <a href="{{ route('login') }}" class="underline font-medium">log in</a> to apply for this job.
            </div>
        @endauth
    </div>
@endsection
