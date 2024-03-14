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
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mis activos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Activos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- // ~~~~~~~~~ CONTENIDO PRINCIPAL ~~~~~~~~~ // -->
  <section class="content">

    <!--fila principal-->
    <div class="row">

      <!--Columna izquierda-->
      <div class="col-lg-8 col-12">

        <div class="card">
          <div class="card-header border-0">
            <!--table dataTable dtr-inline collapsed-->
            <table class="table table-striped hover tablas" id="tabla_activos">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Activo</th>
                  <th>Categoria</th>
                  <th>Subcategoria</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Ubicación</th>
                  <th>Localización</th>
                  <th>Descripcion</th>
                  <th>Imagen</th>
                  <th>Serie</th>
                  <th>Observacion</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $item = null;
                $valor = null;

                $activos = ControladorActivos::ctrMostrarActivos($item, $valor, true);

                if (!$activos == null) {
                  foreach ($activos as $key => $value) {
                    //Verificar el campo blob
                    if (!empty($value['img_modelo'])) {
                      $url_datos = "data:image/jpeg;base64," . base64_encode($value['img_modelo']);
                    } else {
                      $url_datos = "";
                    }


                    echo '<tr>';

                    echo '<td>' . $value['id_activo'] . '</td>';
                    echo '<td>' . $value['placa_activo'] . '</td>';
                    echo '<td>' . $value['detalle_categoria'] . '</td>';
                    echo '<td>' . $value['detalle_subcategoria'] . '</td>';
                    echo '<td>' . $value['detalle_marca'] . '</td>';
                    echo '<td>' . $value['detalle_modelo'] . '</td>';
                    echo '<td>' . $value['detalle_ubicacion'] . '</td>';
                    echo '<td>' . $value['detalle_servicio'] . '</td>';
                    echo '<td>' . $value['descripcion_activo'] . '</td>';
                    if ($url_datos) {
                      echo '<td><img src="' . $url_datos . '" class="img-thumbnail img-size-50" width="40px"></td>';
                    } else {
                      echo '<td></td>';
                    }
                    echo '<td>' . $value['serie_activo'] . '</td>';
                    echo '<td>' . $value['observacion_activo'] . '</td>';

                    echo '</tr>';
                  }
                }

                ?>

              </tbody>
            </table>
          </div>
        </div>


      </div>

      <!--Columna derecha-->
      <div class=" col-lg-4 col-12">
        <div class="sticky-top">

          <div class="card">
            <div class="card-header border-0">
              <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-teal">
                  <!--<div class="widget-user-image">
            <!~~<img class="img-circle elevation-2" id="imgActivo"  alt="User Avatar">~~>
          </div>-->
                  <!-- /.widget-user-image -->
                  <h5 class="">N° Activo</h5>
                  <h3 class="" id="lbl_placa"></h3>
                </div>
                <div class="card-body">
                  <!-- <strong><i class="fas fa-book"></i> Placa</strong>

          <p class="text-muted" >
            
          </p>

          <hr>-->

                  <strong><i class="fas fa-book"></i> Descripción</strong>

                  <p class="text-muted" id="lbl_descripcion">

                  </p>

                  <hr>

                  <strong><i class="fas fa-book"></i> Categoria</strong>

                  <p class="text-muted" id="lbl_categoria">

                  </p>

                  <hr>

                  <strong><i class="fas fa-book"></i> Subcategoria</strong>

                  <p class="text-muted" id="lbl_subcategoria">

                  </p>

                  <hr>

                  <strong><i class="fas fa-book"></i> Marca</strong>

                  <p class="text-muted" id="lbl_marca">

                  </p>

                  <hr>

                  <strong><i class="fas fa-book"></i> Modelo</strong>

                  <p class="text-muted" id="lbl_modelo">

                  </p>

                  <hr>

                  <strong><i class="fas fa-book"></i> Serie</strong>

                  <p class="text-muted" id="lbl_serie"></p>

                  <hr>



                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Ubicación</strong>

                  <p class="text-muted" id="lbl_ubicacion"></p>

                  <hr>
                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Localización</strong>

                  <p class="text-muted" id="lbl_localizacion"></p>

                  <hr>



                  <strong><i class="far fa-file-alt mr-1"></i> Observaciones</strong>

                  <p class="text-muted" id="lbl_observacion"></p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
    <!--/.row-->



  </section>
  <!-- /.CONTENIDO PRINCIPAL -->

  <!-- /.CONTENIDO -->
</div>