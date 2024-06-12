$(document).ready(function () { });

/**
 * Muestra un mensaje en pantalla al usuario, el mensaje es con la libreria toastr
 * @param {Titulo del mensaje} strTitulo 
 * @param {Cuerpo del mensaje} strMensaje 
 * @param {Tipo de msj} tipoMsj s:succes, e:error, i:info, w:warning 
 */
function msj_toastr(strTitulo, strMensaje, tipoMsj) {

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "600",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };


    switch (tipoMsj) {
        case 's':
            toastr["success"](strMensaje, strTitulo);
            break;
        case 'e':
            toastr["error"](strMensaje, strTitulo);
            break;
        case 'i':
            toastr["info"](strMensaje, strTitulo);
            break;
        case 'w':
            toastr["warning"](strMensaje, strTitulo);
            break;

        default:
            break;
    }



}



function msj_sweetalert_retorno(title, msj) {

    return new Promise((resolve, reject) => {

        Swal.fire({
            title: title,
            text: msj,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                resolve(true);
            } else {
                resolve(false);
            }
        });

    });

}

/**
 * 
 * @param {string} $title Titulo del mensaje
 * @param {string} $msj Cuerpo del mensaje
 * @param {string} $type e:Error/ s:succes/ w:warnning/ i:info/ d:delete (tiene confirmacion)
 * @param {string} $value Puede ser un window.load
 */
function msj_sweetalert(title, msj, type, value) {


    switch (type) {

        case 'e':

            Swal.fire({
                icon: "error",
                title: title,
                text: msj,
                confirmButtonText: "¡Cerrar!"
            }).then((result) => {
                if (result.value) {
                    value
                }
            });

            break;

        case 's':

            Swal.fire({
                icon: "success",
                title: title,
                text: msj,
                confirmButtonText: "Aceptar"
            }).then((result) => {
                if (result.value) {
                    value
                }
            });

            break;

        case 'i':

            Swal.fire({
                icon: "info",
                title: title,
                text: msj,
                confirmButtonText: "Aceptar"
            }).then((result) => {
                if (result.value) {
                    value
                }
            });

            break;

        case 'w':

            Swal.fire({
                icon: "warning",
                title: title,
                text: msj,
                confirmButtonText: "Aceptar"
            }).then((result) => {
                if (result.value) {
                    value
                }
            });

            break;


    }

    return 'ok';
}







