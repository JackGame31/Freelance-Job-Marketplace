@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">My Applications</h1>

        @if($applications->isEmpty())
            <p class="text-gray-600 dark:text-gray-300">You haven't applied to any freelance jobs yet.</p>
        @else
            <div class="space-y-4">
                @foreach ($applications as $freelance)
                    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $freelance->title }}
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            {{ \Illuminate\Support\Str::limit($freelance->description, 120) }}
                        </p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full
                                @if ($freelance->pivot->status === 'pending')
                                    bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                @elseif ($freelance->pivot->status === 'accepted')
                                    bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                @else
                                    bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                @endif
                            ">
                                {{ ucfirst($freelance->pivot->status) }}
                            </span>

                            <a href="{{ route('application.show', $freelance->id) }}"
                                class="text-blue-600 hover:underline text-sm dark:text-blue-400">
                                View job →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
