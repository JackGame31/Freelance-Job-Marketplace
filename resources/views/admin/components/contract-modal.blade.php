<button type="button" id="open-approval-modal-btn" data-modal-target="approval-modal" data-modal-toggle="approval-modal" class="hidden"></button>

<div id="approval-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Set Assignment Details
                </h3>
                <button type="button" data-modal-hide="approval-modal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form method="POST" id="approval-form" class="p-6 space-y-4">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="accepted">

                <div>
                    <label for="start_date" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Start
                        Date</label>
                    <input type="date" name="start_date" id="modal_start_date"
                        class="w-full p-2.5 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    @error('start_date')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">End
                        Date</label>
                    <input type="date" name="end_date" id="modal_end_date"
                        class="w-full p-2.5 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    @error('end_date')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="final_salary"
                        class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Final
                        Payment</label>
                    <input type="number" step="0.01" name="final_salary" id="modal_final_salary"
                        class="w-full p-2.5 rounded-lg border dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    @error('final_salary')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('js')
    <script>
        function prepareApprovalModal(action, data = {}) {
            // Set form action
            const form = document.getElementById('approval-form');
            form.action = action;

            // Fill values (if available)
            document.getElementById('modal_start_date').value = data.start_date || '';
            document.getElementById('modal_end_date').value = data.end_date || '';
            document.getElementById('modal_final_salary').value = data.final_salary || '';

            // Trigger the hidden toggle button
            document.getElementById('open-approval-modal-btn').click();
        }
    </script>
@endsection
