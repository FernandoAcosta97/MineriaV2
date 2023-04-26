

<div class="content-wrapper" style="min-height: 1058.31px;">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Bonos Extras sin liquidar</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active"> Bonos Extras sin liquidar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <section class="content">
    
    <div class="container-fluid">

    <input type="hidden" value="<?php echo $usuario["id_usuario"]; ?>" id="id_usuario">

      <?php  

      include "modulos/extras/analitica-sin-liquidar.php"; 

      include "modulos/extras/tabla-extras-sin-liquidar.php"; 

      ?>

    </div>

  </section>

</div>