const dialogBasic   = "DIALOG_BASIC";
const dialogConfirm = "DIALOG_CONFIRM";

function generateDialog(type, title, message, actionText = '', callbackAction = null) {
    const sectionDialog = document.getElementById('section_dialog');
    clearSectionDialog();
    if (type == dialogBasic || type == dialogConfirm) {
        let dialog = '<dialog id="'+type+'" class="w-96 p-0 rounded-xl m-auto backdrop:bg-slate-600 backdrop:opacity-75 drop-shadow-2xl">';
        dialog    += '<div class="p-6">';
        dialog    += '<div class="flex justify-between items-center mb-4">';
        dialog    += '<h3 class="text-lg font-semibold">'+title+'</h3>';
        dialog    += '<button onclick="closeDialog(\'' + type + '\')" class="text-gray-400 hover:text-gray-600  cursor-pointer">';
        dialog    += '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
        dialog    += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
        dialog    += '</svg>';
        dialog    += '</button>';
        dialog    += '</div>';
        dialog    += '<p class="text-gray-600 mb-6">'+message+'</p>';
        dialog    += '<div class="flex justify-end space-x-3">';
        dialog    += '<button onclick="closeDialog(\'' + type + '\')" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 cursor-pointer"> Close </button>';

        if (type == dialogConfirm) {
            dialog    += '<button id="confirmActionButton" class="px-4 py-2 text-white bg-slate-600 rounded-md hover:bg-slate-700 cursor-pointer"> '+actionText+' </button>';
        }

        dialog    +=  '</div>';
        dialog    +=  '</div>';
        dialog    +=  '</dialog>';

        sectionDialog.innerHTML = dialog;

        // Tambahkan event listener untuk tombol konfirmasi jika ada
        if (type === dialogConfirm && callbackAction) {
            const confirmButton = document.getElementById('confirmActionButton');
            if (confirmButton) {
                confirmButton.addEventListener('click', () => {
                    // Panggil fungsi callback dan tutup dialog
                    callbackAction();
                    closeDialog(type);
                });
            }
        }
        return;
    }
    console.log("Dialog type is not defined");
    return;
}

function clearSectionDialog() {
    const sectionDialog = document.getElementById('section_dialog');
    sectionDialog.innerHTML = "";
}

function showBasicDialog(title, message) {
    generateDialog(dialogBasic, title, message);
    document.getElementById(dialogBasic).showModal();
}

function showConfirmDialog(title, message, actionText, callbackAction) {
    generateDialog(dialogConfirm, title, message, actionText, callbackAction);
    document.getElementById(dialogConfirm).showModal();
}

function closeDialog(id) {
    document.getElementById(id).close();
    clearSectionDialog();
}

window.showBasicDialog = showBasicDialog;
window.showConfirmDialog = showConfirmDialog;
window.closeDialog = closeDialog;


// Close on ESC key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const openDialog = document.querySelector('dialog[open]');
        if (openDialog) {
            openDialog.close();
            clearSectionDialog();
        }
    }
});
