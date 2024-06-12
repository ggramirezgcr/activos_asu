<?php



/**
 * Sanitizar 
 */
class ControladorSanitizar
{

     // Método para sanitizar una cadena de texto
     public static function sanitizarCadena($cadena) {
        $cadena = trim($cadena); // Eliminar espacios al principio y al final
        $cadena = stripslashes($cadena); // Eliminar barras invertidas
        $cadena = htmlspecialchars($cadena, ENT_QUOTES, 'UTF-8'); // Convertir caracteres especiales a entidades HTML
        return $cadena;
    }

    // Método para sanitizar un correo electrónico
    public static function sanitizarEmail($email) {
        $email = trim($email); // Eliminar espacios al principio y al final
        $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Filtrar el correo electrónico
        return $email;
    }

    // Método para sanitizar una URL
    public static function sanitizarURL($url) {
        $url = trim($url); // Eliminar espacios al principio y al final
        $url = filter_var($url, FILTER_SANITIZE_URL); // Filtrar la URL
        return $url;
    }
}
