<?php

class ControladorMarcas
{
    // ====================================================== //
    // ===================== NUEVA MARCA ==================== //
    // ====================================================== //
    public static function ctrNuevaMarca($item, $valor)
    {

        $tabla = 'marca';

        $marca = ModeloMarcas::mdlMarcasRegistradas($tabla, $item, $valor);
        if (is_array($marca)) {
            if (count($marca) > 0) {
                return 'existe';
            } else {
                $respuesta = ModeloMarcas::mdlNuevaMarca($tabla, $item, $valor);
            }
        } elseif (!$marca == 'error' || !$marca == 'error') {
            $respuesta = ModeloMarcas::mdlNuevaMarca($tabla, $item, $valor);
        } else {
            return 'error';
        }

        return $respuesta;
    }


    // ====================================================== //
    // =================== ELIMINAR MARCA =================== //
    // ====================================================== //
    public static function ctrEliminarMarca($item, $valor)
    {

        $tabla = "marca";


        $item = ControladorSanitizar::sanitizarCadena($item);
        $valor = ControladorSanitizar::sanitizarCadena($valor);


        $respuesta = ModeloMarcas::mdlEliminarMarca($tabla, $item, $valor);

        return $respuesta;
    }

    // ====================================================== //
    // ==================== EDITAR MARCA ==================== //
    // ====================================================== //
    public static function ctrEditarMarca($datos)
    {
        $tabla = 'marca';
        $item = 'id_marca';

       //Validar datos
       foreach ($datos as $value) {
        if (is_null($value)) {
            return 'incompleto';
        }
       }


       
        $marcaExiste = ModeloMarcas::mdlMarcasRegistradas($tabla, 'detalle_marca', $datos['editada']);


        if (is_array($marcaExiste)) {
            if (count($marcaExiste) > 0) {
                return 'existe';
            }else {
                $respuesta = ModeloMarcas::mdlEditarMarca($tabla, $item, $datos);
            }
        }else {
            return 'error';
        }

        return $respuesta;
    }




    // ====================================================== //
    // ============ DATOS MARCAS PARA SERVER SIDE =========== //
    // ====================================================== //
    public static function ctrDatosMarcas_sside()
    {
        try {

            $tabla = 'marca';
            $item = 'detalle_marca';

            // Obtener los parámetros de DataTables
            $draw = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            $search = $_REQUEST['search']['value'];
            $orderColumnIndex = $_REQUEST['order'][0]['column']; // índice de la columna
            $orderDirection = $_REQUEST['order'][0]['dir']; // dirección de orden

            // Define el mapeo de los índices de columna a los nombres de columna de la base de datos
            $columns = array(
                0 => 'id_marca',
                1 => 'detalle_marca',
                2 => 'id_marca'
            );

            // Obtén el nombre de columna correcto basado en el índice
            $orderColumn = $columns[$orderColumnIndex];


            // Realizar la consulta
            $resultado = ModeloMarcas::getData($start, $length, $search, $orderColumn, $orderDirection, $tabla);

            // Total de registros
            $totalRegistros = ModeloMarcas::getTotalRecords($tabla);

            // Total filtrados
            $filtrados = ModeloMarcas::getFilteredRecords($search, $tabla, $item);

            // Preparar los datos para enviar a DataTables
            $datos = array();
            foreach ($resultado as $fila) {
                $datos[] = array(
                    'id_marca' => $fila['id_marca'],
                    'detalle_marca' => $fila['detalle_marca'],
                    'acciones' => $fila['id_marca']
                );
            }

            // Enviar la respuesta en formato JSON
            $respuesta = array(
                'draw' => intval($draw),
                'recordsTotal' => intval($totalRegistros),
                'recordsFiltered' => intval($filtrados),
                'data' => $datos
            );

            echo json_encode($respuesta);
        } catch (\Throwable $e) {

            echo json_encode(array(
                "error" => $e->getMessage()
            ));
        }
    }
} // /.ControladorMarcas
