<?php
require_once "conexion.php";

class ModeloActivos
{

    // ====================================================== //
    // ================== MOSTRAR ACTIVOS ================== //
    // ====================================================== //
    static public function mdlMostrarActivos($tabla, $item, $valor, $all = false)
    {
        //NOTA: Los archivos tipo blob dan problemas al momento de leer el json en js
        if ($item !== null) {

            if ($all == false) {
                $stmt = Conexion::conectar()->prepare("
                SELECT 
                        id_activo,
                        placa_activo,
                        descripcion_activo,
                        categoria_activo,
                        detalle_categoria,
                        subcategoria_activo,
                        detalle_subcategoria,
                        marca_activo,
                        detalle_marca,
                        modelo_activo,
                        detalle_modelo,
                        id_funcionario,
                        cedula_funcionario,
                        nombre_funcionario,
                        localizacion_activo,
                        id_ubicacion,
                        detalle_ubicacion,
                        servicio.id_servicio as id_serv_pertenece,
                    servicio.detalle_servicio as serv_pertenece,
                    localizacion_.id_servicio,
                    localizacion_.detalle_servicio,
                        detalle_localizacion,
                        ext_localizacion,
                        serie_activo,
                        observacion_activo
                FROM 
                    (((((((activo inner join marca on activo.marca_activo = marca.id_marca)
                    left join modelo_marca on activo.modelo_activo = modelo_marca.id_modelo)
                    inner join categoria on categoria.id_categoria = activo.categoria_activo)
                    left join subcategoria on subcategoria.id_subcategoria = activo.subcategoria_activo)
                    inner join funcionario on funcionario.id_funcionario = activo.responsable_activo)
                    inner join 
                    (select 
                    id_localizacion,
                    id_ubicacion,
                    detalle_ubicacion,
                    id_servicio,
                    detalle_servicio,
                    detalle_localizacion,
                    ext_localizacion 
                    from 
                    ((localizacion inner join ubicacion_servicio on localizacion.ubicacion_serv_localizacion = ubicacion_servicio.id_us)
                    inner join ubicacion on ubicacion.id_ubicacion = ubicacion_servicio.ubicacion_us)
                    inner join servicio on servicio.id_servicio = ubicacion_servicio.servicio_us)
                    as localizacion_ on localizacion_.id_localizacion = activo.localizacion_activo )
                    left join servicio on activo.servicio_pertenece_activo = servicio.id_servicio)
                 WHERE $item = :$item   
                    limit 1
             ");

                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

             if  ( $stmt->execute()){
                 return $stmt->fetch(PDO::FETCH_ASSOC);

             }else {
                return 'error';
             }



            } else {
                $stmt = Conexion::conectar()->prepare(
                    "
            SELECT 
                                                            id_activo,
                                                            placa_activo,
                                                            descripcion_activo,
                                                            categoria_activo,
                                                            detalle_categoria,
                                                            subcategoria_activo,
                                                            detalle_subcategoria,
                                                            marca_activo,
                                                            detalle_marca,
                                                            modelo_activo,
                                                            detalle_modelo,
                                                            id_funcionario,
                                                            cedula_funcionario,
                                                            nombre_funcionario,
                                                            localizacion_activo,
                                                            id_ubicacion,
                                                            detalle_ubicacion,
                                                            servicio.id_servicio as id_serv_pertenece,
                                                        servicio.detalle_servicio as serv_pertenece,
                                                        localizacion_.id_servicio,
                                                        localizacion_.detalle_servicio,
                                                            detalle_localizacion,
                                                            ext_localizacion,
                                                            img_modelo,
                                                            serie_activo,
                                                            observacion_activo
                                                    FROM 
                                                        (((((((activo inner join marca on activo.marca_activo = marca.id_marca)
                                                        left join modelo_marca on activo.modelo_activo = modelo_marca.id_modelo)
                                                        inner join categoria on categoria.id_categoria = activo.categoria_activo)
                                                        left join subcategoria on subcategoria.id_subcategoria = activo.subcategoria_activo)
                                                        inner join funcionario on funcionario.id_funcionario = activo.responsable_activo)
                                                        inner join 
                                                        (select 
                                                        id_localizacion,
                                                        id_ubicacion,
                                                        detalle_ubicacion,
                                                        id_servicio,
                                                        detalle_servicio,
                                                        detalle_localizacion,
                                                        ext_localizacion 
                                                        from 
                                                        ((localizacion inner join ubicacion_servicio on localizacion.ubicacion_serv_localizacion = ubicacion_servicio.id_us)
                                                        inner join ubicacion on ubicacion.id_ubicacion = ubicacion_servicio.ubicacion_us)
                                                        inner join servicio on servicio.id_servicio = ubicacion_servicio.servicio_us)
                                                        as localizacion_ on localizacion_.id_localizacion = activo.localizacion_activo )
                                                        left join servicio on activo.servicio_pertenece_activo = servicio.id_servicio)
                                                    WHERE $item = :$item 
                                                        order by detalle_categoria ASC"
                );

                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    return  'error';
                }
            }
        } else { #////////////////////////////////////////////////////ELSE

            $sql = "SELECT 
            id_activo,
            placa_activo,
            descripcion_activo,
            categoria_activo,
            detalle_categoria,
            subcategoria_activo,
            detalle_subcategoria,
            marca_activo,
            detalle_marca,
            modelo_activo,
            detalle_modelo,
            id_funcionario,
            cedula_funcionario,
            nombre_funcionario,
            localizacion_activo,
            id_ubicacion,
            detalle_ubicacion,
            servicio.id_servicio as id_serv_pertenece,
        servicio.detalle_servicio as serv_pertenece,
        localizacion_.id_servicio,
        localizacion_.detalle_servicio,
            detalle_localizacion,
            ext_localizacion,
            img_modelo,
            serie_activo,
            observacion_activo
    FROM 
        (((((((activo inner join marca on activo.marca_activo = marca.id_marca)
        left join modelo_marca on activo.modelo_activo = modelo_marca.id_modelo)
        inner join categoria on categoria.id_categoria = activo.categoria_activo)
        left join subcategoria on subcategoria.id_subcategoria = activo.subcategoria_activo)
        inner join funcionario on funcionario.id_funcionario = activo.responsable_activo)
        inner join 
        (select 
        id_localizacion,
        id_ubicacion,
        detalle_ubicacion,
        id_servicio,
        detalle_servicio,
        detalle_localizacion,
        ext_localizacion 
        from 
        ((localizacion inner join ubicacion_servicio on localizacion.ubicacion_serv_localizacion = ubicacion_servicio.id_us)
        inner join ubicacion on ubicacion.id_ubicacion = ubicacion_servicio.ubicacion_us)
        inner join servicio on servicio.id_servicio = ubicacion_servicio.servicio_us)
        as localizacion_ on localizacion_.id_localizacion = activo.localizacion_activo )
        left join servicio on activo.servicio_pertenece_activo = servicio.id_servicio)
        order by detalle_categoria ASC";

            $stmt = Conexion::conectar()->prepare($sql);

          if  ($stmt->execute()){
              return $stmt->fetchAll(PDO::FETCH_ASSOC);
          }else{
            return 'error';
          }

        } #////////////////////////////////////////////////////////////Fin If
    }


    // ====================================================== //
    // ================== ACTIVO EN USO ================== //
    // ====================================================== //
    static public function mdlActivoEnPrestamo($tabla, $item, $valor, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("
        SELECT 
            id_activo,
            placa_activo,
            descripcion_activo,
            estado_activo,
            eliminado_activo,
            id_sa,
            devuelto_sa,
            respta_receptor_sa
        FROM activo left join solicitudes_activos on activo.id_activo = solicitudes_activos.activo_sa 
            where $item = :$item
            ORDER BY id_sa DESC LIMIT 1
        ");

        $stmt->bindParam(':' . $item, $valor, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Devolver resultados obtenidos
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return 'error';
        }

        $stmt = null;
    }



    // ====================================================== //
    // =================== TOTALES TABLERO ================== //
    // ====================================================== //
    public static function mdlTotales_tablero($valor)
    {
        try {
            $sql = "
            select
            (SELECT count(*) as activos  FROM activo where responsable_activo = :responsable_activo) as activos, 
            (SELECT count(*) as devueltos FROM solicitudes_activos where devuelto_sa = 1 and emisor_sa = :emisor_sa1 and ocultar_sa = 0) as devueltos,
            (SELECT count(*) as prestados FROM solicitudes_activos where emisor_sa = :emisor_sa2 and (respta_receptor_sa = 1 or respta_receptor_sa is null) and devuelto_sa <> 1) as prestados,
            (SELECT count(*) as solicitados FROM solicitudes_activos WHERE receptor_sa = :receptor_sa AND devuelto_sa = 0 AND (respta_receptor_sa = 1 OR respta_receptor_sa IS NULL)) as solicitados, 
            (SELECT count(*) rechazados FROM asusistema.solicitudes_activos where devuelto_sa = 0 and respta_receptor_sa = 0 and emisor_sa = :emisor_sa and ocultar_sa = 0) as rechazados";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(':responsable_activo', $valor, PDO::PARAM_INT);
            $stmt->bindParam(':emisor_sa1', $valor, PDO::PARAM_INT);
            $stmt->bindParam(':emisor_sa2', $valor, PDO::PARAM_INT);
            $stmt->bindParam(':receptor_sa', $valor, PDO::PARAM_INT);
            $stmt->bindParam(':emisor_sa', $valor, PDO::PARAM_INT);


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

    // ====================================================== //
    // =================== TOTALES TABLERO ================== //
    // ====================================================== //
    /**
     * Muestra el total de los activos que pueda tener un funcionario solo que agrupado por su categoria
     *
     * @param [type] $valor
     * @return void
     */
    public static function mdlTotalesActivosXcat($valor)
    {
        try {


            $sql = "
                SELECT 
                    count(detalle_categoria) cantidad,
                    detalle_categoria 
                 FROM 
                    activo inner join categoria on activo.categoria_activo = categoria.id_categoria
                WHERE responsable_activo = :valor
                GROUP BY detalle_categoria
                ";


            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);


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


    // ====================================================== //
    // =================== TOTALES TABLERO ================== //
    // ====================================================== //
    /**
     * Muestra el total de los activos que pueda tener un funcionario solo que agrupado por su categoria
     *
     * @param [type] $valor
     * @return void
     */
    public static function mdlTotalesActivosXSolic($valor)
    {
        try {


            $sql = "
                SELECT 
                count(detalle_categoria) cantidad, 
                detalle_categoria 
                FROM 
                    (activo inner join categoria on activo.categoria_activo = categoria.id_categoria)
                    inner join solicitudes_activos on solicitudes_activos.activo_sa = activo.id_activo
                WHERE responsable_activo = :responsable_activo and emisor_sa = :emisor_sa
                GROUP BY detalle_categoria
                ";


            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":responsable_activo", $valor, PDO::PARAM_STR);
            $stmt->bindParam(":emisor_sa", $valor, PDO::PARAM_STR);


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


    // ====================================================== //
    // ================== IMAGEN DEL ACTIVO ================= //
    // ====================================================== //
    public static function mdlImagenActivo($valor)
    {
        try {


            $sql = "
                SELECT 
                    img_modelo 
                FROM 
                    activo inner join modelo_marca on modelo_marca.id_modelo = activo.modelo_activo 
                WHERE placa_activo = :valor
                LIMIT 1
                ";


            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);


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
