
<?php


require_once "../controladores/solicitudes.controlador.php";
require_once "../modelos/solicitudes.modelo.php";

class ajaxClsSolicitudDevueltas{

    public function ajaxActivosDevueltosXFecha($valor, $valor2, $valor3) {
        
           
        $respuesta = ControladorSolicitudes::ctrSolicitudesEnviadasXfecha($valor, $valor2, $valor3);

        echo json_encode($respuesta);


    }


}

// ====================================================== //
// ========= FILTRAR POR FECHA ACTIVOS DEVUELTOS ======== //
// ====================================================== //
if (isset($_POST['fechaInicio'])) {
    $activosDevueltos = new ajaxClsSolicitudDevueltas();
    $activosDevueltos->ajaxActivosDevueltosXFecha($_POST['fechaInicio'], $_POST['fechaFin'], $_POST['iduser'] );  
}