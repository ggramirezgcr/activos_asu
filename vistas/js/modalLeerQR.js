
// ====================================================== //
// ====================== DOM LISTO ===================== //
// ====================================================== //
document.addEventListener("DOMContentLoaded", function () {

    // ~~~~~~~~~~~~~~ VARIABLES ~~~~~~~~~~~~~~ //
    let txt_codigoQR = document.getElementById('txt_codigo_mLQ');
    let btnIniciarCamara = document.getElementById("btnIniciarCamara_mLQ");
    let btnDetenerCamara = document.getElementById("btnDetenerCamara_mLQ");
    let audioScanner = document.getElementById("audio_scaner_mLQ");
    const canvas = document.getElementById('canvas_mLQ');
    const video = document.getElementById('videoElement_mLQ');
    // ~~~~~~~~~~~~ FIN VARIABLES ~~~~~~~~~~~~ //


    /**
    * Esta función se ejecuta cuando el documento HTML ha sido completamente cargado y analizado, y se está listo para interactuar con el DOM.
    */
    $(document).ready(function () {
        try {
            /**
                     * Maneja el evento 'shown.bs.modal' del modal #modalLeerQR. Se ejecuta después de que el modal se haya mostrado completamente.
                     * @param {Event} event - El objeto evento asociado al evento 'shown.bs.modal'.
                     */
            $("#modalLeerQR").on('shown.bs.modal', async function (event) {
                event.preventDefault(); // Evita que el formulario se envíe y recargue la página

                btnIniciarCamara.disabled = true;
                btnDetenerCamara.disabled = false;

                let codigo = await startCamera(canvas, video, valorDelQR);
                if (codigo !== null) {
                    audioScanner.play();
                    /*       debugger;*/
                    txt_codigoQR.textContent = codigo;
                    txt_codigoQR.value = codigo;
                    $("#modalLeerQR").modal('hide');
                }

            });
        } catch (error) {

        }
    });/*/. ready*/


    //Escuchar el evento cuando se cierra el modal
    $('#modalLeerQR').on('hide.bs.modal', function (e) {
        stopCamera(video);
    });


    // ====================================================== //
    // ============== INICIAR O DETENER CAMARA ============== //
    // ====================================================== //
    if (btnIniciarCamara !== null || btnDetenerCamara !== null) {

        // ~~~~~~~~~~~~ INICIAR CAMARA ~~~~~~~~~~~ //
        btnIniciarCamara.addEventListener('click', function () {
            btnIniciarCamara.disabled = true;
            btnDetenerCamara.disabled = false;
            startCamera(canvas, video);
        }) /*/. iniciar camara*/

        // ~~~~~~~~~~~~ DETENER CAMARA ~~~~~~~~~~~ //
        btnDetenerCamara.addEventListener('click', function () {
            btnIniciarCamara.disabled = false;
            btnDetenerCamara.disabled = true;
            stopCamera(video);

        })/*/. detener camara*/
    }



})