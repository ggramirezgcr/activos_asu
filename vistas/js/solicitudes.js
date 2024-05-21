
$(document).ready(function () {

// ====================================================== //
// ================ ELIMINAR SOLICITUD ================ //
// ====================================================== //
$(document).on('click', ".btnEliminarSolicitud", async function () {
    let idsolicitud = $(this).attr('idSolicitud');

    try {
        let usuario = await obtenerUsuarioLogueado();
        
        if (usuario !== null) {
            let idUsuario = usuario;

            Swal.fire({
                title: '¿Está seguro de eliminar la solicitud?',
                text: "Si no lo está puede cancelar la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar solicitud!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "index.php?ruta=solicitudesEnviadas&idsolicitud=" + idsolicitud + "&idUsuario=" + idUsuario;
                }
            });
        } else {
            console.log("No hay usuario en la sesión");
            msj_toastr("No hay usuario en la sesión", "", 'e');
        }
    } catch (error) {
        console.error("Error al obtener el usuario:", error);
    }
});


// ====================================================== //
// ================ OCULTAR SOLICITUD ================ //
// ====================================================== //
$(document).on('click', "#btnOcultarSolicitud", async function () {
    let idsolicitud = $(this).attr('idSolicitud');

    window.location = "index.php?ruta=solicitudesEnviadas&id_solOcultar=" + idsolicitud + "&ocultarSolicitud=true" ;
   
});

 });



 
 /**
  * Valida el formulario de nueva solicitud
  */
/* function validarFormulario() {


    // Obtener valores de los campos
    let nCodPlaca = document.getElementById('txt_codigoPlaca').value;
    let nCodReceptor = document.getElementById('idFunReceptor').value;
    let strObservaciones = document.getElementById('txt_Observaciones').value;
    let bolErrorCampo = false;

    // Realizar validaciones
    if (strObservaciones.length > 499) {
        toastr.error('La observación no puede superar los 500 caracteres.');
        bolErrorCampo = true;
    }

    if (nCodPlaca.trim() === '' ||
        nCodReceptor.trim() === ''
    ) {
        bolErrorCampo = true;
        toastr.error('Por favor, completa todos los campos correspondientes para poder continuar.');
    }

    if (bolErrorCampo) {
        return false; // La validación falla
    }

    // Si la validación pasa, puedes enviar el formulario
    return true;
}*/


