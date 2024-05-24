<?php
if (isset($_SESSION['id'])) {
  $idUsarioLogueado = $_SESSION['id'];
}

if (isset($_SESSION["perfil"])) {
  if ($_SESSION["perfil"] !== "Administrador") {
    echo '<script>

            window.location = "inicio";

        </script>';
    exit();
  }
}

?>

<!-- // ====================================================== //
    // ====================== CONTENIDO ===================== //
    // ====================================================== // -->
<div class="content-wrapper text-sm">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Administrar usuarios</li>
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
        <a id="btnAgregarUsuario" class="btn btn-app bg-teal" href="#" data-toggle="modal" data-target="#modalAgregarUsuario">
          <i class="fas fa-user"></i> Agregar usuario
        </a>


      </div>


      <div class="card-body">

        <!-- table-bordered table-hover  dataTable dtr-inline collapsed-->

        <!--table table-bordered table-hover dataTable dtr-inline-->

        <!--table-bordered table-hover dataTable dtr-inline responsive  -->
        <table class="table row-border table-hover dataTable dtr-inline tablas" id="tablaUsuarios">
          <thead>
            <tr>
              <th style="width:10%">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Incautar Activos</th>
              <th>Ultimo login</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="contenido_tabla">

          <?php
            $item = null;
            $valor = null;

            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);


            foreach ($usuarios as $key => $value) {


              echo '<tr>
                
                <td dtr-control sorting_1>' . ($key + 1) . '</td>
                
                <td>' . $value["usuario"] . '</td>
               
                <td>' . $value["nombre"] . '</td>';

              if ($value["foto"] != "") {

                echo '<td dtr-control sorting_1><img src="' . $value["foto"] . '" class="img-thumbnail" width="40px"></td>';
              } else {

                echo  '<td dtr-control sorting_1><img src="vistas/img/usuario/default/default.png" class="img-thumbnail" width="40px"></td>';
              }

              //Perfil
              echo '<td dtr-control sorting_1>' . $value["perfil"] . '</td>';

              //Estado
              if ($value['estado'] != 0) {

                echo '<td dtr-control sorting_1><button class="btn bg-teal btn-xs btnActivar"  idUsuario="' . $value["id"] . '" estadoUsuario="0" style="width: 100px;">Activado</button></td>';
              } else {

                echo '<td dtr-control sorting_1><button class="btn bg-gray btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="1" style="width: 100px;">Desactivado</button></td>';
              }

              //Incautar activos
              if ($value['secuestra_activos']) {
                echo '<td dtr-control sorting_1><button type="button" class="btn bg-maroon btn-xs btnIncautar" idUsuario="' . $value["id"] . '" incautar="1" style="width: 50px;"><i class="fa fa-check"></i>  SI </button></td>';
              } else {
                echo '<td dtr-control sorting_1><button type="button" class="btn bg-gray btn-xs btnIncautar" idUsuario="' . $value["id"] . '" incautar="0" style="width: 50px;"><i class="fa fa-circle"></i>  NO</button></td>';
              }



              //Ultimo login
              echo '<td dtr-control sorting_1>' . $value["ultimo_login"] . '</td>';

              //acciones
              echo '<td dtr-control sorting_1>
                  <div class="btn-group">
                   
                      <button class="btn bg-warning btnEditarUsuario" idUsuario="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil-square-o"></i></button>
                      <button class="btn bg-maroon btnEliminarUsuario" idUsuario="' . $value["id"] . '" fotoUsuario="' . $value["foto"] . '"   usuario="' . $value["usuario"] . '"><i class="fa fa-times"></i></button>
                  
                    </div>
                </td>
              </tr>';
            }

            ?>

          </tbody>
        </table>

      </div>
      <!-- /.card-body -->

   </div>
    <!-- /.card -->

  </section>

</div>





<!--// ====================================================== //
// ================= MODAL AGREGAR  USER ================ //
// ====================================================== //-->

<?php 
  include_once 'vistas/modulos/modal/modalNuevoUsuario.php';
?>





<!--// ====================================================== //
// ================= MODAL EDITAR  USER ================ //
// ====================================================== //-->

<?php 
  include_once 'vistas/modulos/modal/modalEditarUsuario.php';
?>

<?php
$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();
?>