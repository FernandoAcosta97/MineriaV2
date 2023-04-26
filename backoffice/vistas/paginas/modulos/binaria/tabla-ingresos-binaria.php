<!-- <input type="hidden" value="<?php echo $usuario["enlace_afiliado"]; ?>" id="enlace_afiliado"> -->
<input type="hidden" value="<?php echo $usuario["id_usuario"]; ?>" id="id_usuario">


<div class="card card-info card-outline">

	<div class="card-header">
		
		<h3 class="card-title p-3">
			<i class="fas fa-table mr-1"></i>		
			Tabla de Ingresos comisiones
		</h3>

	</div>

	<div class="card-body">
		
		<table class="table table-bordered table-striped dt-responsive tabla-ingresos-comisiones" width="100%">
			
			<thead>

				<tr>

					<th style="width:10px">#</th> 
					<th>Estado</th>
					<th>Detalle</th>
					<th>ID</th>
					<th>Entidad cuenta</th>
					<th>Número cuenta</th>
					<th>Tipo Cuenta</th>				
					<th>Fecha pago</th>

				</tr>   

			</thead>

			<tbody>

			</tbody>

		</table>

	</div>



</div>




<!--=====================================
VER DETALLES PAGO COMISIONES
======================================-->

<!-- The Modal -->
<div class="modal" id="modalVerComisiones">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Detalles comisiones</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">


		  <table class="table table-bordered table-striped dt-responsive tabla-detalles-comisiones" width="100%">
			
			<thead>

				<tr>

					<th style="width:10px">#</th> 
					<th>Documento</th>
					<th>Nombre</th>
					<th>País</th>
					<th>Teléfono</th>
					<th>Total</th>			
					<th>Nivel</th>

				</tr>   

			</thead>

			<tbody>

			</tbody>

		</table>




	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">

	      	<div>

	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

	        </div>

	      </div>

    </div>
  </div>
</div>