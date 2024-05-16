<?php 

include __DIR__.'/vendor/autoload.php';
use Zxing\QrReader;


class decode_qr
{
   static public function leerInfoQR() {
        
       // $rutaImgTemp = $_FILES['qrimage']['tmp_name'];
       // $nuevoNombre = 'qr.png';
       // $rutaTemp = sys_get_temp_dir()."/".$nuevoNombre;
       // $text= '';
       // if (move_uploaded_file($rutaImgTemp, $rutaTemp)) {
        
        $rutaTemp = "C:\Users\Gerald Ramírez\AppData\Local\Temp\qr.png";
        
        $qrcode = new QrReader($rutaTemp);
        $text = $qrcode->text();

        return $text;
    }
}





