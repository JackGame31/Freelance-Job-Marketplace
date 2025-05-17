@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Freelance Job Details</h1>

    {{-- Details --}}
    <div class="mb-6 bg-white dark:bg-gray-800 p-6 rounded shadow">
        <div class="flex flex-col md:flex-row gap-6">
            {{-- Logo Preview --}}
            @if ($freelance->logo)
                <div class="md:w-1/3">
                    <img src="{{ $freelance->logo }}" alt="Job Logo"
                        class="w-full h-48 object-cover rounded-md border dark:border-gray-700">
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 break-all">
                        <span class="font-medium">Logo URL:</span>
                        <a href="{{ $freelance->logo }}" class="text-blue-600 dark:text-blue-400 underline" target="_blank">
                            {{ $freelance->logo }}
                        </a>
                    </p>
                </div>
            @endif

            {{-- Job Info --}}
            <div class="md:flex-1">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $freelance->title }}</h2>

                {{-- Meta Info --}}
                <div class="mb-4 space-y-1">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">Category:</span> {{ $freelance->category->name ?? 'Uncategorized' }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">Salary:</span>
                        ${{ number_format($freelance->start_salary, 0) }} - ${{ number_format($freelance->end_salary, 0) }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">Status:</span>
                        <span
                            class="inline-block px-2 py-1 text-xs rounded-full font-medium
                        @if ($freelance->status === 'open') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                        @else
                            bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                            {{ ucfirst($freelance->status) }}
                        </span>
                    </p>
                </div>

                {{-- Description --}}
                <div class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                    {{ $freelance->description }}
                </div>

                {{-- Edit/Delete --}}
                <div class="flex flex-col sm:flex-row gap-2 mt-6">
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
        </div>
    </div>

    <div>
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Applicants</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Contract Date</th>
                        <th class="px-4 py-3">Final Salary</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applicants as $applicant)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-3">{{ $applicant->name }}</td>
                            <td class="px-4 py-3">{{ $applicant->email }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="text-sm font-medium px-2 py-1 rounded-full
                                        @if ($applicant->pivot->status === 'accepted') bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300
                                        @elseif ($applicant->pivot->status === 'rejected')
                                            bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300
                                        @else
                                            bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300 @endif">
                                    {{ ucfirst($applicant->pivot->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if ($applicant->pivot->start_date && $applicant->pivot->end_date)
                                    {{ \Carbon\Carbon::parse($applicant->pivot->start_date)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($applicant->pivot->end_date)->format('d M Y') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($applicant->pivot->final_salary)
                                    ${{ number_format($applicant->pivot->final_salary, 2) }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                {{-- Approve/Edit --}}
                                @if ($applicant->pivot->status === 'accepted')
                                    <button type="button"
                                        class="text-sm text-yellow-600 hover:underline dark:text-yellow-400"
                                        onclick="prepareApprovalModal('{{ route('admin.freelances.applicant.status', [$freelance->id, $applicant->id]) }}', 
                                        { 
                                            start_date: '{{ $applicant->pivot->start_date }}', 
                                            end_date: '{{ $applicant->pivot->end_date }}', 
                                            final_salary: '{{ $applicant->pivot->final_salary }}' 
                                        })">
                                        Edit
                                    </button>
                                @else
                                    <button type="button"
                                        class="text-sm text-green-600 hover:underline dark:text-green-400"
                                        onclick="prepareApprovalModal(
                                            '{{ route('admin.freelances.applicant.status', [$freelance->id, $applicant->id]) }}',
                                            { 
                                                start_date: '{{ \Carbon\Carbon::now()->toDateString() }}', 
                                                end_date: '', 
                                                final_salary: '{{ $freelance->start_salary }}' 
                                            })">
                                        Approve
                                    </button>
                                @endif

                                <form method="POST"
                                    action="{{ route('admin.freelances.applicant.status', [$freelance->id, $applicant->id]) }}"
                                    class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected" />
                                    <button type="submit"
                                        @if ($applicant->pivot->status === 'rejected') disabled class="opacity-50 cursor-not-allowed" @else class="text-sm text-red-600 hover:underline dark:text-red-400" @endif>
                                        Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('admin.components.contract-modal')
@endsection