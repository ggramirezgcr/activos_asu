
<?php

require_once "../controladores/solicitudesRecibidas.controlador.php";
require_once "../modelos/solicitudesRecibidas.modelo.php";

class ajaxClsSolicitudesRecibidas
{

    // ====================================================== //
    // =================== ACEPTAR SOLICITUD================= //
    // ====================================================== //
    public $id_solicitud;
    public $respuesta;

    public function ajaxAceptarSolicitudRecibida()
    {

        $item2 = "id_sa";
        $valor2 = $this->id_solicitud;
        $item = "respta_receptor_Sa";
        if ($this->respuesta == 'aceptar') {
            $valor = "1";
        } elseif ($this->respuesta == 'rechazar') {
            $valor = "0";
        }

        $respuesta = ControladorSolicitudesRecibidas::ctrAceptarSolicitudesRecibidas($item, $valor, $item2, $valor2);

        echo json_encode($respuesta);
    }

    // ====================================================== //
    // =================== DEVOLVER ACTIVO  ================= //
    // ====================================================== //

    public function ajaxDevolverActivo($id_sa)
    {

        $item = "devuelto_Sa";
        $valor = "1";
        $item2 = "id_sa";
        $valor2 = $id_sa;

        $respuesta = ControladorSolicitudesRecibidas::ctrDevolverActivosRecibidos($item, $valor, $item2, $valor2);

        echo json_encode($respuesta);
    }







    // ~~~~~~~~~~~~~ FIN DE CLASE ~~~~~~~~~~~~ //
}

// ====================================================== //
// =================== ACEPTAR SOLICITUD================= //
// ====================================================== //
if (isset($_POST['id_sa'])) {
    if (isset($_POST['respuesta'])) {
       
        $aceptarSolicitud = new ajaxClsSolicitudesRecibidas();
        $aceptarSolicitud->id_solicitud = $_POST['id_sa'];
        $aceptarSolicitud->respuesta = $_POST['respuesta'];
        $aceptarSolicitud->ajaxAceptarSolicitudRecibida();
        
    }
}

if (isset($_POST['devolver_activo'])) {
    if (isset($_POST['id_sa'])) {
    
        $devolverActivo = new ajaxClsSolicitudesRecibidas();
        $devolverActivo->ajaxDevolverActivo($_POST['id_sa']);
    }
}
