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
          <h1>Marcas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Marcas</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- // ~~~~~~~~~ CONTENIDO PRINCIPAL ~~~~~~~~~ // -->
  <section class="content">

<div class="row" style="display: flex; justify-content: center;">
  <div class="col-lg-6 col-12">

 <!-- Default box -->
 <div class="card card-outline card-teal">

<!--ENCABEZADO CARD-->
<!--<div class="card-header border-0">
</div>-->



<div class="card-header" style="display: flex; justify-content: center;">

<!--NUEVO-->
  <div class="row" id="rowNuevaMarca" >
    <div class="col-lg-12">

      <div class="card card-teal">
        <div class="card-header">
          <h3 class="card-title">Marca a registrar</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div><!-- /.card-tools -->

        </div><!-- /.card-header -->


        <div class="card-body" style="display: block;">

          <div class="form-group row">

            <label for="txtMarca" class="col-sm-3 col-form-label text-center">Marca</label>
            <div class="col-sm-9">
              <!--<input type="text" class="form-control" id="txtMarca" placeholder="Marca">-->
              <div class="input-group input-group-sm">
                <input type="text" id="txt_Marca" class="form-control" maxlength="80">
                <span class="input-group-append">
                  <button type="button" class="btn bg-teal btn-flat" id="btnGuardarMarca"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                </span>
              </div>
            </div>

          </div>

          <div class="row mt-4">

          </div>




        </div><!-- /.card-body -->


      </div>


    </div>
  </div>
<!-- /. NUEVO-->

  <!--EDITAR-->
  <div class="row" id="rowEditarMarca" style="display: none;">
    <div class="col-lg-12">

      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Marca a editar</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div><!-- /.card-tools -->

        </div><!-- /.card-header -->


        <div class="card-body" style="display: block;">

          <div class="form-group row">

            <label for="txtMarca" class="col-sm-3 col-form-label text-center">Marca</label>
            <div class="col-sm-9">
              <!--<input type="text" class="form-control" id="txtMarca" placeholder="Marca">-->
              <div class="input-group input-group-sm">
                <input type="text" id="txt_MarcaEditar" class="form-control" maxlength="80">
                <span class="input-group-append">
                  <button type="button" class="btn bg-warning btn-flat" id="btnGuardarMarcaEditar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                  <button type="button" class="btn bg-maroon btn-flat" id="btnCancelarEditar">Cancelar</button>
                </span>
              </div>
            </div>

          </div>

          <div class="row mt-4">

          </div>




        </div><!-- /.card-body -->


      </div>


    </div>
  </div>
<!-- /. EDITAR-->

</div>


<!--CUERPO CARD-->
<div class="card-body">

  <div class="row">
  <div class="col-lg-12">
  <table class="table" id="tablaMarcas">
    <thead>
      <tr>
        <th style="width:10px">ID</th>
        <th>Marca</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="contenido_tabla">

    </tbody>


  </table>
  </div>
  </div>


  


</div>
<!-- /.card-body -->

</div>
<!-- /.card -->

  </div>
</div>

   

  </section>
  <!-- /.CONTENIDO PRINCIPAL -->

  <!-- /.CONTENIDO -->
</div>