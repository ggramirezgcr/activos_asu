
<?php

class ControladormisActivosIncautados
{

    // ====================================================== //
    // =============== MIS ACTIVOS INCAUTADOS =============== //
    // ====================================================== //
    static public function mdlmisActivosIncautados($item, $valor)
    {
        try {

            $tabla = 'incautar_activos';
           
            $respuesta = ModelomisActivosIncautados::mdlmisActivosIncautados($tabla, $item, $valor);

            return $respuesta;

        } catch (error $e) {
            return null;
        }
    }


    static public function ctrRespuestaIncautamiento($datos) {
        $tabla = "incautar_activo";

        $respuesta = ModelomisActivosIncautados::mdlRespuestaIncautamiento($tabla, $datos);

        return $respuesta;
    }
}
