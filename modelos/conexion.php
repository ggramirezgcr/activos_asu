<?php

class Conexion
{
    static public function conectar()
    {
        try {
            $config = [
                'host' => 'localhost',
                'dbname' => 'asusistema',
                'usuario' => 'root',
                'contrasena' => 'cogualco',
                'charset' => 'utf8'
            ];

            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
            $opciones = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false];
            $link = new PDO($dsn, $config['usuario'], $config['contrasena'], $opciones);

            $link->exec("set names {$config['charset']}");

            return $link;
        } catch (PDOException $e) {
            // Manejar errores de conexión aquí
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}

