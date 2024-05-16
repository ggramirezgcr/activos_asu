<?php 

require_once "../controladores/incautarActivo.controlador.php";
require_once "../modelos/incautarActivo.modelo.php";

class ajaxClsIncautarActivo
{
    /**
     * Verifica si el activo esta incautado
     *
     * @param [String] $valor
     * @return void
     */
    public function ajaxVerificarDisponibilidad($valor) {
        
        $respuesta = ControladorIncautarActivo::ctrVerificarDisponibilidad($valor);
        
        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }
} // /. fin de clase



if (isset($_POST['codigoActivo'])) {
    if (isset($_POST['consultar'])) {
        $activoEncautado = new ajaxClsIncautarActivo();
        $activoEncautado->ajaxVerificarDisponibilidad($_POST['codigoActivo']);
    }
}


