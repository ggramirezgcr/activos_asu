
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
                ControladorHelpers::ctrProceso_envioCorreo($datosEmail, 'ACEPTO EL ACTIVO INCAUTADO', 'Han aceptado la devolución  del activo incautado.', '', 'a');
            }else {
                ControladorHelpers::ctrProceso_envioCorreo($datosEmail, 'RECHAZO DE DEVOLUCION ACTIVO INCAUTADO', 'Han rechazado el activo incautado que fue devuelto .', '', 'e');
            }
        }


        return $respuesta;
    }
}
