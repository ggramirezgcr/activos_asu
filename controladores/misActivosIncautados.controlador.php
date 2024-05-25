
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


    static public function ctrRespuestaIncautamiento($datos, $datosEmail)
    {
        $tabla = "incautar_activo";

        $respuesta = ModelomisActivosIncautados::mdlRespuestaIncautamiento($tabla, $datos);

        //enviar email
        if ($respuesta == 'ok') {
            if ($datos['respuesta'] == '1') {
                ControladorHelpers::ctrProceso_envioCorreo($datosEmail, 'ACEPTO LA DEVOLUCION DEL ACTIVO CONFISCADO', 'Han aceptado la devolución del activo confiscado.', '', 'a');
            }else {
                ControladorHelpers::ctrProceso_envioCorreo($datosEmail, 'RECHAZO LA DEVOLUCION DEL ACTIVO CONFISCADO', 'Han rechazado el activo confiscado que fue devuelto.', '', 'e');
            }
        }


        return $respuesta;
    }
}
