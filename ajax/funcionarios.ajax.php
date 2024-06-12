<?php

require_once "../controladores/sanitizar.controlador.php";
require_once "../controladores/funcionario.controlador.php";
require_once "../modelos/funcionarios.modelo.php";
require_once "../controladores/activos.controlador.php";
require_once "../modelos/activos.modelo.php";
require_once "../controladores/solicitudesRecibidas.controlador.php";
require_once "../modelos/solicitudesRecibidas.modelo.php";



class ajaxClsFuncionario
{


    public function ajaxDatosFun_ssidep()
    {

        $respuesta = ControladorFuncionarios::ctrDatosFun_sside();
    }

    // ====================================================== //
    // ================ DATOS DEL FUNCIONARIO ============== //
    // ====================================================== //

    public function ajaxDatosFuncionario($valor)
    {
        $item = "id_funcionario";

        $respuesta = ControladorFuncionarios::ctrMostrarFuncionarios($item, $valor);

        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }

    // ====================================================== //
    // ================ OBTENER USUARIO DE RED ============== //
    // ====================================================== //
    public $idFuncionario;

    public function ajaxObtenerUsuarioRed()
    {
        $item = "id_funcionario";
        $valor = $this->idFuncionario;

        $respuesta = ControladorFuncionarios::ctrMostrarFuncionarios($item, $valor);

        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }


    // ====================================================== //
    // ================ FILTRAR FUNCIONARIOS  ============== //
    // ====================================================== //

    public $strPalabraClave;


    public function ajaxFiltrarFuncionarios()
    {
        $item = "";
        $valor = "";

        $respuesta = ControladorFuncionarios::ctrMostrarFuncionarios($item, $valor, true);

        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }


    // ====================================================== //
    // ============= OBTENER TODOS FUNCIONARIOS ============= //
    // ====================================================== //
    public function ajaxTodosFuncionarios()
    {
        $item = "";
        $valor = "";

        $respuesta = ControladorFuncionarios::ctrMostrarFuncionarios($item, $valor, false);

        if ($respuesta) {
            foreach ($respuesta as $key => $value) {
                $data = [
                    "id" => $value['id_funcionario'],
                    'cedula' => $value['cedula_funcionario'],
                    'nombre' => $value['nombre_funcionario'],
                    'usuario' => $value['usuario_red_funcionario']
                ];
            }
        }

        echo json_encode($data, JSON_FORCE_OBJECT);
    }


    // ====================================================== //
    // ================ ELIMINAR FUNCIONARIO ================ //
    // ====================================================== //
    public function ajaxEliminarFuncionario()
    {
        $item = 'id_funcionario';
        $valor = $_POST['idfun'];


        $respuesta = ControladorFuncionarios::ctrEliminarFuncionario($item, $valor);

        echo json_encode($respuesta);
    }

    // ====================================================== //
    // =============== INHABILITAR FUNCIONARIO =============== //
    // ====================================================== //
    public function ajaxCambiarEstadoFuncionario()
    {
        $item1 = 'estado_funcionario';
        $valor1 = $_POST['estado'] == 'true' ? 1 : 0;
        $item2 = 'id_funcionario';
        $valor2 = ControladorSanitizar::sanitizarCadena($_POST['idfun']);


        $respuesta = ControladorFuncionarios::ctrCambiarEstadoFuncionario($item1, $valor1, $item2, $valor2);

        echo json_encode($respuesta);

    } // /. ajaxCambiarEstadoFuncionario







    // ~~~~~~~~~~~~~~ FIN CLASE ~~~~~~~~~~~~~~ //
}


// ##################################################################### //
// ############################### RUTAS ############################### //
// ##################################################################### //

// ====================================================== //
// ================ OBTENER USUARIO DE RED ============== //
// ====================================================== //
if (isset($_POST["idFuncionario"])) {
    $obtenerUsuarioRed = new ajaxClsFuncionario();
    $obtenerUsuarioRed->idFuncionario = $_POST['idFuncionario'];
    $obtenerUsuarioRed->ajaxObtenerUsuarioRed();
}


// ====================================================== //
// ================ FILTRAR FUNCIONARIOS  ============== //
// ====================================================== //
if (isset($_POST['palabraClave'])) {
    $filtrarFuncionarios = new ajaxClsFuncionario();
    $filtrarFuncionarios->strPalabraClave = $_POST[''];
    $filtrarFuncionarios->ajaxFiltrarFuncionarios();
}


// ====================================================== //
// ================ DATOS DEL FUNCIONARIO =============== //
// ====================================================== //
if (isset($_POST["idFun"])) {
    if (isset($_POST['datosFuncionarios'])) {
        $datosFuncionario = new ajaxClsFuncionario();
        $datosFuncionario->ajaxDatosFuncionario($_POST['idFun']);
    }
}

// ====================================================== //
// ========= TODOS LOS FUNCIONARIOS SERVER SIDE ========= //
// ====================================================== //
if (isset($_GET['accion']) && $_GET['accion'] == 'obtenerFuncionarios') {
    $funcionarios = new ajaxClsFuncionario();
    $funcionarios->ajaxTodosFuncionarios();
}



if (isset($_GET['accion']) && $_GET['accion'] == 'obtenerFuncionarios_ssidep') {
    $controller = new ControladorFuncionarios();
    // $controller->obtenerDatos();
    $controller->ctrDatosFun_sside();
}


// ====================================================== //
// ================ ELIMINAR FUNCIONARIO ================ //
// ====================================================== //
if (isset($_POST['idfun']) && isset($_POST['eliminarFuncionario'])) {
   if ($_POST['eliminarFuncionario'] == true) {
       $eliminar = new ajaxClsFuncionario();
       $eliminar->ajaxEliminarFuncionario();
   }
}


// ====================================================== //
// ============= CAMBIAR ESTADO FUNCIONARIO ============= //
// ====================================================== //
if (isset($_POST['inhabilitarFuncionario']) && isset($_POST['idfun']) && isset($_POST['estado'])) {
   $inhabilitar = new ajaxClsFuncionario();
   $inhabilitar->ajaxCambiarEstadoFuncionario();
}

if (isset($_POST['habilitarFuncionario']) && isset($_POST['idfun']) && isset($_POST['estado'])) {
   $inhabilitar = new ajaxClsFuncionario();
   $inhabilitar->ajaxCambiarEstadoFuncionario();
}