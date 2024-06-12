<?php

if (isset($_SESSION["perfil"])) {
  if ($_SESSION["perfil"] !== "Administrador") {
    echo '<script>

            window.location = "inicio";

        </script>';
    exit();
  }
}

if (isset($_SESSION['id'])) {
  $idUsarioLogueado = $_SESSION['id'];
}

$devolverActivo = new ControladorIncautarActivo();
$devolverActivo->ctrDevolverActivo();

$ocultarIncautamiento = new ControladorIncautarActivo();
$ocultarIncautamiento->ctrOcultarIncautamiento();
//ControladorMensajes::msj_Swal('', 'Fin del proceso de encautamiento de este activo', 's', '');

?>


<!-- // ====================================================== //
    // ====================== CONTENIDO ===================== //
    // ====================================================== // -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <input type="hidden" name="iduser" value=<?php echo $idUsarioLogueado ?>>
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Funcionarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Funcionarios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- // ~~~~~~~~~ CONTENIDO PRINCIPAL ~~~~~~~~~ // -->
  <section class="content">

    <!-- Default box -->
    <div class="card">

      <!--ENCABEZADO CARD-->
      <div class="card-header">
        <h3 class="card-title">Funcionarios</h3>
      </div>



      <div class="card-header">
        <a id="btnNuevoFuncionario" class="btn btn-app bg-teal" href="#" data-toggle="modal" data-target="#modalNuevoFuncionario">
          <i class="fa fa-plus"></i> Nuevo
        </a>
      </div>


      <!--CUERPO CARD-->
      <div class="card-body">

      <!--row-border table-hover dataTable dtr-inline tablas-->
        <table class="table" id="tabla_Funcionarios">
          <thead>
            <tr>
              <th style="width:10px">ID</th>
              <th>Tipo ID</th>
              <th>Cédula</th>
              <th>Nombre</th>
              <th>Usuario de red</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="contenido_tabla">
           
          </tbody>


        </table>


      </div>
      <!-- /.card-body -->

    </div>
    <!-- /.card -->

  </section>
  <!-- /.CONTENIDO PRINCIPAL -->

  <!-- /.CONTENIDO -->
</div>