<input type="hidden" value="<?php echo $usuario["enlace_afiliado"]; ?>" id="enlace_afiliado">
<input type="hidden" value="<?php echo $usuario["id_usuario"]; ?>" id="id_usuario">


<div class="card card-info card-outline">

	<div class="card-header">
		
		<h3 class="card-title p-3">
			<i class="fas fa-table mr-1"></i>		
			Tabla ordenes por pagar
		</h3>

		<button type="button" class="btn btn-default btn-sm checkbox-toggle6">
                	<i class="far fa-square"></i>
        	</button>

			<button type="button" class="btn btn-default btn-sm btnPagos" data-toggle="tooltip" idPagos tipoPago="retiros">
							 PAGAR SELECCIONADOS
		    </button>

	</div>

	<div class="card-body p-3 seleccionarPagos">
		
		<table class="table table-bordered table-striped dt-responsive tabla-pagar-retiros" width="100%">
			
			<thead>

				<tr> 
				    <th style="width:10px">#</th>
					<th style="width:10px">Seleccionar</th> 
				    <th>Acciones</th>
					<th>ID</th>
					<th>Total a pagar</th>
					<th>Documento</th>
					<th>Nombre</th>
					<th>País</th>
					<th>Teléfono</th>
					<th>Entidad bancaria</th>				   
					<th>Cuenta bancaria</th>					
					<th>Tipo cuenta</th>
					<th>Fecha orden</th>

				</tr>   

			</thead>

			<tbody>

				<!-- <tr>
					
					<td>1</td> 
					<td>LM46YZQVHWW74</td>
					<td>Jaime Carrillo</td>
					<td>tutorialesatualcance-buyer@hotmail.com</td>
					<td>2019-06-19 a 2019-07-19</td> 
					<td>$ 14,345</td>			  
					<td>$ 16,300</td>			
					<td>2019-07-19</td>
					<td>
						<h5><span class="badge badge-success">Pagada</span></h5>
					</td>

				</tr> -->


			</tbody>

		</table>

	</div>



</div>