import TomSelect from 'tom-select';

document.addEventListener('DOMContentLoaded', function () {
    const selectElements = document.querySelectorAll('[data-select]');

    selectElements.forEach(el => {
        // const options = el.dataset.options ? JSON.parse(el.dataset.options) : {};
        new TomSelect(el,{
            create: true, // Opsional: memungkinkan user membuat opsi baru
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    });
});
