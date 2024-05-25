
<?php

require_once "conexion.php";

class ModelomisActivosIncautados
{

    // ====================================================== //
    // =============== MIS ACTIVOS INCAUTADOS =============== //
    // ====================================================== //
    public static function mdlmisActivosIncautados($tabla, $item, $valor)
    {
        try {

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
                    aceptado_ea, 
                    observacion_ea 
                    FROM (((((incautar_activo inner join activo on incautar_activo.activo_ea = activo.id_activo)
                    inner join funcionario on incautar_activo.incautador_ea = funcionario.id_funcionario)
                    inner join categoria on categoria.id_categoria = activo.categoria_activo)
                    inner join subcategoria on subcategoria.id_subcategoria = activo.subcategoria_activo)
                    inner join marca on marca.id_marca = activo.marca_activo)
                    where ocultar_ea = 0 and $item = :$item";


            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return  $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                // Manejar el error según tus necesidades
                return false;
            }
        } catch (PDOException $e) {
            // Manejar la excepción según tus necesidades
            return false;
        } finally {
            // Si es necesario, realiza alguna limpieza
            $stmt = null;
        }
    } // /.fin 


    // ====================================================== //
    // =============== RESPUESTA INCAUTAMIENTO ============== //
    // ====================================================== //
    static public function mdlRespuestaIncautamiento($tabla, $datos)
    {
        try {
            $sql = "UPDATE $tabla
            SET aceptado_ea = :aceptado_ea,
                fecha_respta_ea = CURRENT_TIMESTAMP,
                devuelto_ea = :devuelto_ea
            WHERE
            id_ea = :id_ea";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":id_ea", $datos['idea'], PDO::PARAM_STR);
            $stmt->bindParam(":aceptado_ea", $datos['respuesta'], PDO::PARAM_STR);
            $stmt->bindParam(":devuelto_ea", $datos['respuesta'], PDO::PARAM_STR);


            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0)
                {
                    return 'ok';
                }else {
                    return 'error';
                }
            } else {
                return 'error';
            }
        } catch (PDOException  $e) {
            return 0;
        }
    }
} // /. fin clase


?>