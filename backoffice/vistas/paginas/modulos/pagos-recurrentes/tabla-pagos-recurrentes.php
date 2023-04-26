<input type="hidden" value="<?php echo $usuario["enlace_afiliado"]; ?>" id="enlace_afiliado">
<input type="hidden" value="<?php echo $usuario["id_usuario"]; ?>" id="id_usuario">


<div class="card card-info card-outline">

	<div class="card-header">
		
		<h3 class="card-title p-3">
			<i class="fas fa-table mr-1"></i>		
			Tabla bonos recurrentes por pagar
		</h3>

		<button type="button" class="btn btn-default btn-sm checkbox-toggle5">
                	<i class="far fa-square"></i>
        	</button>

			<button type="button" class="btn btn-default btn-sm btnPagos" data-toggle="tooltip" idPagos tipoPago="recurrencia">
							 PAGAR SELECCIONADOS
		    </button>

	</div>

	<div class="card-body p-3 seleccionarPagos">
		
		<table class="table table-bordered table-striped dt-responsive tabla-pagar-recurrencia" width="100%">
			
			<thead>

				<tr> 
				    <th style="width:10px">#</th>
					<th>Seleccionar</th> 
				    <th>Acciones</th>
					<th>ID</th>
					<th>Documento</th>
					<th>Nombre</th>
					<th>País</th>
					<th>Teléfono</th>
					<th>Entidad bancaria</th>				   
					<th>Cuenta bancaria</th>					
					<th>Tipo cuenta</th>
					<th>Inversiones</th>
					<th>Fecha retorno</th>
					<th>Total a pagar</th>

				</tr>   

			</thead>

			<tbody>


			</tbody>

		</table>

	</div>



</div>