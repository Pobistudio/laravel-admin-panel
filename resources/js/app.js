import './bootstrap';

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
});
