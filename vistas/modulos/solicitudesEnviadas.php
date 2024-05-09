 <?php
  if (isset($_SESSION['id'])) {
    $idUsarioLogueado = $_SESSION['id'];
  }

  ?>


 <!-- 
 // ====================================================== //
    // ====================== CONTENIDO ===================== //
    // ====================================================== // -->
 <div class="content-wrapper text-sm">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1>Prestar Activo</h1>

         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
             <li class="breadcrumb-item active"></li>
           </ol>
         </div>
       </div>
     </div><!-- /.container-fluid -->
   </section>


   <!-- // ~~~~~~~~~ CONTENIDO PRINCIPAL ~~~~~~~~~ // -->
   <section class="content">

     <!-- Default box -->
     <div class="card">

       <div class="callout callout-info">
         <h5><i class="fas fa-info"></i> Nota.</h5>

         <p>En este apartado vas a encontrar los registros de los activos que poseas en préstamo, puedes visualizar la respuesta del funcionario/a al que le generas el registro de préstamo, el cual puede ser aceptado o rechazado o devuelto.</p>
       </div>

       <div class="card-header">
         <a id="btnNuevoMovimiento" class="btn btn-app bg-teal" href="#" data-toggle="modal" data-target="#modalEnviarPrestamo">
           <i class="fa fa-plus"></i> Nuevo
         </a>


       </div>


       <div class="card-body">

         <!--              TABLA                -->
         <table class="table row-border table-hover dataTable dtr-inline tablas" id="tabla_solicitudesEnviadas" with=100%>
           <thead>
             <tr>
               <th style="width:10%">#</th>
               <th>Placa</th>
               <th>Categoria</th>
               <th>Subcategoria</th>
               <th>Marca</th>
               <th>Solicitante</th>
               <th>Fecha solicitud</th>
               <th>Respuesta</th>
               <th>Fecha respuesta</th>
               <th>Acciones</th>
             </tr>
           </thead>
           <tbody>

             <?php



              $item = "emisor_sa";
              $valor = $idUsarioLogueado;
              $item2 = "ocultar_sa";
              $valor2 = "0";



              $solicitudesEnviadas = ControladorSolicitudes::ctrSolicitudesEnviadas($item, $valor, $item2, $valor2);

              if ($solicitudesEnviadas !== null) {

                foreach ($solicitudesEnviadas as $key => $value) {


                  echo '<tr>';
                  echo '<td>' . $value["id_sa"] . '</td>';
                  echo '<td>' . $value["placa_activo"] . '</td>';

                  echo '<td>' . $value["detalle_categoria"] . '</td>';
                  echo '<td>' . $value["detalle_subcategoria"] . '</td>';
                  echo '<td>' . $value["detalle_marca"] . '</td>';

                  echo '<td>' . $value["nombre_funcionario"] . '</td>';
                  echo '<td>' . ($value["fecha_crea_sa"] !== null ?  date('d-m-Y h:i A', strtotime($value["fecha_crea_sa"])) : '') . '</td>';

                  if ($value["respta_receptor_sa"] == '1') {
                    if ($value["devuelto_sa"] == '1') {
                      echo '<td><span class="badge badge-warning"></i>Devuelto</span></td>';
                    } else {
                      echo '<td><span class="badge badge-success"></i>Aceptada</span></td>';
                    }
                  } elseif ($value["respta_receptor_sa"] == '0') {
                    echo '<td><span class="badge badge-danger"></i>Rechazada</span></td>';
                  } else {
                    echo '<td></td>';
                  }

                  echo '<td>' . ($value["fecha_respta_sa"] !== null ? date('d-m-Y h:i A', strtotime($value["fecha_respta_sa"])) :'') . '</td>';

                  echo '<td>
                          <div class="btn-group btn-group-sm">';


                  if (
                    $value["respta_receptor_sa"] === null ||
                    $value["respta_receptor_sa"] == '0' ||
                    $value["devuelto_sa"] == '1'
                  ) {
                    if ($value["respta_receptor_sa"] === null) {
                      //btn_Eliminar solicitud
                      echo ' <a href="#" class="btn btn-danger bg-maroon btnEliminarSolicitud"  idSolicitud= "' . $value['id_sa'] . '"><i class="fas fa-trash"></i></a>';
                    } else {
                      // btn_Ocultar Solicitud
                      echo '<a href="#" class="btn bg-indigo" id="btnOcultarSolicitud" idSolicitud= "' . $value['id_sa'] . '"><i class="fa fa-eye-slash"></i></a>';
                    }

                  }

                  

                  echo  '</div>
                        </td>';

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









 <!--// ====================================================== //
// ================= MODAL ENVIAR SOLICITUD ================ //
// ====================================================== //-->

<?php 
include_once 'vistas/modulos/modal/modalEnviarSolicitud.php';
?>



 <?php
  $eliminarSolicitud = new ControladorSolicitudes();
  $eliminarSolicitud->ctrEliminarSolicitud();
  ?>

 <?php
  $ocultarSolicitud = new ControladorSolicitudes();
  $ocultarSolicitud->ctrOcultarSolicitud();

  ?>