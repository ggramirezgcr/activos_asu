<?php


if (isset($_SESSION['id'])) {
  $idUsarioLogueado = $_SESSION['id'];
}

if (isset($_SESSION["secuestra_activos"])) {
  if ($_SESSION["secuestra_activos"] !== 1) {
    echo '<script>
            window.location = "inicio";
        </script>';
    exit();
  }
} else {
  echo '<script>
            window.location = "inicio";
        </script>';
  exit();
};

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
          <h1>Encautar activo</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Encautar Activo</li>
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
        <h3 class="card-title">Incautar activo.</h3>
      </div>



      <div class="card-header">
        <a id="btnNuevoIncautamiento" class="btn btn-app bg-teal" href="#" data-toggle="modal" data-target="#modalIncautarActivo">
          <i class="fa fa-plus"></i> Nuevo
        </a>
      </div>


      <!--CUERPO CARD-->
      <div class="card-body">

        <table class="table row-border table-hover dataTable dtr-inline tablas" id="tabla_activosIncautados">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Placa</th>
              <th>Categoria</th>
              <th>Subcategoria</th>
              <th>Marca</th>
              <th>Propietario</th>
              <th>Fecha Encautado</th>
              <th>Fecha Devolucion</th>
              <th>Respuesta</th>
              <th>Fecha Respuesta</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody id="contenido_tabla">

            <?php

            $item = "incautador_ea";
            $valor = $idUsarioLogueado;

            $activosEncautados = ControladorIncautarActivo::ctrActivosIncautados($item, $valor);

            if ($activosEncautados) {
              foreach ($activosEncautados as $key => $value) {
                echo ' <tr>';

                echo '<td>' . $value["id_ea"] . '</td>'; //Id de encautmiento

                echo '<td>' . $value["placa_activo"] . '</td>'; //Placa

                echo '<td>' . $value["detalle_categoria"] . '</td>'; //Categoria

                echo '<td>' . $value["detalle_subcategoria"] . '</td>'; //SubCategoria

                echo '<td>' . $value["detalle_marca"] . '</td>'; //Marca

                echo '<td>' . $value["nombre_funcionario"] . '</td>'; //Propietario

                echo '<td>' . ($value["fecha_ea"] !== null ? date('d-m-Y h:i A', strtotime($value["fecha_ea"])) : '') . '</td>'; //Fecha del encautamiento

                echo '<td>' . ($value["fecha_devol_ea"] !== null ? date('d-m-Y h:i A', strtotime($value["fecha_devol_ea"])) : '') . '</td>'; //Fecha de devolucion del activo

                //Botonera
                if ($value['devuelto_ea'] == '1') {

                  switch ($value['aceptado_ea']) {
                    case '0':
                      echo '<td><span class="badge bg-gray"></i>Sin respuesta</span></td>'; //Respuesta
                      break;

                    case '1':
                      echo '<td><span class="badge bg-teal"></i>Aceptado</span></td>'; //Respuesta
                      break;

                    case '2':
                      echo '<td><span class="badge bg-maroon"></i>Rechazada</span></td>'; //Respuesta
                      break;


                    default:
                      echo '<td></td>';
                      break;
                  }
                } elseif ($value['devuelto_ea'] == '2') {
                  echo '<td><span class="badge bg-maroon"></i>Rechazada</span></td>'; //Respuesta
                } else {
                  echo '<td></td>';
                }

                //Fecha de la respuesta
                echo '<td>' . ($value["fecha_respta_ea"] !== null ? date('d-m-Y h:i A', strtotime($value["fecha_respta_ea"])) : '') . '</td>'; //Fecha de la respuesta

                //btn Accion
                echo '<td>';
                echo '<div class="btn-group">';
                if ($value['devuelto_ea'] == '0') {
                  echo  '<button type="button" class="btn bg-indigo" id="btnDevolverActivo_oe" idIncautamiento = "' . $value['id_ea'] . '">Devolver</button>';
                } elseif ($value['devuelto_ea'] == '1') {
                  if ($value['aceptado_ea'] == '1') {
                    echo '<a href="#" class="btn bg-indigo" id="btnOcultarIncautamiento" idIncautamiento = "' . $value['id_ea'] . '"><i class="fa fa-eye-slash"></i></a>';
                  }
                } elseif ($value['devuelto_ea'] == '2') {
                  if ($value['aceptado_ea'] == '2') {
                    echo  '<button type="button" class="btn bg-maroon" id="btnDevolverActivo_oe" idIncautamiento = "' . $value['id_ea'] . '">Devolver nuevamente</button>';
                  }
                }
                echo '</div>';
                echo '</td>';

                echo '</tr>';
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