<?php

require_once "../controladores/activos.controlador.php";
require_once "../modelos/activos.modelo.php";

class ajaxClsActivos
{
    // ====================================================== //
    // =================== MOSTRAR PLACA =================== //
    // ====================================================== //
    public $strPlaca;

    public function ajaxMostrarPlaca()
    {

        $item = "placa_activo";
        $valor = $this->strPlaca;
        
        $respuesta = ControladorActivos::ctrMostrarActivos($item, $valor);
        header('Content-Type: text/plain');

        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }



    

    // ====================================================== //
    // =================== ACTIVO EN PRESTAMO================ //
    // ====================================================== //
    public $nCodActivo;

    public function ajaxActivoEnPrestamo()
    {
        $item = 'id_activo';
        $valor = $this->nCodActivo;
        $item2 = 'devuelto_sa';
        $valor2 = '1';

        $respuesta = ControladorActivos::ctrActivoEnPrestamo($item, $valor, $item2, $valor2);
        header('Content-Type: text/plain');

        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }




    function ajaxTotalActivosXcat($valor, $xSolicitudes)
    {
        $respuesta = ControladorActivos::ctrTotalActivosXcat($valor, $xSolicitudes);
        header('Content-Type: text/plain');
        
        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }


    // ====================================================== //
    // ================== IMAGEN DEL ACTIVO ================= //
    // ====================================================== //
    function ajaxImagenActivo($valor)
    {
        $respuesta = ControladorActivos::ctrImagenActivo($valor);

        if ($respuesta) {
            // Establecer el tipo de contenido como imagen JPEG
            $url_datos = $respuesta[0]['img_modelo'];
        
            header('Content-Type: image/jpeg');
           
            echo base64_encode($url_datos);

        } else {

            echo '';
        }
    }






    // ~ // ---------- FIN CLASE --------- //  //
}



// ====================================================== //
// =================== MOSTRAR PLACA =================== //
// ====================================================== //
if (isset($_POST['strPlacaBuscar'])) {
    $placaBuscar = new ajaxClsActivos();
    $placaBuscar->strPlaca = $_POST['strPlacaBuscar'];
    $placaBuscar->ajaxMostrarPlaca();
}


// ====================================================== //
// =================== ACTIVO EN PRESTAMO================ //
// ====================================================== //
if (isset($_POST['idActivo'])) {
    $activoPrestado = new ajaxClsActivos();
    $activoPrestado->nCodActivo = $_POST['idActivo'];
    $activoPrestado->ajaxActivoEnPrestamo();
}

// ====================================================== //
// ============== TOTAL ACTIVOS X CATEGORIA ============= //
// ====================================================== //
if (isset($_POST['totalActivosXcat'])) {
    if (isset($_POST['id'])) {
        $activosXcat = new ajaxClsActivos();

        $activosXcat->ajaxTotalActivosXcat($_POST['id'], false);
    }
}

// ====================================================== //
// ============== TOTAL ACTIVOS X SOLICITUDES ============= //
// ====================================================== //
if (isset($_POST['totalActivosXsol'])) {
    if (isset($_POST['id'])) {
        $activosXcat = new ajaxClsActivos();
        $activosXcat->ajaxTotalActivosXcat($_POST['id'], true);
    }
}



// ====================================================== //
// =================== MOSTRAR PLACA =================== //
// ====================================================== //
if (isset($_POST['datosDelActivo'])) {
    if ($_POST['placaActivo']) {
        $placaBuscar = new ajaxClsActivos();

        $placaBuscar->ajaxImagenActivo($_POST['placaActivo']);
    }
}


// ====================================================== //
// ================== CONSULTAR ACTIVO ================== //
// ====================================================== //
if (isset($_POST["placa"])) {
    if (isset($_POST["consultar"])) {
        $activo = new ajaxClsActivos();
        $activo->strPlaca = $_POST["placa"];
        $activo->ajaxMostrarPlaca();
    }
}