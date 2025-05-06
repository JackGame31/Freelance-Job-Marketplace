@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">My Freelance Jobs</h1>
        <a href="{{ route('admin.freelance.create') }}"
            class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5">
            + Create Job
        </a>
    </div>

    @php
        $freelances = [
            [
                'id' => 1,
                'title' => 'Full Stack Laravel Developer',
                'description' => 'Looking for an experienced Laravel developer...',
                'category' => 'Web Development',
                'status' => 'published',
                'applicants' => 5,
            ],
            [
                'id' => 2,
                'title' => 'Graphic Designer for Brand Kit',
                'description' => 'Creative graphic designer needed...',
                'category' => 'Design',
                'status' => 'draft',
                'applicants' => 2,
            ],
        ];
    @endphp

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Applicants</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($freelances as $job)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-4 py-3">
                            <div class="font-semibold text-gray-900 dark:text-white">{{ $job['title'] }}</div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ \Illuminate\Support\Str::limit($job['description'], 60) }}
                            </p>
                        </td>
                        <td class="px-4 py-3">{{ $job['category'] }}</td>
                        <td class="px-4 py-3">{{ $job['applicants'] }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @if ($job['status'] === 'published')
                                    bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                @else
                                    bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                @endif
                            ">
                                {{ ucfirst($job['status']) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('admin.freelance.show', $job['id']) }}"
                                class="text-blue-600 hover:underline dark:text-blue-400">View</a>
                            <a href="{{ route('admin.freelance.edit', $job['id']) }}"
                                class="text-gray-700 hover:underline dark:text-gray-300">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
