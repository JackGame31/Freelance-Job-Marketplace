@extends('layouts.main')

@section('content')
    <div class="text-center text-xl font-bold dark:text-white text-gray-900 mt-10">
        <h1>Search Freelance Jobs</h1>
    </div>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('search') }}" class="mt-8 max-w-4xl mx-auto">
        <div class="relative">
            <label for="default-search" class="sr-only">Search</label>
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                <input type="search" id="default-search" name="query"
                    class="w-full py-3 pl-10 pr-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for freelance jobs, skills, categories..." value="{{ request('query') }}" />
                <div class="w-full sm:w-auto">
                    <select name="category_id"
                        class="block w-full py-3 px-4 border border-gray-300 rounded-lg bg-white text-sm text-gray-700 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500">
                    <span class="text-sm">Search</span>
                    <i class="ms-3 bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>

    {{-- Job Results --}}
    <div class="mt-10 max-w-6xl mx-auto">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Search Results</h2>
        {{-- Pagination --}}
        <div class="my-3">
            {{ $freelances->links() }}
        </div>

        @if ($freelances->isEmpty())
            <div class="text-gray-500 dark:text-gray-400 text-center">
                No jobs found.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($freelances as $job)
                    <div
                        class="flex flex-col bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                        <div class="flex-shrink-0 mb-4">
                            <img class="w-full h-40 object-cover rounded-md" src="{{ $job->logo }}" alt="Job Image">
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                                {{ $job->title }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Category: <span class="font-medium">{{ $job->category->name ?? 'N/A' }}</span>
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Posted by: {{ $job->admin->name ?? 'Unknown' }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Salary: ${{ number_format($job->start_salary, 0) }} -
                                ${{ number_format($job->end_salary, 0) }}
                            </p>
                            <p class="text-sm mt-2">
                                <span
                                    class="inline-block px-2 py-1 rounded text-xs font-medium
                                    @if ($job->status === 'open') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @else
                                        bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                    {{ ucfirst($job->status) }}
                                </span>
                            </p>
                            <a href="{{ route('search.show', $job->id) }}"
                                class="text-sm text-blue-600 hover:underline mt-3 inline-block dark:text-blue-400">
                                View Job
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
