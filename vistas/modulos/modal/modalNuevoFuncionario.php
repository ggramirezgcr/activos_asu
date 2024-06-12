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

<div class="modal fade" id="modalNuevoFuncionario" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
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
      <div class="modal-body">

        <!------------------------------------------------------------------->


        <form role="form" method="post" id="frmNuevoFuncionario_mNF">

          <!------------------------------------------------------------------->
          <!--// ---- CARD PRINCIPAL ---- //-->
          <div class="card" id="card_principal_mEA">

            <div class="card-body">

              <h5 class=" mb-2">Nuevo funcionario</h5>
              <hr>



              <!--// ~~~~~~~~~~~~ Tipo de cedula ~~~~~~~~~~~ //-->
              <div class="row">

                <div class="col-sm-6">

                  <label for="cmd_TipoID_mNF">Tipo cédula</label>

                  <select name="cmd_TipoID_mNF" id="cmd_TipoID_mNF" class="form-control input-lg">
                    <option value="nacional">Nacional</option>
                    <option value="extrangero">Extranjero</option>

                  </select>

                </div>
              </div>


              <!--                 CEDULA                 -->
              <div class="row">
                <div class="col-sm-6">
                  <label for="txt_CedulaFunc_mNF">Cédula</label>
                  <input type="text" name="txt_CedulaFunc_mNF" id="txt_CedulaFunc_mNF" class="form-control text-danger font-weight-bold">
                </div>
              </div>


              <!--                 NOMBRE                 -->
              <div class="row">
                <div class="col-sm-12">
                  <label for="txt_NombreFunc_mNF">Nombre</label>
                  <input type="text" name="txt_NombreFunc_mNF" id="txt_NombreFunc_mNF" class="form-control">
                </div>
              </div>

              <!--                 USUARIO DE RED                 -->
              <div class="row">
                <div class="col-sm-6">
                  <label for="txt_userRed_mNF">Usuario de red</label>
                  <input type="text" name="txt_userRed_mNF" id="txt_userRed_mNF" class="form-control">
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
        <button type="submit" id="btnNuevoFunc_mNF" name="btnNuevoFunc_mNF" class="btn btn-primary" pattern="[a-zA-Z0-9\s,.]+">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->


  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<?php 
  $nuevoFunc = new ControladorFuncionarios();
  $validarDatos = $nuevoFunc::ctrValidarDatos();
  if ($validarDatos) {
    if ($nuevoFunc::ctrNuevoFuncionario() == 'ok') {
      ControladorMensajes::msj_sweetalert('¡Registro exitoso!', 'Los datos del usuario se han registrado de forma correcta','s','');
    }else {
      ControladorMensajes::msj_sweetalert('Error', 'Error al intentar guardar los datos del usuario', 'e', '');
    }
  }elseif($validarDatos === false){
    ControladorMensajes::msj_sweetalert('Error en datos', 'Por favor ingrese los datos correctamente he intente de nuevo', 'e', '');
  }

?>

</form>

</div>