<?php

require_once 'conexion.php';

class ModeloSolicitudesRecibidas
{

    // ====================================================== //
    // ===== REGISTRO DE SOLICITUD RECIVIDAS ================ //
    // ====================================================== //
    /**
     * retorna lista de activos que otro funcionario le esta prestando para que el usuario valide
     * si debe aceptar el prestamo o bien debe recharzarlo
     *
     * @param [string] $tabla
     * @param [string] $item: receptor_sa
     * @param [string] $valor
     * @param [string] $item2: devuelto_sa
     * @param [string] $valor2
     * @return void
     */
    public static function mdlMiSolicitudesRecibidas($tabla, $item, $valor, $item2, $valor2)
    {
        try
        {

            $sql = "SELECT 
            id_sa,
            placa_activo,
            activo_sa,
            detalle_categoria,
            detalle_subcategoria, 
            detalle_marca,
            id_funcionario,
            nombre_funcionario,
            fecha_crea_sa,
            respta_receptor_sa,
            fecha_respta_sa,
            devuelto_sa, 
            ocultar_sa
        FROM 
            ((((activo inner join categoria on activo.categoria_activo = categoria.id_categoria)
            inner join subcategoria on activo.categoria_activo = subcategoria.id_subcategoria)
            inner join marca on activo.marca_activo = marca.id_marca) 
            inner join solicitudes_activos on activo.id_activo = solicitudes_activos.activo_sa) 
            inner join funcionario on solicitudes_activos.emisor_sa = funcionario.id_funcionario
        WHERE $item = :$item and $item2 = :$item2";
    
            $stmt = Conexion::conectar()->prepare($sql);
    
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
    
    
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
    
            $stmt = null;
        }
        catch (\Throwable $e)
        {
            return 'error';
        }


       
    }





    // ====================================================== //
    // =============== ACEPTAR SOLICITUD RECIBIDA============= //
    // ====================================================== //
    public static function mdlAceptarSolicitudRecibida($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("
        UPDATE
         $tabla 
         SET $item = :$item,
         fecha_respta_sa = CURRENT_TIMESTAMP
         WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt = null;
    }



    // ====================================================== //
    // =============== ACEPTAR SOLICITUD RECIBIDA============= //
    // ====================================================== //
    public static function mdlDevolverActivoRecibido($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("
        UPDATE
         $tabla 
         SET $item = :$item,
         fecha_devol_sa = CURRENT_TIMESTAMP
         WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt = null;
    }
}
