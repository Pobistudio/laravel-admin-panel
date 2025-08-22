import './bootstrap';
import 'remixicon/fonts/remixicon.css';
import './alert.js';
import './dialog.js';
import './sidebar.js';
import './dropdown-menu-navbar.js';
import 'laravel-datatables-vite';
import './datatable-tailwind.js';

window.confirmLogoutDialog = function (logoutUrl) {
    showConfirmDialog('Logout', 'Apakah anda ingin logout aplikasi ini ?', 'Logout', function () {
        window.location.href = logoutUrl;
    });
}
