import './bootstrap';
import 'remixicon/fonts/remixicon.css';

document.addEventListener('DOMContentLoaded', function () {
    const menuToggles = document.querySelectorAll('.menu-toggle');

    menuToggles.forEach(toggle => {
        toggle.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Find the next sibling ul (the nested menu)
            const nestedMenu = this.nextElementSibling;

            if (nestedMenu && nestedMenu.classList.contains('nested-menu')) {
                nestedMenu.classList.toggle('hidden'); // Toggle visibility

                // Rotate the arrow icon
                const arrowIcon = this.querySelector('svg');
                if (arrowIcon) {
                    arrowIcon.classList.toggle('rotate-180');
                }
            }
        });
    });

    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    // Fungsi untuk membuka sidebar
    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.remove('hidden');
    }

    // Fungsi untuk menutup sidebar
    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
    }

    // Event listener untuk tombol toggle
    toggleSidebarBtn.addEventListener('click', () => {
        if (sidebar.classList.contains('-translate-x-full')) {
            openSidebar();
        } else {
            closeSidebar();
        }
    });

    // Event listener untuk overlay (menutup sidebar saat klik di luar)
    sidebarOverlay.addEventListener('click', closeSidebar);

    // Menutup sidebar saat ukuran layar berubah dari mobile ke desktop
    // Ini memastikan sidebar selalu terbuka di desktop jika itu adalah perilaku yang diinginkan
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) { // 768px adalah breakpoint default 'md' di Tailwind
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.add('hidden'); // Pastikan overlay tersembunyi di desktop
        }
    });

    const button = document.getElementById('menu-button');
    const dropdownMenu = document.getElementById('dropdown-menu');

    button.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden'); // Menambah/menghapus kelas 'hidden'
    });

    // Menutup dropdown jika klik di luar area dropdown
    document.addEventListener('click', (event) => {
        if (!button.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
        }
    });
});
