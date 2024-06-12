<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/funcionario.controlador.php";
require_once "controladores/solicitudes.controlador.php";
require_once "controladores/solicitudesRecibidas.controlador.php";
require_once "controladores/activos.controlador.php";
require_once "controladores/incautarActivo.controlador.php";
require_once "controladores/misActivosIncautados.controlador.php";
require_once "controladores/email.controlador.php";
require_once "controladores/helpers.controlador.php";



require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/funcionarios.modelo.php";
require_once "modelos/solicitudes.modelo.php";
require_once "modelos/solicitudesRecibidas.modelo.php";
require_once "modelos/activos.modelo.php";
require_once "modelos/incautarActivo.modelo.php";
require_once "modelos/misActivosIncautados.modelo.php";
require_once "modelos/configdb.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
