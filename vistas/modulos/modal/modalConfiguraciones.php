<?php
if (isset($_SESSION['id'])) {
  $idUsarioLogueado = $_SESSION['id'];
}
?>


<!--// ====================================================== //
// ================= MODAL CONFIGURACIONES  ================ //
// ====================================================== //-->

<!-- Modal -->
<div class="modal fade" id="modalConfiguraciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog card card-widget widget-user " role="document">
    

        <!--// ~~~~~~~~~~~ CONTENIDO MODAL ~~~~~~~~~~~ //-->
        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="iduser" id="id_user" value=<?php echo $idUsarioLogueado ?>>

                <!--// ~~~~~~~~~ TITULO DE LA VENTANA ~~~~~~~~ //-->
                <div class="widget-user-header bg-navy" style="height: 120px">
                    <h3 class="widget-user-desc">Cambiar contraseña</h3>
                </div><!--/. titulo de la ventana-->


                <!--// ~~~~~~~~~~ IMAGEN DEL USUARIO ~~~~~~~~~ //-->
                <div class="widget-user-image" style="width:115px; height:115px; top: 60px;">
                    <img class="img-circle elevation-2 img-thumbnail previsualizar" src="vistas/img/usuario/default/profile.png" style="width:100%; height:auto;">
                </div><!--/. imagen del usuario-->


                <!--// ~~~~~~~~~~~~~ CARD FOOTER ~~~~~~~~~~~~~ //-->
                <div class="card-footer">

                    <!--// ~~~~~~~~~~~~ FILA PRINCIPAL ~~~~~~~~~~~ //-->
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
                                        <input type="text" class="form-control" id="editarNombre_config" name="editarNombre" value="" required readonly>

                                    </div>
                                </div><!--/. entrada nombre-->


                                <!--ENTRADA USUARIO-->
                                <div class="form-group">

                                    <div class="input-group">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="editarUsuario_config" name="editarUsuario" value="" required readonly>

                                    </div>
                                </div> <!--/. entrada usuario-->


                                <!--ENTRADA CONTRASEÑA-->
                                <div class="form-group">

                                    <div class="input-group">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="passwordActual_config" name="passwordActual_config" valido='false' placeholder="Escriba su contraseña actual">
                                        
                                    </div>

                                </div> <!-- /. entrada contraseña-->
                                
                                
                                <!--ENTRADA CONTRASEÑA NUEVA-->
                                <div class="form-group">

                                    <div class="input-group">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="nuevaPassword_config" name="nuevaPassword_config" onchange="mostrarImagenSeleccionada()" placeholder="Escriba una nueva contraseña">
                                        
                                    </div>

                                </div> <!-- /. entrada contraseña nueva-->

                               


                                <!--ENTRADA SUBIR FOTO
                                <div class="form-group">

                                    
                                    <div class="callout callout-info">

                                        <label for="editarFoto_config" class="subir">
                                            <i class="fas fa-cloud-upload-alt"> </i>   Subir mi foto...
                                        </label>
                                        <input type="file" class="nuevaFoto" name="editarFoto_config" id="editarFoto_config" style="display: none">

                                        <p class="text-danger">Peso máximo de la foto 2MB</p>

                                        <input type="hidden" name="fotoActual_config" id="fotoActual_config">

                                    </div>
                                </div> /. entrada subir foto-->

                            </div>

                        </div><!-- /. cuerpo del modal-->


                    </div><!-- /.fila principal -->

                </div><!-- /. card footer-->


                <!--// ~~~~~~~~~~~ PIE PAGINA MODAL ~~~~~~~~~~ //-->
                <div class="modal-footer justify-content-between">
                    
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" name="submitEditarUsuarioConfig" class="btn btn-primary">Modificar cambios</button>
                </div>


                <?php
                $editarUsuario = new ControladorUsuarios();
                if ($editarUsuario->ctrValidarDatosConfig()) {
                    $editarUsuario->ctrEditarPass();
                }
                ?>


            </form>

        </div>

    </div>
</div>