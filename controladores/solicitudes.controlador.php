<?php

require_once "msj.controlador.php";


class ControladorSolicitudes
{

    // ====================================================== //
    // ================== SOLICITUDES ENVIADAS=============== //
    // ====================================================== //

    public static function ctrSolicitudesEnviadas($item, $valor, $item2, $valor2)
    {
        $tabla = "solicitudes_activos";

        $respuesta = ModeloSolicitud::mdlSolicitudesEnviadas($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;
    }


    // ====================================================== //
    // ============= VALIDAR DATOS               ============ //
    // ====================================================== //
    /**
     * Valida los datos que se van a guardar de la nueva solucitud
     *
     * @return void
     */
    static public function ctrValidarDatosNuevaSolicitud()
    {


        #Si viene el boton
        if (isset($_POST['submitGuardarSolicitud'])) {

            #Validar valores

            if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['txt_codigoPlaca'])) {
                $errores[] = "Error en los campos";
            }

            if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['iduser'])) {
                $errores[] = "Error en los campos";
            }
            if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['idFunReceptor'])) {
                $errores[] = "Error en los campos";
            }
            if (!isset($_POST['txt_Observaciones']) && !preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['txt_Observaciones'])) {
                $errores[] = "Error en los campos";
            }

            if (empty($errores)) {
                return true;
            } else {
                return false;
            }
        }
    }

    // ====================================================== //
    // ================== NUEVA SOLICITUD  ================== //
    // ====================================================== //
    public static function ctrNuevaSolicitudActivo()
    {
        if (isset($_POST['submitGuardarSolicitud'])) {


            $tabla = 'solicitudes_activos';
            $datos = array(
                'activo' => $_POST['txt_codigoPlaca'],
                'emisor' => $_POST['iduser'],
                'receptor' => $_POST['idFunReceptor'],
                'detalle' => $_POST['txt_Observaciones'],
            );

            $respuesta = ModeloSolicitud::mdlNuevaSolicitud($tabla, $datos);

            if ($respuesta == 'ok') {
                $body = new ControladorHelpers();
                
                //Imagen
                if ($_SESSION['nombre'] !== null) {
                    $imagen = "https://localhost/Activos-ASU/" . $_SESSION['foto'];
                } else {
                    $imagen = "https://localhost/Activos-ASU/" . "vistas/img/usuario/default/profile.png"; // Corrección en la ruta de la imagen
                }
                 //Nombre
                 $nombre = $_SESSION['nombre'];
                 $placa = $_POST['txt_placaActivo_mES'];
                 $id = $_POST['idFunReceptor'];

                $body = new ControladorHelpers();
             $html =  $body->ctrhtmlPendientes($nombre, $imagen, 'TE HAN PRESTADO UN ACTIVO',$placa);
            ControladorEmail::ctrEnviarEmail('Te han prestado un activo','', $html, $id);

                ControladorMensajes::msj_sweetalert('', '¡Registro exitoso!', 's', 'window.location = "solicitudesEnviadas";');
            } else {

                ControladorMensajes::msj_sweetalert('Error', '¡Error al intentar registrar los datos!', 'e', 'window.location = "solicitudesEnviadas";');
            }
        }
    }


    // ====================================================== //
    // ================== ELIMINAR SOLICITUD  =============== //
    // ====================================================== //
    public static function ctrEliminarSolicitud()
    {

        if (isset($_GET['idsolicitud'])) {
            $tabla = 'solicitudes_activos';
            $valor = $_GET['idsolicitud'];

            $respuesta = ModeloSolicitud::mdlEliminarSolicitud($tabla, $valor);

            if ($respuesta == 'ok') {
                ControladorMensajes::msj_Swal("¡Solicitud eliminada!", "La solicitud se elimino.", "s", 'window.location = "solicitudesEnviadas";');
            } else {
            }
        }
    }

    // ====================================================== //
    // ================== OCULTAR SOLICITUD  ================ //
    // ====================================================== //
    public static function ctrOcultarSolicitud()
    {
        if (isset($_GET['id_solOcultar'])) {

            if (isset($_GET['ocultarSolicitud'])) {

                $tabla = "solicitudes_activos";
                $item = "id_sa";
                $valor = $_GET['id_solOcultar'];

                $respuesta = ModeloSolicitud::mdlOcultarSolicitud($tabla, $item, $valor);

                if ($respuesta == 'ok') {
                    ControladorMensajes::msj_Swal("", "La solicitud se ha ocultado satisfactoriamente.", "s", 'window.location = "solicitudesEnviadas";');
                }
            }
        }
    }




     // ====================================================== //
    // ================== SOLICITUDES ENVIADAS X FECHA======== //
    // ====================================================== //

    public static function ctrSolicitudesEnviadasXfecha($valor, $valor2, $valor3)
    {
        $tabla = "solicitudes_activos";       
        $item = "fecha_crea_sa";
        $item2 = "fecha_crea_sa";    
           
            $respuesta = ModeloSolicitud::mdlSolicitudesEnviadasXfecha($tabla, $item, $valor, $item2, $valor2, $valor3);
    
        return $respuesta;


    }



    //-------------------fin------------------------------
}
