

document.addEventListener('DOMContentLoaded', function () {
    
    function validarEmail() {
        const emailInput = document.getElementById('nuevoEmail');
        const email = emailInput.value;
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!regex.test(email)) {
            msj_toastr('Error', 'Debe ingresar un correo electrónico válido.', 'e');
            emailInput.focus();
            return false;
        }
        return true;
    }


})