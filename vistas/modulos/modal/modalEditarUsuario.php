
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
                    <input type="text" class="form-control" id="editarNombre" name="editarNombre" value="" required readonly>

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
          <button type="submit" name="submitEditarUsuario" class="btn btn-primary">Modificar cambios</button>
        </div>


        <?php
        $crearUsuario = new ControladorUsuarios();
        if ($crearUsuario->ctrValidarDatosEditarUsuario()) {
          $crearUsuario->ctrEditarUsuario();
        }
        ?>


      </form>

    </div>

  </div>
</div>