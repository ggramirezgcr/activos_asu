<?php
require_once "conexion.php";

class ModeloMarcas
{
    // ====================================================== //
    // ===================== NUEVA MARCA ==================== //
    // ====================================================== //
    public static function mdlNuevaMarca($tabla, $item, $valor)
    {
        try {
            $sql = "INSERT INTO $tabla(detalle_marca) 
                VALUES(:$item)";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    return 'ok';
                } else {
                    return false;
                }
            } else {
                return 'error';
            }
        } catch (\Throwable $e) {
            return 'error';
        }
    }


    // ====================================================== //
    // =================== ELIMINAR MARCA =================== //
    // ====================================================== //
    public static function mdlEliminarMarca($tabla, $item, $valor)
    {
        try {
            $sql = "DELETE FROM $tabla WHERE id_marca = :id_marca";
            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":id_marca", $valor, PDO::PARAM_INT);

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
            return 'false';
        }
    }


    // ====================================================== //
    // ==================== EDITAR MARCA ==================== //
    // ====================================================== //
    public static function mdlEditarMarca($tabla, $item, $datos)
    {
        try {
            $sql = "update 
                    $tabla 
                    set 
                    detalle_marca = :detalle_marca
                    where 
                    $item = :$item and detalle_marca = :detalle_marca2";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":".$item, $datos['idmarca'], PDO::PARAM_INT);
            $stmt->bindParam(":detalle_marca", $datos['editada'], PDO::PARAM_STR);
            $stmt->bindParam(":detalle_marca2", $datos['marca'], PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    return 'ok';
                }else {
                    return false;
                }
            }else {
                return 'error';
            }


        } catch (\Throwable $th) {
            return 'error';
        }
    }




    // ====================================================== //
    // =============== DETALLE MARCA O MARCAS =============== //
    // ====================================================== //
    public static function mdlMarcasRegistradas($tabla, $item, $valor)
    {
        try {

            if ($item == '') { //Si no trae es para ver todas las marcas
                $sql = "SELECT id_marca, detalle_marca FROM $tabla";

                $stmt = Conexion::conectar()->prepare($sql);

                if ($stmt->execute()) {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    return false;
                }
            } else { //Para obtener los datos de un solo registro

                $sql = "SELECT id_marca, detalle_marca FROM $tabla WHERE $item = :$item";

                $stmt = Conexion::conectar()->prepare($sql);

                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    return false;
                }
            } // /.if

        } catch (\Throwable $th) {
            return 'error';
        }
    }


    // ====================================================== //
    // ============== OBTENER DATOS MARCAS SSP ============== //
    // ====================================================== //
    static public function getData($start, $length, $search, $orderColumn, $orderDir, $tabla)
    {
        $sql = "SELECT  
                id_marca,
                detalle_marca
            FROM $tabla 
            where (detalle_marca LIKE :search )
            ORDER BY $orderColumn $orderDir 
            LIMIT :start, :length";

        $stmt = Conexion::conectar()->prepare($sql);

        $searchParam = "%{$search}%";
        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':length', $length, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
    }


    static public function getTotalRecords($tabla)
    {
        $query = "SELECT COUNT(*) as count FROM $tabla";
        return Conexion::conectar()->query($query)->fetch()['count'];
    }

    static public function getFilteredRecords($search, $tabla, $item)
    {
        $query = "SELECT COUNT(*) as count FROM $tabla WHERE $item LIKE :search";

        $stmt = Conexion::conectar()->prepare($query);

        $searchParam = "%{$search}%";
        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetch()['count'];
        } else {
            return -1; //error
        }
    }
}
