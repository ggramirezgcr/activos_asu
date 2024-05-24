<?php
/*if (isset($_SESSION["secuestra_activos"])) {
  if ($_SESSION["secuestra_activos"] !== 1) {
    echo '<script>
            window.location = "inicio";
        </script>';
    exit();
  }
};*/
?>

<!--Modal-->

<div class="modal fade" id="modalIncautarActivo" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
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
      <div class="modal-body" id="modal-body_mEA">

        <!------------------------------------------------------------------->


        <form role="form" method="post" id="frm_consultarActivo_mEA">

          <!------------------------------------------------------------------->
          <!--// ---- CARD PRINCIPAL ---- //-->
          <div class="card" id="card_principal_mEA">

            <div class="card-body">

              <h5 class=" mb-2">Confiscar activo.</h5>
              <hr>

              <!--Fila boton escanear QR-->
              <div class="row d-sm-none">
                <div class="col-sm-12 mb-2 col-12 d-flex justify-content-center">
                  <button type="button" class="btn btn-app bg-teal btn-flat" data-toggle="modal" data-target="#modalLeerQR" id="btnScanearQR_mEA">
                    <i class="fa fa-qrcode"></i> Escanear código
                  </button>
                </div>

                <input type="file" class="ImgQR" accept="image/*" name="scanearQR" id="scanearQR_mEA" style="display: none">
                <div id="qrResult"></div>
              </div>

              <!--Fila buscar placa-->

              <div class="row">
                <!--<label class="col-sm-2 col-form-label">N° Placa</label>-->
                <div class="col-sm-6">
                  <div class="input-group input-group-sm">
                    <input type="text" id="txt_placaBuscar_mEA" class="form-control" pattern="[0-9]+" placeholder="N° Activo a buscar.." title="Solo números permitidos">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary btn-flat" id="btnBuscarActivo_mEA">
                        <i class="fas fa-search fa-fw"></i>
                      </button>
                    </span>
                  </div>

                </div>
              </div>

              <!--Fila Datos placa-->
              <div class="row mt-3 mb-2">

                <!--Codigo de la placa-->
                <input type="hidden" name="txt_codigoPlaca_mEA" id="txt_codigoPlaca_mEA">
                <input type="hidden" name="idFunReceptor_mIA" id="idFunReceptor_mIA">

                <!--                 PLACA                 -->
                <div class="col-sm-3">
                  <label for="txt_Placa_mEA">Placa</label>
                  <input type="text" id="txt_Placa_mEA" class="form-control text-danger font-weight-bold" readonly=true>
                  <input type="hidden" name="placa_mIA" id="placa_mIA">
                </div>

                <!--                 CATEGORIA                 -->
                <div class="col-sm-3">
                  <label for="txt_categoria_mEA">Categoria</label>
                  <input type="text" id="txt_categoria_mEA" class="form-control" readonly=true>
                </div>

                <!--                 subCategoria                 -->
                <div class="col-sm-3">
                  <label for="txt_subCategoria_mEA">Subcategoria</label>
                  <input type="text" id="txt_subCategoria_mEA" class="form-control" readonly=true>
                </div>


                <!--                 MARCA                 -->
                <div class="col-sm-3">
                  <label for="txt_Marca_mEA">Marca</label>
                  <input type="text" id="txt_Marca_mEA" class="form-control" readonly=true>
                </div>

              </div>


              <!--                    Fila Propietario                    -->
              <div class="row  mt-3 mb-2">

                <div class="col-sm-12">
                  <label for="txt_detalle_mEA">Propietario</label>
                  <input type="text" id="txt_Propietario_mEA" class="form-control" readonly=true>
                </div>
              </div>

              <!--                    Fila detalle                    -->
              <div class="row">

                <div class="col-sm-12">
                  <label for="txt_detalle_mEA">Detalle</label>
                  <input type="text" id="txt_detalle_mEA" class="form-control" readonly=true>
                </div>

              </div>

              <div class="row">
                <div class="col-sm-12">
                  <!--Fila observaciones-->
                  <div class="form-group">
                    <label for="txt_Observaciones_mEA">Observaciones</label>
                    <textarea class="form-control" id="txt_Observaciones_mEA" maxlength="499" name="txt_Observaciones_mEA" rows="2"></textarea>
                  </div>
                </div>
              </div>



            </div>
          </div> <!--/. card principal-->




      </div>

      <!------------------------------------------------------------------->

      <!--PIE-->
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <input type="hidden" name="iduser" value="<?php echo $idUsarioLogueado;  ?>">
        <button type="submit" id="btnGuardarIncautamiento" name="btnGuardarIncautamiento" class="btn btn-primary" pattern="[a-zA-Z0-9\s,.]+" disabled>Confiscar activo</button>
      </div>
    </div>
    <!-- /.modal-content -->


  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<?php
$nuevoEncautamiento = new ControladorIncautarActivo();
if ($nuevoEncautamiento->ctrValidarDatos()) {
  $nuevoEncautamiento->ctrNuevoIncautamiento();
}

?>

</form>

</div>