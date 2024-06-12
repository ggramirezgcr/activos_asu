<?php
session_start();

// Establecer tiempo de vida de la sesión en segundos
$inactividad = 600;
// Comprobar si $_SESSION["timeout"] está establecida
if (isset($_SESSION["timeout"])) {
    // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactividad) {
        session_destroy();
        header("Location: ingreso");
    }
}
// El siguiente key se crea cuando se inicia sesión
$_SESSION["timeout"] = time();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCA</title>

    <link rel="shortcut icon" href="../vistas/img/ico/box.ico" type="image/x-icon">


    <!--// ~~~~~~~~~~~~~~~ ESTILOS ~~~~~~~~~~~~~~~ //-->
    <?php
    include_once "modulos/includes/estilosInclude.php";
    ?>

    <!--// ~~~~~~~~~~~~~~~~~~ JS ~~~~~~~~~~~~~~~~~ //-->
    <?php

    ?>

</head>


<!--sidebar-collapse-->

<?php

if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == 'ok') {

    //echo '<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed">';
    //echo '<body class="sidebar-mini layout-navbar-fixed layout-fixed sidebar-collapse">';
    echo '<body class="control-sidebar-slide-open layout-navbar-fixed layout-fixed" style="height: auto;">';

    // - <!-- Site wrapper -->  //
    echo  '<div class="wrapper">';

    // ~~~~~~~~~~~~~~~ SPINER ~~~~~~~~~~~~~~ //
    include "modulos/spiner.php";

    // ~~~~~~~~~~~~~~~ CABEZOTE ~~~~~~~~~~~~~~ //
    include "modulos/cabezote.php";

    // ~~~~~~~~~~~~~~~~~ MENU ~~~~~~~~~~~~~~~~ //
    include "modulos/menu.php";

    // ~~~~~~~~~~~~~~ CONTENIDO ~~~~~~~~~~~~~~ //

    if (isset($_GET["ruta"])) {
        if (
            $_GET["ruta"] == "inicio" ||
            $_GET["ruta"] == "usuarios" ||
            $_GET["ruta"] == "categorias" ||
            $_GET["ruta"] == "productos" ||
            $_GET["ruta"] == "cleintes" ||
            $_GET["ruta"] == "ventas" ||
            $_GET["ruta"] == "activos" ||
            $_GET["ruta"] == "misactivos" ||
            $_GET["ruta"] == "solicitudesEnviadas" ||
            $_GET["ruta"] == "solicitudesRecibidas" ||
            $_GET["ruta"] == "solicitudesDevueltas" ||
            $_GET["ruta"] == "incautarActivo" ||
            $_GET["ruta"] == "misActivosIncautados" ||
            $_GET["ruta"] == "acti" ||
            $_GET["ruta"] == "funcionarios" ||
            $_GET["ruta"] == "marcasActivos" ||
            $_GET["ruta"] == "salir"
        ) {

            include "modulos/" . $_GET["ruta"] . ".php";
            require_once "vistas/modulos/modal/modalLoading.php";
            require_once "vistas/modulos/modal/modal.php";
           

            // ##################################################################### //
            // ################### // - <!--Incluir los js-->  // ################## //
            // ##################################################################### //

            // ~ Estos scrip siempre se van a ocupar ~ //
            include_once "modulos/includes/script_plugins.php";

            echo '<script src="vistas/js/mensaje.js"></script>';
            echo '<script src="vistas/js/modalConfiguraciones.js"></script>';
            echo '<script src="vistas/js/activos.js"></script>';

            //  Incluimos el script de acuerdo a si se necesita  //
            switch ($_GET["ruta"]) {

                case 'inicio':
                    echo '<script src="vistas/js/inicio.js"></script>';
                    echo '<script src="vistas/js/funcionarios.js"></script>';
                    break;
                case 'usuarios':
                    echo '<script src="vistas/js/usuarios.js"></script>';
                    echo '<script src="vistas/js/funcionarios.js"></script>';
                    break;

                case 'activos':
                    //  echo '<script src="vistas/js/activos.js"></script>';
                    break;

                case 'misactivos':
                    echo '<script src="vistas/js/misactivos.js"></script>';
                    break;

                case 'solicitudesEnviadas':
                    echo '<script src="vistas/js/usuarios.js"></script>';
                    echo '<script src="vistas/js/funcionarios.js"></script>';
                    echo '<script src="vistas/js/solicitudes.js"></script>';
                    echo '<script src="vistas/js/modalPrestarActivo.js"></script>';
                    // echo '<script src="vistas/js/activos.js"></script>';
                    break;

                case 'solicitudesRecibidas':
                    echo '<script src="vistas/js/solicitudesRecibidas.js"></script>';
                    echo '<script src="vistas/js/modalEnviarSolicitud.js"></script>';
                    break;

                case 'solicitudesDevueltas':
                    echo '   <script src="vistas/js/solicitudesDevueltas.js"></script>';
                    break;

                case 'incautarActivo':
                    echo '<script src="vistas/js/modalIncautarActivo.js"></script>';
                    echo '<script src="vistas/js/incautarActivo.js"></script>';

                    break;

                case 'misActivosIncautados':
                    echo '<script src="vistas/js/misActivosIncautados.js"></script>';

                    break;

                case 'funcionarios':
                    require_once "vistas/modulos/modal/modalNuevoFuncionario.php";
                    echo '<script src="vistas/js/funcionarios.js"></script>';
                    echo '<script src="vistas/js/funcionariosModulo.js"></script>';
                    echo '<script src="vistas/js/modalNuevoFuncionario.js"></script>';

                    break;

                case 'marcasActivos':
                    echo '<script src="vistas/js/marcasModulo.js"></script>';
                    

                    break;

                default:
                    break;
            } // ----- /. fin swtch ----- //

            //  Script que siempre se usan pero se agregan al final por orden  //

            echo '<script src="vistas/js/modalConsultarActivo.js"></script>';
            echo '<script src="vistas/plugins/jsQR/jsQR.js"></script>';
            echo '<script src="vistas/js/modalLeerQR.js"></script>';
            echo '<script src="vistas/js/scanQR.js"></script>';
        } else {
            include "modulos/404.php";
            include_once "modulos/includes/script_plugins.php";
        }
    } else {
        include "modulos/inicio.php";
        
        include_once "modulos/includes/script_plugins.php";
        
        echo '<script src="vistas/js/inicio.js"></script>';

        // ~ Estos scrip siempre se van a ocupar ~ //
        echo '<script src="vistas/js/activos.js"></script>';
        echo '<script src="vistas/js/mensaje.js"></script>';
        echo '<script src="vistas/js/modalConfiguraciones.js"></script>';
        echo '<script src="vistas/js/modalConsultarActivo.js"></script>';
        echo '<script src="vistas/plugins/jsQR/jsQR.js"></script>';
        echo '<script src="vistas/js/modalLeerQR.js"></script>';
        echo '<script src="vistas/js/scanQR.js"></script>';
    }

    echo '</div>';
    // -- <!-- ./wrapper --> -- //


} else {
    echo '<body class="hold-transition sidebar-mini sidebar-collapse login-page">';
    include "modulos/login.php";
    // include_once "modulos/includes/script_plugins.php";
}

?> <!--/. -->


</body>

</html>