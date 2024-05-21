<?php

require_once "msj.controlador.php";

class ControladorIncautarActivo
{


    static public function ctrOcultarIncautamiento()
    {
        try {
            if (isset($_GET['idIncautamiento']) and isset($_GET['idUser']) and isset($_GET['ocultar'])) {
                $bandera = false;

                //Si solo hay numeros en la varible la variable bandera no se activa
                if (!preg_match('/^[0-9]+$/', $_GET['idIncautamiento'])) {
                    $bandera = true;
                }

                if (!preg_match('/^[0-9]+$/', $_GET['idUser'])) {
                    $bandera = true;
                }


                if ($bandera == false) {

                    $tabla = "incautar_activo";
                    $item = "id_ea";
                    $datos = array(
                        'idIncautamiento' => $_GET['idIncautamiento'],
                        'idUser'          => $_GET['idUser']
                    );

                    $encautamiento = new ModeloIncautarActivo();
                    $info  =   $encautamiento->mdlActivosIncautados($tabla, $item, $datos['idIncautamiento'], true);

                    $bolBandera = false;
                    if ($info) {

                        if ($info['aceptado_ea'] <> '1') {
                            $bolBandera = true;
                        }

                        if ($info['fecha_respta_ea'] == null) {
                            $bolBandera = true;

                            ControladorMensajes::msj_Swal('', 'Tenemos un problema, no hemos encontrado la fecha de la repuesta que indica por parte del propietario que acepta el activo.', 'e', 'window.location = "incautarActivo";');
                        }
                    } else {
                        $bolBandera = true;
                    }

                    if ($bolBandera == false) {

                        $respuesta = ModeloIncautarActivo::mdlOcultarIncautamiento($tabla, $datos);

                        if ($respuesta > 0) {
                            ControladorMensajes::msj_Swal('', 'Fin del proceso de incautamiento de este activo', 's', 'window.location = "incautarActivo";');
                        } else {
                            ControladorMensajes::msj_Swal('Error', 'Error al intentar devolver el activo', 'e', 'window.location = "incautarActivo";');
                        }
                    }
                }
            }
        } catch (Error $e) {
        }
    }

    // ====================================================== //
    // ============ DEVOLVER EL ACTIVO ENCAUTADO ============ //
    // ====================================================== //
    /**
     * Establece en true el campo donde se indica que el activo se ha devuelto
     *
     * @return void
     */
    static public function ctrDevolverActivo()
    {
        try {
            if (isset($_GET['idIncautamiento']) and isset($_GET['idUser']) and isset($_GET['devolucion'])) {
                $bandera = false;

                //Si solo hay numeros en la varible la variable bandera no se activa
                if (!preg_match('/^[0-9]+$/', $_GET['idIncautamiento'])) {
                    $bandera = true;
                }

                if (!preg_match('/^[0-9]+$/', $_GET['idUser'])) {
                    $bandera = true;
                }


                if ($bandera == false) {

                    $tabla = "incautar_activo";
                    $datos = array(
                        'idIncautamiento' => $_GET['idIncautamiento'],
                        'idUser'          => $_GET['idUser']
                    );

                    $datosEmail = array(
                        'idfun' => $_GET['idPropiet'],
                        'placa'         => $_GET['placa'],
                        'nombre'        => $_SESSION['nombre'],
                        'foto'          => $_SESSION['foto']
                    );

                    $respuesta = ModeloIncautarActivo::mdlDevolverActivo($tabla, $datos);

                    if ($respuesta > 0) {
                        ControladorHelpers::ctrProceso_envioCorreo($datosEmail, 'DEVUELTO ACTIVO INCAUTADO POR', 'Te han devuelto un activo incautado','','w');
                        ControladorMensajes::msj_Swal('', 'El activo ahora esta en proceso de devolución, por lo que hay que esperar a que el propietario lo acepte.', 's', 'window.location = "incautarActivo";');
                    } else {
                        ControladorMensajes::msj_Swal('Error', 'Error al intentar devolver el activo', 'e', 'window.location = "incautarActivo";');
                    }
                }
            }
        } catch (Error $e) {
        }
    }



    // ====================================================== //
    // ================= NUEVO ENCAUTAMIENTO ================ //
    // ====================================================== //
    static public function ctrNuevoIncautamiento()
    {
        $tabla = "incautar_activo";

        $datos = array(
            'activo'     => $_POST['txt_codigoPlaca_mEA'],
            'incautador' => $_POST['iduser'],
            'observacion' => $_POST['txt_Observaciones_mEA']
        );

        //  $activoIncautado = ModeloIncautarActivo::mdlVerificarEquipoDisponible($tabla, 'incautador_ea', $_POST['iduser'] );
       
        $datosEmail = array(
            'idfun' => $_POST['idFunReceptor_mIA'],
            'placa' => $_POST['placa_mIA'],
            'nombre'=> $_SESSION['nombre'],
            'foto'  => $_SESSION['foto']
        );

        $respuesta = ModeloIncautarActivo::mdlNuevoIncautamiento($tabla, $datos);

        if ($respuesta > 0) {
           ControladorHelpers::ctrProceso_envioCorreo($datosEmail, 'ACTIVO INCAUTADO POR', 'Te han incautado un activo', '', 'w');
            ControladorMensajes::msj_sweetalert('', '¡Registro exitoso!', 's', 'window.location = "incautarActivo";');
        } else {

            ControladorMensajes::msj_sweetalert('Error', '¡Error al intentar registrar los datos!', 'e', 'window.location = "incautarActivo";');
        }

        //return $respuesta;
    }


    // ====================================================== //
    // ==================== VALIDAR DATOS =================== //
    // ====================================================== //
    static public function ctrValidarDatos()
    {
        try {
            $bandera = false; //Si es false es por que hay algun inconveniente

            if (isset($_POST['btnGuardarIncautamiento'])) {
                $bandera = true;

                if (!isset($_POST['txt_codigoPlaca_mEA']) || empty($_POST['txt_codigoPlaca_mEA'])) {
                    $bandera = false;
                }

                if (!isset($_POST['iduser']) || empty($_POST['iduser'])) {
                    $bandera = false;
                }

                //Solo permite numeros, letras, comas, puntos y espacios
                if (!empty($_POST['txt_Observaciones_mEA'])) {
                    if (!preg_match("/^[a-zA-Z0-9\s,.]+$/u", $_POST['txt_Observaciones_mEA'])) {
                        $bandera = false;
                    }
                }
            }

            return $bandera;
        } catch (\Throwable $th) {
        }
    }


    // ====================================================== //
    // ============== VERIFICAR DISPONIBILIDAD ============== //
    // ====================================================== //
    /**
     * Pasa como parametro el codigo del activo para verificar si el mismo esta encautado o no
     *
     * @param [string] $valor
     * @return void
     */
    static public function ctrVerificarDisponibilidad($valor)
    {
        $tabla = "incautar_activo";
        $item = "activo_ea";

        $respuesta = ModeloIncautarActivo::mdlVerificarEquipoDisponible($tabla, $item, $valor);

        return $respuesta;
    }



    static public function ctrActivosIncautados($item, $valor)
    {
        try {
            $tabla = "incautar_activo";

            $respuesta = ModeloIncautarActivo::mdlActivosIncautados($tabla, $item, $valor);

            return $respuesta;
        } catch (\Throwable $e) {
        }
    }
}
