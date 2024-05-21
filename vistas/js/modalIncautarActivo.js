
// ====================================================== //
// ====================== DOM LISTO ===================== //
// ====================================================== //
document.addEventListener("DOMContentLoaded", function () {



    // ~~~~~~~~~~~~~~ VARIABLES ~~~~~~~~~~~~~~ //
    var txt_codigo_mEA = document.getElementById('txt_placaBuscar_mEA');
    const btnBuscarActivo = document.getElementById("btnBuscarActivo_mEA");
    let btnGuardar = document.getElementById("btnGuardarIncautamiento");
    // ~~~~~~~~~~~~ FIN VARIABLES ~~~~~~~~~~~~ //



    // ========================================================= //
    //  MANDA A LLAMAR MODAL LEER QR Y LLAMA AL BOTON DE BUSCAR //
    // ======================================================== //
    /**
     *  Se ejecuta solo si el modal es abierto
     */
    $("#modalIncautarActivo").on('shown.bs.modal', function () {

        //  Realizar alguna acción cuando el modal se esté cerrando  //
        $('#modalLeerQR').on('hide.bs.modal', function (e) {

            var textoQR = document.getElementById('txt_codigo_mLQ').value;
            debugger;
            if (textoQR !== null) {
                txt_codigo_mEA.value = textoQR;
                /*debugger;*/

                if (btnBuscarActivo !== null) {
                    btnBuscarActivo.click();
                }
            }
        });/*/.acción cuando el modal se esté cerrando*/


        //  Restaurar scroll en el modal padre  //
        $('#modalLeerQR').on('hidden.bs.modal', function () {
            $('body').addClass('modal-open');
        });

    });

    // ====================================================== //
    // == VERIFICAR DISPONIBILIDAD DE ACTIVO PARA INCAUTAR == //
    // ====================================================== //
 async function verificarDisponibilidad(codigoActivo) {
    try {
        let datos = new FormData();
        datos.append("codigoActivo", codigoActivo);
        datos.append("consultar", true);


        const respuesta = await fetch("ajax/incautarActivo.ajax.php", {
        method: "POST",
        body: datos,
        cache: "no-cache"
      });

        if (!respuesta.ok) {
            throw {ok:false, msg:"error 404"};
        }

        const data = await respuesta.json();
       console.log(data['0']['idea']);
        if (data['0']['idea'] == '0') {
            btnGuardar.removeAttribute("disabled");
        }else{
            $("#txt_codigoPlaca").val('')
            msj_toastr("", "El activo ya se encuentra cautivo.", 'w');
            btnGuardar.setAttribute("disabled", true);
        }

    } catch (error) {
        console.log(error);
    }
}


    /**
    // ====================================================== //
    //  Mandar a buscar la placa ingresada al darle en el boton //
    // ====================================================== //
     */
    $(document).on('click', '#btnBuscarActivo_mEA', async function () {
        /*debugger;*/
        let txt_placa = document.getElementById('txt_placaBuscar_mEA').value;
        txt_placa.replace(/['";\\]/g, '\\$&');// Escapar caracteres especiales que pueden ser utilizados en una inyección SQL

        if (txt_placa !== null && txt_placa !== '') {
            if (esSoloNumeros(txt_placa)) {
                // debugger;
                Buscar_activo(txt_placa, function (respuesta) {

                    //Limpiar campos
                    $("#txt_codigoPlaca_mEA").val("");
                    $("#idFunReceptor_mIA").val("");
                    $("#placa_mIA").val("");
                    $("#txt_Placa_mEA").val("");
                    $("#txt_Propietario_mEA").val("");
                    $('#txt_categoria_mEA').val("");
                    $('#txt_Marca_mEA').val("");

                    $('#txt_detalle_mEA').val("");
                    $('#txt_subCategoriaMCA').val("");

                    $('#txt_placaBuscarMCA').val("");


                    if (Object.keys(respuesta).length === 0) {
                        msj_toastr("Error", "No se encontro el activo.", 'e');
                    }

                    /*Mostrar datos*/
                    $("#txt_codigoPlaca_mEA").val(respuesta['id_activo']);
                    $("#idFunReceptor_mIA").val(respuesta['id_funcionario']);
                    $("#txt_Placa_mEA").val(respuesta["placa_activo"]);
                    $("#placa_mIA").val(respuesta['placa_activo']);
                    $("#txt_Propietario_mEA").val(respuesta['nombre_funcionario']);
                    $('#txt_categoria_mEA').val(respuesta["detalle_categoria"]);
                    $('#txt_Marca_mEA').val(respuesta["detalle_marca"]);

                    $('#txt_detalle_mEA').val(respuesta["descripcion_activo"]);
                    $('#txt_subCategoria_mEA').val(respuesta['detalle_subcategoria']);

                    $('#txt_placaBuscar_mEA').val("");

                    verificarDisponibilidad(respuesta['id_activo']);

                });
            } else {
                msj_toastr('Error', 'Debe ingresar un número de activo valido.', 'e');
            }
        } else {
            msj_toastr('Error', 'Debe ingresar un número de activo valido.', 'e');
        }
    });



    // ====================================================== //
    //  Verifica si una cadena de texto contiene solo números.  //
    // ====================================================== //
    /**
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