

// Alert Animation Functions
function closeAlert(alertId) {
    const alert = document.getElementById(alertId);
    if (alert) {
        alert.classList.add('animation-out-up');
        setTimeout(() => {
            alert.style.display = 'none';
            alert.classList.remove('animation-out-up');
        }, 300);
    }
}

// Optional: Auto close alert setelah beberapa detik
function autoCloseAlert(alertId, delay = 5000) {
    setTimeout(() => {
        closeAlert(alertId);
    }, delay);
}

// Make functions globally available
window.closeAlert = closeAlert;
window.autoCloseAlert = autoCloseAlert;
