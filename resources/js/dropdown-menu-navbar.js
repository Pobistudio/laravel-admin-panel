document.addEventListener('DOMContentLoaded', function () {

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
