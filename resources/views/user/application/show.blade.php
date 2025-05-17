@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto mt-12 bg-white rounded-lg shadow-md dark:bg-gray-800 p-6">

        {{-- Title & Status --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $freelance->title }}
            </h1>
            <span
                class="inline-block px-3 py-1 text-sm font-medium rounded
                @if ($application->pivot->status === 'accepted') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                @elseif($application->pivot->status === 'rejected')
                    bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                @else
                    bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300 @endif">
                {{ ucfirst($application->pivot->status) }}
            </span>
        </div>

        {{-- Submission Info --}}
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Submitted on {{ \Carbon\Carbon::parse($application->pivot->created_at)->format('M d, Y') }} |
            Posted by <span
                class="font-medium text-gray-900 dark:text-white">{{ $freelance->admin->name ?? 'Unknown Employer' }}</span>
        </p>

        {{-- Logo --}}
        @if ($freelance->logo)
            <div class="mt-4">
                <img src="{{ $freelance->logo }}" alt="Job Logo"
                    class="w-full h-56 object-cover rounded-lg border dark:border-gray-700">
            </div>
        @endif

        {{-- Info Tags --}}
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

        {{-- Accepted Details --}}
        @if ($application->pivot->status === 'accepted')
            <div class="mt-8">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Assignment Details</h2>

                <div
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border dark:border-gray-600">
                    {{-- Start Date --}}
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500 dark:text-gray-300">Start Date</span>
                        <div class="text-base font-medium text-gray-800 dark:text-white flex items-center gap-2">
                            <i class="bi bi-calendar-event-fill text-blue-500"></i>
                            {{ \Carbon\Carbon::parse($application->pivot->start_date)->format('M d, Y') }}
                        </div>
                    </div>

                    {{-- End Date --}}
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500 dark:text-gray-300">End Date</span>
                        <div class="text-base font-medium text-gray-800 dark:text-white flex items-center gap-2">
                            <i class="bi bi-calendar-check-fill text-green-500"></i>
                            {{ \Carbon\Carbon::parse($application->pivot->end_date)->format('M d, Y') }}
                        </div>
                    </div>

                    {{-- Final Salary --}}
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-gray-500 dark:text-gray-300">Final Salary</span>
                        <div class="text-base font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                            <i class="bi bi-cash-stack text-yellow-500"></i>
                            ${{ number_format($application->pivot->final_salary, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Withdraw Button --}}
        @if ($application->pivot->status === 'pending')
            <div class="mt-6">
                <form action="{{ route('application.withdraw', $freelance->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to withdraw your application?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-red-700 dark:hover:bg-red-800">
                        Withdraw Application
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
