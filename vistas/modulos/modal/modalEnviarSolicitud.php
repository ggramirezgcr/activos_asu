
 
 <!--Modal-->
 
 <div class="modal fade" id="modalEnviarPrestamo" tabindex="-2" role="dialog" >
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">

       <!------------------------------------------------------------------->
       <!--ENCABEZADO-->
       <div class="modal-header">
         <h4 class="modal-title">Prestamo de activo</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>


       <!------------------------------------------------------------------->
       <!--CUERPO-->
       <div class="modal-body">

         <form role="form" method="post" id="frmNuevaSolicitud">

           <div class="card">

             <div class="card-body">

               <h5 class="mt-4 mb-2">Datos del activo.</h5>
               <hr>

               <!--Fila boton escanear QR-->
              <div class="row d-sm-none">
                <div class="col-sm-12 mb-2 col-12 d-flex justify-content-center">
                  <button type="button" class="btn btn-app bg-teal btn-flat" data-toggle="modal" data-target="#modalLeerQR" id="btnScanearQR_mES">
                    <i class="fa fa-qrcode"></i> Escanear código
                  </button>
                </div>

              </div>

               <!--Fila buscar placa-->

               <div class="row">
                 <!--<label class="col-sm-2 col-form-label">N° Placa</label>-->
                 <div class="col-sm-3">
                   <div class="input-group input-group-sm">
                     <input type="text" id="txt_placaBuscar" class="form-control" pattern="[0-9]+" placeholder="Buscar placa..">
                     <span class="input-group-append">
                       <button type="button" class="btn btn-primary btn-flat" id="btnBuscarPlaca">
                         <i class="fas fa-search fa-fw"></i>
                       </button>
                     </span>
                   </div>

                 </div>
               </div>


               <!--Fila Datos placa-->
               <div class="row mt-3 mb-2">

                 <input type="hidden" name="txt_codigoPlaca" id="txt_codigoPlaca">

                 <!--                 PLACA                 -->
                 <div class="col-sm-3">
                   <label for="txt_Placa">Placa</label>
                   <input type="text" id="txt_Placa" class="form-control" readonly=true>
                 </div>

                 <!--                 CATEGORIA                 -->
                 <div class="col-sm-3">
                   <label for="txt_categoria">Categoria</label>
                   <input type="text" id="txt_categoria" class="form-control" readonly=true>
                 </div>

                 <!--                 subCategoria                 -->
                 <div class="col-sm-3">
                   <label for="txt_subCategoria">Subcategoria</label>
                   <input type="text" id="txt_subCategoria" class="form-control" readonly=true>
                 </div>


                 <!--                 MARCA                 -->
                 <div class="col-sm-3">
                   <label for="txt_Marca">Marca</label>
                   <input type="text" id="txt_Marca" class="form-control" readonly=true>
                 </div>

               </div>

               <!--Fila Datos placa (Modelo Ubicacion Localizacion)-->
               <div class="row">

                 <!--                 MODELO                 -->
                 <div class="col-sm-3">
                   <label for="txt_Modelo">Modelo</label>
                   <input type="text" id="txt_Modelo" class="form-control" readonly=true>
                 </div>


                 <!--                 Ubicacion                 -->
                 <div class="col-sm-6">
                   <label for="txt_ubicacion">Ubicación</label>
                   <input type="text" id="txt_ubicacion" class="form-control" readonly=true>
                 </div>

                 <!--                 Localizacion                 -->
                 <div class="col-sm-3">
                   <label for="txt_localizacion">Localización</label>
                   <input type="text" id="txt_localizacion" class="form-control" readonly=true>
                 </div>
               </div>

               <!--                    Fila detalle                    -->
               <div class="row">

                 <div class="col-sm-12">
                   <label for="txt_detalle">Detalle</label>
                   <input type="text" id="txt_detalle" class="form-control" readonly=true>
                 </div>
               </div>


               <h5 class="mt-4 mb-2">Datos del solicitante.</h5>
               <hr>


               <!--Fila Datos Funcionario-->
               <div class="row mt-3 mb-2">


                 <!--Fila detalle-->

                 <input type="hidden" name="idFunReceptor" id="idFunReceptor">

                 <div class="col-sm-3">
                   <label for="txt_cedula">Usuario</label>
                   <input type="text" id="txt_usuarioRedSolEnv" class="form-control" readonly=true>
                 </div>

                 <!--ENTRADA USUARIO-->

                 <div class="col-sm-6">
                   <div class="form-group">
                     <label for="cmbfuncionarios">Funcionario</label>
                     <select name="cmbfuncionarios" id="cmbfuncionarios" class="select2 select2-container select2-container--default select2-container--below select2-container--focus" style="width : 100%">
                       <option value="0">Seleccionar funcionario</option>

                       <?php

                        $item = null;
                        $valor = null;

                        $funcionarios = ControladorFuncionarios::ctrMostrarFuncionarios($item, $valor, false);
                        if (is_array($funcionarios)) {
                          # code...
                          foreach ($funcionarios as $key => $value) {
                            echo '<option value="' . $value["id_funcionario"] . '">' . $value["nombre_funcionario"] . '</option>';
                          }
                        }

                        ?>
                     </select>

                   </div>
                 </div>
               </div>

               <!--Fila observaciones-->
               <div class="form-group">
                 <label for="txt_Observaciones">Observaciones</label>
                 <textarea class="form-control" id="txt_Observaciones" maxlength="499" name="txt_Observaciones" rows="3" placeholder="Enter ..."></textarea>
               </div>

               </br>

             </div>
           </div>
       </div>

       <!------------------------------------------------------------------->
       <!--PIE-->
       <div class="modal-footer justify-content-between">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         <input type="hidden" name="iduser" value="<?php echo $idUsarioLogueado;  ?>">
         <button type="submit" id="submitGuardarSolicitud" name="submitGuardarSolicitud" class="btn btn-primary">Guardar</button>
       </div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
   <?php
    $nuevaSolicitud = new ControladorSolicitudes();
    if ($nuevaSolicitud->ctrValidarDatosNuevaSolicitud()) {
      $nuevaSolicitud->ctrNuevaSolicitudActivo();
    }
    ?>
   </form>

 </div>