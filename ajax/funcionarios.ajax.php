<?php

require_once "../controladores/funcionario.controlador.php";
require_once "../modelos/funcionarios.modelo.php";

class ajaxClsFuncionario
{


    // ====================================================== //
    // ================ OBTENER USUARIO DE RED ============== //
    // ====================================================== //
    public $idFuncionario;

    public function ajaxObtenerUsuarioRed()
    {
        $item = "id_funcionario";
        $valor = $this->idFuncionario;

        $respuesta = ControladorFuncionarios::ctrMostrarFuncionarios($item, $valor);

        echo json_encode($respuesta);
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

        echo json_encode($respuesta);
    }




    // ~~~~~~~~~~~~~~ FIN CLASE ~~~~~~~~~~~~~~ //
}


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
