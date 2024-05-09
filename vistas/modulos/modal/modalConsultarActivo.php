
<!--Modal-->

<div class="modal fade" tabindex="-1" role="dialog" id="modalConsultarActivo">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">

      <!------------------------------------------------------------------->
      <!--ENCABEZADO-->
      <div class="modal-header bg-navy">

        <button type="button" class="close btn-danger" id="btnCloseModal" name="btnCloseModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>


      <!------------------------------------------------------------------->
      <!--CUERPO-->
      <div class="modal-body" id="modal-body_mCA">

        <!------------------------------------------------------------------->
       

        <form role="form" method="post" id="frm_consultarActivo">

          <!------------------------------------------------------------------->
          <!--// ---- CARD PRINCIPAL ---- //-->
          <div class="card" id="card_principal">

            <div class="card-body">

              <h5 class=" mb-2">Consultar activo.</h5>
              <hr>

              <!--Fila boton escanear QR-->
              <div class="row d-sm-none">
                <div class="col-sm-12 mb-2 col-12 d-flex justify-content-center">
                  <button type="button" class="btn btn-app bg-teal btn-flat" data-toggle="modal" data-target="#modalLeerQR" id="btnScanearQrMCA">
                    <i class="fa fa-qrcode"></i> Escanear código
                  </button>
                </div>
                <!--style="display: none"-->
                <!--<input type="file" class="ImgQR" accept="image/*" name="scanearQR" id="scanearQR" onchange="this.form.submit()">-->

                <input type="file" class="ImgQR" accept="image/*" name="scanearQR" id="scanearQR" style="display: none">
                <div id="qrResult"></div>
              </div>

              <!--Fila buscar placa-->

              <div class="row">
                <!--<label class="col-sm-2 col-form-label">N° Placa</label>-->
                <div class="col-sm-6">
                  <div class="input-group input-group-sm">
                    <input type="text" id="txt_placaBuscarMCA" class="form-control" pattern="[0-9]+" placeholder="Número de activo a buscas placa..">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary btn-flat" id="btnBuscarActivoMCA">
                        <i class="fas fa-search fa-fw"></i>
                      </button>
                    </span>
                  </div>

                </div>



              </div>








              <!--Fila Datos placa-->
              <div class="row mt-3 mb-2">

                <input type="hidden" name="txt_codigoPlacaMCA" id="txt_codigoPlacaMCA">



                <!--                 PLACA                 -->
                <div class="col-sm-3">
                  <label for="txt_PlacaMCA">Placa</label>
                  <input type="text" id="txt_PlacaMCA" class="form-control text-danger font-weight-bold" readonly=true>
                </div>

                <!--                 CATEGORIA                 -->
                <div class="col-sm-3">
                  <label for="txt_categoriaMCA">Categoria</label>
                  <input type="text" id="txt_categoriaMCA" class="form-control" readonly=true>
                </div>

                <!--                 subCategoria                 -->
                <div class="col-sm-3">
                  <label for="txt_subCategoriaMCA">Subcategoria</label>
                  <input type="text" id="txt_subCategoriaMCA" class="form-control" readonly=true>
                </div>


                <!--                 MARCA                 -->
                <div class="col-sm-3">
                  <label for="txt_MarcaMCA">Marca</label>
                  <input type="text" id="txt_MarcaMCA" class="form-control" readonly=true>
                </div>

              </div>

              <!--Fila Datos placa (Modelo Ubicacion Localizacion)-->
              <div class="row">

                <!--                 MODELO                 -->
                <div class="col-sm-3">
                  <label for="txt_ModeloMCA">Modelo</label>
                  <input type="text" id="txt_ModeloMCA" class="form-control" readonly=true>
                </div>


                <!--                 Ubicacion                 -->
                <div class="col-sm-6">
                  <label for="txt_ubicacionMCA">Ubicación</label>
                  <input type="text" id="txt_ubicacionMCA" class="form-control" readonly=true>
                </div>

                <!--                 Localizacion                 -->
                <div class="col-sm-3">
                  <label for="txt_localizacionMCA">Localización</label>
                  <input type="text" id="txt_localizacionMCA" class="form-control" readonly=true>
                </div>
              </div>


              <!--                    Fila Propietario                    -->
              <div class="row  mt-3 mb-2">

                <div class="col-sm-12">
                  <label for="txt_detalleMCA">Propietario</label>
                  <input type="text" id="txt_PropietarioMCA" class="form-control" readonly=true>
                </div>
              </div>

              <!--                    Fila detalle                    -->
              <div class="row">

                <div class="col-sm-12">
                  <label for="txt_detalleMCA">Detalle</label>
                  <input type="text" id="txt_detalleMCA" class="form-control" readonly=true>
                </div>
              </div>



              <!--Fila observaciones-->
              <div class="form-group">
                <label for="txt_ObservacionesMCA">Observaciones</label>
                <textarea class="form-control" id="txt_ObservacionesMCA" maxlength="499" name="txt_Observaciones" rows="3"></textarea>
              </div>

              </br>

            </div>
          </div> <!--/. card principal-->

        </form>

      </div>

      <!------------------------------------------------------------------->

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->



</div>