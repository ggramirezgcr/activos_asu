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

        $sql = "SELECT 
                id_funcionario, 
                tipo_ced_funcionario,
                cedula_funcionario, 
                nombre_funcionario, 
                usuario_red_funcionario, 
                estado_funcionario 
            FROM $tabla 
            WHERE $item = :$item and nombre_funcionario <> 'root'";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
      } else {

        //FILTRAMOS
        $sql = "SELECT 
            id_funcionario, 
            tipo_ced_funcionario,
            cedula_funcionario, 
            nombre_funcionario, 
            usuario_red_funcionario, 
            estado_funcionario
        FROM $tabla 
        WHERE $item like :$item and nombre_funcionario <> 'root' order by nombre_funcionario ASC";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":" . $item, '%' . $valor . '%', PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
      }
    } else {

      $sql = "SELECT  
                  id_funcionario, 
                  tipo_ced_funcionario,
                  cedula_funcionario, 
                  nombre_funcionario, 
                  usuario_red_funcionario, 
                  estado_funcionario 
              FROM funcionario 
              where nombre_funcionario <> 'root' order by nombre_funcionario ASC";

      $stmt = Conexion::conectar()->prepare($sql);

      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $stmt = null;
  }
}
