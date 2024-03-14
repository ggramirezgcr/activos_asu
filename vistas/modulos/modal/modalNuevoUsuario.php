<!-- Modal -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog card card-widget widget-user" role="document">
    <div class="modal-content">

      <!------------------------------------------------------------------->
      <!--ENCABEZADO-->

      <div class="widget-user-header bg-info" style="height: 120px">
        <h3 class="widget-user-desc">Agregar usuario</h3>
      </div>

      <div class="widget-user-image" style="width:115px; height:115px; top: 60px;">
        <img class="img-circle elevation-2 img-thumbnail previsualizar" src="vistas/img/usuario/default/avatar-128.png" style="width:100%; height:auto;">
      </div>

      <!------------------------------------------------------------------->
      <!--CUERPO-->
      <div class="modal-body">

        <form role="form" method="post" enctype="multipart/form-data">



          <div class="card-footer">

            <div class="row">

              <!--// ~~~~~~~~~~~~~ CUERPO MODAL ~~~~~~~~~~~~ //-->
              <div class="modal-body text-sm">

                <div class="box-body">



                  <!--LISTA DE FUNCIONARIOS-->

                  <div class="form-group">

                      <div class="input-group">

                        <!--<div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-users"></i></span>
                        </div>-->
                          <select name="cmbfuncionarios" id="cmbfuncionarios" class="form-control input-lg" style="width : 100%">
                            <option value="0">Seleccionar funcionario</option>

                            <?php

                            $item = null;
                            $valor = null;

                            $funcionarios = ControladorFuncionarios::ctrMostrarFuncionarios($item, $valor);

                            foreach ($funcionarios as $key => $value) {
                              echo '<option value="' . $value["id_funcionario"] . '">' . $value["nombre_funcionario"] . '</option>';
                            }

                            ?>
                          </select>
                        
                      </div>

                    

                  </div>



                  <!--ENTRADA NOMBRE-->
                  <input type="hidden" class="form-control" name="nuevoNombre" id="nuevoNombre" placeholder="Nombre" required>



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
                      <select name="nuevoPerfil" id="nuevoPerfil" class="form-control input-lg">
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
            <button type="submit" name="submitNuevoUsuario" class="btn btn-primary">Guardar cambios</button>
          </div>


          <?php
          $crearUsuario = new ControladorUsuarios();
          if ($crearUsuario->ctrValidarDatosNuevoUsuario()) {
            $crearUsuario->ctrCrearUsuario();
          }
          ?>


        </form>

      </div>

    </div>

  </div>
</div>