<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuario
{
    
    // ====================================================== //
    // =================== EDITAR USUARIO =================== //
    // ====================================================== //
    public $idUsuario;

    public function ajaxEditarUsuario() {
    
        $item = "id";
        $valor  = $this->idUsuario;
        $respuesta =  ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
        header("Content-Type: application/json");
        echo json_encode($respuesta);

    }


    // ====================================================== //
    // =================== ACTIVAR USUARIO ================== //
    // ====================================================== //
    public $activarUsuario;
    public $activarId;

    public function  ajaxActivarUsuario() {
      
        $tabla = "usuarios";
        
        $item1 = "estado";
        $valor1 = $this->activarUsuario;
       
        $item2 = "id";
        $valor2 = $this->activarId;

       
        
    $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2); 

        echo  $respuesta;

    }



    // ====================================================== //
    // =================== ACTIVAR USUARIO ================== //
    // ====================================================== //
 /**
  * Recibe 2 parametros, el id del usuario y el estado de si puede incautar o no activos
  *
  * @param [type] $valor
  * @param [type] $valor2
  * @return void
  */
    public function  ajaxIncautar($valor, $valor2) {
      
        $tabla = "usuarios";
        
        $item1 = "secuestra_activos";
        $valor1_ = $valor2;
       
        $item2 = "id";
        $valor2_ = $valor;

       
        
    $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1_, $item2, $valor2_); 

        echo  $respuesta;

        header('Content-Type: text/plain');
        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }


 

    // ====================================================== //
    // ============= VALIDAR NO REPETIR USUARIO ============= //
    // ====================================================== //
    public $validarUsuario;

    public function ajaxValidarUsuario(){
        
        $item = "usuario";
        $valor  = $this->validarUsuario;
        $respuesta =  ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }


    // ====================================================== //
    // ============= VALIDAR PASSWORD ============= //
    // ===================================================== //
      public function ajaxValidarPass($valor, $valor2){
        
       
        $valor_  = $valor;
        $valor2_  = $valor2;
        $respuesta =  ControladorUsuarios::ctrComparaPass($valor_, $valor2_);
        header('Content-Type: text/plain');
        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    }


    
// ====================================================== //
// ============= ID USUARIO LOGUEADO ============= //
// ====================================================== //
public $verIdUsuario;

public function ajaxIdUsuarioLogueado() {
    $verIdUsuario = null;
    $respuesta = ControladorUsuarios::ctrUsuarioLogueado();
    
    echo json_encode($respuesta);
}



// ~~~~~~~~~~~~~~ FIN CLASE ~~~~~~~~~~~~~~ //
}




// ====================================================== //
// =================== EDITAR USUARIO =================== //
// ====================================================== //
if (isset($_POST["idUsuario"])) {
    
    $editar = new AjaxUsuario();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();

}


// ====================================================== //
// ===== CONFIGURACOIN EDITAR USUARIO =================== //
// ====================================================== //
if (isset($_POST["iduser"])) {
    if (isset($_POST['modalConfiguraciones'])) {
        $datosUsuario = new AjaxUsuario();
        $datosUsuario->idUsuario = $_POST["iduser"];
        $datosUsuario->ajaxEditarUsuario();
    }

}


// ====================================================== //
// =================== ACTIVAR USUARIO ================== //
// ====================================================== //
if(isset($_POST["activarId"])){
    $activarUsuario = new AjaxUsuario();
    $activarUsuario -> activarUsuario = $_POST["activarUsuario"];
    $activarUsuario -> activarId = $_POST["activarId"];
    $activarUsuario ->ajaxActivarUsuario();

}

// ====================================================== //
// ============= VALIDAR NO REPETIR USUARIO ============= //
// ====================================================== //
if (isset($_POST["validarUsuario"])) {
    $valUsuario = new AjaxUsuario();
    $valUsuario->validarUsuario = $_POST['validarUsuario'];
    $valUsuario->ajaxValidarUsuario();

}


// ====================================================== //
// ============= ID USUARIO LOGUEADO ============= //
// ====================================================== //
if (isset($_POST['ObtenerID'])) {
    $usuarioId = new AjaxUsuario();
    $usuarioId->verIdUsuario = $_POST['ObtenerID'];
    $usuarioId->ajaxIdUsuarioLogueado();
}


if (isset($_POST['modalConfiguraciones'])) {
    if (isset($_POST['validarPass'])) {
        $validarPass = new AjaxUsuario();
        $validarPass->ajaxValidarPass($_POST['iduser'], $_POST['validarPass']);
    }
}


if (isset($_POST['incautar'])) {
   if (isset($_POST['iduser'])) {
     $incautar = new AjaxUsuario();
     $incautar->ajaxIncautar($_POST['iduser'], $_POST['incautar'] );
   }
}


// ====================================================== //
// =================== CAMBIAR IMAGEN =================== //
// ====================================================== //
