class DialogManager {
    constructor() {
        this.DIALOG_BASIC = "DIALOG_BASIC";
        this.DIALOG_CONFIRM = "DIALOG_CONFIRM";
        this.sectionDialogId = 'section_dialog';
        this.init();
    }

    init() {
        // Setup ESC key listener
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.handleEscapeKey();
            }
        });

        // Expose methods to window for backward compatibility
        this.exposeToWindow();
    }

    generateDialog(type, title, message, actionText = '', bgAction = 'slate', callbackAction = null) {
        const sectionDialog = document.getElementById(this.sectionDialogId);
        this.clearSectionDialog();

        if (type === this.DIALOG_BASIC || type === this.DIALOG_CONFIRM) {
            const dialogHTML = this.buildDialogHTML(type, title, message, actionText, bgAction);
            sectionDialog.innerHTML = dialogHTML;

            // Add event listener for confirm button if needed
            if (type === this.DIALOG_CONFIRM && callbackAction) {
                this.attachConfirmListener(callbackAction, type);
            }
            return;
        }

        console.log("Dialog type is not defined");
    }

    buildDialogHTML(type, title, message, actionText, bgAction) {
        let dialog = `<dialog id="${type}" class="w-96 p-0 rounded-xl m-auto backdrop:bg-slate-600 backdrop:opacity-75 drop-shadow-2xl animation-in-down">`;
        dialog += '<div class="p-6">';
        dialog += '<div class="flex justify-between items-center mb-4">';
        dialog += `<h3 class="text-lg font-semibold">${title}</h3>`;
        dialog += `<button onclick="dialogManager.closeDialog('${type}')" class="text-gray-400 hover:text-gray-600 cursor-pointer">`;
        dialog += '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
        dialog += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
        dialog += '</svg>';
        dialog += '</button>';
        dialog += '</div>';
        dialog += `<p class="text-gray-600 mb-6">${message}</p>`;
        dialog += '<div class="flex justify-end space-x-3">';
        dialog += `<button onclick="dialogManager.closeDialog('${type}')" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 cursor-pointer">Close</button>`;

        if (type === this.DIALOG_CONFIRM) {
            const bgActionMain = bgAction == 'red' ? 'bg-red-600' : `bg-${bgAction}-500`;
            dialog += `<button id="confirmActionButton" class="px-4 py-2 text-white ${bgActionMain} rounded-md hover:bg-${bgAction}-700 cursor-pointer">${actionText}</button>`;
        }

        dialog += '</div>';
        dialog += '</div>';
        dialog += '</dialog>';

        return dialog;
    }

    attachConfirmListener(callbackAction, type) {
        const confirmButton = document.getElementById('confirmActionButton');
        if (confirmButton) {
            confirmButton.addEventListener('click', () => {
                callbackAction();
                this.closeDialog(type);
            });
        }
    }

    clearSectionDialog() {
        const sectionDialog = document.getElementById(this.sectionDialogId);
        if (sectionDialog) {
            sectionDialog.innerHTML = "";
        }
    }

    showBasicDialog(title, message) {
        this.generateDialog(this.DIALOG_BASIC, title, message);
        const dialog = document.getElementById(this.DIALOG_BASIC);
        if (dialog) {
            dialog.showModal();
        }
    }

    showConfirmDialog(title, message, actionText, callbackAction, bgAction = 'slate') {
        this.generateDialog(this.DIALOG_CONFIRM, title, message, actionText, bgAction, callbackAction);
        const dialog = document.getElementById(this.DIALOG_CONFIRM);
        if (dialog) {
            dialog.showModal();
        }
    }

    closeDialog(id) {
        const dialog = document.getElementById(id);
        if (dialog) {
            dialog.classList.remove('animation-in-down');
            dialog.classList.add('animation-out-up');
            setTimeout(() => {
                dialog.close();
                dialog.classList.remove('animation-out-up');
                this.clearSectionDialog();
            }, 300);
        }
    }

    handleEscapeKey() {
        const openDialog = document.querySelector('dialog[open]');
        if (openDialog) {
            openDialog.close();
            this.clearSectionDialog();
        }
    }

    // Custom dialog methods
    confirmLogoutDialog(logoutUrl) {
        this.showConfirmDialog(
            'Logout',
            'Apakah anda ingin logout aplikasi ini ?',
            'Logout',
            () => {
                window.location.href = logoutUrl;
            },
            'gray'
        );
    }

    confirmDeleteDialog(dataDelete, deleteUrl) {
        this.showConfirmDialog(
            'Delete',
            `Apakah anda ingin delete data <strong>${dataDelete}</strong> ?`,
            'Delete',
            () => {
                window.location.href = deleteUrl;
            },
            'red'
        );
    }

    confirmResetPasswordDialog(data, resetPasswordUrl) {
        this.showConfirmDialog(
            'Reset Password',
            `Apakah anda ingin reset password <strong>${data}</strong> ?`,
            'Reset Password',
            () => {
                window.location.href = resetPasswordUrl;
            },
            'red'
        );
    }

    confirmChangeStatusDialog(data, desStatusName, changeStatusUrl) {
        this.showConfirmDialog(
            'Change Status',
            `Apakah anda ingin ${desStatusName}-kan <strong>${data}</strong> ?`,
            desStatusName,
            () => {
                window.location.href = changeStatusUrl;
            },
            'red'
        );
    }

    // Method to create custom dialogs
    createCustomDialog(config) {
        const {
            type = this.DIALOG_CONFIRM,
            title,
            message,
            actionText = 'OK',
            bgAction = 'slate',
            callback = null
        } = config;

        if (type === this.DIALOG_BASIC) {
            this.showBasicDialog(title, message);
        } else {
            this.showConfirmDialog(title, message, actionText, callback, bgAction);
        }
    }

    // Expose methods to window for backward compatibility
    exposeToWindow() {
        window.showBasicDialog = (title, message) => this.showBasicDialog(title, message);
        window.showConfirmDialog = (title, message, actionText, callbackAction) =>
            this.showConfirmDialog(title, message, actionText, callbackAction);
        window.closeDialog = (id) => this.closeDialog(id);
        window.confirmLogoutDialog = (logoutUrl) => this.confirmLogoutDialog(logoutUrl);
        window.confirmDeleteDialog = (dataDelete, deleteUrl) => this.confirmDeleteDialog(dataDelete, deleteUrl);
        window.confirmResetPasswordDialog = (data, resetPasswordUrl) => this.confirmResetPasswordDialog(data, resetPasswordUrl);
        window.confirmChangeStatusDialog = (data, desStatusName, changeStatusUrl) => this.confirmChangeStatusDialog(data, desStatusName, changeStatusUrl);
    }

    // Static method to create singleton instance
    static getInstance() {
        if (!DialogManager.instance) {
            DialogManager.instance = new DialogManager();
        }
        return DialogManager.instance;
    }
}

// Create global instance
const dialogManager = DialogManager.getInstance();

// Export for module usage (optional)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = DialogManager;
}

// Di akhir file dialog-manager.js
document.addEventListener('DOMContentLoaded', () => {
    // Create global instance when DOM is ready
    window.dialogManager = DialogManager.getInstance();
});
