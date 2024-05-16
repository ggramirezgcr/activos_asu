

<!--Modal-->

<div class="modal fade" id="modalLeerQR" role="dialog" aria-labelledby="modalHijoLabel" aria-hidden="true">
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
      <div class="modal-body bg-navy">

        <div class="card bg-purple">
          
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- -->
                      <!--style="transform: scaleX(-1);"-->
                      <div class="video-container">
                        <video class="video" id="videoElement_mLQ" autoplay playsinline></video>
                        <canvas id="canvas_mLQ" style="display: none;"></canvas>
                        <div class="scanLine"></div>
                        <div class="qr-box"></div> <!-- Elemento para guiar al usuario -->
                      </div>
          
                      <audio src="vistas/audio/scaner.mp3" id="audio_scaner_mLQ" style="display: none;"></audio>
          
                    </div>
                  </div>

                  <div class="row">
                    <input type="text" hidden name="txt_codigo_mLQ" id="txt_codigo_mLQ">
                  </div>
          
                  <!-- Botones de iniciar y parar camara -->
                  <div class="row mt-4">
                    <div class="col-sm-12 col-12 d-flex justify-content-center" style="margin: 0 auto;">
                      <div class="d-inline-flex">
                        <button type="button" class="btn btn-app bg-teal" id="btnIniciarCamara_mLQ">
                          <i class="fa fa-play" aria-hidden="true"></i>
                          Iniciar
                        </button>
                        <button type="button" class="btn btn-app bg-navy" id="btnDetenerCamara_mLQ">
                          <i class="fa fa-stop" aria-hidden="true"></i>
                          Detener
                        </button>
                      </div>
                    </div>
                  </div>


        </div>

      </div>

      <!------------------------------------------------------------------->

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->



</div>