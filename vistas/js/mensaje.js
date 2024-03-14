$(document).ready(function () {});

    /**
     * Muestra un mensaje en pantalla al usuario, el mensaje es con la libreria toastr
     * @param {Titulo del mensaje} strTitulo 
     * @param {Cuerpo del mensaje} strMensaje 
     * @param {Tipo de msj} tipoMsj 
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
            "showDuration": "300",
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




