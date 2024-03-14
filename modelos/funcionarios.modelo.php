<?php

require_once "conexion.php";

class ModeloFuncionarios
{

     // ====================================================== //
    // ================== MOSTRAR FUNCIONARIOS =============== //
    // ====================================================== //
  static public function mdlMostrarFuncionarios($tabla, $item, $valor, $filtrar = false)
  {
    if ($item != null) { 

      if ($filtrar == false) {
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and nombre_funcionario <> 'root'");
  
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
  
        $stmt->execute();
  
        return $stmt->fetch();

      }else {
        //FILTRAMOS
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item like :$item and nombre_funcionario <> 'root' order by nombre_funcionario ASC");
  
        $stmt->bindParam(":".$item, '%'. $valor.'%', PDO::PARAM_STR);
  
        $stmt->execute();
  
        return $stmt->fetch();

      }

    }else {
      
      $stmt = Conexion::conectar()->prepare("SELECT * FROM funcionario where nombre_funcionario <> 'root' order by nombre_funcionario ASC");

      $stmt->execute();

      return $stmt->fetchAll();

    }

    $stmt = null;
  }


}