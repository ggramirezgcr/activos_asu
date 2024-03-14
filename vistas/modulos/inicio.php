 <?php
  if (isset($_SESSION['id'])) {
    $idUsarioLogueado = $_SESSION['id'];
  }

  $activos = null;
  $prestados = null;
  $devueltos = null;
  $solicitados = null;
  $rechazados = null;

  $totalbox = ControladorActivos::ctrTotalesTablero($idUsarioLogueado);

  if ($totalbox !== null) {
    if ($totalbox !== false) {
      if (is_array($totalbox)) {



        if (isset($totalbox[0]['activos'])) {
          $activos = $totalbox[0]['activos'];
        } else {
          $activos = 0;
        }


        if (isset($totalbox[0]['prestados'])) {
          $prestados = $totalbox[0]['prestados'];
        } else {
          $prestados = $totalbox[0]['prestados'];
        }

        if (isset($totalbox[0]['devueltos'])) {
          $devueltos = $totalbox[0]['devueltos'];
        } else {
          $devueltos = 0;
        }

        if (isset($totalbox[0]['solicitados'])) {
          $solicitados = $totalbox[0]['solicitados'];
        } else {
          $solicitados = 0;
        }

        if (isset($totalbox[0]['rechazados'])) {
          $rechazados = $totalbox[0]['rechazados'];
        } else {
          $rechazados = 0;
        }

        /* 
 $activos = (is_array($totalbox[0]['activos']) && isset($totalbox[0]['activos'])) ? $totalbox[0]['activos'] : 0 ;
  $prestados = (is_array($totalbox[0]['prestados']) && isset($totalbox[0]['prestados']))  ? $totalbox[0]['prestados'] :0;
  $devueltos =(is_array($totalbox[0]['devueltos']) && isset($totalbox[0]['devueltos'])) ? $totalbox[0]['devueltos'] : 0;
  $solicitados =(is_array($totalbox[0]['solicitados']) && isset($totalbox[0]['solicitados'])) ? $totalbox[0]['solicitados'] :0;
  $rechazados = (is_array($totalbox[0]['rechazados']) && isset($totalbox[0]['rechazados'])) ?  $totalbox[0]['rechazados'] : 0;
  */
      }
    }
  }




  ?>

 <!-- // ====================================================== //
    // ====================== CONTENIDO ===================== //
    // ====================================================== // -->

 <div class="content-wrapper text-sm">
   <input type="hidden" name="id" id="id" value=<?php echo $idUsarioLogueado; ?>>
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1>Tablero</h1>
         </div>
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#inicio">Inicio</a></li>
             <li class="breadcrumb-item active">Tablero</li>
           </ol>
         </div>
       </div>
     </div><!-- /.container-fluid -->
   </section>


   <!-- // ~~~~~~~~~ CONTENIDO PRINCIPAL ~~~~~~~~~ // -->
   <section class="content">

     <div class="container-fluid">


       <!-- // ~~~~~~~~~~~~ FILA Stat box ~~~~~~~~~~~~ // -->
       <div class="row justify-content-center text-center mb-4">

         <!--        <div class="col-lg-1 col-6">
</div>-->
         <div class="col-lg-2 col-6">

           <!-- small box -->
           <div class="small-box bg-info">
             <div class="inner">
               <h3><?php echo $activos ?></h3>
               <p>Mis activos</p>
             </div>
             <div class="icon">
               <i class="ion ion-bag"></i>
             </div>
             <a href="misactivos" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>

         <!-- ./col -->
         <div class="col-lg-2 col-6">
           <!-- small box -->
           <div class="small-box bg-teal">
             <div class="inner">
               <h3><?php echo $prestados ?><sup style="font-size: 20px"></sup></h3>

               <p>Activos Prestados</p>
             </div>
             <div class="icon">
               <i class="ion ion-stats-bars"></i>
             </div>
             <a href="solicitudesEnviadas" class="small-box-footer">Mas informacíon <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-2 col-6">
           <!-- small box -->
           <div class="small-box bg-warning">
             <div class="inner">
               <h3><?php echo $solicitados ?></h3>

               <p>Me han Prestado</p>
             </div>
             <div class="icon">
               <i class="ion ion-person-add"></i>
             </div>
             <a href="solicitudesRecibidas" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-2 col-6">
           <!-- small box -->
           <div class="small-box bg-maroon">
             <div class="inner">
               <h3><?php echo $rechazados ?></h3>

               <p>Rechazados</p>
             </div>
             <div class="icon">
               <i class="ion ion-pie-graph"></i>
             </div>
             <a href="solicitudesEnviadas" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>

         <div class="col-lg-2 col-6">
           <!-- small box -->
           <div class="small-box bg-purple">
             <div class="inner">
               <h3><?php echo $devueltos ?></h3>

               <p>Me han Devuelto</p>
             </div>
             <div class="icon">
               <i class="ion ion-pie-graph"></i>
             </div>
             <a href="solicitudesEnviadas" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
       </div>



       <!-- /.row -->


       <!--// ====================================================== //
// =================== FILA PRINCIPAL =================== //
// ====================================================== //-->
       <div class="row">
         <!-- Left col -->
         <div class="col-md-8">
           <!-- MAP & BOX PANE -->
           <div class="card ">
             <div class="card-header border-0">
               <h3 class="card-title">Mis activos por categoria</h3>

               <div class="card-tools">
                 <button type="button" class="btn btn-tool" data-card-widget="collapse">
                   <i class="fas fa-minus"></i>
                 </button>
                 <button type="button" class="btn btn-tool" data-card-widget="remove">
                   <i class="fas fa-times"></i>
                 </button>
               </div>
             </div>
             <div class="card-body">
               <div class="chart">
                 <div class="chartjs-size-monitor">
                   <div class="chartjs-size-monitor-expand">
                     <div class=""></div>
                   </div>
                   <div class="chartjs-size-monitor-shrink">
                     <div class=""></div>
                   </div>
                 </div>
                 <canvas id="lineChart" style="min-height: 250px; height: 300px; max-height: 300px; max-width: 100%; display: block; width: 453px;" width="500" height="150" class="chartjs-render-monitor"></canvas>
               </div>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.row -->


           <!-- /.card -->
         </div>
         <!-- /.col -->

         <div class="col-md-4">


           <div class="card bg-warning">
             <div class="card-header border-0">
               <h3 class="card-title">Solicitudes de activos</h3>

               <div class="card-tools">
                 <button type="button" class="btn btn-tool" data-card-widget="collapse">
                   <i class="fas fa-minus"></i>
                 </button>
                 <button type="button" class="btn btn-tool" data-card-widget="remove">
                   <i class="fas fa-times"></i>
                 </button>
               </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <div class="row">
                 <div class="col-md-12">
                   <div class="chart-responsive">
                     <div class="chartjs-size-monitor">
                       <div class="chartjs-size-monitor-expand">
                         <div class=""></div>
                       </div>
                       <div class="chartjs-size-monitor-shrink">
                         <div class=""></div>
                       </div>
                     </div>
                     <canvas id="polarChartSolicitudes" height="73" width="147" style="display: block; width: 300px; height: 300px;" class="chartjs-render-monitor"></canvas>
                   </div>
                   <!-- ./chart-responsive -->
                 </div>

               </div>
               <!-- /.row -->
             </div>
             <!-- /.card-body -->
             <div class="card-footer p-0">

             </div>
             <!-- /.footer -->
           </div>
           <!-- /.card -->




         </div>
         <!-- /.col -->
       </div>

       <!--// ~~~~~~~~~~~ / Fila principal ~~~~~~~~~~ //-->




     </div><!-- /.container-fluid -->
   </section>
   <!-- /.CONTENIDO PRINCIPAL -->


 </div>

 <!-- /.CONTENIDO -->