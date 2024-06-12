<?php
require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";
require_once "../controladores/sanitizar.controlador.php";


class ajaxClsMarca
{

    // ====================================================== //
    // ============== LISTADO DE MARCAS POR SSP ============= //
    // ====================================================== //
    /**
     * Carga las marcas registradas en el sistema el cual es un json
     * es llamado desde el datatable cuando se carga
     *
     * @return void
     */
    public function ajaxListadoMarcas_ssp()
    {
        $respuesta = ControladorMarcas::ctrDatosMarcas_sside();

        echo json_encode($respuesta);
    }


    // ====================================================== //
    // ===================== NUEVA MARCA ==================== //
    // ====================================================== //
    public function ajaxNuevaMarca()
    {

        $item = 'detalle_marca';
        $valor = ControladorSanitizar::sanitizarCadena($_POST['marca']);

        $respuesta = ControladorMarcas::ctrNuevaMarca($item, $valor);

        echo json_encode($respuesta);
    }


    // ====================================================== //
    // =================== ELIMINAR MARCA =================== //
    // ====================================================== //
    public function ajaxEliminarMarca()
    {

        $item = '';
        $valor = $_POST['valor'];

        $respuesta = ControladorMarcas::ctrEliminarMarca($item, $valor);

        echo json_encode($respuesta);
    }

    // ====================================================== //
    // ==================== EDITAR MARCA ==================== //
    // ====================================================== //
    public function ajaxEditarMarca()
    {
        if (!is_null($_POST['id'])) {
            $id = ControladorSanitizar::sanitizarCadena($_POST['id']);
        }else {
            return json_encode('incompleto');
        }

        if (!is_null($_POST['marca'])) {
            $marca = ControladorSanitizar::sanitizarCadena($_POST['marca']);   
        }else {
            return json_encode('incompleto');
        }

        if (!is_null($_POST['marcaEditada'])) {
            $editada = ControladorSanitizar::sanitizarCadena($_POST['marcaEditada']);    
        }else {
            return json_encode('incompleto');
        }

        $datos = array(
            'idmarca' => $id,
            'marca'   => $marca,
            'editada' => $editada
        );

        $respuesta = ControladorMarcas::ctrEditarMarca($datos);

        echo json_encode($respuesta);
    }
    
} // /.ajaxClsMarca



// ##################################################################### //
// ############################### RUTAS ############################### //
// ##################################################################### //

// ====================================================== //
// ============= CARGAR MARCAS (SERVER SIDE ) =========== //
// ====================================================== //
/*if (isset($_GET['accion'])) {
    if ($_GET['accion'] == 'obtenerMarcas_sside') {
        $marcas = new ajaxClsMarca();
        $marcas->ajaxListadoMarcas_ssp();
    }
}*/


if (isset($_GET['accion'])) {
    if ($_GET['accion'] == 'obtenerMarcas_sside') {
        $marcas = new ControladorMarcas();
        $marcas->ctrDatosMarcas_sside();
    }
}


// ====================================================== //
// ===================== NUEVA MARCA ==================== //
// ====================================================== //
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'nuevaMarca') {
        $nuevaMarca = new ajaxClsMarca();
        $nuevaMarca->ajaxNuevaMarca();
    }
}

// ====================================================== //
// =================== ELIMINAR MARCA =================== //
// ====================================================== //
if (isset($_POST['accion']) && $_POST['accion'] == 'eliminarMarca') {
    if (isset($_POST['valor']) && $_POST['valor'] !== null) {
        $eliminarMarca = new ajaxClsMarca();
        $eliminarMarca->ajaxEliminarMarca();
    }
}

// ====================================================== //
// ==================== EDITAR MARCA ==================== //
// ====================================================== //
if (isset($_POST['accion']) && $_POST['accion'] == 'editarMarca') {
    if (isset($_POST['marca']) && isset($_POST['id'])) {
        $editarMarca = new ajaxClsMarca();
        $editarMarca->ajaxEditarMarca();
    }
}
