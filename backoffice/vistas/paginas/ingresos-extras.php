<div class="content-wrapper" style="min-height: 1058.31px;">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ingresos Bonos Extras Liquidados</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Ingresos Bonos Extras</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <section class="content">
    
    <div class="container-fluid">

      <?php  
      include "modulos/extras/analitica-sin-liquidar.php";

      include "modulos/extras/graficos-ingresos-extras.php"; 

      include "modulos/extras/tabla-ingresos-extras.php"; 

      ?>

    </div>

  </section>

</div>