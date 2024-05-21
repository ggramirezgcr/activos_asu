<?php

require_once "conexion.php";

class ModeloIncautarActivo
{

   


    static public function mdlOcultarIncautamiento($tabla, $datos)
    {
        try {
            $sql = "UPDATE $tabla 
                    SET ocultar_ea = '1'
                     WHERE 
                     id_ea = :id_ea and incautador_ea = :incautador_ea";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":id_ea", $datos['idIncautamiento'], PDO::PARAM_STR);
            $stmt->bindParam(":incautador_ea", $datos['idUser'], PDO::PARAM_STR);


            if ($stmt->execute()) {
                return $stmt->rowCount();
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return 0;
        }
    }


    static public function mdlDevolverActivo($tabla, $datos)
    {
        try {
            $sql = "UPDATE $tabla 
                SET devuelto_ea = '1',
                 fecha_devol_ea = CURRENT_TIMESTAMP 
                 WHERE 
                 id_ea = :id_ea and incautador_ea = :incautador_ea";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":id_ea", $datos['idIncautamiento'], PDO::PARAM_STR);
            $stmt->bindParam(":incautador_ea", $datos['idUser'], PDO::PARAM_STR);


            if ($stmt->execute()) {
                return $stmt->rowCount();
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return 0;
        }
    }

    // ====================================================== //
    // ================= NUEVO ENCAUTAMIENTO ================ //
    // ====================================================== //
    static public function mdlNuevoIncautamiento($tabla, $datos)
    {
        try {
            $sql = "INSERT INTO 
                    $tabla(activo_ea, incautador_ea, observacion_ea) 
                    VALUE(:activo_ea, :incautador_ea, :observacion_ea);";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":activo_ea", $datos["activo"], PDO::PARAM_STR);
            $stmt->bindParam(":incautador_ea", $datos["incautador"], PDO::PARAM_STR);
            $stmt->bindParam(":observacion_ea", $datos["observacion"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return $stmt->rowCount();
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return 0;
        } finally {
            $stmt = null;
        }
    }




    static public function mdlActivosIncautados($tabla, $item, $valor, $unRegistro = false)
    {
        try {
            if ($unRegistro) {
               
                $sql = "SELECT 
                    id_ea, 
                    activo_ea, 
                    activo.placa_activo,
                    activo.descripcion_activo,
                    categoria.detalle_categoria,
                    subcategoria.detalle_subcategoria, 
                    marca.detalle_marca,
                    funcionario.id_funcionario,
                    funcionario.nombre_funcionario, 
                    fecha_ea, 
                    fecha_devol_ea, 
                    devuelto_ea,
                    fecha_respta_ea, 
                    aceptado_ea 
                    FROM (((((incautar_activo inner join activo on incautar_activo.activo_ea = activo.id_activo)
                    inner join funcionario on activo.responsable_activo = funcionario.id_funcionario)
                    inner join categoria on categoria.id_categoria = activo.categoria_activo)
                    inner join subcategoria on subcategoria.id_subcategoria = activo.subcategoria_activo)
                    inner join marca on marca.id_marca = activo.marca_activo)
                    where $item = :$item";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return  $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }


            }else {
                
            $sql = "SELECT 
                    id_ea, 
                    activo_ea, 
                    activo.placa_activo,
                    activo.descripcion_activo,
                    categoria.detalle_categoria,
                    subcategoria.detalle_subcategoria, 
                    marca.detalle_marca,
                    funcionario.id_funcionario,
                    funcionario.nombre_funcionario, 
                    fecha_ea, 
                    fecha_devol_ea, 
                    devuelto_ea,
                    fecha_respta_ea, 
                    aceptado_ea 
                    FROM (((((incautar_activo inner join activo on incautar_activo.activo_ea = activo.id_activo)
                    inner join funcionario on activo.responsable_activo = funcionario.id_funcionario)
                    inner join categoria on categoria.id_categoria = activo.categoria_activo)
                    inner join subcategoria on subcategoria.id_subcategoria = activo.subcategoria_activo)
                    inner join marca on marca.id_marca = activo.marca_activo)
                    where ocultar_ea = 0 and $item = :$item";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return  $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }

        }


        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Verifica que el numero de activo no se encuentre ya encautado
     *
     * @param [string] $tabla
     * @param [string] $item
     * @param [string] $valor
     * @return void
     */
    static public function mdlVerificarEquipoDisponible($tabla, $item, $valor)
    {
        try {
            //Siempre me deberia devolver por lo menos 0
            $sql = "SELECT coalesce(count(*), 0) idea FROM $tabla WHERE $item = :$item and devuelto_ea <> 1 limit 1";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }
}
