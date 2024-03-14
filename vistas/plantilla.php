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

   
    
    <!--// ====================================================== //
    // ================= PLUGINS JAVASCRIPT ================= //
    // ====================================================== //-->


<!-- jQuery -->
<!--<script src="vistas/plugins/jquery/jquery.min.js"></script>-->
<script src="vistas/plugins/jquery/jquery-3.7.1.min.js"></script>

<!--Select2-->
<script src="vistas/plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.js"></script>

<!-- SweetAlert2 -->
<script src="vistas/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- Toastr -->
<script src="vistas/plugins/toastr/toastr.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="vistas/plugins/jszip/jszip.min.js"></script>
<script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
<script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>

<script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!--moment-->
<script src="vistas/plugins/moment/moment.min.js"></script>
<script src="vistas/plugins/inputmask/jquery.inputmask.min.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>


<!--flatpickr Fechas-->
<script src="vistas/plugins/flatpickr_/js/flatpickr.js"></script>
<script src="vistas/plugins/flatpickr_/js/es.js"></script>

<!--Chart js-->
<script src="vistas/plugins/chart.js/Chart.min.js"></script>

<!--Script propios-->
<script src="vistas/js/inicio.js"></script>
<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/mensaje.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/activos.js"></script>
<script src="vistas/js/funcionarios.js"></script>
<script src="vistas/js/solicitudes.js"></script>
<script src="vistas/js/solicitudesRecibidas.js"></script>
<script src="vistas/js/solicitudesDevueltas.js"></script>
<script src="vistas/js/modalConfiguraciones.js"></script>




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
            $_GET["ruta"] == "salir"
        ) {
            include "modulos/" . $_GET["ruta"] . ".php";
        } else {
            include "modulos/404.php";
        }
    } else {
        include "modulos/inicio.php";
    }

    echo '</div>';
    // -- <!-- ./wrapper --> -- //

} else {
    echo '<body class="hold-transition sidebar-mini sidebar-collapse login-page">';
    include "modulos/login.php";
}
?>



</body>

</html>