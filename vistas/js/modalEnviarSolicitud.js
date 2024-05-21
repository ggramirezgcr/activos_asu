
var textoQR_mEA = "";

function valorDelQR(valor) {
    textoQR_mEA = valor;
}

// ====================================================== //
// ====================== DOM LISTO ===================== //
// ====================================================== //
document.addEventListener("DOMContentLoaded", function () {

    // ~~~~~~~~~~~~~~ VARIABLES ~~~~~~~~~~~~~~ //
    var txt_codigoBuscar = document.getElementById('txt_placaBuscar');

    // ~~~~~~~~~~~~ FIN VARIABLES ~~~~~~~~~~~~ //

    

    $('#modalEnviarPrestamo').on('shown.bs.modal', function () {

        //  Realizar alguna acción cuando el modal se esté cerrando  //
        $('#modalLeerQR').on('hide.bs.modal', function (e) {
            var textoQR = document.getElementById('txt_codigo_mLQ').value;

            if (textoQR !== null) {
                txt_codigoBuscar.value = textoQR;

                if (esSoloNumeros(textoQR) && textoQR) {
                    const btnBuscarActivo = document.getElementById("btnBuscarPlaca");
                    btnBuscarActivo.click();
                }
            }


        });/*/.acción cuando el modal se esté cerrando*/

        //  Restaurar scroll en el modal padre  //
        $('#modalLeerQR').on('hidden.bs.modal', function () {
            $('body').addClass('modal-open');
        });


        
    });

    $("#btnScanearQR_mES").on("click", function () {
       // debugger;
        if ($('#modalLeerQR').hasClass("show")) {
            alert("Modal Abierto");
        }else{
            //debugger;
            $('#modalLeerQR').css("z-index", "1050")
        }
    })







    /**
     * Verifica si una cadena de texto contiene solo números.
     * @param {string} cadena - La cadena de texto que se va a verificar.
     * @returns {boolean} - Devuelve true si la cadena contiene solo números, de lo contrario devuelve false.
     */
    function esSoloNumeros(cadena) {
        try {
            for (let index = 0; index < cadena.length; index++) {
                if (isNaN(cadena[index])) {
                    return false;
                }
            }
            return true

        } catch (error) {
            return false;
        }
    }


})