<input type="hidden" value="<?php echo $usuario["enlace_afiliado"]; ?>" id="enlace_afiliado">
<input type="hidden" value="<?php echo $usuario["id_usuario"]; ?>" id="id_usuario">


<div class="card card-info card-outline">

	<div class="card-header">
		
		<h3 class="card-title p-3">
			<i class="fas fa-table mr-1"></i>		
			Tabla de Ingresos Crypto
		</h3>

	</div>

	<?php 
// $estimado_binance=ControladorUsuarios::binance();
$estimado_binance=0;
 ?>

	<div class="card-body">
		
		<table class="table table-bordered table-striped dt-responsive tabla-ingresos-inversiones2" width="100%">
			
			<thead>

				<tr>

					<th style="width:10px">#</th> 
					<th>Tipo Movimiento / Valor</th>
					<th>Entidad cuenta</th>
					<th>Número cuenta</th>
					<th>Crypto Tipo cuenta</th>					   
					<th>Fecha</th>			
					<th>Importe</th>		
					<th>Precio en Dolar</th>		
					<th>Precio en Cop</th>				

				</tr>   

			</thead>

			<tbody>

				<tr>
					
					<td>1</td> 
					<td><small class='text-success mr-1'><i class='fas fa-arrow-up'></i></small><?php echo number_format($estimado_binance,1) ?></td>
					<td>Binance</td>
					<td>43928902</td> 
					<td>BTC</td>				  		
					<td>2023-06-05</td>
					<td>1</td>
					<td>31,110</td>
					<td>129,888,798</td>

				</tr>


			</tbody>

		</table>

	</div>



</div>