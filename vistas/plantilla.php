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

    <!--// ====================================================== //
    // ==================== PLUGINS STYLE =================== //
    // ====================================================== //-->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/dist/css/adminlte.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="vistas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="vistas/plugins/toastr/toastr.min.css">

    <!-- main -->
    <link rel="stylesheet" href="vistas/dist/css/main.css">

    <!-- DataTables -->

    <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!--Select2-->
    <link rel="stylesheet" href="vistas/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="vistas/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <!--flatpickr Fechas-->
    <link rel="stylesheet" href="vistas/plugins/flatpickr_/css/flatpickr.min.css">
    <link rel="stylesheet" href="vistas/plugins/flatpickr_/css/material_red.css">



</head>


<!--sidebar-collapse-->

<?php

if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == 'ok') {

    echo '<body class="hold-transition sidebar-mini sidebar-collapse">';

    // - <!-- Site wrapper -->  //
    echo  '<div class="wrapper">';

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
            $_GET["ruta"] == "encautarActivo" ||
            $_GET["ruta"] == "salir"
        ) {

            include "modulos/" . $_GET["ruta"] . ".php";


            // ##################################################################### //
            // ################### // - <!--Incluir los js-->  // ################## //
            // ##################################################################### //
            include_once "modulos/script_plugins.php";

            // ~ Estos scrip siempre se van a ocupar ~ //
            echo '<script src="vistas/js/plantilla.js"></script>';
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

                case 'solicitudesEnviadas':
                    echo '<script src="vistas/js/usuarios.js"></script>';
                    echo '<script src="vistas/js/funcionarios.js"></script>';
                    echo '<script src="vistas/js/solicitudes.js"></script>';
                    // echo '<script src="vistas/js/activos.js"></script>';
                    break;

                case 'solicitudesRecibidas':
                    echo '<script src="vistas/js/solicitudesRecibidas.js"></script>';
                    echo '<script src="vistas/js/modalEnviarSolicitud.js"></script>';
                    break;

                case 'solicitudesDevueltas':
                    echo '   <script src="vistas/js/solicitudesDevueltas.js"></script>';
                    break;

                case 'encautarActivo':
                    echo '<script src="vistas/js/modalEncautarActivo.js"></script>';
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
            include_once "modulos/script_plugins.php";
        }
    } else {
        include "modulos/inicio.php";
        include_once "modulos/script_plugins.php";

        echo '<script src="vistas/js/inicio.js"></script>';

        // ~ Estos scrip siempre se van a ocupar ~ //
        echo '<script src="vistas/js/activos.js"></script>';
        echo '<script src="vistas/js/plantilla.js"></script>';
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
    include_once "modulos/script_plugins.php";
}

echo '</body>';
?> <!--/. -->



<!--</body>-->


</html>