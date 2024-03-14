<?php

require_once "msj.controlador.php";

class ControladorSolicitudesRecibidas
{



    // ====================================================== //
    // ================== SOLICITUDES ENVIADAS=============== //
    // ====================================================== //

    public static function ctrMiSolicitudesRecibidas($item, $valor, $item2, $valor2)
    {
        $tabla = "solicitudes_activos";

        $respuesta = ModeloSolicitudesRecibidas::mdlMiSolicitudesRecibidas($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;
    }

    // ====================================================== //
    // ================== ACEPTAR SOLICITUDES RECIBIDAS======= //
    // ====================================================== //

    public static function ctrAceptarSolicitudesRecibidas($item, $valor, $item2, $valor2)
    {
        $tabla = "solicitudes_activos";
        $respuesta = "";

        if (isset($item) && isset($valor) && isset($item2) && isset($valor2)) {
            if (strlen($item) > 0 && strlen($valor) > 0 && strlen($item2) > 0 && strlen($valor2) > 0) {
               
                $respuesta = ModeloSolicitudesRecibidas::mdlAceptarSolicitudRecibida($tabla, $item, $valor, $item2, $valor2);
            }
        }

        return $respuesta;
        
    }


    // ====================================================== //
    // ================== DEVOLVER ACTIVOS ================== //
    // ====================================================== //

    public static function ctrDevolverActivosRecibidos($item, $valor, $item2, $valor2)
    {
        $tabla = "solicitudes_activos";

        $respuesta = ModeloSolicitudesRecibidas::mdlDevolverActivoRecibido($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;
    }
}
