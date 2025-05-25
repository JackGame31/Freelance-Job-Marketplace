@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Applicant Details</h1>

        {{-- Applicant Summary Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8 space-y-6">
            {{-- Profile Picture & Info --}}
            <div class="flex items-center gap-5">
                <img src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="{{ $applicant->name }} profile"
                    class="w-16 h-16 rounded-full object-cover border border-gray-300 dark:border-gray-600">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $applicant->name }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $applicant->email }}</p>
                </div>
            </div>

            {{-- Contract Details --}}
            {{-- Contract Details --}}
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Final Salary</p>
                    <p class="text-gray-800 dark:text-gray-300 font-medium">
                        ${{ number_format($applicant->pivot->final_salary, 2) }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Start Date</p>
                    <p class="text-gray-800 dark:text-gray-300 font-medium">
                        {{ \Carbon\Carbon::parse($applicant->pivot->start_date)->format('M d, Y') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">End Date</p>
                    <p class="text-gray-800 dark:text-gray-300 font-medium">
                        {{ \Carbon\Carbon::parse($applicant->pivot->end_date)->format('M d, Y') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Received</p>
                    <p class="text-green-700 dark:text-green-400 font-semibold">
                        ${{ number_format($totalPayment, 2) }}
                    </p>
                </div>
            </div>


            {{-- Pay & Edit Buttons --}}
            <div class="pt-4 flex flex-col sm:flex-row gap-3">
                <button type="button" data-modal-target="payment-modal" data-modal-toggle="payment-modal"
                    class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-150">
                    Pay Freelancer
                </button>

                <button type="button"
                    class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 transition-colors duration-150"
                    title="Edit"
                    onclick="prepareApprovalModal('{{ route('admin.freelances.applicant.status', [$freelance->id, $applicant->id]) }}', 
                    { 
                        start_date: '{{ $applicant->pivot->start_date }}', 
                        end_date: '{{ $applicant->pivot->end_date }}', 
                        final_salary: '{{ $applicant->pivot->final_salary }}' 
                    })">
                    Edit Contract
                </button>
            </div>
        </div>

        {{-- Payment History --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Payment History</h2>
            @if ($payments->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No payments made yet.</p>
            @else
                <div class="mb-4">
                    {{ $payments->links() }}
                </div>

                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-3 font-medium">${{ number_format($payment->amount, 2) }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($payment->created_at)->format('M d, Y') }}
                                </td>
                                <td class="px-4 py-3">{{ $payment->notes ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Payment Modal --}}
    <div id="payment-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto inset-0 h-[calc(100%-1rem)] max-h-full flex items-center justify-center bg-black/50">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pay Freelancer</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-900 dark:hover:text-white"
                        data-modal-hide="payment-modal">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                            <path stroke="currentColor" stroke-width="2" d="M1 1l12 12m0-12L1 13" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('admin.freelances.applicant.pay', [$freelance->id, $applicant->id]) }}"
                    method="POST" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label for="amount"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Amount</label>
                        <input type="number" name="amount" id="amount" step="0.01"
                            class="w-full p-2.5 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            value="{{ $applicant->pivot->final_salary }}" required>
                    </div>
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes
                            (optional)</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="w-full p-2.5 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="e.g. Milestone 1, Final payment..."></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg px-5 py-2.5">
                            Submit Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit contract modal --}}
    @include('admin.components.contract-modal')
@endsection
