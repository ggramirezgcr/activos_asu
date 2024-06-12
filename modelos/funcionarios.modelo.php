<?php

require_once "conexion.php";

class ModeloFuncionarios
{

  // ====================================================== //
  // ================== NUEVO FUNCIONARIO ================= //
  // ====================================================== //
  static public function mdlNuevoFuncionario($tabla, $datos)
  {
    try {
      $sql = "INSERT INTO 
          $tabla(tipo_ced_funcionario, cedula_funcionario, nombre_funcionario, usuario_red_funcionario)
          VALUES(:tipo_ced_funcionario, :cedula_funcionario, :nombre_funcionario, :usuario_red_funcionario)";

      $stmt = Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":tipo_ced_funcionario", $datos['tipoCedula'], PDO::PARAM_STR);
      $stmt->bindParam(":cedula_funcionario", $datos['cedula'], PDO::PARAM_STR);
      $stmt->bindParam(":nombre_funcionario", $datos['nombre'], PDO::PARAM_STR);
      $stmt->bindParam(":usuario_red_funcionario", $datos['usuario_red'], PDO::PARAM_STR);

      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          return 'ok';
        } else {
          return 'false';
        }
      }
    } catch (\Throwable $e) {
    }
  }


  // ====================================================== //
  // ================ ELIMINAR FUNCIONARIO ================ //
  // ====================================================== //
  static public function mdlEliminarFuncionario($tabla, $item, $valor)
  {
    try {
      $sql = "DELETE FROM $tabla WHERE $item = :$item";

      $stmt = Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

      if ($stmt->execute()) {

        if ($stmt->rowCount() > 0) {
          return 'ok';
        } else {
          return 'false';
        }
      } else {

        return 'false';
      }
    } catch (\Throwable $e) {
      return 'error';
    }
  }

  // ====================================================== //
  // ================== MOSTRAR FUNCIONARIOS =============== //
  // ====================================================== //
  static public function mdlMostrarFuncionarios($tabla, $item, $valor, $filtrar = false)
  {
    try {

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

          $stmt->bindValue(":" . $item, '%' . $valor . '%', PDO::PARAM_STR);

          $stmt->execute();

          $result = $stmt->fetch(PDO::FETCH_ASSOC);

          if (!$result) {
            return false;
          } else {
            return $result;
          }
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
    } catch (\Throwable $e) {
      return 'error';
    }
  }


  // ====================================================== //
  // ================= EDITAR FUNCIONARIO ================= //
  // ====================================================== //
  static public function mdlEditarDatoFuncionario($tabla, $item1, $valor1, $item2, $valor2) {
    try
    {
      $sql = "UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2";

      $stmt = Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":".$item1 , $valor1, PDO::PARAM_STR);
      $stmt->bindParam(":".$item2 , $valor2, PDO::PARAM_STR);

      if ($stmt->execute()){
        if ($stmt->rowCount() > 0) {
          return 'ok';
        }else {
          return 'false';
        }
      }else{
        return 'error';
      };


    }
    catch (\Throwable $e)
    {
      return 'error';
    }
  }


  // ====================================================== //
  // =============== TODOS LOS FUNCIONARIOS =============== //
  // ====================================================== //
  static public function getData($start, $length, $search, $orderColumn, $orderDir)
  {
    $sql = "SELECT  
              id_funcionario, 
              tipo_ced_funcionario,
              cedula_funcionario, 
              nombre_funcionario, 
              usuario_red_funcionario, 
              estado_funcionario 
          FROM funcionario 
          where nombre_funcionario <> 'root' 
          AND (nombre_funcionario LIKE :search
               OR cedula_funcionario LIKE :search1
               OR usuario_red_funcionario LIKE :search2
               )
          ORDER BY $orderColumn $orderDir 
          LIMIT :start, :length";

    $stmt = Conexion::conectar()->prepare($sql);

    $searchParam = "%{$search}%";
    $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    $stmt->bindParam(':search1', $searchParam, PDO::PARAM_STR);
    $stmt->bindParam(':search2', $searchParam, PDO::PARAM_STR);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':length', $length, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll();
  }


  static public function getTotalRecords()
  {
    $query = "SELECT COUNT(*) as count FROM funcionario";
    return Conexion::conectar()->query($query)->fetch()['count'];
  }



  static public function getFilteredRecords($search)
  {
    $query = "SELECT COUNT(*) as count FROM funcionario WHERE nombre_funcionario LIKE :search";

    $stmt = Conexion::conectar()->prepare($query);

    $searchParam = "%{$search}%";
    $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);

    $stmt->execute();
    return $stmt->fetch()['count'];
  }

  
}
