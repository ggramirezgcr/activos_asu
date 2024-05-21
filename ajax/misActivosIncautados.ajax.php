<?php

require_once "../controladores/misActivosIncautados.controlador.php";
require_once "../modelos/misActivosIncautados.modelo.php";
require_once "../Controladores/helpers.controlador.php";
require_once "../Controladores/email.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class ajaxClsMisActivosIncautados
{
    public function ajaxAceptarIncautamiento($valor, $valor2)
    {
        //El valor3 tiene el valor para cambiar en la tabla el campo devuelto_ea por 0,1, 2=Este seria un renviar
        $datos = array(
            'idea'        => $valor,
            'respuesta'   => $valor2
        );

        $datosEmail = array(
            'idfun' => $_POST['incautador'],
            'placa' => $_POST['placa'],
            'nombre'=> $_POST['nombre'],
            'foto'  => $_POST['foto']
        );

        $respuesta = ControladormisActivosIncautados::ctrRespuestaIncautamiento($datos, $datosEmail);

        echo json_encode($respuesta, JSON_FORCE_OBJECT);
    } // /. ajaxAceptarIncautamiento

} // /. Fin clase




// ====================================================== //
// ================ ACEPTAR INCAUTAMIENTO =============== //
// ====================================================== //
if (isset($_POST['idIncautamiento'])) {
    if (isset($_POST['aceptarIncaut'])) {
        $aceptarIncautamiento = new ajaxClsMisActivosIncautados();
        $aceptarIncautamiento->ajaxAceptarIncautamiento($_POST['idIncautamiento'], '1');
    }
}


// ====================================================== //
// =============== RECHAZAR INCAUTAMIENTO =============== //
// ====================================================== //
if (isset($_POST['idIncautamiento'])) {
    if (isset($_POST['rechazarIncaut'])) {
        $aceptarIncautamiento = new ajaxClsMisActivosIncautados();
        $aceptarIncautamiento->ajaxAceptarIncautamiento($_POST['idIncautamiento'], '2' );
    }
}
