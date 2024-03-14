<div class="login-box">
 

  <div class="card card-outline card-primary">
    
  <div class="card-header text-center">
      <a  class="h1"><b>Bienvenido </b>SCA</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Ingresar tus datos</p>

     
      <form action="" method="post">

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
           <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recor
              </label>
            </div>-->
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>

      <?php 
        $login = new ControladorUSuarios();
        $login->ctrIngresoUsuario();
      
      ?>

      </form>

    
     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>