
<?php

require_once __DIR__ .  "../../helpers/phpmailer/PHPMailer.php";
require_once __DIR__ .  "../../helpers/phpmailer/SMTP.php";
require_once __DIR__ . "../../helpers/phpmailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ControladorEmail
{

    // ====================================================== //
    // ==================== ENVIAR CORREO =================== //
    // ====================================================== //
    /**
     * Envia correo electronico
     *
     * @param [string] $asunto = Asunto del mensaje
     * @param [string] $para = Destinatario
     * @param [string] $tipo = a:aceptado verde w:warning amarillo e:error rojo 
     * @return void
     */
    static public function ctrEnviarEmail($asunto, $para, $body, $idReceptor = 0)
    {
        if ($idReceptor > 0) {
            $datosReceptor =  self::ctrDatosReceptor($idReceptor);
            if ($datosReceptor !== null &&  $datosReceptor !== 'error') {
                if (filter_var($datosReceptor['email_usuario'], FILTER_VALIDATE_EMAIL)) {
                    $para = $datosReceptor['email_usuario'];
                }
            }
        }

      //  $asunto = self::ctrSanitizarCadena_paraHTML($asunto);
      if ($para == null && $para == '') {
        return;
      }

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output 0 sin debug / 2 debug
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'asupala@stecmacr.com';                     //SMTP username
            $mail->Password   = 'Qwerty@01';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('asupala@stecmacr.com', 'ASUPALA'); //Quien envia El segundo parametro es el nombre
            $mail->addAddress($para);     //Receptor en el segundo paramaetro va el nombre es opcional

            // Configuración de codificación
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body = $body;

            $mail->send();
            return  true;
        } catch (Exception $e) {
            // echo "Error al enviar: {$mail->ErrorInfo}";
            return false;
        }
    }



    // ====================================================== //
    // ================= DATOS DEL RECEPTOR ================= //
    // ====================================================== //
    static function ctrDatosReceptor($id)
    {
        try {
            $tabla = "usuarios";
            $item = "id";

            $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $id);

            return $respuesta;
        } catch (\Throwable $th) {
            return 'error';
        }
    }



    // ====================================================== //
    // ============= SANITIZAR CADENA PARA HTML ============= //
    // ====================================================== //
    /**
     * Devuelve una cadena sanitizada para html
     *
     * @param string $valor
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
}
