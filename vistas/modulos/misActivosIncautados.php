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
          <h1>Mis activos encautados.</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Mis activos encautados.</li>
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
        <div class="callout callout-info">
          <h5><i class="fa fa-info-circle"></i> Mis activos incautados.</h5>
          <p>En este módulo encontrara todos los activos incautados por algún funcionario autorizado.</p>
        </div>
      </div>



      <!--<div class="card-header">
        <a id="btnNuevoIncautamiento" class="btn btn-app bg-teal" href="#" data-toggle="modal" data-target="#modalIncautarActivo">
          <i class="fa fa-plus"></i> Nuevo
        </a>
      </div>-->


      <!--CUERPO CARD-->
      <div class="card-body">

        <table class="table row-border table-hover dataTable dtr-inline tablas" id="tabla_misactivosincautados">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Placa</th>
              <th>Categoria</th>
              <th>Subcategoria</th>
              <th>Marca</th>
              <th>Propietario</th>
              <th>Fecha Encautado</th>
              <th>Accion</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="contenido_tabla">

            <?php
            $item = "responsable_activo";
            $valor = $idUsarioLogueado;

            $misActivosIncautados = ControladormisActivosIncautados::mdlmisActivosIncautados($item, $valor);

            if ($misActivosIncautados) {
              if ($misActivosIncautados !== NULL) {
                foreach ($misActivosIncautados as $key => $value) {


                  echo '<tr>';

                  echo ' <td>*</td>';

                  echo '<td>' . $value['placa_activo'] . '</td>';

                  echo '<td>' . $value['detalle_categoria'] . '</td>';

                  echo '<td>' . $value['detalle_subcategoria'] . '</td>';

                  echo '<td>' . $value['detalle_marca'] . '</td>';

                  echo '<td>' . $value['nombre_funcionario'] . '</td>';

                  echo '<td>' . $value['fecha_ea'] . '</td>';

                  if ($value['devuelto_ea'] == '1') {

                    switch ($value['aceptado_ea']) {

                      case '0':
                        echo '<td>';
                        echo '<div class="btn-group">';
                        echo   '<button type="button" class="btn bg-teal" id="btn_aceptarIncautamiento" idIncautamiento="' . $value['id_ea'] . '">Aceptar</button>';
                        echo  '<button type="button" class="btn bg-maroon" id="btn_rechazarIncautamiento" idIncautamiento="' . $value['id_ea'] . '">Rechazar</button>';
                        echo '</div>';
                        echo '</td>';
                        break;

                      case '1':

                        echo '<td><span class="badge bg-teal"></i>Lo aceptaste</span></td>'; //Respuesta

                        break;

                      case '2':

                        echo '<td>';
                        echo '<div class="btn-group">';
                        echo   '<button type="button" class="btn bg-teal" id="btn_aceptarIncautamiento" idIncautamiento="' . $value['id_ea'] . '">Aceptar</button>';
                        echo  '<button type="button" class="btn bg-maroon" id="btn_rechazarIncautamiento" idIncautamiento="' . $value['id_ea'] . '">Rechazar</button>';
                        echo '</div>';
                        echo '</td>';

                        break;

                      default:
                        break;
                    }
                  } elseif($value['devuelto_ea'] == '0') {

                    echo '<td><span class="badge bg-gray"></i>De momento incautado</span></td>'; //Respuesta
                  }elseif ($value['devuelto_ea'] == '2') {
                    echo '<td><span class="badge bg-warning"></i>Lo rechazaste</span></td>'; //Respuesta
                  }

                  //Commentario
                  if ($value['observacion_ea'] !== '') {
                   
                    echo '<td>';
                            echo '<a href="#" class="link-black text-sm" id="popCommentIncaut" data-toggle="popover" title="Commentario" data-content="'.$value['observacion_ea'].'"><i class="fa fa-comment aria-hidden="true" mr-1"></i></a>';
                    echo '</td>';
                  }else {
                    echo '<td></td>';
                  }



                  echo '</tr>';
                }
              }
            }
            ?>

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