
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('registro_exitoso')) {
        alert('Usuario correctamente registrado');
    }
});
