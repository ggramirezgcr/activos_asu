
<?php

require_once 'conexion.php';

class ModeloSolicitud
{
    // ====================================================== //
    // =============== LISTA DE ACTIVOS PRESTADOS============ //
    // ====================================================== //
    /**
     * Devuelve la lista de los equipos que el usuario tiene en prestamo
     *
     * @param [type] $item
     * @param [type] $valor
     * @param [type] $item2
     * @param [type] $valor2
     * @return void
     */
    public static function mdlSolicitudesEnviadas($tabla, $item, $valor, $item2, $valor2)
    {
        $sql =  "SELECT 
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
            devuelto_sa, ocultar_sa
        FROM 
            ((((activo inner join categoria on activo.categoria_activo = categoria.id_categoria)
            inner join subcategoria on activo.categoria_activo = subcategoria.id_subcategoria)
            inner join marca on activo.marca_activo = marca.id_marca) 
            inner join solicitudes_activos on activo.id_activo = solicitudes_activos.activo_sa) 
            inner join funcionario on solicitudes_activos.receptor_sa = funcionario.id_funcionario
        WHERE $item = :$item and $item2 = :$item2 ";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return  $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }

        $stmt = null;
    }


    // ====================================================== //
    // =============== REGISTRO DE SOLICITUD ================ //
    // ====================================================== //
    public static function mdlNuevaSolicitud($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("
        INSERT INTO 
        $tabla(activo_sa, emisor_sa, receptor_sa, detalle_sa)
        VALUES(:activo_sa, :emisor_sa, :receptor_sa, :detalle_sa)
        ");

        $stmt->bindParam('activo_sa', $datos['activo'], PDO::PARAM_INT);
        $stmt->bindParam('emisor_sa', $datos['emisor'], PDO::PARAM_INT);
        $stmt->bindParam('receptor_sa', $datos['receptor'], PDO::PARAM_INT);
        $stmt->bindParam('detalle_sa', $datos['detalle'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
    }



    // ====================================================== //
    // =============== ELIMINAR SOLICITUD ================ //
    // ====================================================== //
    public static function mdlEliminarSolicitud($tabla, $valor)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_sa = :id_sa");

        $stmt->bindParam(":id_sa", $valor, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt = null;
    }

     // ====================================================== //
    // =============== OCULTAR SOLICITUD ================ //
    // ====================================================== //
    public static function mdlOcultarSolicitud($tabla, $item, $valor) {
       
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ocultar_sa ='1' WHERE $item = :$item");
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR );

        if ($stmt->execute()) {
            return 'ok';
        }else {
            return 'error';
        }

    }


      // ====================================================== //
    // =============== REGISTRO DE SOLICITUD ================ //
    // ====================================================== //
    /**
     * Devuelve la lista de los equipos que el usuario tiene en prestamo
     *
     * @param [type] $item
     * @param [type] $valor
     * @param [type] $item2
     * @param [type] $valor2
     * @return void
     */
    public static function mdlSolicitudesEnviadasXfecha($tabla, $item, $valor, $item2, $valor2, $valor3)
    {
        try {
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
                        fecha_devol_sa,
                        respta_receptor_sa,
                        devuelto_sa,
                        ocultar_sa
                    FROM ((((solicitudes_activos
                    INNER JOIN funcionario ON solicitudes_activos.receptor_sa = funcionario.id_funcionario)
                    INNER JOIN activo ON solicitudes_activos.activo_sa = activo.id_activo)
                    LEFT JOIN categoria ON activo.categoria_activo = categoria.id_categoria)
                    LEFT JOIN subcategoria ON activo.subcategoria_activo = subcategoria.id_subcategoria)
                    right JOIN marca ON activo.marca_activo = marca.id_marca
                    WHERE emisor_sa = :valor3 
                    AND (devuelto_sa = 1 or respta_receptor_sa = 0) 
                    AND DATE(fecha_crea_sa) BETWEEN DATE(:valor1) AND DATE(:valor2) < CURDATE() + INTERVAL 1 DAY";
    
            $stmt = Conexion::conectar()->prepare($sql);
    
            $stmt->bindParam(":valor1", $valor, PDO::PARAM_STR);
            $stmt->bindParam(":valor2", $valor2, PDO::PARAM_STR);
            $stmt->bindParam(":valor3", $valor3, PDO::PARAM_STR);
    
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
    }
    



}
