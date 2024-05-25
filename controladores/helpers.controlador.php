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
                        body {
                            font-family: Arial, sans-serif; /* Usar una fuente más común */
                            background-color: #f7fafc;
                            margin: 0;
                            padding: 0;
                        }

                        .contenedor {
                            width: 100%;
                            padding: 30px;
                            background-color: #f7fafc;
                        }

                        .card {
                            width: 400px;
                            background-color: #231e39;
                            color: #b3b8cd;
                            margin: 0 auto;
                            text-align: center; /* Centrar el contenido de la tarjeta */
                        }

                        .Position {
                            font-size: 1rem;
                            background-color: #87f33f;
                            padding: 10px;
                            color: #231e39;
                            margin-bottom: 10px;
                            display: inline-block; /* Para asegurar que el margen funcione */
                        }

                        .card__img {
                            height: 120px;
                            width: 120px;
                            border-radius: 50%;
                            border: 2px solid #c101d4;
                            margin-top: 30px;
                        }

                        .img__card {
                            max-width: 100%;
                            height: auto;
                            border-radius: 50%;
                            display: block;
                            margin: 0 auto; /* Centrando la imagen */
                        }

                        .btn__msj {
                            border: 2px solid #c400d7;
                            text-decoration: none;
                            color: #f2f2f2;
                            padding: 10px 20px;
                            font-size: 0.9rem;
                            background-color: #c400d7;
                            display: inline-block;
                            margin-top: 25px;
                        }

                        .card__out {
                            width: 100%;
                            background-color: #1f1a36;
                            padding: 20px 0px;
                            margin-top: 20px;
                        }

                        .text__skill__card {
                            font-size: 0.9rem;
                        }

                        .skills__card {
                            padding: 10px 15px;
                        }

                        h3 {
                            font-weight: 300;
                            font-size: .7rem;
                            padding: 3px;
                            border: 1px solid #403a5a;
                        }
                    </style>
                </head>
                    <body>
                        <div class="contenedor">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <div class="card">
                                            <div class="card__sup">
                                                <h1 class="Position">' . $titulo . '</h1>
                                                <table align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto; padding: 0;">
                                                    <tr>
                                                        <td align="center" style="padding: 0;">
                                                            <div class="card__img">
                                                                <img src="' . $imagen . '" alt="" class="img__card">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div style="font-size: 1.1rem; font-weight: 550; padding-top: 14px;">' . $nombre . '</div>
                                                <div style="font-size: 0.9rem; padding-top: 4px;">Área de Salud Upala</div>
                                                <div style="font-size: 1rem; text-align: center; padding: 15px 5px 0px; margin: 5px; font-weight: bold;">NÚMERO DE ACTIVO</div>
                                                <div style="font-size: 1.5rem; text-align: center; padding: 0px 50px; color: #febb0b; font-weight: bold;">' . $activo . '</div>
                                                <a href="https://www.stecmacr.com/asupala" class="btn__msj"><span>Revisar</span></a>
                                            </div>
                                            <div class="card__out">
                                                <div class="text__skill__card">Información</div>
                                                <div class="skills__card">
                                                    <h3>El contenido de este email es para uso exclusivo de los funcionarios del área de salud de Upala.</h3>
                                                </div>
                                            </div>
                                        </div>
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
                    body {
                        font-family: Arial, sans-serif; /* Usar una fuente más común */
                        background-color: #f7fafc;
                        margin: 0;
                        padding: 0;
                    }

                    .contenedor {
                        width: 100%;
                        padding: 30px;
                        background-color: #f7fafc;
                    }

                    .card {
                        width: 400px;
                        background-color: #231e39;
                        color: #b3b8cd;
                        margin: 0 auto;
                        text-align: center; /* Centrar el contenido de la tarjeta */
                    }

                    .Position {
                        font-size: 1rem;
                        background-color: #febb0b;
                        padding: 10px;
                        color: #231e39;
                        margin-bottom: 10px;
                        display: inline-block; /* Para asegurar que el margen funcione */
                    }

                    .card__img {
                        height: 120px;
                        width: 120px;
                        border-radius: 50%;
                        border: 2px solid #c101d4;
                        margin-top: 30px;
                    }

                    .img__card {
                        max-width: 100%;
                        height: auto;
                        border-radius: 50%;
                        display: block;
                        margin: 0 auto; /* Centrando la imagen */
                    }

                    .btn__msj {
                        border: 2px solid #c400d7;
                        text-decoration: none;
                        color: #f2f2f2;
                        padding: 10px 20px;
                        font-size: 0.9rem;
                        background-color: #c400d7;
                        display: inline-block;
                        margin-top: 25px;
                    }

                    .card__out {
                        width: 100%;
                        background-color: #1f1a36;
                        padding: 20px 0px;
                        margin-top: 20px;
                    }

                    .text__skill__card {
                        font-size: 0.9rem;
                    }

                    .skills__card {
                        padding: 10px 15px;
                    }

                    h3 {
                        font-weight: 300;
                        font-size: .7rem;
                        padding: 3px;
                        border: 1px solid #403a5a;
                    }
                </style>
            </head>
                <body>
                    <div class="contenedor">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center">
                                    <div class="card">
                                        <div class="card__sup">
                                            <h1 class="Position">' . $titulo . '</h1>
                                            <table align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto; padding: 0;">
                                                <tr>
                                                    <td align="center" style="padding: 0;">
                                                        <div class="card__img">
                                                            <img src="' . $imagen . '" alt="" class="img__card">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div style="font-size: 1.1rem; font-weight: 550; padding-top: 14px;">' . $nombre . '</div>
                                            <div style="font-size: 0.9rem; padding-top: 4px;">Área de Salud Upala</div>
                                            <div style="font-size: 1rem; text-align: center; padding: 15px 5px 0px; margin: 5px; font-weight: bold;">NÚMERO DE ACTIVO</div>
                                            <div style="font-size: 1.5rem; text-align: center; padding: 0px 50px; color: #febb0b; font-weight: bold;">' . $activo . '</div>
                                            <a href="https://www.stecmacr.com/asupala" class="btn__msj"><span>Revisar</span></a>
                                        </div>
                                        <div class="card__out">
                                            <div class="text__skill__card">Información</div>
                                            <div class="skills__card">
                                                <h3>El contenido de este email es para uso exclusivo de los funcionarios del área de salud de Upala.</h3>
                                            </div>
                                        </div>
                                    </div>
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
                    body {
                        font-family: Arial, sans-serif; /* Usar una fuente más común */
                        background-color: #f7fafc;
                        margin: 0;
                        padding: 0;
                    }
            
                    .contenedor {
                        width: 100%;
                        padding: 30px;
                        background-color: #f7fafc;
                    }
            
                    .card {
                        width: 400px;
                        background-color: #231e39;
                        color: #b3b8cd;
                        margin: 0 auto;
                        text-align: center; /* Centrar el contenido de la tarjeta */
                    }
            
                    .Position {
                        font-size: 1rem;
                        background-color: #f33f57;
                        padding: 10px;
                        color: #ffffff;
                        margin-bottom: 10px;
                        display: inline-block; /* Para asegurar que el margen funcione */
                    }
            
                    .card__img {
                        height: 120px;
                        width: 120px;
                        border-radius: 50%;
                        border: 2px solid #c101d4;
                        margin-top: 30px;
                    }
            
                    .img__card {
                        max-width: 100%;
                        height: auto;
                        border-radius: 50%;
                        display: block;
                        margin: 0 auto; /* Centrando la imagen */
                    }
            
                    .btn__msj {
                        border: 2px solid #c400d7;
                        text-decoration: none;
                        color: #f2f2f2;
                        padding: 10px 20px;
                        font-size: 0.9rem;
                        background-color: #c400d7;
                        display: inline-block;
                        margin-top: 25px;
                    }
            
                    .card__out {
                        width: 100%;
                        background-color: #1f1a36;
                        padding: 20px 0px;
                        margin-top: 20px;
                    }
            
                    .text__skill__card {
                        font-size: 0.9rem;
                    }
            
                    .skills__card {
                        padding: 10px 15px;
                    }
            
                    h3 {
                        font-weight: 300;
                        font-size: .7rem;
                        padding: 3px;
                        border: 1px solid #403a5a;
                    }
                </style>
            </head>
            <body>
                <div class="contenedor">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="center">
                                <div class="card">
                                    <div class="card__sup">
                                        <h1 class="Position">' . $titulo . '</h1>
                                        <table align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto; padding: 0;">
                                            <tr>
                                                <td align="center" style="padding: 0;">
                                                    <div class="card__img">
                                                        <img src="' . $imagen . '" alt="" class="img__card">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div style="font-size: 1.1rem; font-weight: 550; padding-top: 14px;">' . $nombre . '</div>
                                        <div style="font-size: 0.9rem; padding-top: 4px;">Área de Salud Upala</div>
                                        <div style="font-size: 1rem; text-align: center; padding: 15px 5px 0px; margin: 5px; font-weight: bold;">NÚMERO DE ACTIVO</div>
                                        <div style="font-size: 1.5rem; text-align: center; padding: 0px 50px; color: #febb0b; font-weight: bold;">' . $activo . '</div>
                                        <a href="https://www.stecmacr.com/asupala" class="btn__msj"><span>Revisar</span></a>
                                    </div>
                                    <div class="card__out">
                                        <div class="text__skill__card">Información</div>
                                        <div class="skills__card">
                                            <h3>El contenido de este email es para uso exclusivo de los funcionarios del área de salud de Upala.</h3>
                                        </div>
                                    </div>
                                </div>
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
