@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Freelance Job Details</h1>

    {{-- Details --}}
    <div class="mb-6 bg-white dark:bg-gray-800 p-6 rounded shadow">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-1">{{ $freelance->title }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                Category: <strong>{{ $freelance->category->name ?? 'Uncategorized' }}</strong>
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                Status:
                <span class="inline-block px-2 py-1 text-xs rounded-full font-medium
                    @if ($freelance->status === 'open')
                        bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                    @else
                        bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                    @endif">
                    {{ ucfirst($freelance->status) }}
                </span>
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed mt-3">
                {{ $freelance->description }}
            </p>
            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                Salary: <strong>${{ number_format($freelance->start_salary, 0) }} - ${{ number_format($freelance->end_salary, 0) }}</strong>
            </p>
        </div>

        {{-- Edit/Delete buttons --}}
        <div class="flex flex-col sm:flex-row gap-2 mt-4">
            <a href="{{ route('admin.freelances.edit', $freelance->id) }}"
                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg w-full sm:w-auto">
                Edit
            </a>
            <form action="{{ route('admin.freelances.destroy', $freelance->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this job?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg w-full sm:w-auto">
                    Delete
                </button>
            </form>
        </div>
    </div>

    {{-- Dummy Applicants --}}
    @php
        $applicants = [
            ['name' => 'Alice Johnson', 'email' => 'alice@example.com', 'status' => 'pending'],
            ['name' => 'Bob Smith', 'email' => 'bob@example.com', 'status' => 'approved'],
            ['name' => 'Charlie Doe', 'email' => 'charlie@example.com', 'status' => 'pending'],
        ];
    @endphp

    <div>
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Applicants (Dummy Data)</h3>

        <div class="overflow-x-auto">
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
                    @foreach ($applicants as $applicant)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-3">{{ $applicant['name'] }}</td>
                            <td class="px-4 py-3">{{ $applicant['email'] }}</td>
                            <td class="px-4 py-3">
                                <span class="text-sm font-medium px-2 py-1 rounded-full
                                    @if($applicant['status'] === 'approved')
                                        bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300
                                    @else
                                        bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300
                                    @endif">
                                    {{ ucfirst($applicant['status']) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                <button class="text-sm text-green-600 hover:underline dark:text-green-400">
                                    Approve
                                </button>
                                <button class="text-sm text-red-600 hover:underline dark:text-red-400">
                                    Reject
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
