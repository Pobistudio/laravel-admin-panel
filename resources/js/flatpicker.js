import 'flatpickr/dist/flatpickr.min.css';
import flatpickr from 'flatpickr';

// Inisialisasi Flatpickr
document.addEventListener('DOMContentLoaded', function() {
    const datepickerElements = document.querySelectorAll('[data-datepicker]');

    datepickerElements.forEach(el => {
        const options = el.dataset.options ? JSON.parse(el.dataset.options) : {};
        flatpickr(el, options);
    });
});

window.flatpickr = flatpickr;
