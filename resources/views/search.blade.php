@extends('layouts.main')

@section('content')
    <div class="text-center text-xl font-bold dark:text-white text-gray-900 mt-10">
        <h1>Search Freelance Jobs</h1>
    </div>

    {{-- Search Bar --}}
    <form class="mt-8 max-w-4xl mx-auto">
        <div class="relative">
            <label for="default-search" class="sr-only">Search</label>
            
            <div class="flex items-center space-x-4">
                <!-- Search Input -->
                <input type="search" id="default-search" 
                    class="w-full py-3 pl-10 pr-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for freelance jobs, skills, categories..." required />
                
                <!-- Search Button -->
                <button type="submit"
                    class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500">
                    <span class="text-sm">Search</span>
                    <i class="ms-3 bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>

    {{-- Dummy Data - Freelance Job Listings --}}
    <div class="mt-8 max-w-4xl mx-auto">
        <h2 class="text-xl font-bold dark:text-white text-gray-900 mb-6">Search Results</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Job 1 --}}
            <div class="flex flex-col bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                <div class="flex-shrink-0 mb-4">
                    <img class="w-full h-40 object-cover rounded-md" src="https://picsum.photos/id/237/1000" alt="Job Image">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Web Developer Needed</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Skills Required: React, Node.js, JavaScript</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Location: Remote | Budget: $5000</p>
                    <a href="{{ route('freelance') }}" class="text-sm text-blue-600 hover:underline mt-2 inline-block">View Job</a>
                </div>
            </div>

            {{-- Job 2 --}}
            <div class="flex flex-col bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                <div class="flex-shrink-0 mb-4">
                    <img class="w-full h-40 object-cover rounded-md" src="https://picsum.photos/id/238/1000" alt="Job Image">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Graphic Designer for Startup</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Skills Required: Photoshop, Illustrator, Branding</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Location: Remote | Budget: $3000</p>
                    <a href="{{ route('freelance') }}" class="text-sm text-blue-600 hover:underline mt-2 inline-block">View Job</a>
                </div>
            </div>

            {{-- Job 3 --}}
            <div class="flex flex-col bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                <div class="flex-shrink-0 mb-4">
                    <img class="w-full h-40 object-cover rounded-md" src="https://picsum.photos/id/239/1000" alt="Job Image">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Content Writer for Blog</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Skills Required: SEO, Copywriting, Blogging</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Location: Remote | Budget: $1500</p>
                    <a href="{{ route('freelance') }}" class="text-sm text-blue-600 hover:underline mt-2 inline-block">View Job</a>
                </div>
            </div>

            {{-- Job 4 --}}
            <div class="flex flex-col bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                <div class="flex-shrink-0 mb-4">
                    <img class="w-full h-40 object-cover rounded-md" src="https://picsum.photos/id/240/1000" alt="Job Image">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Mobile App Developer</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Skills Required: iOS, Swift, Firebase</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Location: Remote | Budget: $4000</p>
                    <a href="{{ route('freelance') }}" class="text-sm text-blue-600 hover:underline mt-2 inline-block">View Job</a>
                </div>
            </div>
        </div>
    </div>
@endsection
