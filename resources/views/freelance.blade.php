@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto mt-12 bg-white rounded-lg shadow-md dark:bg-gray-800 p-6">
        {{-- Job Title --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $freelance->title }}
            </h1>
            {{-- Status Badge --}}
            <span
                class="inline-block px-3 py-1 text-sm font-medium rounded 
                @if ($freelance->status === 'open') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 
                @else 
                    bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                {{ ucfirst($freelance->status) }}
            </span>
        </div>

        {{-- Posted Info --}}
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Posted on {{ $freelance->created_at->format('M d, Y') }} by
            <span class="font-medium text-gray-900 dark:text-white">{{ $freelance->admin->name ?? 'Unknown' }}</span>
        </p>

        {{-- Job Logo --}}
        @if ($freelance->logo)
            <div class="mt-4">
                <img src="{{ $freelance->logo }}" alt="Job Logo" class="w-full h-56 object-cover rounded-lg">
            </div>
        @endif

        {{-- Category & Salary --}}
        <div class="mt-6 flex flex-wrap gap-4">
            <span
                class="inline-block px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded dark:bg-blue-900 dark:text-blue-300">
                {{ $freelance->category->name ?? 'Uncategorized' }}
            </span>
            <span
                class="inline-block px-3 py-1 text-sm bg-gray-100 text-gray-800 rounded dark:bg-gray-700 dark:text-gray-300">
                ${{ number_format($freelance->start_salary, 0) }} - ${{ number_format($freelance->end_salary, 0) }}
            </span>
        </div>

        {{-- Job Description --}}
        <div class="mt-6 text-gray-700 dark:text-gray-300 leading-relaxed">
            {{ $freelance->description }}
        </div>

        {{-- Apply Section --}}
        @guest('admin')
        <div class="mt-8">
            @auth
                <form action="
                    {{-- {{ route('freelance.apply', $freelance->id) }} --}}
                 "
                    method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Apply for this Job
                    </button>
                </form>
            @else
                <div class="bg-yellow-50 text-yellow-800 p-4 rounded mb-4 mt-6 dark:bg-yellow-800 dark:text-yellow-200">
                    Please <a href="{{ route('login') }}" class="underline font-medium">log in</a> to apply for this job.
                </div>
            @endauth
        </div>
        @else
            <div class="mt-8">
                <p class="text-gray-500 dark:text-gray-400">
                    You are logged in as an admin. You can manage this job from the admin panel.
                </p>
            </div>
        @endguest
    </div>
@endsection
