<?php
if (isset($_SESSION['id'])) {
  $idUsarioLogueado = $_SESSION['id'];

}

?>



<!-- // ====================================================== //
    // ====================== CONTENIDO ===================== //
    // ====================================================== // -->
<div class="content-wrapper text-sm">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Recibir activo</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Recibir activo.</li>
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
        <!-- <h1 class="card-title">Recibir activos.</h1>-->
        <div class="callout callout-info">
          <h5><i class="fa fa-info-circle"></i> Recibir activos.</h5>
          <p>En esta página se mostrarán los registros de los prestamos que te han realizado y los cuales no se han devuelto a su propietario, aquí puedes aceptar, rechazar o devolver el registro del préstamo del activo que otros funcionarios te han hecho.</p>
        </div>

      </div>


      <div class="card-body">

        <table class="table row-border table-hover dataTable dtr-inline tablas" id="tabla_SolicitudesRecibidas" with=100%>
          <thead>
            <tr>
              <th style="width:10%">#</th>
              <th>N° Activo</th>
              <th>Categoria</th>
              <th>Subcategoria</th>
              <th>Marca</th>
              <th>Propietario</th>
              <th>Fecha solicitud</th>
              <th>Fecha respuesta</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $item = "receptor_sa";
            $valor = $idUsarioLogueado;
            $item2 = "devuelto_sa";
            $valor2 = "0";


            $solicitudesRecibidas = ControladorSolicitudesRecibidas::ctrMiSolicitudesRecibidas($item, $valor, $item2, $valor2);

            if ($solicitudesRecibidas) {


              foreach ($solicitudesRecibidas as $key => $value) {

                if ($value['devuelto_sa'] == '0') {

                  if ($value['respta_receptor_sa'] === null || $value['respta_receptor_sa'] === 1) {

                    if ($value['ocultar_sa'] === 0) {

                      echo '<tr>';

                      echo '<td>' . $value['id_sa'] . '</td>';

                      echo '<td>' . $value['placa_activo'] . '</td>';

                      echo '<td>' . $value['detalle_categoria'] . '</td>';

                      echo '<td>' . $value['detalle_subcategoria'] . '</td>';

                      echo '<td>' . $value['detalle_marca'] . '</td>';

                      echo '<td>' . $value['nombre_funcionario'] . '</td>';

                      echo '<td>' . ($value['fecha_crea_sa'] !== null ?  date("d-m-Y h:i A", strtotime($value['fecha_crea_sa'])) : '') . '</td>';

                      echo '<td>' . ($value['fecha_respta_sa'] !== null ? date("d-m-Y h:i A", strtotime($value['fecha_respta_sa'])) : '') . '</td>';

                      echo '<td>
                   <div class="btn-group">';
                      if ($value['respta_receptor_sa'] === null) {
                        //Boton Aceptar
                        echo '<button type="button" 
                              class="btn bg-teal" 
                              id="btnAceptarPrestamo" 
                              idSolicitud= "' . $value['id_sa'] . '" 
                              idfun="' . $value['id_funcionario'] . '" 
                              placa="' . $value['placa_activo'] . '"
                              >Aceptar</button>';

                        //Boton Rechazar
                        echo '<button type="button" 
                              class="btn bg-maroon" 
                              id="btnRechazarPrestamo" 
                              idSolicitud= "' . $value['id_sa'] . '" 
                              idfun="' . $value['id_funcionario'] . '" 
                              placa="' . $value['placa_activo'] . '"
                              >Rechazar</button>';

                      } else {

                        //Boton devolver
                        echo '<button type="button" 
                              class="btn bg-indigo" 
                              id="btnDevolverActivo" 
                              idSolicitud= "' . $value['id_sa'] . '" 
                              idfun="' . $value['id_funcionario'] . '" 
                              placa="' . $value['placa_activo'] . '"
                              >Devolver</button>';

                      }



                      echo  '</div>
                 </td>';

                      echo '</tr>';
                    }
                  }
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









<!--// ====================================================== //
// ================= MODAL AGREGAR  USER ================ //
// ====================================================== //-->

<!-- Modal -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog card card-widget widget-user" role="document">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">


        <!-- // ~~~~~~~~~~~~~~~~~ CARD ~~~~~~~~~~~~~~~~ //-->


        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-info" style="height: 120px">
          <!--<h3 class="widget-user-username"> </h3>-->
          <h3 class="widget-user-desc">Agregar usuario</h3>
          <!--&amp;-->
        </div>
        <div class="widget-user-image" style="width:115px; height:115px; top: 60px;">
          <!--<img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">-->

          <img class="img-circle elevation-2 img-thumbnail previsualizar" src="vistas/img/usuario/default/avatar-128.png" style="width:100%; height:auto;">

        </div>
        <div class="card-footer">
          <div class="row">

            <!--// ~~~~~~~~~~~~~ CUERPO MODAL ~~~~~~~~~~~~ //-->
            <div class="modal-body text-sm">

              <div class="box-body">

                <!--ENTRADA NOMBRE-->
                <div class="form-group">

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre" required>

                  </div>
                </div>

                <!--ENTRADA USUARIO-->
                <div class="form-group">

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nuevoUsuario" id="nuevoUsuario" placeholder="Usuario" required>

                  </div>
                </div>

                <!--ENTRADA CONTRASEÑA-->
                <div class="form-group">

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="nuevoPassword" placeholder="Contraseña" required>

                  </div>
                </div>

                <!--ENTRADA PERFIL-->
                <div class="form-group">

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-users"></i></span>
                    </div>
                    <select name="nuevoPerfil" class="form-control input-lg">
                      <option value="">Seleccionar perfil</option>
                      <option value="Administrador">Administrador</option>
                      <option value="Especial">Especial</option>
                      <option value="Digitador">Digitador</option>
                    </select>
                  </div>
                </div>


                <!--ENTRADA SUBIR FOTO-->
                <div class="form-group">

                  <div class="callout callout-info">

                    <label for="nuevaFoto" class="subir">
                      <i class="fas fa-cloud-upload-alt"> </i> Archivo de imagen
                    </label>
                    <input class="nuevaFoto form-control-file" type="file" name="nuevaFoto" id="nuevaFoto" style="display: none">

                    <p class="text-danger">Peso máximo de la foto 2MB</p>
                  </div>

                </div>

              </div>

            </div>



            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!--FIN CARD-->


        <!--// ~~~~~~~~~~~ PIE PAGINA MODAL ~~~~~~~~~~ //-->
        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>






        <?php
        $crearUsuario = new ControladorUsuarios();
        $crearUsuario->ctrCrearUsuario();
        ?>


      </form>

    </div>

  </div>
</div>





<!--// ====================================================== //
// ================= MODAL EDITAR  USER ================ //
// ====================================================== //-->

<!-- Modal -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog card card-widget widget-user " role="document">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">


        <!-- // ~~~~~~~~~~~~~~~~~ CARD ~~~~~~~~~~~~~~~~ //-->

        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-maroon" style="height: 120px">
          <!--<h3 class="widget-user-username"> </h3>-->
          <h3 class="widget-user-desc">Editar usuario</h3>
          <!--&amp;-->
        </div>
        <div class="widget-user-image" style="width:115px; height:115px; top: 60px;">
          <!--<img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">-->

          <img class="img-circle elevation-2 img-thumbnail previsualizar" src="vistas/img/usuario/default/avatar-128.png" style="width:100%; height:auto;">

        </div>
        <div class="card-footer">
          <div class="row">



            <!--// ~~~~~~~~~~~~~ CUERPO MODAL ~~~~~~~~~~~~ //-->
            <div class="modal-body text-sm">

              <div class="box-body">

                <!--ENTRADA NOMBRE-->
                <div class="form-group">

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="editarNombre" name="editarNombre" value="" required>

                  </div>
                </div>

                <!--ENTRADA USUARIO-->
                <div class="form-group">

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" id="editarUsuario" name="editarUsuario" value="" required readonly>

                  </div>
                </div>

                <!--ENTRADA CONTRASEÑA-->
                <div class="form-group">

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" id="editarPassword" name="editarPassword" placeholder="Escriba una nueva contraseña">
                    <input type="hidden" id="passwordActual" name="passwordActual">
                  </div>
                </div>

                <!--ENTRADA PERFIL-->
                <div class="form-group">

                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-users"></i></span>
                    </div>
                    <select name="editarPerfil" class="form-control input-lg">
                      <option value="" id="editarPerfil"></option>
                      <option value="Administrador">Administrador</option>
                      <option value="Tramitador">Tramitador</option>
                      <option value="Digitador">Digitador</option>
                    </select>
                  </div>
                </div>


                <!--ENTRADA SUBIR FOTO-->
                <div class="form-group">

                  <div class="callout callout-info">

                    <label for="editarFoto" class="subir">
                      <i class="fas fa-cloud-upload-alt"> </i> Archivo de imagen
                    </label>
                    <input type="file" class="nuevaFoto" name="editarFoto" id="editarFoto" style="display: none">

                    <p class="text-danger">Peso máximo de la foto 2MB</p>

                    <input type="hidden" name="fotoActual" id="fotoActual">

                  </div>
                </div>

              </div>

            </div>


            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!--FIN CARD-->

        <!--// ~~~~~~~~~~~ PIE PAGINA MODAL ~~~~~~~~~~ //-->
        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar cambios</button>
        </div>


        <?php
        $crearUsuario = new ControladorUsuarios();
        $crearUsuario->ctrEditarUsuario();
        ?>


      </form>

    </div>

  </div>
</div>

<?php
$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();
?>