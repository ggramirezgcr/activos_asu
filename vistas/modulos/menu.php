<?php
include_once 'vistas/modulos/modal/modalConsultarActivo.php';
include_once 'vistas/modulos/modal/modalIncautarActivo.php';
include_once 'vistas/modulos/modal/modalLeerQR.php';


?>


<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-dark-primary">
  <!-- Brand Logo -->
  <a href="inicio" class="brand-link">
    <img src="vistas/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SCA</span>
  </a>


  <!-- Sidebar -->
  <div class="sidebar text-sm">


    <!--// ~~~~~~~~~~~ FOTO DEL USUARIO ~~~~~~~~~~ //-->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="image">

        <?php

        if ($_SESSION['foto'] != "") {
          echo '<img src="' . $_SESSION['foto'] . '" class="img-circle elevation-2" alt="User Image">';
        } else {
          echo '<img src="vistas\img\usuario\default\profile.png" class="img-circle elevation-2" alt="User Image">';
        }

        ?>

      </div>

      <!--// ~~~~~~~~~~~ NICK DEL USUARIO ~~~~~~~~~~ //-->
      <div class="info">
        <a href="inicio" class="d-block"><?= $_SESSION['usuario']; ?></a>
      </div>

    </div>



    <!--// ====================================================== //
          // ==================== MENU SIDEBAR ==================== //
          // ====================================================== //-->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->






        <!--// ====================================================== //
         // ======================= ACTIVOS ====================== //
         // ====================================================== //-->
        <li class="nav-item">

          <a class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Activos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <!--// --------Mis Activos ------- //-->
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="misactivos" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Mis activos</p>
              </a>
            </li>

          </ul>



          <!--// --- Consultar Activos -- //-->
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="" class="nav-link" data-toggle="modal" data-target="#modalConsultarActivo">
                <i class="far fa-circle nav-icon"></i>
                <p>Consultar por placa</p>
              </a>
            </li>
          </ul> <!--/ .Consultar Activos-->


          <!--// -------- Activos ------- //-->
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="activos" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Todos los Activos</p>
              </a>
            </li>
          </ul>

          <!--// --- Incautar activos --- //-->
          <?php
          if (isset($_SESSION["secuestra_activos"])) {
            if ($_SESSION["secuestra_activos"] === 1) {
             
              echo  '<ul class="nav nav-treeview">';
              echo '<li class="nav-item">';
              echo '<a href="incautarActivo" class="nav-link">';
              echo '<i class="far fa-circle nav-icon"></i>';
              echo '<p>Confiscar activo</p>';
              echo '</a>';
              echo '</li>';
              echo '</ul>';
              
            }
          };

          ?>



          <!--// --- Mis activos incautados --- //-->
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="misActivosIncautados" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Mis activos confiscados</p>
              </a>
            </li>
          </ul>


        </li> <!--/ . ACTIVOS-->




        <!--// ====================================================== //
            //  <!~~// ~~~~~~~~~ PRESTAMO DE ACTIVOS ~~~~~~~~~ //~~>  //
            // ====================================================== //-->
        <li class="nav-item">

          <a href="activos" class="nav-link">
            <i class="nav-icon fas fa-hands-helping"></i>
            <p>
              Solicitudes de activos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <!--// ~ PRESTAMO DE ACTIVOS/Prestar activos ~ //-->
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="solicitudesEnviadas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Prestar Activo</p>
              </a>
            </li>

          </ul>

          <!--// ~ PRESTAMO DE ACTIVOS/Solicitar prestamo ~ //-->
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="solicitudesRecibidas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Recibir Activo</p>
              </a>
            </li>

          </ul>


          <!--// ~ VEVOLVER ACTIVOS/Solicitar prestamo ~ //-->
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="solicitudesDevueltas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Activos devueltos</p>
              </a>
            </li>

          </ul>


        </li> <!--/ .PRESTAMO DE ACTIVOS-->

        <!--// ~~~~~~~~~~~~~~~ USUARIOS ~~~~~~~~~~~~~~ //-->
        <?php

        if (isset($_SESSION["perfil"])) {
          if ($_SESSION["perfil"] === "Administrador") {
            echo  '<li class="nav-item">';
            echo '<a href="usuarios" class="nav-link">';

            echo '<i class="nav-icon fas fa-user"></i>';
            echo '<p>';
            echo 'Usuarios';

            echo '</p>';
            echo '</a>';
            echo '</li>';
          }
        }

        ?>





      </ul>
    </nav>
    <!-- /.MENU SIDEBAR -->


  </div>
  <!-- /.sidebar -->
</aside>