<?php

class ControladorFuncionarios
{

    // ====================================================== //
    // ================= LISTADO DE USUARIOS ================ //
    // ====================================================== //

   /**
    * Mostrar funcionarios
    *
    * @param [type] $item : Campo de la bd por el cual se va a buscar
    * @param [type] $valor : Valor en la bd a buscar
    * @param boolean $filtrar :Si se desea filtrar el valor sera en true
    * @return void
    */
   static public function ctrMostrarFuncionarios($item, $valor, $filtrar = false) 
   {
    
    $tabla = "funcionario";

    $respuesta = ModeloFuncionarios::mdlMostrarFuncionarios($tabla, $item, $valor, $filtrar);

    return $respuesta;
   }


}