<?php


class ControladorActivos
{

    // ====================================================== //
    // ================= MOSTRAR ACTIVO ===================== //
    // ====================================================== //
    static public function ctrMostrarActivos($item, $valor, $all = false)
    {
        $tabla = "activo";

        $respuesta = ModeloActivos::mdlMostrarActivos($tabla, $item, $valor, $all);

        return $respuesta;
    }

    // ====================================================== //
    // ================= ACTIVO EN PRESTAMO================== //
    // ====================================================== //
    static public function ctrActivoEnPrestamo($item, $valor, $item2, $valor2)
    {
        $tabla = "solicitudes_activos";

        $respuesta = ModeloActivos::mdlActivoEnPrestamo($tabla, $item, $valor, $item2, $valor2);

        return $respuesta;
    }


    // ====================================================== //
    // =================== TOTALES TABLERO ================== //
    // ====================================================== //
    public static function ctrTotalesTablero($valor)
    {

        $respuesta = ModeloActivos::mdlTotales_tablero($valor);
        return $respuesta;
    }


    // ====================================================== //
    // ============== TOTAL ACTIVOS X CATEGORIA ============= //
    // ====================================================== //
    public static function ctrTotalActivosXcat($valor, $xSolicitud)
    {
        if ($xSolicitud) {

            $respuesta = ModeloActivos::mdlTotalesActivosXSolic($valor);
        } else {

            $respuesta = ModeloActivos::mdlTotalesActivosXcat($valor);
        }
        return $respuesta;
    }



    // ====================================================== //
    // ================== IMAGEN DEL ACTIVO ================= //
    // ====================================================== //
    public static function ctrImagenActivo($valor)
    {

        $respuesta = ModeloActivos::mdlImagenActivo($valor);
        return $respuesta;
    }






}
