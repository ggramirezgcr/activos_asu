<?php

use Zxing\Qrcode\QRCodeReader;
use Zxing\QrReader;


require_once "../vistas/plugins/phpqrcode/phpqrcode.php";
require_once "../vistas/plugins/zxing/decode_qr.php";


class qrAjax
{
    // Función para procesar la imagen QR
    function leerQR($imageData)
    {
        $nuevoNombre = "qr.png";
        $rutaTemp = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $nuevoNombre;
        $rutaTXT = "C:\Users\Gerald Ramírez\AppData\Local\Temp\qr.txt";
        $size = 5;
        

        // Decodificar la imagen base64
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));

        // Guardar la imagen en el directorio temporal
        file_put_contents($rutaTemp, $imageData);

        // Obtener el contenido del código QR
        $qrContent = QRcode::text($rutaTemp);

        QRcode::png($rutaTemp, "QR", $rutaTXT);


        // Eliminar el archivo temporal
        unlink($rutaTemp);

        // Devolver el contenido del código QR
        echo json_encode($qrContent, JSON_FORCE_OBJECT);;
    }

    function leerQR_($imageData)
    {
        $nuevoNombre = "qr.png";
        $rutaTemp = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $nuevoNombre;

        // Decodificar la imagen base64
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));

        // Crear una imagen a partir de los datos
        $image = imagecreatefromstring($imageData);

        // Generar un nombre de archivo temporal único


        // Guardar la imagen como archivo PNG temporal
        imagepng($image, $rutaTemp);

        $rutaTemp = "C:\Users\Gerald Ramírez\AppData\Local\Temp\qr.png";

        // Obtener el contenido del código QR
       // $qrContent = new QrReader($rutaTemp);
       // $text = $qrContent->text();
       
       $qrContent = new decode_qr();
       $text = $$qrContent->leerInfoQR();

        // Liberar la memoria ocupada por el recurso de imagen
        imagedestroy($image);

        // Eliminar el archivo temporal
        unlink($rutaTemp);

        // Devolver el contenido del código QR
        echo json_encode($$text, JSON_FORCE_OBJECT);;
    }
} //. fin clase qrAjax


// ====================================================== //
// ================= LLAMAR A LEER EL QR ================ //
// ====================================================== //
if (isset($_POST['imageData'])) {
    $infoQR = new qrAjax();
    $infoQR->leerQR_($_POST['imageData']);
}
