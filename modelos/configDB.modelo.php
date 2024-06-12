<?php

class ModeloConfigDB
{

    // ====================================================== //
    // ============ DETALLE USUARIO SOLO LECTURA ============ //
    // ====================================================== //
    /**
     * Funcion que devuelve el detalle del usuario en la bd que deberia tener permiso de solo lectura
     *
     * @return void
     */
    static public function sql_DetallesUsuarioLectura()
    {

        return  $sql_details = [
            'user' => 'root',
            'pass' => 'cogualco',
            'db'   => 'asusistema',
            'host' => 'localhost'
        ];
    }
}
