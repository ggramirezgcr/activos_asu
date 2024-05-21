
<?php


class ControladorUsuarios
{
    // ----------------------------------------------------------------------------FRM LOGIN //

    // ====================================================== //
    // =================== INGRESO USUARIO ================== //
    // ====================================================== //
    static public function ctrIngresoUsuario()
    {
        if (isset($_POST['ingUsuario'])) {

            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])
            ) {
                $tabla = "usuarios";
                $item = "usuario";
                $valor = $_POST['ingUsuario'];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if (is_array($respuesta) && isset($respuesta['usuario'])) {

                    $encriptar = crypt($_POST['ingPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    // $encriptar = $_POST['ingPassword'];

                    if (
                        $respuesta['usuario'] == $_POST['ingUsuario'] &&
                        $respuesta['password'] == $encriptar
                    ) {
                        if ($respuesta['estado'] == 1) {

                            // ~~~~~ CREAMOS VARIABLES DE SESSION ~~~~ //
                            $_SESSION['iniciarSesion'] = 'ok';
                            $_SESSION['id'] = $respuesta['id'];
                            $_SESSION['nombre'] = $respuesta['nombre'];
                            $_SESSION['usuario'] = $respuesta['usuario'];
                            $_SESSION['foto'] = $respuesta['foto'];
                            $_SESSION['perfil'] = $respuesta['perfil'];
                            $_SESSION['secuestra_activos'] = $respuesta['secuestra_activos'];

                            //  REGISTRAR FECHA PARA SABER EL ULTIMO LOGIN  //

                            date_default_timezone_set("America/Costa_Rica"); //Establecer zona horaria
                            $fecha = date('Y-m-d'); //Fecha actual
                            $hora = date('H:i:s');

                            $fechaActual = $fecha . " " . $hora;

                            $item1 = "ultimo_login";
                            $valor1 = $fechaActual;

                            $item2 = "id";
                            $valor2 = $respuesta["id"];

                            $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                            if ($respuesta == 'ok') {

                                echo '<script>
    
                                    window.location = "inicio";
    
                                     </script>';
                            }
                        } else {
                            echo '<script>
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": true,
                                        "positionClass": "toast-top-full-width",
                                        "preventDuplicates": true,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    }

                                toastr["error"]("¡La cuenta del usuario se encuentra desactivada!.", "Usuario desactivado.")

                                </script>';
                        }
                    } else {

                        echo '<script>
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-full-width",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                    toastr["error"]("¡Usuario o contraseña incorrecta!.", "Error.")

                    </script>';
                    }
                } else {
                    echo '<script>
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-full-width",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                    toastr["error"]("¡Usuario o contraseña incorrecta!.", "Error.")

                    </script>';
                }
            }
        }
    }


    // ====================================================== //
    // =================== OBTENER USUARIO LOGUEADO========== //
    // ====================================================== //
    /**
     * Devuelve un objeto json con el ID del usuario logueado
     *
     * @return void
     */
    static public function ctrUsuarioLogueado()
    {
        session_start();
        if (isset($_SESSION['id'])) {
            $idUsuario = $_SESSION['id'];
            return ['nIdUsuario' => $idUsuario];
        } else {
            return ['nIdUsuario' => null];
        }
    }



    // ====================================================== //
    // ================= LISTADO DE USUARIOS ================ //
    // ====================================================== //
    static public function ctrMostrarUsuarios($item, $valor)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }



    // ====================================================== //
    // ================= LISTADO DE USUARIOS ================ //
    // ====================================================== //
    /**
     * Caompara el password
     *
     * @param [type] $valor
     * @param [type] $valor2
     * @return void
     */
    static public function ctrComparaPass($valor, $valor2)
    {

        $tabla = "usuarios";
        $item_ = "id";
        $valor_ = $valor;
        $item2 = "password";
        $valor2_ = crypt($valor2, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $respuesta = ModeloUsuarios::mdlComparaPass($tabla, $item_, $valor_, $item2, $valor2_);

        return $respuesta;
    }




    // ====================================================== //
    // ================== REGISTRO USUARIO ================== //
    // ====================================================== //
    static public function ctrCrearUsuario()
    {

        if (isset($_POST['nuevoUsuario'])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoNombre']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoUsuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPassword']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPerfil'])
            ) {

                $ruta = "";

                // ~~~~~~~~~~~~ VALIDAR IMAGEN ~~~~~~~~~~~ //



                if (
                    isset($_FILES["nuevaFoto"]["tmp_name"]) &&
                    $_FILES["nuevaFoto"]["tmp_name"] != ""
                ) {
                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // ~ DIRECTORIO DONDE GUARDAMOS LA IMAGEN  //
                    $directorio = "vistas/img/usuario/" . $_POST['nuevoUsuario'];

                    if (!is_dir($directorio)) {
                        mkdir($directorio, 0755);
                    }


                    //  DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO  //
                    if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {
                        // ~ GUARDAMOS LA IMAGEN EN EL DIRECTORIO  //
                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/usuario/" . $_POST['nuevoUsuario'] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["nuevaFoto"]["type"] == "image/png") {
                        // ~ GUARDAMOS LA IMAGEN EN EL DIRECTORIO  //
                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/usuario/" . $_POST['nuevoUsuario'] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";

                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array(
                    "id"       => $_POST['cmbfuncionarios'],
                    "nombre"   => $_POST["nuevoNombre"],
                    "usuario"  => $_POST["nuevoUsuario"],
                    "password" => $encriptar,
                    "perfil"   => $_POST["nuevoPerfil"],
                    "foto"     => $ruta,
                    "estado"   => 1,
                    "email"    => $_POST["nuevoEmail"]
                );

                $respuesta = ModeloUsuarios::mdlIngresarUSuario($tabla, $datos);

                if ($respuesta == 'ok') {
                    echo '<script>
                Swal.fire({
                    icon: "success",
                    text: "¡El usuario ha sido guardado!"
                  }).then((result)=>{
                    if(result.value){
                        window.location = "usuarios";
                    }
                    });
                    </script>';

                    //Enviar correo
                    $body = self::htmlBodyUsuario($_POST["nuevoNombre"], $_POST["nuevoUsuario"], $_POST["nuevoPassword"], 'USUARIO CREADO');
                    ControladorEmail::ctrEnviarEmail('Usuario creado', $_POST["nuevoEmail"], $body );
                }
            } else {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "El usuario no puede ir vacio o llevar caracteres especiales!",
                   
                  }).then((result)=>{
                    if(result.value){
                        window.location = "usuarios";
                    }
                    });
                    </script>';
            }
        }
    }


    // ====================================================== //
    // =================== EDITAR USUARIO =================== //
    // ====================================================== //
    static function ctrEditarUsuario()
    {

        if (isset($_POST['editarUsuario'])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarNombre'])) {

                $ruta = $_POST['fotoActual'];

                // ~~~~~~~~~~~~ VALIDAR IMAGEN ~~~~~~~~~~~ //

                if (
                    isset($_FILES["editarFoto"]["tmp_name"]) &&
                    $_FILES["editarFoto"]["tmp_name"] != ""
                ) {
                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // ~ DIRECTORIO DONDE GUARDAMOS LA IMAGEN  //
                    $directorio = "vistas/img/usuario/" . $_POST['editarUsuario'];

                    //  PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD  //
                    if (!empty($_POST['fotoActual'])) {

                        unlink($_POST['fotoActual']);
                    } else {

                        if (!is_dir($directorio)) {
                            mkdir($directorio, 0755);
                        }
                    }



                    //  DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO  //
                    if ($_FILES["editarFoto"]["type"] == "image/jpeg") {
                        // ~ GUARDAMOS LA IMAGEN EN EL DIRECTORIO  //
                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/usuario/" . $_POST['editarUsuario'] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editarFoto"]["type"] == "image/png") {
                        // ~ GUARDAMOS LA IMAGEN EN EL DIRECTORIO  //
                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/usuario/" . $_POST['nuevoUsuario'] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "El usuario no puede ir vacio o llevar caracteres especiales!",
                       
                      }).then((result)=>{
                        if(result.value){
                            window.location = "usuarios";
                        }
                        });
                        </script>';
            }

            $tabla = "usuarios";

            if ($_POST['editarPassword'] != "") {

                if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarPassword'])) {

                    $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                } else {
                    echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "La contraseña no puede llevar espacios o caracteres especiales!",
                       
                      }).then((result)=>{
                        if(result.value){
                            window.location = "usuarios";
                        }
                        });
                        </script>';
                }
            } else {
                $encriptar = $_POST['passwordActual'];
            }

            $datos =  array(
                "nombre" => $_POST['editarNombre'],
                "usuario" => $_POST['editarUsuario'],
                "password" => $encriptar,
                "perfil" => $_POST['editarPerfil'],
                "foto" => $ruta
            );

            $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire({
                    icon: "success",
                    text: "¡El usuario ha sido modificado!"
                  }).then((result)=>{
                    if(result.value){
                        window.location = "usuarios";
                    }
                    });
                    </script>';
            } else {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Se ha producido un error al intentar editar los datos!",
                   
                  }).then((result)=>{
                    if(result.value){
                        window.location = "usuarios";
                    }
                    });
                    </script>';
            }
        }
    }


    // ====================================================== //
    // ===================== EDITAR PASS ==================== //
    // ====================================================== //
    public function ctrEditarPass()
    {
        try {

            $tabla = "usuarios";
            $encriptar = crypt($_POST['nuevaPassword_config'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');


            $datos = array(
                "password" => $encriptar,
                "id" => $_POST['iduser']
            );

            $respuesta = ModeloUsuarios::mdlEditarPassword($tabla, $datos);

            if ($respuesta == 'ok') {
                ControladorMensajes::msj_sweetalert('', '¡Dato actualizado!', 's', 'window.location = "inicio";');
            } else {
                ControladorMensajes::msj_sweetalert('', '¡Algo salio mal!', 'e', 'window.location = "inicio";');
            }
        } catch (Exception $e) {
        }
    }


    // ====================================================== //
    // ================ EDITAR IMAGEN USUARIO =============== //
    // ====================================================== //

    static public function ctrEditarImagenUsuario($item, $valor)
    {
        $tabla = "";

        // ~~~~~~~~~~~~ VALIDAR IMAGEN ~~~~~~~~~~~ //



    }





    // ====================================================== //
    // ================== ELIMINAR USUARIO ================== //
    // ====================================================== //
    public static function ctrBorrarUsuario()
    {

        if (isset($_GET['idUsuario'])) {
            $tabla = 'usuarios';
            $datos = $_GET["idUsuario"];

            if ($_GET["fotoUsuario"] != "") {
                $fotoUsuario = $_GET['fotoUsuario'];
                 $directorio = rtrim(dirname($_GET['fotoUsuario']), DIRECTORY_SEPARATOR)  ;
                //Validar si archivo existe
                if (file_exists($fotoUsuario)) {
                    if (unlink($fotoUsuario)) {
                      //Comprobar directorio
                        if (is_dir($directorio)) {
                        rmdir($directorio);
                       }
                    }
                }
                
              //  unlink($_GET["fotoUsuario"]);
              //  rmdir('vistas/img/usuarios/' . $_GET["usuario"]);
            }

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire({
                    title: "¡Usuario eliminado!",
                    text: "El usuario ha sido eliminado correctamente.",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Cerrar"
                  }).then((result) => {
                    if (result.isConfirmed) {
                
                      window.location = "usuarios";         
                     
                    }
                  })
                </script>';
            }
        }
    }



    // ====================================================== //
    // ============= VALIDAR DATOS NUEVO USUARIO ============ //
    // ====================================================== //
    static public function ctrValidarDatosNuevoUsuario()
    {

        if (isset($_POST['submitNuevoUsuario'])) {

            #Validar que el usuario seleecione algun funcionario
            if (isset($_POST['cmbfuncionarios'])) {
                if ($_POST['cmbfuncionarios'] == 0) {
                    $errores[] = "Error";
                    self::ctrMostrarMensaje("Debe seleccionar un funcionario", "Error");
                }
            } else {
                $errores[] = "Error";
                self::ctrMostrarMensaje("Debe seleccionar un funcionario", "Error");
            }


            #Validar que el usuario soo se registre una vez
            if (isset($_POST['nuevoUsuario'])) {

                $tabla = "usuarios";
                $item = "usuario";
                $valor = $_POST['nuevoUsuario'];

                $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                if (!empty($respuesta)) {
                    $errores[] = "Usuario ya se encuentra registrado.";
                    self::ctrMostrarMensaje("Usuario ya se encuentra registrado.", "Error");
                }
            } else {
                $errores[] = "Campo de usuario sin completar";
            }


            #Validar el perfil del usuario
            if (empty($_POST["nuevoPerfil"])) {
                $errores[] = "Debe seleccionar un perfil de usuario.";
                self::ctrMostrarMensaje("Debe seleccionar un perfil de usuario.", "Error en el perfil");
            }

            #validar email
            if (empty($_POST['nuevoEmail'])) {
                if (!filter_var($_POST['nuevoEmail'], FILTER_VALIDATE_EMAIL)) {
                    $errores[] = "Email incorrecto";
                    self::ctrMostrarMensaje("Formato de correo no valido", 'Error');
                }
            }


            #Validar la contraseña
            if (empty($_POST['nuevoPassword'])) {
                $errores[] = "Contraseña incorrecta";
                self::ctrMostrarMensaje("La contraseña es incorrecta.", "Error en contraseña");
            }


            if (empty($errores)) {
                return true; #Hay errores
            } else {
                return false;
            }
        }
    }



    // ====================================================== //
    // ============= VALIDAR DATOS NUEVO USUARIO ============ //
    // ====================================================== //
    static public function ctrValidarDatosEditarUsuario()
    {
        if (isset($_POST['submitEditarUsuario'])) {

            //Validar contraseña
            if (!isset($_POST['editarPassword'])) {
                $errores[] = "Error contraseña";
                self::ctrMostrarMensaje("Debe ingresar una contraseña correcta", "Error");
            }


            #Validar el perfil del usuario
            if (isset($_POST["nuevoPerfil"])) {
                $errores[] = "Debe seleccionar un perfil de usuario.";
                self::ctrMostrarMensaje("Debe seleccionar un perfil de usuario.", "Error en el perfil");
            }


            if (empty($errores)) {
                return true; #Hay errores
            } else {
                return false;
            }
        }
    }



    // ====================================================== //
    // =============  ============ //
    // ====================================================== //

    static public function ctrValidarDatosConfig()
    {


        if (isset($_POST['submitEditarUsuarioConfig'])) {


            $bolCambios = false;
            $patron = '/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*(),.?":{}|<>])(?=\S+$).{8,}$/';

            #Validar la nueva contraseña
            if (!empty($_POST['nuevaPassword_config'])) {
                $nuevaPass = $_POST['nuevaPassword_config'];

                if (!$nuevaPass == "") {

                    if (!strlen($nuevaPass) >= 6) {
                        $errores[] = true;
                        self::ctrMostrarMensaje("La contraseña debe tener mas de 6 caracteres.", "Contraseña no cumple");
                    } elseif (preg_match($patron, $nuevaPass)) {
                        $errores[] = true;
                        self::ctrMostrarMensaje("Lo contraseña tiene caracteres no permitodos.", "Contraseña no cumple");
                    }



                    #validar la contraseña actual
                    $passActual = $_POST['passwordActual_config'];
                    if (!empty($passActual)) {

                        if (!self::ctrComparaPass($_POST['iduser'], $_POST['passwordActual_config'])) {
                            $errores[] = true;
                            self::ctrMostrarMensaje("Contraseña actual incorrecta.", "Error en contraseña");
                        }
                    } else {
                        $errores[] = true;
                        self::ctrMostrarMensaje("Ingrese la contraseña actual con la que ingresa al sistema.", "Error en contraseña");
                    }
                }
            } else {
                $errores[] = true;
                self::ctrMostrarMensaje("Debe completar el campo correctamente.", "Error en contraseña");
            }


            if (isset($_POST['editarFoto_config'])) {
            }


            if (empty($errores)) {

                return true; #no Hay errores

            } else {
                return false;
            }
        }
    }



    // ====================================================== //
    // ============= MUESTRA MENSAJE AL USUARIO ============ //
    // ====================================================== //
    static public function ctrMostrarMensaje($mensaje, $titulo,  $error = false)
    {
        if ($error == false) {
            echo '<script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        toastr["error"]("' . $mensaje . '.", "' . $titulo . '.")

        </script>';
        } else {
            echo '<script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-full-width",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

        toastr["success"]("' . $mensaje . '.", "' . $titulo . '.")

        </script>';
        }
    }



    // ====================================================== //
    // ==================== GUARDAR FOTO ==================== //
    // ====================================================== //
    static public function ctrGuardarFoto($datos)
    {
        if (isset($_FILES['editarFoto_config'])) {
            $nombreArchivo = $_FILES["editarFoto_config"]["name"];
            $nombreArchivo = $_FILES["editarFoto_config"]["name"];
            $tipoArchivo = $_FILES["editarFoto_config"]["type"];
            $tamanioArchivo = $_FILES["editarFoto_config"]["size"];
            $tempArchivo = $_FILES["editarFoto_config"]["tmp_name"];
            $errorArchivo = $_FILES["editarFoto_config"]["error"];

            list($ancho, $alto) = getimagesize($tempArchivo);

            $nuevoAncho = 500;
            $nuevoAlto = 500;

            // ~ DIRECTORIO DONDE GUARDAMOS LA IMAGEN  //
            $directorio = "vistas/img/usuario/" . $datos["usuario"];

            //  VERIFICAMOS SI EL DIRECTORIO TIENE IMAGENES  //
            if (!is_dir($directorio)) {
                mkdir($directorio, 0755);
            } else {
                //Borrar el contenido de la carpeta
                $archivos = scandir($directorio);
                foreach ($archivos as $archivo) {
                    if ($archivo != "." && $archivo != "..") {
                        $rutaArchivo = $directorio . DIRECTORY_SEPARATOR . $archivo;
                        if (!is_dir($rutaArchivo)) {
                            unlink($rutaArchivo);
                        }
                    }
                }
            }


            //  DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO  //
            if ($tipoArchivo == "image/jpeg") {
                // ~ GUARDAMOS LA IMAGEN EN EL DIRECTORIO  //
                $aleatorio = mt_rand(100, 999);

                $ruta = "vistas/img/usuario/" . $datos["usuario"] . "/" . $aleatorio . ".jpg";

                $origen = imagecreatefromjpeg($tempArchivo);

                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                imagejpeg($destino, $ruta);
            }

            if ($tipoArchivo == "image/png") {
                // ~ GUARDAMOS LA IMAGEN EN EL DIRECTORIO  //
                $aleatorio = mt_rand(100, 999);

                $ruta = "vistas/img/usuario/" . $datos["usuario"] . "/" . $aleatorio . ".png";

                $origen = imagecreatefrompng($tempArchivo);

                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                imagepng($destino, $ruta);
            }

            if ($ruta != "") {
                $tabla = "usuarios";
                $datos = array(
                    "id"   => $datos["id"],
                    "foto" => $ruta
                );

                $respuesta = ModeloUsuarios::mdlEditarImagen($tabla, $datos);

                if ($respuesta == "ok") {
                    $_SESSION["foto"] = $ruta;
                    ControladorMensajes::msj_Swal("", "Imagen actualizada.", "s", 'window.location = "inicio";');
                } else {
                    ControladorMensajes::msj_Swal("", "Error al actualizar imagen.", "e", 'window.location = "inicio";');
                }
            }
        }
    }


    // ====================================================== //
    // ============= SANITIZAR CADENA PARA HTML ============= //
    // ====================================================== //
    /**
     * Devuelve una cadena sanitizada para html
     *
     * @param [string] $valor
     * @return void
     */
    static function sanitizarCadena_paraHTML($valor)
    {
        try {
            return htmlentities($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        } catch (\Throwable $e) {
            return '';
        }
    }

/**
 * Crea el body html del email que se envia 
 *
 * @param string $nombre : Nombre funcionario
 * @param string $usuario : Usuario de red
 * @param string $pass : Contraseña
 * @param string $titulo : Titulo del encabezado
 * @return void
 */
    static function htmlBodyUsuario($nombre, $usuario, $pass, $titulo)
    {
        try {

            $nombre = ControladorHelpers::ctrSanitizarCadena_paraHTML($nombre);
            $titulo = ControladorHelpers::ctrSanitizarCadena_paraHTML($titulo);



            $html = '
            <html>
<head>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Montserrat", sans-serif;
            background-repeat: no-repeat;
            height: 100%; /* Cambiado a altura automática */
            min-height: 100vh; /* Para garantizar que ocupe al menos el 100% del alto de la ventana del navegador */
        }
    </style>
</head>

<body>
    <div class="prueba_cls" style="padding-bottom:80px;margin:0; background-color:#f7fafc">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <section class="contenedor" style="overflow: hidden; border-radius: 10px; padding:30px">
                    <div class="card" style="width: 400px; height:auto; border-radius: 10px; box-shadow: 10px 20px 10px rgba(0, 0, 0, 0.442); background-color: #231e39; color: #b3b8cd;">
                        <div class="card__sup" style="display: flex; flex-direction: column; align-items: center; height: 400px; width: 100%; margin: 30px 0px 20px;">
                            <h1 class="Position" style="display: block; position: relative; font-size: 1rem; background-color: #00b2e6; padding: 10px; border-radius: 9px 0; color: #231e39; top: -20px; left: 0px; margin: 10px 0px 10px">USUARIO CREADO</h1>
                            
                            <div style="font-size: 1.1rem; line-height: normal; font-weight: 550; padding-top: 14px;"   >' . $nombre . '</div>
                            <div style="font-size: 0.9rem; padding-top: 4px;">Are de Salud Upala</div>
                            <div style="font-size: 1rem; text-align: center; padding: 15px 5px 0px; margin: 5px; font-weight: bold;">Usuario </div>
                            <div style="font-size: 1rem; text-align: center; padding: 0px 50px; letter-spacing: 0.8pt; color: #febb0b; font-weight: bold; font-size: 1.5rem; ">'.$usuario.'</div>
                            <div style="display: flex; flex-direction: row; align-items: center; font-size: 0.9rem; padding-top: 4px;"><h3>Contrase&ntildea:</h3><span style="margin-left: 8px; font-size: 0.9rem;">'.$pass.'</span></div>
                            
                            <div class="btns__card" style="height: 40px; margin-top: 25px;">
                                <a href="https://www.stecmacr.com/asupala" class="btn__msj" style="border: 2px solid #c400d7; text-decoration: none; color: #f2f2f2; padding: 10px 20px; font-size: 0.9rem; text-align: center; font-weight: 400; border-radius: 5px; background: #c400d7 !important; ;"><span>Ingresar</span></a>
                            </div>
                        </div>
                        <div class="card__out" style="width: 100%; background-color: #1f1a36; padding: 20px 10px; overflow: hidden; border-radius: 0px 0px 10px 10px">
                            <div class="text__skill__card" style="font-size: 0.9rem; letter-spacing: -0.5pt;">Informaci&oacuten</div>
                            <div class="skills__card" style="padding: 10px 15px; height: 100px; width: 100%;">
                                <h3 style="display: inline-block; font-weight: 300; font-size: .7rem; padding: 3px; margin-top: 5px; margin-right: 3px; border: 1px solid #403a5a;">El contenido de este email es para uso esclusivo de los funcionarios del area de salud de Upala.</h3>
                            </div>
                        </div>
                    </div>
                </section>
            </td>
        </tr>
    </table>
    </div>
</body>

</html>
            ';

            return $html;
        } catch (\Throwable $th) {
        }
    }
}
