<input type="hidden" value="<?php echo $usuario["enlace_afiliado"]; ?>" id="enlace_afiliado">
<input type="hidden" value="<?php echo $usuario["id_usuario"]; ?>" id="id_usuario">


<div class="card card-info card-outline">

	<div class="card-header">
		
		<h3 class="card-title p-3">
			<i class="fas fa-table mr-1"></i>		
			Tabla bonos extras por pagar
		</h3>

		<button type="button" class="btn btn-default btn-sm checkbox-toggle4">
                	<i class="far fa-square"></i>
        	</button>

			<button type="button" class="btn btn-default btn-sm btnPagos" data-toggle="tooltip" idPagos tipoPago="bonos">
							 PAGAR SELECCIONADOS
		    </button>

	</div>

	<div class="card-body p3 seleccionarPagos">
		
		<table class="table table-bordered table-striped dt-responsive tabla-pagar-extras" width="100%">
			
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
					<th>Referidos obtenidos</th>
					<th>Entidad Bancaria</th>
					<th>Cuenta Bancaria</th>
					<th>Tipo Cuenta</th>
					<th>Total a pagar</th>

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





<!--=====================================
VER DETALLES PAGO BONOS
======================================-->

<!-- The Modal -->
<div class="modal" id="modalVerBonos">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

	      <!-- Modal Header -->
<div class="modal-header bg-primario text-white">	        <h4 class="modal-title">Detalles bonos extras</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">


		  <table class="table table-bordered table-striped dt-responsive tabla-detalles-bonos" width="100%">
			
			<thead>

				<tr>

					<th style="width:10px">#</th> 
					<th>Documento</th>
					<th>Nombre</th>
					<th>País</th>
					<th>Teléfono</th>
					<th>Total bono</th>			

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