<?php
require_once 'config/ssp.class.php';




class ControladorFuncionarios
{

    // ====================================================== //
    // ================== NUEVO FUNCIONARIO ================= //
    // ====================================================== //
    static public function ctrNuevoFuncionario()
    {
        try {
            $tabla = "funcionario";
            $tipoId = $_POST['cmd_TipoID_mNF'] == 'nacional' ? 'n' : 'e';
            $cedulaSinGiones = str_replace("-", "", $_POST['txt_CedulaFunc_mNF']);
            $cedulaSinGiones = str_replace("_", "", $cedulaSinGiones);


            $datos = [
                "tipoCedula" => $tipoId,
                "cedula"      => $cedulaSinGiones,
                "nombre"      => $_POST['txt_NombreFunc_mNF'],
                "usuario_red" => $_POST['txt_userRed_mNF']
            ];

            $respuesta = ModeloFuncionarios::mdlNuevoFuncionario($tabla, $datos);

            return $respuesta;
        } catch (\Throwable $th) {
        }
    }


    static public function ctrValidarDatos()
    {
        try {
            $bandera = false;


            if (isset($_POST['btnNuevoFunc_mNF'])) {

                //Cedula
                if (isset($_POST['txt_CedulaFunc_mNF'])) {
                    $cedulaSinGiones = str_replace("-", "", $_POST['txt_CedulaFunc_mNF']);
                    $cedulaSinGiones = str_replace("_", "", $cedulaSinGiones);


                    if (empty($_POST['txt_CedulaFunc_mNF'])) {
                        $bandera = true;
                    } elseif (!preg_match('/^[0-9]+$/', $cedulaSinGiones)) {
                        $bandera = true;
                    } elseif (strlen($cedulaSinGiones) >= 9) {

                        //Comprobar si el numero de cedula ya esta registrado
                        $cedulaReg = self::ctrMostrarFuncionarios('cedula_funcionario', $cedulaSinGiones);

                        if ($cedulaReg !== false || $cedulaReg == 'error') {
                            $bandera = true;
                        }
                    } else {
                        $bandera = true;
                    }
                } else {
                    $bandera = true;
                }

                //Nombre
                if (isset($_POST['txt_NombreFunc_mNF'])) {
                    if (empty($_POST['txt_NombreFunc_mNF'])) {
                        $bandera = true;
                    } elseif (!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/', $_POST['txt_NombreFunc_mNF'])) {
                        $bandera = true;
                    }
                } else {
                    $bandera = true;
                }


                //Usuario de red
                if (isset($_POST['txt_userRed_mNF'])) {
                    if (empty($_POST['txt_userRed_mNF'])) {
                        $bandera = true;
                    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['txt_userRed_mNF'])) {
                        $bandera = true;
                    } else {
                        //Comprobar si el nombre de usuario esta registrado
                        $userRed = self::ctrMostrarFuncionarios('usuario_red_funcionario', $_POST['txt_userRed_mNF']);

                        if ($userRed !== false || $userRed == 'error') {
                            $bandera = true;
                        }
                    }
                } else {
                    $bandera = true;
                }

                if ($bandera == false) {
                    return true;
                } else {
                    return  false;
                }
            }
        } catch (\Throwable $th) {
            return 'error';
        }
    }

    // ====================================================== //
    // ================ ELIMINAR FUNCIONARIO ================ //
    // ====================================================== //
    static public function ctrEliminarFuncionario($item, $valor)
    {

        $tabla = "funcionario";


        $activos = ModeloActivos::mdlMostrarActivos('activo', 'responsable_activo', $valor);
        if ($activos !== 'error') {
            if (is_array($activos)) {
                return 'activos';
            } else {
                //  $solicitudes = ModeloSolicitudesRecibidas::mdlMiSolicitudesRecibidas('solicitudes_activos',)
                $respuesta = ModeloFuncionarios::mdlEliminarFuncionario($tabla, $item, $valor);
            }
        }

        return $respuesta;
    }



    // ====================================================== //
    // =============== ESTADO FUNCIONARIO ============== //
    // ====================================================== //
    /**
     * Cambia el valor del estado del funcionario para habilitarlo o para habilitarlo
     * habilitarlo = 1 
     * inhabilitarlo =0
     *
     * @param string $item1
     * @param string $valor1
     * @param string $item2
     * @param string $valor2
     * @return void
     */
    static public function ctrCambiarEstadoFuncionario($item1, $valor1, $item2, $valor2)
    {
        $tabla = 'funcionario';

        $activos = ModeloActivos::mdlMostrarActivos('activo', 'responsable_activo', $valor2);

        if ($valor1 == 0) {
            if ($activos !== 'error') {
                if (is_array($activos)) {
                    return 'activos';
                } else {
                    $prestamos = ControladorSolicitudesRecibidas::ctrMiSolicitudesRecibidas('receptor_sa', $valor2, 'devuelto_sa', 0);
                    if (is_array($prestamos)) {
                        return 'prestamos';
                    } else {
                        $respuesta = ModeloFuncionarios::mdlEditarDatoFuncionario($tabla, $item1, $valor1, $item2, $valor2);
                    }
                }
            } else {
                return 'error';
            }
        } else {
            $respuesta = ModeloFuncionarios::mdlEditarDatoFuncionario($tabla, $item1, $valor1, $item2, $valor2);
        }

        return $respuesta;
    }









    // ====================================================== //
    // ================= LISTADO DE USUARIOS ================ //
    // ====================================================== //

    /**
     * Mostrar funcionarios
     *
     * @param [type] $item : Campo de la bd por el cual se va a buscar
     * @param [type] $valor : Valor en la bd a buscar
     * @param boolean $filtrar :Si se desea filtrar el valor sera en true
     * @return void
     */
    static public function ctrMostrarFuncionarios($item, $valor, $filtrar = false)
    {

        $tabla = "funcionario";

        $respuesta = ModeloFuncionarios::mdlMostrarFuncionarios($tabla, $item, $valor, $filtrar);

        return $respuesta;
    }


    public function obtenerDatos()
    {
        $table = 'funcionario';
        $primaryKey = 'id_funcionario';

        $columns = [
            ['db' => 'id_funcionario',           'dt' => 'id_funcionario'],
            ['db' => 'cedula_funcionario',       'dt' => 'cedula_funcionario'],
            ['db' => 'nombre_funcionario',       'dt' => 'nombre_funcionario'],
            ['db' => 'usuario_red_funcionario',  'dt' => 'usuario_red_funcionario'],
            ['db' => 'id_funcionario',           'dt' => 'acciones'],
        ];

        //  $sql_details = ModeloConfigDB::sql_DetallesUsuarioLectura();

        $sql_details = [
            'user' => 'root',
            'pass' => 'cogualco',
            'db'   => 'asusistema',
            'host' => 'localhost'
        ];

        echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    static public function ctrDatosFun_sside()
    {
        try {
            // Obtener los parámetros de DataTables
            $draw = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            $search = $_REQUEST['search']['value'];
            $orderColumnIndex = $_REQUEST['order'][0]['column']; // índice de la columna
            $orderDirection = $_REQUEST['order'][0]['dir']; // dirección de orden

            // Define el mapeo de los índices de columna a los nombres de columna de la base de datos
            $columns = array(
                0 => 'id_funcionario',
                1 => 'tipo_ced_funcionario',
                2 => 'cedula_funcionario',
                3 => 'nombre_funcionario',
                4 => 'usuario_red_funcionario',
                5 => 'estado_funcionario'
            );


            // Obtén el nombre de columna correcto basado en el índice
            $orderColumn = $columns[$orderColumnIndex];

            // Realizar la consulta
            $resultado = ModeloFuncionarios::getData($start, $length, $search, $orderColumn, $orderDirection);

            // Total de registros
            $totalRegistros = ModeloFuncionarios::getTotalRecords();

            // Total filtrados
            $filtrados = ModeloFuncionarios::getFilteredRecords($search);

            // Preparar los datos para enviar a DataTables
            $datos = array();
            foreach ($resultado as $fila) {
                $datos[] = array(
                    'id_funcionario' => $fila['id_funcionario'],
                    'tipo_ced_funcionario' => $fila['tipo_ced_funcionario'],
                    'cedula_funcionario' => $fila['cedula_funcionario'],
                    'nombre_funcionario' => $fila['nombre_funcionario'],
                    'usuario_red_funcionario' => $fila['usuario_red_funcionario'],
                    'estado_funcionario' => $fila['estado_funcionario'],
                    'acciones' => $fila['id_funcionario']
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
            // Manejar la excepción si es necesario
            echo json_encode(array(
                "error" => $e->getMessage()
            ));
        }
    } // /. ctrDatosFun_sside

} // /. Fin clase



//RUTAS

if (isset($_GET['accion']) && $_GET['accion'] == 'obtenerFuncionarios_ssidep') {
    $controller = new ControladorFuncionarios();
    // $controller->obtenerDatos();
    // $controller->ctrDatosFun_sside();
}
