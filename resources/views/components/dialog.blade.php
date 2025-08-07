<dialog id="basic-dialog" class="w-96 p-0 rounded-xl m-auto backdrop:bg-slate-600 backdrop:opacity-75">
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Basic Dialog</h3>
            <button onclick="closeDialog('basic-dialog')"
                    class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <p class="text-gray-600 mb-6">This is a native HTML dialog element with Tailwind styling.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDialog('basic-dialog')"
                    class="px-4 py-2 text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200">
                Close
            </button>
        </div>
    </div>
</dialog>

<dialog id="confirm-dialog" class="w-96 p-0 rounded-xl">
    <div class="p-6">
        <div class="flex items-start mb-4">
            <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900">Confirm Action</h3>
                <p class="text-gray-600 mt-1">Are you sure you want to delete this item? This action cannot be undone.</p>
            </div>
        </div>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDialog('confirm-dialog')"
                    class="px-4 py-2 text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200">
                Cancel
            </button>
            <button onclick="handleConfirm()"
                    class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">
                Delete
            </button>
        </div>
    </div>
</dialog>
