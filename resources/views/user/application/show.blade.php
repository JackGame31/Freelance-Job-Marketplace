@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto mt-12 bg-white rounded-lg shadow-md dark:bg-gray-800 p-6">
        @php
            $application = [
                'id' => 1,
                'status' => 'pending', // could be accepted, rejected, etc.
                'applied_at' => '2025-05-03',
                'note' => 'Looking forward to contributing to your project.',
                'freelance' => [
                    'title' => 'Laravel Developer for E-commerce',
                    'description' => 'Build and maintain e-commerce features using Laravel, Livewire, and Tailwind.',
                    'category' => 'Web Development',
                    'employer' => 'CodeCraft Agency',
                    'created_at' => '2025-04-25',
                ],
            ];
        @endphp

        {{-- Title --}}
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">
            Application for: {{ $application['freelance']['title'] }}
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
            Submitted on {{ \Carbon\Carbon::parse($application['applied_at'])->format('M d, Y') }}
        </p>

        {{-- Status --}}
        <div class="mb-4">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Application Status:</span>
            <span
                class="inline-block ml-2 px-3 py-1 text-sm rounded 
                @if ($application['status'] === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                @elseif($application['status'] === 'accepted') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                @elseif($application['status'] === 'rejected') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif">
                {{ ucfirst($application['status']) }}
            </span>
        </div>

        {{-- Job Info --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Job Details</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Category: {{ $application['freelance']['category'] }} |
                Posted by: {{ $application['freelance']['employer'] }} on
                {{ \Carbon\Carbon::parse($application['freelance']['created_at'])->format('M d, Y') }}
            </p>
            <p class="mt-2 text-gray-700 dark:text-gray-300 leading-relaxed">
                {{ $application['freelance']['description'] }}
            </p>
        </div>

        {{-- Applicant Note --}}
        @if ($application['note'])
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Your Note</h2>
                <p class="text-gray-700 dark:text-gray-300 mt-1">{{ $application['note'] }}</p>
            </div>
        @endif

        {{-- Optional: Withdraw Application --}}
        <form action="
        {{-- {{ route('application.withdraw', $application['id']) }} --}}
         " method="POST"
            onsubmit="return confirm('Are you sure you want to withdraw your application?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="px-4 py-2 text-sm text-white bg-red-600 hover:bg-red-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-red-700 dark:hover:bg-red-800">
                Withdraw Application
            </button>
        </form>
    </div>
@endsection
