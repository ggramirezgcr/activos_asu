<?php


class ControladorHelpers
{

    // ====================================================== //
    // ============== PROCESO DE ENVIAR CORREO ============== //
    // ====================================================== //
    /**
     * Prepara todo lo necesario para el envio del email
     *
     * @param string $datos
     * @param string $titulo_html
     * @param string $asunto
     * @param string $para
     * @param string $tipoMsj : a:verde e:rojo w:amarillo
     * @return void
     */
    static function ctrProceso_envioCorreo($datos, $titulo_html, $asunto, $para, $tipoMsj)
    {
        try {

            //Imagen
            if ($datos['nombre'] !== null) {
                $imagen = "https://localhost/Activos-ASU/" . $datos['foto'];
            } else {
                $imagen = "https://localhost/Activos-ASU/" . "vistas/img/usuario/default/profile.png"; // Corrección en la ruta de la imagen
            }
            //Nombre
            $nombre = $datos['nombre'];

            $body = new ControladorHelpers();
            switch ($tipoMsj) {

                case 'a':
                    $html =  $body->ctrhtmlAceptadas($nombre, $imagen, $titulo_html, $datos['placa']);
                    break;
                case 'e':
                    $html =  $body->ctrhtmlRechazadas($nombre, $imagen, $titulo_html, $datos['placa']);
                    break;
                case 'w':
                    $html =  $body->ctrhtmlPendientes($nombre, $imagen, $titulo_html, $datos['placa']);
                    break;

                default:
                    $html =  $body->ctrhtmlPendientes($nombre, $imagen, $titulo_html, $datos['placa']);
                    break;
            }

            ControladorEmail::ctrEnviarEmail($asunto, $para, $html, $datos['idfun']);
            
        } catch (\Throwable $th) {
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
    static function ctrSanitizarCadena_paraHTML($valor)
    {
        try {
            return htmlentities($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        } catch (\Throwable $e) {
            return '';
        }
    }



    // ====================================================== //
    // ====================== BODY HTML ===================== //
    // ====================================================== //
    /**
     * Crea el body html del email, contiene un titulo de color verde
     *
     * @param string $nombre : funcionario
     * @param string $imagen :
     * @param string $titulo : Titulo del encabezado de la card
     * @param string $activo : Placa del activo
     * @return string
     */
    static function ctrhtmlAceptadas($nombre, $imagen, $titulo, $activo, $idReceptor = 0)
    {
        try {




            $titulo = self::ctrSanitizarCadena_paraHTML($titulo);
            $nombre = self::ctrSanitizarCadena_paraHTML($nombre);


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
                                        <h1 class="Position" style="display: block; position: relative; font-size: 1rem; background-color: #87f33f; padding: 10px; border-radius: 9px 0; color: #231e39; top: -20px; left: 0px; margin: 10px 0px 10px">' . $titulo . '</h1>
                                        <div class="card__img" style="height: 120px; width: 120px; overflow: hidden; border-radius: 50%; padding: 5px; border: 2px solid #c101d4; margin-top: 30px;">
                                            <img src="' . $imagen . '" alt="" class="img__card" style="max-width: 100%; height: auto; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div style="font-size: 1.1rem; line-height: normal; font-weight: 550; padding-top: 14px;"   >' . $nombre . '</div>
                                        <div style="font-size: 0.9rem; padding-top: 4px;">Are de Salud Upala</div>
                                        <div style="font-size: 1rem; text-align: center; padding: 15px 5px 0px; margin: 5px; font-weight: bold;">NUMERO DE ACTIVO </div>
                                        <div style="font-size: 1rem; text-align: center; padding: 0px 50px; letter-spacing: 0.8pt; color: #febb0b; font-weight: bold; font-size: 1.5rem; ">' . $activo . '</div>
                                        <div class="btns__card" style="height: 40px; margin-top: 25px;">
                                            <a href="https://www.stecmacr.com/asupala" class="btn__msj" style="border: 2px solid #c400d7; text-decoration: none; color: #f2f2f2; padding: 10px 20px; font-size: 0.9rem; text-align: center; font-weight: 400; border-radius: 5px; background: #c400d7 !important; ;"><span>Revisar</span></a>
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

    /**
     * Crea el body html del email, contiene un titulo de color Amarillo
     *
     * @param string $nombre : funcionario
     * @param string $imagen :
     * @param string $titulo : Titulo del encabezado de la card
     * @param string $activo : Placa del activo
     * @return string
     */
    static function ctrhtmlPendientes($nombre, $imagen, $titulo, $activo)
    {
        try {

            $titulo = self::ctrSanitizarCadena_paraHTML($titulo);
            $nombre = self::ctrSanitizarCadena_paraHTML($nombre);

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
                                        <h1 class="Position" style="display: block; position: relative; font-size: 1rem; background-color: #febb0b; padding: 10px; border-radius: 9px 0; color: #231e39; top: -20px; left: 0px; margin: 10px 0px 10px">' . $titulo . '</h1>
                                        <div class="card__img" style="height: 120px; width: 120px; overflow: hidden; border-radius: 50%; padding: 5px; border: 2px solid #c101d4; margin-top: 30px;">
                                            <img src="' . $imagen . '" alt="" class="img__card" style="max-width: 100%; height: auto; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div style="font-size: 1.1rem; line-height: normal; font-weight: 550; padding-top: 14px;"   >' . $nombre . '</div>
                                        <div style="font-size: 0.9rem; padding-top: 4px;">Are de Salud Upala</div>
                                        <div style="font-size: 1rem; text-align: center; padding: 15px 5px 0px; margin: 5px; font-weight: bold;">NUMERO DE ACTIVO </div>
                                        <div style="font-size: 1rem; text-align: center; padding: 0px 50px; letter-spacing: 0.8pt; color: #febb0b; font-weight: bold; font-size: 1.5rem; ">' . $activo . '</div>
                                        <div class="btns__card" style="height: 40px; margin-top: 25px;">
                                            <a href="https://www.stecmacr.com/asupala" class="btn__msj" style="border: 2px solid #c400d7; text-decoration: none; color: #f2f2f2; padding: 10px 20px; font-size: 0.9rem; text-align: center; font-weight: 400; border-radius: 5px; background: #c400d7 !important; ;"><span>Revisar</span></a>
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

    /**
     * Crea el body html del email, contiene un titulo de color ROJO
     *
     * @param string $nombre : funcionario
     * @param string $imagen :
     * @param string $titulo : Titulo del encabezado de la card
     * @param string $activo : Placa del activo
     * @return string
     */
    static function ctrhtmlRechazadas($nombre, $imagen, $titulo, $activo)
    {
        try {

            $titulo = self::ctrSanitizarCadena_paraHTML($titulo);
            $nombre = self::ctrSanitizarCadena_paraHTML($nombre);

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
                                        <h1 class="Position" style="display: block; position: relative; font-size: 1rem; background-color: #f33f57; padding: 10px; border-radius: 9px 0; color: #ffffff; top: -20px; left: 0px; margin: 10px 0px 10px">' . $titulo . '</h1>
                                        <div class="card__img" style="height: 120px; width: 120px; overflow: hidden; border-radius: 50%; padding: 5px; border: 2px solid #c101d4; margin-top: 30px;">
                                            <img src="' . $imagen . '" alt="" class="img__card" style="max-width: 100%; height: auto; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div style="font-size: 1.1rem; line-height: normal; font-weight: 550; padding-top: 14px;"   >' . $nombre . '</div>
                                        <div style="font-size: 0.9rem; padding-top: 4px;">Are de Salud Upala</div>
                                        <div style="font-size: 1rem; text-align: center; padding: 15px 5px 0px; margin: 5px; font-weight: bold;">NUMERO DE ACTIVO </div>
                                        <div style="font-size: 1rem; text-align: center; padding: 0px 50px; letter-spacing: 0.8pt; color: #febb0b; font-weight: bold; font-size: 1.5rem; ">' . $activo . '</div>
                                        <div class="btns__card" style="height: 40px; margin-top: 25px;">
                                            <a href="https://www.stecmacr.com/asupala" class="btn__msj" style="border: 2px solid #c400d7; text-decoration: none; color: #f2f2f2; padding: 10px 20px; font-size: 0.9rem; text-align: center; font-weight: 400; border-radius: 5px; background: #c400d7 !important; ;"><span>Revisar</span></a>
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
