
<div class="content-wrapper" style="min-height: 1058.31px;">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Patrocinador: <?php echo $usuario["patrocinador"] ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Mi perfil</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="row">

      <?php if($usuario["perfil"]!="admin" && $usuario["fecha_contrato"]==null): ?>

      <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Atención!</h5>
    Recuerda que para recibir todos nuestros beneficios debes llenar los campos a continuación, aceptar y el contrato.
    Puedes leer los términos y condiciones, y ver el plan de compensación.
    </div>
        
        <?php 

      endif;

           include "modulos/perfil/info-usuario.php";

           include "modulos/perfil/formulario-suscripcion.php";

           #include "modulos/perfil/material-promocion.php";

         ?>

     </div>

    </div>

  </section>
  <!-- /.content -->

</div>