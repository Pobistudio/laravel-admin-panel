function generateDialog(type, title, message) {
    let dialog = '<dialog id="'+type+'" class="w-96 p-0 rounded-xl m-auto backdrop:bg-slate-600 backdrop:opacity-75 drop-shadow-2xl">';
    dialog    += '<div class="p-6">';
    dialog    += '<div class="flex justify-between items-center mb-4">';
    dialog    += '<h3 class="text-lg font-semibold">'+title+'</h3>';
    dialog    += '<button class="text-gray-400 hover:text-gray-600  cursor-pointer">';
    dialog    += '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
    dialog    += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
    dialog    += '</svg>';
    dialog    += '</button>';
    dialog    += '</div>';
    dialog    += '<p class="text-gray-600 mb-6">'+message+'</p>';
    dialog    += '<div class="flex justify-end space-x-3">';
    dialog    += '<button onclick="closeDialog('+type+')" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 cursor-pointer"> Close </button>';
    dialog    +=  '</div>';
}

function showBasicDialog() {
    document.getElementById('basic-dialog').showModal();
}

function showConfirmDialog() {
    document.getElementById('confirm-dialog').showModal();
}

function closeDialog(id) {
    document.getElementById(id).close();
}

function handleConfirm() {
    alert('Item deleted!');
    closeDialog('confirm-dialog');
}

window.showBasicDialog = showBasicDialog;
window.showConfirmDialog = showConfirmDialog;
window.closeDialog = closeDialog;
window.handleConfirm = handleConfirm;


// Close on ESC key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const openDialog = document.querySelector('dialog[open]');
        if (openDialog) {
            openDialog.close();
        }
    }
});
