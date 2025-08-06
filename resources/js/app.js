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
        if (sidebar && sidebarOverlay) {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        }
    }

    // Fungsi untuk menutup sidebar
    function closeSidebar() {
        if (sidebar && sidebarOverlay) {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        }
    }

    // Event listener untuk tombol toggle
    if (toggleSidebarBtn && sidebar) {
        toggleSidebarBtn.addEventListener('click', () => {
            if (sidebar.classList.contains('-translate-x-full')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });
    }

    // Event listener untuk overlay (menutup sidebar saat klik di luar)
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    // Menutup sidebar saat ukuran layar berubah dari mobile ke desktop
    // Ini memastikan sidebar selalu terbuka di desktop jika itu adalah perilaku yang diinginkan
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) { // 768px adalah breakpoint default 'md' di Tailwind
            if (sidebar && sidebarOverlay) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden'); // Pastikan overlay tersembunyi di desktop
            }
        }
    });

    const menuButton = document.getElementById('menu-button');
    const dropdownMenu = document.getElementById('dropdown-menu');

    if (menuButton && dropdownMenu) {
        menuButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden'); // Menambah/menghapus kelas 'hidden'
            const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
            menuButton.setAttribute('aria-expanded', !isExpanded);
        });
    }

    // Opsional: Sembunyikan dropdown jika klik di luar area
    document.addEventListener('click', (event) => {
        if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
            menuButton.setAttribute('aria-expanded', 'false');
        }
    });
});
