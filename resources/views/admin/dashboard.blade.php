@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Total Jobs --}}
        <div class="flex items-center justify-between p-6 bg-white shadow-lg rounded-lg dark:bg-gray-800 dark:text-white">
            <div class="flex items-center space-x-4">
                <div class="p-4 bg-blue-500 text-white rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M3 6h18M3 14h18M3 18h18" />
                    </svg>
                </div>
                <div class="text-xl font-bold">Total Jobs</div>
            </div>
            <div class="text-2xl font-semibold">1,250</div>
        </div>

        {{-- New Freelancers --}}
        <div class="flex items-center justify-between p-6 bg-white shadow-lg rounded-lg dark:bg-gray-800 dark:text-white">
            <div class="flex items-center space-x-4">
                <div class="p-4 bg-green-500 text-white rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 15l7-7 7 7" />
                    </svg>
                </div>
                <div class="text-xl font-bold">New Freelancers</div>
            </div>
            <div class="text-2xl font-semibold">1,000</div>
        </div>

        {{-- Active Contracts --}}
        <div class="flex items-center justify-between p-6 bg-white shadow-lg rounded-lg dark:bg-gray-800 dark:text-white">
            <div class="flex items-center space-x-4">
                <div class="p-4 bg-yellow-500 text-white rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <div class="text-xl font-bold">Active Contracts</div>
            </div>
            <div class="text-2xl font-semibold">875</div>
        </div>
    </div>

    {{-- Chart or More Stats --}}
    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg dark:bg-gray-800 dark:text-white">
        <h3 class="text-2xl font-semibold mb-4">Recent Activity</h3>
        {{-- Placeholder for charts or graphs --}}
        <div class="h-72 bg-gray-100 dark:bg-gray-700 rounded-lg flex justify-center items-center">
            <p class="text-xl text-gray-400 dark:text-gray-500">Chart or stats will go here.</p>
        </div>
    </div>
@endsection
