function togglePassword(name) {
    const input  = document.querySelector('input[name="'+name+'"]');
    const openEye = document.getElementById(name+'_open_eye');
    const closeEye = document.getElementById(name+'_close_eye');

    if (input.type === "password") {
        input.type = 'text';
    } else {
        input.type = 'password';
    }

    openEye.classList.toggle('hidden');
    closeEye.classList.toggle('hidden');
}

window.togglePassword = togglePassword;
