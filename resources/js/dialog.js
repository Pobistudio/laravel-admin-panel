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
