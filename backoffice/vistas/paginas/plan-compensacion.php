<div class="content-wrapper" style="min-height: 1058.31px;">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Plan de compensación</h1>
          <?php if($usuario["perfil"]=="admin"): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalCambiarNiveles">NIVELES COMISIONES(ÁRBOL)</button>
          <?php endif ?>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Plan de compensación</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      
    <?php 


      include "modulos/plan-compensacion/diapositivas.php";

      include "modulos/plan-compensacion/videos.php";


     ?>

    </div>

  
  </section>
  <!-- /.content -->

</div>





<!--=====================================
Cambiar Niveles Comisiones
======================================-->

<!-- The Modal -->
<div class="modal" id="modalCambiarNiveles">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form method="post">

	      <!-- Modal Header -->
<div class="modal-header bg-primario text-white">
	        <h4 class="modal-title">Cambiar niveles</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
	        
			<div class="form-group">
				
				<input type="number" class="form-control" placeholder="Nivel" name="nivel" min="1" max="6" required>

			</div>

      <div class="form-group">
				
				<input type="number" class="form-control" placeholder="Porcentaje de ganancia" name="porcentajeNivel" min="1" max="50" required>

			</div>

	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">

	      	<div>
	        	
	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

	        </div>

        	<div>
	        	
	        	<button type="submit" class="btn bg-primario text-white">Enviar</button>
	        </div>

	      </div>




      </form>

    </div>
  </div>
</div>