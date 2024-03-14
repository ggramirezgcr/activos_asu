<?php
if (isset($_SESSION['id'])) {
  $idUsarioLogueado = $_SESSION['id'];
}

if (isset($_SESSION['usuario'])) {
  $usuario = $_SESSION['usuario'];
}

if (isset($_SESSION['foto'])) {
  $fotoActual = $_SESSION['foto'];
} else {
  $fotoActual = null;
}

require_once "vistas/modulos/modal/modalConfiguraciones.php";

//Comprobar si se cargo una imagen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_FILES['editarFoto_config'])) {
    $guardarFoto = new ControladorUsuarios();

    $datos = [
      "id" => $idUsarioLogueado,
      "usuario" => $usuario,
      "fotoActual" => $fotoActual
    ];
    $guardarFoto->ctrGuardarFoto($datos);
  }
}

?>

<!--// ====================================================== //
      // =================== CABEZOTE Navbar ================== //
      // ====================================================== //-->
<nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">

  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="" class="nav-link"><i class="fa fa-home" aria-hidden="true"></i> </a>     
    </li>

    <li class="nav-item d-none d-sm-inline-block">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button" data-toggle="modal" data-target="#modalConsultarActivo">
          <i class="fas fa-search"></i> Consultar activo
        </a>
    </li>

  </ul>

  <!--------------------------------------------------------------------->
  <!-- MENU DERECHO -->

  <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">

      <!--//  BOTON CONFIG GENERAL DEL USUARIO  //-->
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user"></i>
      </a>

      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">

        <!--// ~~~~ <!~~ITEM FOTO Y NICK DE USUARIO~~> ~~~~ //-->
        <span class="dropdown-header bg-navy">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="media justify-content-center text-center">
              <?php

              if ($_SESSION['foto'] != "") {
                echo '<img src="' . $_SESSION['foto'] . '" class="img-size-50 mr-3 img-circle" id="imagenPreview" alt="User Image" >';
              } else {
                echo '<img src="vistas\img\usuario\default\profile.png" class="img-size-50 mr-3 img-circle" id="imagenPreview" alt="User Image" >';
              }

              ?>

            </div>


            <input type="file" class="nuevaFoto" accept="image/*" name="editarFoto_config" id="editarFoto_config" onchange="this.form.submit()" style="display: none">
          </form>


          <h5 class="justify-content-center"><?= $_SESSION['usuario']; ?></h5>
        </span>


        <!--// ~~~~~~~~~ ITEM CONFIGURACIONES ~~~~~~~~ //-->
        <div class="dropdown-divider"></div>
        <a href="" class="dropdown-item " iduser="<?php echo $idUsarioLogueado; ?>" id="itemConfigPrinc" data-toggle="modal" data-target="#modalConfiguraciones"><i class="fas fa-cog"></i> Cambiar contraseña</a>
        <!-- <input type="hidden" name="" id="iduser" value="<?php echo $idUsarioLogueado; ?>">-->

        <!--// ~~~~~~~~~~~~~~ ITEM SALIR ~~~~~~~~~~~~~ //-->
        <div class="dropdown-divider"></div>
        <a href="salir" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Salir</a>

      </div>


    </li>

  </ul> <!-- /. menu derecho-->
</nav>
<!-- /.navbar -->