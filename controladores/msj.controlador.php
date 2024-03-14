<?php


class ControladorMensajes
{

    /**
     * Muestra en pantalla el mensaje de sweetalert al usuario
     *
     * @param [] $title
     * @param [type] $msj
     * @param [type] $type : [e=error, i=Info, w=warning, s=success] $tipo
     * @param [type] $value : Es lo que va de acuerdo a al mensaje de aceptar o cancelar
     * @return void
     */
    public static function msj_sweetalert($title, $msj, $type, $value)
    {
        

        switch ($type) {
            
            case 'e':


                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "' . $title . '",
                    text: "' . $msj . '",
                }).then((result) => {
                    if (result.value) {
                        ' . $value . ';
                    }
                });
            </script>';

                break;

            case 's':

                echo '<script>
                Swal.fire({
                    icon: "success",
                    text: "' . $msj . '"
                }).then((result) => {
                    if (result.value) {
                        ' . $value . '
                    }
                });
            </script>';

                break;

            case 'w':

                break;

            case 'i':

                break;

            default:
                break;
        }
    }


    /**
     * Muestra un mensage del tipo toastr
     *
     * @param [text] $title
     * @param [type] $text
     * @param [type] $type
     * @param [type] $value
     * @return void
     */
    public static function msj_Swal($title, $msj, $type, $value)
    {
        switch ($type) {
            case "s":

                echo '<script>
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
                }
    
            toastr["success"]("' . $msj . '.", "' . $title . '.")
    
            ' . $value . '
            </script>';

                break;

            default:
                break;
        }
    }
}
