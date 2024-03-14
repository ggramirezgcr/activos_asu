 <!-- // ====================================================== //
    // ====================== CONTENIDO ===================== //
    // ====================================================== // -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1>Administrar categorias</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
             <li class="breadcrumb-item active">Categorias</li>
           </ol>
         </div>
       </div>
     </div><!-- /.container-fluid -->
   </section>


   <!-- // ~~~~~~~~~ CONTENIDO PRINCIPAL ~~~~~~~~~ // -->
   <section class="content">

     <!-- Default box -->
     <div class="card">

       <div class="card-header">
         <a name="" id="" class="btn btn-primary" href="#" data-toggle="modal" data-target="#modalAgregarUsuario">
           Agregar categorias
         </a>
       </div>


       <div class="card-body">

         <table class="table table-bordered table-hover dataTable dtr-inline collapsed tablas" id="tablas">
           <thead>
             <tr>
               <th style="width:10px">#</th>
               <th>Nombre</th>
               <th>Usuario</th>
               <th>Foto</th>
               <th>Perfil</th>
               <th>Estado</th>
               <th>Ultimo login</th>
               <th>Acciones</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td>1</td>
               <td>Usuario administrador</td>
               <td>Gerald Ramirez Garcia</td>
               <td><img src="vistas/img/usuario/profile.png" class="img-thumbnail" width="40px"></td>
               <td>Administrador</td>
               <td><button class="btn btn-success btn-xs">Activado</button></td>
               <td>2023-09-22 11:05:30</td>
               <td>
                 <div class="btn-group">
                   <button class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></button>
                   <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                 </div>
               </td>
             </tr>
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
   <div class="modal-dialog" role="document">

     <div class="modal-content">
      <form role="form" method="post" entype="multipart/form-data">


        <!--// ~~~~~~~~~~~~~ CABEZA MODAL ~~~~~~~~~~~~ //-->
          <div class="modal-header" style="background: #001f3f; color:white">
   
            <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
   
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
   
          </div>
   
          <!--// ~~~~~~~~~~~~~ CUERPO MODAL ~~~~~~~~~~~~ //-->
          <div class="modal-body">
   
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
                  <input type="text" class="form-control" name="nuevoUsuario" placeholder="Usuario" required>
   
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
                    <option value="">Administrador</option>
                    <option value="">Especial</option>
                    <option value="">Vendedor</option>
                  </select>
                </div>
              </div>
   
              <!--ENTRADA SUBIR FOTO-->
              <div class="form-group">
   
                
   
                <div class="panel">SUBIR FOTO</div>
                <input type="file" id="nuevaFoto" name="nuevaFoto">
                <p class="help-block">Peso máximo de la foto 200MB</p>
   
                <img src="vistas/img/usuario/avatar-128.png" class="img-thumbnail" width="100px">
   
              </div>
   
            </div>
   
          </div>
   
          <!--// ~~~~~~~~~~~ PIE PAGINA MODAL ~~~~~~~~~~ //-->
          <div class="modal-footer justify-content-between">
   
            <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>


      </form>

     </div>

   </div>
 </div>