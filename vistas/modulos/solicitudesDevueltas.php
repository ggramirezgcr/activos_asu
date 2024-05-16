<?php
if (isset($_SESSION['id'])) {
  $idUsarioLogueado = $_SESSION['id'];
}

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
          <!--<h1>Historial de préstamo de activos</h1>-->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Historial de préstamos</li>
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
        <h2 class="card-title">Historial de préstamo de activos</h2>
      </div>

      <!--CUERPO CARD-->
      <div class="card-body">

        <div class="card">
          <div class="card-body">
            
            <form role="form" method="post">
              <div class="row">
              <h3 class="card-title">Seleccione un rango de fechas.</h3>
              </div>
              <!--FILA FECHAS-->
              <div class="row">

                <!--// ~~~~~~~~~~~~~ FECHA INICIO ~~~~~~~~~~~~ //-->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label><b>Del Dia</b></label>
                    <input type="date" name="from_date" class="form-control">
                  </div>
                </div>

                <!--// ~~~~~~~~~~~~~ FECHA FIN ~~~~~~~~~~~~ //-->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label><b> Hasta el Dia</b></label>
                    <input type="date" name="to_date" class="form-control">
                  </div>
                </div>

              </div>

              <!--// -- FILA BOTON BUSQUEDA - //-->
              <div class="row">
                <div class="col-ms-4">
                  <div class="form-group">
                    <button type="submit" id="btnActivosDevueltosXFecha" class="btn btn-primary">Buscar</button>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>



        <table class="table row-border table-hover dataTable dtr-inline tablas" id="tabla_activosDevueltos">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Placa</th>
              <th>Categoria</th>
              <th>Subcategoria</th>
              <th>Marca</th>
              <th>Prestado a</th>
              <th>Fecha Prestamo</th>
              <th>Fecha Devolucion</th>
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