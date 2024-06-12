
// ====================================================== //
// ================= MASCARA TXT CEDULA ================= //
// ====================================================== //
/**
 * Asigna una mascara al campo de texto deacuerdo a lo seleccionado 
 * en el campo select
 */
function mascaraTxtID() {
    try {

        let selectOption = document.getElementById("cmd_TipoID_mNF").value;
        let txtCedula = $('#txt_CedulaFunc_mNF');

        if (selectOption == 'nacional') {
            txtCedula.inputmask('9-9999-9999');
        } else {
            txtCedula.inputmask('99-9999999999');
        }

    } catch (error) {

    }
}// /.mascaraTxtID 

// ====================================================== //
// =================== DOCUMENTO LISTO ================== //
// ====================================================== //
$(document).ready(function () {
    mascaraTxtID();


    // ##################################################################### //
    // ############################## EVENTOS ############################## //
    // ##################################################################### //


    // ====================================================== //
    // ================ CAMBIOS EN EL SELECT ================ //
    // ====================================================== //
    $('#cmd_TipoID_mNF').change(function () {
        mascaraTxtID();
    })// /. change


    // ~~~~ // -- txt_NombreFunc_mNF -- // ~~~ //
    document.getElementById("txt_NombreFunc_mNF").addEventListener("keydown", function (event) {
        let teclaPresionada = event.key;

        // Permitir teclas de control como Backspace, Delete, flechas, y espacio
        if (teclaPresionada === "Backspace" ||
            teclaPresionada === "ArrowLeft" ||
            teclaPresionada === "ArrowRight" ||
            teclaPresionada === "Delete" ||
            teclaPresionada === " " ||
            teclaPresionada === "Tab" || // Permitir Tabulación
            teclaPresionada === "Shift" ||
            teclaPresionada === "Control" ||
            teclaPresionada === "Meta") {
            return true;
        }

        // Validar si la tecla presionada es una letra, una vocal con tilde o un espacio
        let esLetraOespacio = /^[a-zA-ZáéíóúÁÉÍÓÚ0\s]$/.test(teclaPresionada);
        if (!esLetraOespacio) {
            event.preventDefault();
        }
    });

// ~~~~~~~~~~~ txt_userRed_mNF ~~~~~~~~~~~ //
    document.getElementById('txt_userRed_mNF').addEventListener('input', function (event) {
        let inputValue = event.target.value;
        let textoLimpio = inputValue.replace(/[^a-zA-Z]/g, '')
        event.target.value = textoLimpio;
    })


   // ~~~~~~~~~~ txt_CedulaFunc_mNF ~~~~~~~~~ //
    document.getElementById("txt_CedulaFunc_mNF").addEventListener("input", function (event) {
        let inputValue = event.target.value;
        let numeroError = document.getElementById("numeroError");

        // Eliminar cualquier carácter que no sea un número
        let numericValue = inputValue.replace(/\D/g, '');
        event.target.value = numericValue;

    });


})// /. fin ready