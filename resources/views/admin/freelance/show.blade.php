@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Freelance Job Details</h1>

    @php
        $freelance = [
            'title' => 'Full Stack Laravel Developer',
            'description' => 'We are hiring a Laravel developer to build a platform with authentication, APIs, and dashboard functionality.',
            'category' => 'Web Development',
            'status' => 'published',
            'applicants' => [
                ['name' => 'Alice Johnson', 'email' => 'alice@example.com', 'status' => 'pending'],
                ['name' => 'Bob Smith', 'email' => 'bob@example.com', 'status' => 'approved'],
            ]
        ];
    @endphp

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $freelance['title'] }}</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $freelance['category'] }}</p>
        <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $freelance['description'] }}</p>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Applicants</h3>
        <div class="overflow-x-auto mt-3">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($freelance['applicants'] as $applicant)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-3">{{ $applicant['name'] }}</td>
                            <td class="px-4 py-3">{{ $applicant['email'] }}</td>
                            <td class="px-4 py-3">
                                <span class="text-sm font-medium px-2 py-1 rounded-full
                                    @if($applicant['status'] === 'approved')
                                        bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300
                                    @else
                                        bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300
                                    @endif
                                ">
                                    {{ ucfirst($applicant['status']) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                <button
                                    class="text-sm text-green-600 hover:underline dark:text-green-400">Approve</button>
                                <button
                                    class="text-sm text-red-600 hover:underline dark:text-red-400">Reject</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
