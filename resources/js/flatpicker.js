import 'flatpickr/dist/flatpickr.min.css';
import 'flatpickr/dist/themes/dark.css';
import flatpickr from 'flatpickr';

// Inisialisasi Flatpickr
document.addEventListener('DOMContentLoaded', function() {
    const datepickerElements = document.querySelectorAll('[data-datepicker]');

    datepickerElements.forEach(el => {
        const options = el.dataset.options ? JSON.parse(el.dataset.options) : {};
        flatpickr(el, options);
    });
});

function setRangeMinMaxDate(e, range, idEndDate) {
    const endDate         = document.getElementById(idEndDate);
    const startDateString = e.value;
    const startDate       = new Date(startDateString + 'T00:00:00');
    const maxDate         = startDate;
    flatpickr(endDate, {
        minDate: startDate,
        maxDate: maxDate.fp_incr(range)
    });
}

window.flatpickr = flatpickr;
window.setRangeMinMaxDate = setRangeMinMaxDate
